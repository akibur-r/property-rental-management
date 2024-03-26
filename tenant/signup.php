<?php
session_start();
  include("../connection.php");
  include("../functions.php");

  if($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $error = "";

    if(!empty($username) && 
      !empty($password) && 
      !is_numeric($username) && 
      !is_numeric($name) && 
      !empty($name)) {
      //no empty input given
      $query = " INSERT INTO tenant (tenant_username, tenant_password, tenant_name) VALUES('$username', '$password', '$name') ";

      $select = "SELECT * FROM tenant WHERE tenant_username = '$username'";

      $result = mysqli_query($con, $select);
      
      if(mysqli_num_rows($result) > 0) {
        $error = "User already exists";
      }
      else {
        $error = "This feature is Coming Soon";
      }
    }
    else {
      $error = "Invalid information";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/signup.css" />
    <title>PRMS | Register as Tenant</title>
  </head>
  <body class="bg-dark">
    <div class="container flex-y">
      <nav class="navbar flex-x">
        <span class="navbar__logo"
          ><a href="../index.php"
            ><img src="../resources/images/logo-light.png" alt="LOGO" /></a
        ></span>
        <span class="navbar__text"
          ><a href="../landlord/signup.php" class="txt-accent-blue"
            >Landlord Login</a
          ></span
        >
      </nav>

      <div class="form-container flex-y fs-400 txt-white">
        <div class="form-container__header fw-500"></div>
        <form action="" method="post" class="form grid bg-light-dark">
          <div class="form__title fw-500">Register as Tenant</div>
          <label for="name">Name</label>
          <input type="text" name="name" class="bg-dark" />

          <label for="username">Choose Username</label>
          <input type="text" name="username" class="bg-dark" />

          <label for="password">Choose Password</label>
          <input type="password" name="password" class="bg-dark" />

          <input
            type="submit"
            value="Register"
            class="bg-accent-blue txt-dark"
          />
          <p class="error-msg">
            <?php
              if(!empty($error)) {
                echo '<span>'.$error.'</span>';
              }
            ?>
          </p>
        </form>
        <div class="form-container__footer">
          Already signed up?
          <a href="login.php" class="txt-accent-blue">Login</a>
        </div>
      </div>
    </div>
  </body>
</html>
