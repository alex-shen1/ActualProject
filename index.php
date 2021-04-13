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

  <div class="overlay"></div>

  <div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-12 my-auto">
          <div class="masthead-content text-white py-5 py-md-0">
            <h1 class="mb-3">Fridgin'Cool: Your Daily Meal Planner</h1>
            <h5>Alex Shen (as5gd) and Jennifer Long (rz5sc)</h5>
            <p class="mb-5">Login to access your meals and recipes: </p>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

              <div class="input-group input-group-newsletter">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="addon-wrapping">@</span>
                </div>
                <input type="email" name="email" class="form-control"
                       placeholder="Email address" autofocus required
                       aria-label="Email" aria-describedby="addon-wrapping">
              </div>

              <div class="input-group input-group-newsletter">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="addon-wrapping">
                    <i class="fa fa-lock"></i>
                  </span>
                </div>
                <input type="password" name="password" class="form-control"
                       placeholder="Password" autofocus required
                       aria-label="Password" aria-describedby="addon-wrapping">
              </div>
              <div class="input-group input-group-newsletter">
                <input id="loginButton" type="submit" value="Login"
                       class="btn btn-block btn-secondary"/>
              </div>

              <?php
              authenticate();
              ?>

            </form>


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


  <?php
  function authenticate()
  {
      // Valid credentials are password"
      // Hash generated with: echo password_hash('password',PASSWORD_BCRYPT);
      $hash = '$2y$10$yLagqKxgUQlIk71elu8TWOyCTAEe.iFtOn/GkCPCMPCB9D1HjkeTq';

      if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email']) && isset($_POST['password'])) {
          // Check if field exists before access
          $email = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['password']);
          if (password_verify($password, $hash)) {
              // Set session variables
              $_SESSION['email'] = $_POST['email'];
              $_SESSION['pwd'] = $_POST['password'];
              header('Location: dashboard.php');
          } else {
              echo '
          <div class="my-5 w-100">
          <div class="alert alert-danger" role="alert">Email or password does not match our record.</div>
          </div>';
          }
      }

  }
  ?>

</body>

</html>
