<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'common/head-content.php';?>

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/landing.css" rel="stylesheet">
</head>


<body>
  <?php session_start(); ?>

  <?php
  if (isset($_SESSION) && isset($_SESSION['pwd']) && isset($_SESSION['email'])) {
      // header("Location: dashboard.php");
      echo "<script>window.location = 'dashboard.php';</script>";
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
            <h5>Alex Shen (as5gd) and Jennifer Long (rz5sc)</h5>
            <p class="mb-5">Login to access your meal planner and recipes</p>

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

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

              <!-- Number of login attempts so far (hidden) -->
              <input type="hidden" name="attempt"
                     value="<?php if (isset($_POST['attempt'])) echo $_POST['attempt'] + 1; else echo 1 ?>">
              <!-- Login button disabled on third failed attempt -->
              <div class="input-group input-group-newsletter">
                <input id="loginButton" type="submit" value="Login"
                       class="btn btn-block btn-secondary"
                       <?php if (isset($_POST['attempt']) && $_POST['attempt'] >= 3) echo 'disabled' ?>/>
              </div>

              <?php echo "Login attempts:" ?>
              <?php if (isset($_POST['attempt'])) echo $_POST['attempt']; else echo "0" ?>
              <?php authenticate(); ?>

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
      // Valid credentials are any username with password "password"
      // Hash generated with: echo password_hash('password',PASSWORD_BCRYPT);
      $hash = '$2y$10$yLagqKxgUQlIk71elu8TWOyCTAEe.iFtOn/GkCPCMPCB9D1HjkeTq';

      if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['email'], $_POST['password'])) {
          // Check if field exists before access
          $email = htmlspecialchars($_POST['email']);
          $password = htmlspecialchars($_POST['password']);

          foreach ($_POST as $k => $v)
            echo "<br/> $k : $v";

          if (password_verify($password, $hash)) {
              // Set session variables
              $_SESSION['email'] = $email;
              $_SESSION['pwd'] = $password;
              // header('Location: dashboard.php');
              echo "<script>window.location = 'dashboard.php';</script>";
              echo 'Redirect failed';
          }
          // Disable login on 3 failed attempts
          else if (isset($_POST['attempt']) && $_POST['attempt'] >= 3) {
              echo '
                <div class="my-5 w-100">
                    <div class="alert alert-danger" role="alert">
                    You have attempted to login 3 times unsuccessfully. We have locked your ability to log in.
                    </div>
                </div>';
          }
          // Display message if password does not match
          else {
              echo 'bad password';
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
