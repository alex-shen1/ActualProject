<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'common/head-content.php';?>
    <style></style>
  </head>


  <body>
    <?php require 'common/login-session.php';?>

    <?php include 'common/navbar.php';?>

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
          <a href="http://localhost:4200?session=<?php echo session_id()?>" class="btn btn-danger btn-lg btn-block bg-radish">
            Plan meals
          </a>
          <a href="shopping-list.php" class="btn btn-secondary btn-lg btn-block">
            View Shopping List
          </a>
        </div>
      </div>
    </div>

    <?php include 'common/footer.php';?>

    <!-- Bootstrap core JavaScript -->
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

  </body>

</html>
