<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'common/head-content.php';?>
  <style></style>
</head>

<body>
  <?php require 'common/login-session.php';?>

  <?php
  require('connect-db.php');  // connect to DB
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['id_to_delete'])) {
          global $db;
          echo "TO DELETE: " . $_POST['id_to_delete'];
          $query = "DELETE FROM meals
              WHERE id = :id";
          $statement = $db -> prepare($query);
          $statement -> bindValue(':id', $_POST['id_to_delete']);
          $statement -> execute();

          $results = $statement -> fetchAll();

          $statement -> closeCursor();
      }
      echo "TITLE: " . $_POST['meal_title'];
      echo "<br>";
      if ($_POST['meal_title'] == '') {
          echo "MEAL TITLE EMPTY <br>";
      } elseif ($_POST['ingredients'] == '') {
          echo "INGREDIENTS EMPTY";
      } else {
          $meal_title = $_POST['meal_title'];
          $num_servings = $_POST['num_servings'];
          $ingredients = $_POST['ingredients'];
          $instructions = $_POST['instructions'];
  //        $ingredients = str_replace("\n", "<br>", $_POST['ingredients']);
  //        $instructions = str_replace("\n", "<br>", $_POST['instructions']);
          insertMeal($meal_title, $num_servings, $ingredients, $instructions);
      }

      echo str_replace("\n", "<br>", $_POST['instructions']);
  }

  function insertMeal(string $meal_title, int $num_servings, string $ingredients, string $instructions)
  {
      global $db;

      $query = "INSERT INTO meals
  VALUES (:title, :num_servings, :ingredients, :instructions, :user_email, uuid())";

      $statement = $db->prepare($query);
      $statement->bindValue(':title', $meal_title);
      $statement->bindValue(':num_servings', $num_servings);
      $statement->bindValue(':ingredients', $ingredients);
      $statement->bindValue(':instructions', $instructions);
      $statement->bindValue(':user_email', 'root@test.com');
      $statement->execute();

      $statement->closeCursor();
  }

  function getMeals()
  {
      global $db; // Name needs to match connect-db.php
      $query = "SELECT * FROM meals";
      $statement = $db->prepare($query);
      $statement->execute();

      $results = $statement->fetchAll();

      $statement->closeCursor();

      echo "TYPE OF \$RESULTS: " . gettype($results);

      foreach ($results as $result) {
          echo '<div class="col-4">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">' . $result['title'] . '</h5>
                      <p class="card-text">Ingredients: ' . $result['ingredients'] . '</p>
                      <form method="POST" action="meals.php">
                      <input type="hidden" name="id_to_delete" value="' . $result['id'] . '" />
                      <button type="submit" class="btn btn-primary bg-radish">
                          <i class="fas fa-trash" aria-hidden="true"></i>
                      </button>
                      </form>
                  </div>
              </div>
          </div>';

  //        editMeal($result['title'],$result['num_servings'], $result['ingredients'], $result['instructions'], $result['id']);
      }
  }
?>

<?php include 'common/navbar.php';?>

