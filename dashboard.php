<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Meal Planning Web Application" />
        <meta name="author" content="Jennifer Long, Alex Shen" />
        <title>Fridgin'Cool</title>

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Stylesheets (includes Bootstrap)-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="css/styles.css" rel="stylesheet" />

        <style>
        </style>
    </head>
    <body>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Fridgin'Cool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mr-auto">
            <a class="nav-link active" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="meals.php">Meals</a>
            <a class="nav-link" href="shopping-list.php">Shopping List</a>
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Planner (TBD)</a>
          </div>
          <div class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                 role="button" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false">
                Settings
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item disabled" href="#">My Account (TBD)</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </div>
        </div>
      </nav>

      <div id="content" class="container py-5">
        <h2 id="pageHeader">My Dashboard</h2>
        <div class="row py-4">
          <div class="col-4">
            <div class="card">
              <div class="card-header">
                Today's Meals
              </div>
              <div class="card-body">
                <h5 class="card-title">Breakfast</h5>
                <p class="card-text">Mac & Cheese</p>
                <h5 class="card-title">Lunch</h5>
                <p class="card-text">Mac & Cheese</p>
                <h5 class="card-title">Snack</h5>
                <p class="card-text">Mac & Cheese</p>
                <h5 class="card-title">Dinner</h5>
                <p class="card-text">Mac & Cheese</p>
                <a href="#" class="btn btn-primary bg-radish">
                  <i class="fas fa-edit" aria-hidden="true"></i> Edit meals
                </a>
              </div>
            </div>
          </div>
          <div class="col-8">
            <a href="meals.php" class="btn btn-info btn-lg btn-block bg-coral">
              My meals
            </a>
            <button type="button" class="btn btn-danger btn-lg btn-block bg-radish">
              Plan meals
            </button>
            <a href="shopping-list.php" class="btn btn-secondary btn-lg btn-block">
              View Shopping List
            </a>
          </div>
        </div>
      </div>

      <footer class="primary-footer bg-dark text-white">
        <small class="copyright">&copy; 2021 Jennifer Long (rz5sc), Alex Shen (as5gd)</small>
      </footer>

      <!-- Bootstrap core JavaScript -->
      <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

    </body>

</html>
