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
      <h2 id="pageHeader">My Account</h2>
      <div class="row py-4">
        <div class="col">

          <div class="card">
            <div class="card-header">
              Account Information
            </div>

            <div class="card-body">
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4"
                    value="<?php echo $_SESSION['email']?>" disabled>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" value="********" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                  <label for="inputAddress2">Address 2</label>
                  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                      <option selected>Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
              </form>
            </div>
          </div>

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
