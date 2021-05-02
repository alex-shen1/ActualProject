<!-- Note: This is neccessary for GCP -->
<?php
//echo @parse_url($_SERVER['REQUEST_URI'])['path'];
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
    case '/dashboard.php':
        require './dashboard.php';
        break;
    case '/meals.php':
        require './meals.php';
        break;
    case '/shopping-list.php':
        require './shopping-list.php';
        break;
    case '/db-test':
        require './db-exercise.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}