<div id="content" class="container py-5">
    <div class="row py-4">
      <div class="col d-flex justify-content-between">
        <h2 id="pageHeader">My Meals</h2>
        <form method="GET" action="./meals.php">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Filter by</label>
              </div>
              <select class="form-control" id="filterOptions" name="filteroptions">
                  <option value = "all"
                    <?php if (isset($_GET['filteroptions']) && $_GET['filteroptions'] == "all") echo "selected"; ?>
                    >All</option>
                  <option value = "breakfast"
                    <?php if (isset($_GET['filteroptions']) && $_GET['filteroptions'] == "breakfast") echo "selected"; ?>
                    >Breakfast</option>
                  <option value = "lunch"
                    <?php if (isset($_GET['filteroptions']) && $_GET['filteroptions'] == "lunch") echo "selected"; ?>
                    >Lunch</option>
                  <option value = "dinner"
                  <?php if (isset($_GET['filteroptions']) && $_GET['filteroptions'] == "dinner") echo "selected"; ?>
                    >Dinner</option>
                  <option value = "snack"
                    <?php if (isset($_GET['filteroptions']) && $_GET['filteroptions'] == "snack") echo "selected"; ?>
                    >Snack</option>
              </select>
              <div class="input-group-append">
                <button type="submit" class="btn btn-success">Go</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <?php echo "Filtering by" ?>
    <span class="font-weight-bold">
      <?php if (isset($_GET['filteroptions'])) echo $_GET['filteroptions']; else echo "all" ?>
    </span>

    <div class="row py-4">
                <?php getMeals(); ?>
        <!--        <div class="col-4">-->
        <!--            <div class="card">-->
        <!--                <div class="card-body">-->
        <!--                    <h5 class="card-title">Mac & Cheese</h5>-->
        <!--                    <p class="card-text">Ingredients: Mac, Cheese, Butter, Milk</p>-->
        <!--                    <a href="#" class="btn btn-primary bg-radish">-->
        <!--                        <i class="fas fa-edit" aria-hidden="true"></i>-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="col-4">-->
        <!--            <div class="card">-->
        <!--                <div class="card-body">-->
        <!--                    <h5 class="card-title">Broccoli Stir-Fry</h5>-->
        <!--                    <p class="card-text">Ingredients: Broccoli, Olive oil, Soy sauce</p>-->
        <!--                    <a href="#" class="btn btn-primary bg-radish">-->
        <!--                        <i class="fas fa-edit" aria-hidden="true"></i>-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="col-4">-->
        <!--            <div class="card">-->
        <!--                <div class="card-body">-->
        <!--                    <h5 class="card-title">Mashed Potatoes</h5>-->
        <!--                    <p class="card-text">Ingredients: Potatoes, Butter, Milk</p>-->

        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end">
            <a class="display-3 text-radish" data-toggle="modal" data-target="#mealCreateModal">
                <i class="fas fa-plus-circle" data-toggle="tooltip" data-placement="bottom" title="Add a recipe"></i>
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="mealCreateModal" tabindex="-1" aria-labelledby="mealCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mealCreateLabel">Add a recipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="./meals.php">
                    <div class="form-group">
                        <label for="RecipeTitle">Recipe Title</label>
                        <input type="text" class="form-control" id="RecipeTitle" placeholder="Recipe Title"
                               name="meal_title">
                    </div>
                    <div class="form-group">
                        <label for="NumServings">Number of servings</label>
                        <select class="form-control" id="NumServings" name="num_servings">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Ingredients">Ingredients</label>
                        <textarea class="form-control" id="Ingredients" rows="3" name="ingredients"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Recipe">Recipe Instructions</label>
                        <textarea class="form-control" id="Recipe" rows="3" name="instructions"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save recipe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'common/footer.php';?>

<!--SCRAPPED CODE-->
<?php
//function editMeal(string $meal_title, int $num_servings, string $ingredients, string $instructions, string $id)
//{
////<!-- Modal for creating new meals -->
//    echo '<div class="modal fade" id="mealCreateModal' . $id . '" tabindex=" - 1" aria-labelledby="mealCreateLabel" aria-hidden="true">
//    <div class="modal - dialog">
//        <div class="modal - content">
//            <div class="modal - header">
//                <h5 class="modal - title" id="mealCreateLabel">Add a recipe</h5>
//                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                    <span aria-hidden="true">&times;</span>
//                </button>
//            </div>
//            <div class="modal - body">
//                <form method="POST" action=" ./meals . php">
//                    <div class="form - group">
//                        <label for="RecipeTitle">Recipe Title</label>
//                        <input type="text" class="form - control" id="RecipeTitle" placeholder="Recipe Title" value="' . $meal_title . '"
//                               name="meal_title">
//                    </div>
//                    <div class="form - group">
//                        <label for="NumServings">Number of servings</label>
//                        <select class="form - control" id="NumServings" name="num_servings" value="' . $num_servings . '">
//                            <option>1</option>
//                            <option>2</option>
//                            <option>3</option>
//                            <option>4</option>
//                            <option>5</option>
//                        </select>
//                    </div>
//                    <div class="form - group">
//                        <label for="Ingredients">Ingredients</label>
//                        <textarea class="form - control" id="Ingredients" rows="3" name="ingredients" value="' . $ingredients . '"></textarea>
//                    </div>
//                    <div class="form - group">
//                        <label for="Recipe">Recipe Instructions</label>
//                        <textarea class="form - control" id="Recipe" rows="3" name="instructions" value="' . $instructions . '"></textarea>
//                    </div>
//                    <div class="modal - footer">
//                        <button type="button" class="btn btn - secondary" data-dismiss="modal">Cancel</button>
//                        <button type="submit" class="btn btn - success">Save recipe</button>
//                    </div>
//                </form>
//            </div>
//        </div>
//    </div>
//</div>';
//}

//editMeal('', 1, '', '', '');
?>

<!-- Bootstrap core JavaScript -->
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

<script>
    // Initialize tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    // For input autofocus in the modal
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>

</body>

</html>
