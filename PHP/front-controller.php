<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

session_start();

// front controller necessary for GCP

switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':                   // URL (without file name) to a default screen
        require './index.php';
        break;
    case '/index.php':     // if you plan to also allow a URL with the file name
        require './index.php';
        break;
    case '/logout.php':
        require './logout.php';
        break;
    case '/my-account.php':
        require './my-account.php';
        break;
    case '/dashboard.php':
        require './dashboard.php';
    case '/dashboard.html':
        require './dashboard.html';
        break;
    case '/meals.php':
        require './meals.php';
        break;
    case '/shopping-list.php':
        require './shopping-list.php';
        break;
    case '/planner-backend.php':
        require './planner-backend.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}
