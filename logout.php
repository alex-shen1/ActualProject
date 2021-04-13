<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Meal Planning Web Application" />
  <meta name="author" content="Jennifer Long, Alex Shen" />
  <title>Fridgin'Cool - Daily Meal Planner</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link href="css/landing.css" rel="stylesheet">

</head>


<body>
  <!-- Built-in PHP session manager: https://www.php.net/manual/en/function.session-start.php -->
  <?php session_start(); ?>

  <?php
  if (!isset($_SESSION) || !isset($_SESSION['pwd']) || !isset($_SESSION['email'])) {
      header("Location: index.php");
  }
  ?>

  <div class="overlay"></div>

  <div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-12 my-auto">
          <div class="masthead-content text-white py-5 py-md-0">
            <h1 class="mb-3">Fridgin'Cool: Your Daily Meal Planner</h1>
            <p class="mb-5">You have successfully logged out.</p>
            <p><a class="mb-5 text-danger" href="index.php">Back to home page</a></p>

            <div id="sessionInfo">
              <hr/>
              $_SESSION (<?php echo session_id() ?>) contained:<br/>
              <?php
                foreach ($_SESSION as $k => $v)
                  echo "$k : $v <br/>";
              ?>
            </div>

            <div id="logout">
              <hr/>
              <?php
              if (count($_SESSION) > 0)
              {
                foreach ($_SESSION as $k => $v)
                {
                  unset($_SESSION[$k]); // removes items on server-side
                }
                session_destroy();
                echo "sessionID = " . session_id() . "<br/>";
                setcookie("PHPSESSID", "", time()-3600, "/"); // removes items on client-side
              }
              ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="social-icons">
    <ul class="list-unstyled text-center mb-0">
      <li class="list-unstyled-item">
        <a href="https://github.com/alex-shen1/FridginCool">
          <i class="fab fa-github"></i>
        </a>
      </li>
    </ul>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</body>

</html>
