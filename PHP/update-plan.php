<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');

// Converts it into a PHP object
    $postdata = json_decode($json);

    $data = [];
    foreach ($postdata as $field) {
        array_push($data, $field);
        echo $field;
    }
// expected order: session, day, mealtime, meal_name

    $session = $data[0];
    $day = $data[1];
    $mealtime = $data[2];
    $meal_name = $data[3];

    session_write_close();
    session_id($session);
    session_start();
    if(isset($_SESSION['email'])) {

        require('connect-db.php');
//if (isset($_SESSION['email'])) {
//    $email = $_SESSION['email'];

        $email = $_SESSION['email'];

        global $db; // Name needs to match connect-db.php
        $query = "DELETE FROM scheduled_meals WHERE user_email = :user_email AND day = :day AND mealtime = :mealtime";
        $statement = $db->prepare($query);
        $statement->bindValue(':user_email', $email);
        $statement->bindValue(':day', $day);
        $statement->bindValue(':mealtime', $mealtime);
        $statement->execute();
        $statement->closeCursor();

        if($meal_name !== "--") {
            $query = "INSERT INTO scheduled_meals VALUES (:user_email, :day, :mealtime, :meal_title)";
            $statement = $db->prepare($query);
            $statement->bindValue(':user_email', $email);
            $statement->bindValue(':day', $day);
            $statement->bindValue(':mealtime', $mealtime);
            $statement->bindValue(':meal_title', $meal_name);
            $statement->execute();
            $statement->closeCursor();
            echo "Value inserted";
        }
        else{
            echo "Meal deleted";
        }
    }
//}
}
else {
    echo "ERROR: Expected a POST request";
}

