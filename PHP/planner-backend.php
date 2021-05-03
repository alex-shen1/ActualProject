<?php
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
//header('Access-Control-Max-Age: 1000');
//header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

$json = file_get_contents('php://input');

// Converts it into a PHP object
$postdata = json_decode($json);

$data = [];
foreach ($postdata as $field) {
    array_push($data, $field);
}

//$email = $data[0];
$session = $data[0];

//echo $email;
//echo $session;

session_write_close();
session_id($session);
session_start();

require('connect-db.php');
if (isset($_SESSION['email'])) {
    // will be converted into a JSON
    $return_data = new stdClass();

    $email = $_SESSION['email'];

    global $db; // Name needs to match connect-db.php
    $query = "SELECT * FROM meals WHERE user_email = :user_email";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_email', $email);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    // There's probably a better way to do this. Too bad!
    $meal_titles = [];
    foreach ($results as $result) {
        array_push($meal_titles, $result['title']);
    }
    // Combine all titles into comma-separated string
    $return_data->mealnames = implode(',', $meal_titles);

    //---------------------- SCHEDULED MEALS ----------------------
    $query = "SELECT * FROM scheduled_meals WHERE user_email = :user_email";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_email', $email);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    $arranged_plan = createEmptyPlan();
    foreach ($results as $entry){
        $day = $entry['day'];
        $mealtime = $entry['mealtime'];
        $meal_title = $entry['meal_title'];

        $arranged_plan[$day][$mealtime] = $meal_title;
    }
//    echo print_r($arranged_plan);
//    echo json_encode($arranged_plan);
    $return_data->plan = $arranged_plan;

    echo json_encode($return_data);

//    echo $return_data->mealnames;
}

function createEmptyPlan(){
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $mealtimes = ['Breakfast', 'Lunch', 'Snack', 'Dinner'];
    $plan = [];
    foreach($days as $day){
        $plan[$day] = array();
        foreach($mealtimes as $mealtime){
            $plan[$day][$mealtime] = 'None';
        }
    }

    return $plan;
}


