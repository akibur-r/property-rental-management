<?php
session_start();
  include("../connection.php");
  include("../functions.php");

  $page_id = "tenant login";

  if($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];
    $error = "";

    if(!empty($username) && !empty($password)) {
      //no empty input given

      $select = "SELECT * FROM tenant WHERE tenant_username = '$username'";

      $result = mysqli_query($con, $select);
      
      if(mysqli_num_rows($result) > 0) {
        
        $user_data = mysqli_fetch_assoc($result);
        if($password===$user_data['tenant_password']) {
          $_SESSION['username'] = $username;
        
          header('location:dashboard.php');
        }
        else {
          $error = "Incorrect Password!";
        }
      }
      else {
        $error = "User not found";
      }


    }
    else {
      $error = "Please enter valid information";
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
    <link rel="stylesheet" href="../css/login.css" />
    <title>PRMS | Login as Tenant</title>
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
          <div class="form__title fw-500">Login as Tenant</div>
          <label for="username">Username</label>
          <input type="text" name="username" class="bg-dark" />

          <label for="password">Password</label>
          <input type="password" name="password" class="bg-dark" />

          <input type="submit" value="Login" class="bg-accent-blue txt-dark" />
          <p class="error-msg">
            <?php
              if(!empty($error)) {
                echo '<span>'.$error.'</span>';
              }
            ?>
          </p>
        </form>
        <div class="form-container__footer">
          Didn't sign up yet?
          <a href="signup.php" class="txt-accent-blue">Register</a>
        </div>
      </div>
    </div>
  </body>
</html>
