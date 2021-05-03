<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

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

session_id($session);
session_start();

require('connect-db.php');
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    //echo "email is " . $email ;
    global $db; // Name needs to match connect-db.php
    $query = "SELECT * FROM meals WHERE user_email = :user_email";
//    $query = "SELECT * FROM meals";//" WHERE user_email = :user_email";
    $statement = $db->prepare($query);
    $statement->bindValue(':user_email', $email);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closeCursor();

    $meal_titles = [];
    foreach ($results as $result) {
        array_push($meal_titles, $result['title']);
    }

// combines all titles into comma-separated string
    echo implode(',', $meal_titles);
}


