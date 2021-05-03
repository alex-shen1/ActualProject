<?php
if(isset($_POST['session'])) {
    session_id($_POST['session']);
    echo "hi";
}
session_start();
require('connect-db.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
// Angular frontend should make a POST request to this endpoint with the session ID
echo session_id() . "\n";
$email = "*";
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}

//echo "email is " . $email ;
global $db; // Name needs to match connect-db.php
//$query = "SELECT * FROM meals WHERE user_email = :user_email";
$query = "SELECT * FROM meals";//" WHERE user_email = :user_email";
$statement = $db->prepare($query);
$statement->bindValue(':user_email', $email);
$statement->execute();

$results = $statement->fetchAll();

$statement->closeCursor();

$meal_titles = [];
foreach ($results as $result){
    array_push($meal_titles, $result['title']);
}

// combines all titles into comma-separated string
echo implode(',',$meal_titles);
