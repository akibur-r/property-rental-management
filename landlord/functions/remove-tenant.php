<?php
session_start();
  include("../../connection.php");
  include("../../functions.php");

  $page_id = "landlord remove tenant";
  $user_data = check_login($con, $page_id);

  $landlord_username = $user_data['username'];
  $landlord_password = $user_data['password'];

  $error = "";

  if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $tenant_username = $_POST['username'];  
    $password = $_POST['password'];  

    if(empty($tenant_username) || empty($password)) {
      $error = "Fields can't be empty";
    }
    else {
      $select = "SELECT * FROM tenant WHERE tenant_username = '$tenant_username'";
      $result = mysqli_query($con, $select);

      if(!$result || mysqli_num_rows($result) <= 0) {
        //tenant not found
        $error = "Tenant not Found";
      }
      else {
        if($landlord_password === $password) {
          //password matched
          $property_query = "SELECT * FROM property WHERE property_owner = '$landlord_username'";
          $result = mysqli_query($con, $property_query);
          
          $property = mysqli_fetch_assoc($result);
          $property_name = $property['property_name'];

          $property_query = "UPDATE property SET property_status = 0 WHERE property_name = '$property_name' && property_owner = '$landlord_username'";
          mysqli_query($con, $property_query);

          $query = "DELETE FROM tenant WHERE tenant_username = '$tenant_username'";
          mysqli_query($con, $query);

          header('location: ../dashboard.php');
        }
        else {
          $error = "Incorrect Password";
        }
      }
    }
    
  }
  

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/main.css" />
    <link rel="stylesheet" href="../../css/form.css" />
    <link rel="stylesheet" href="../../css/remove-property.css" />
    <title>PRMS | Remove Property</title>
  </head>
  <body class="bg-dark">
    <div class="container flex-y">
      <nav class="navbar flex-x">
        <span class="navbar__logo"
          ><a href="../dashboard.php"
            ><img src="../../resources/images/logo-light.png" alt="LOGO" /></a
        ></span>
        <span class="navbar__text">
          <a href="../../index.php" class="txt-accent-blue">Logout as
            <?php echo $landlord_username; ?>
          </a>
        </span>
      </nav>

      <div class="form-container flex-y fs-400 txt-white">
        <div class="form-container__header fw-500"></div>
        <form action="" method="post" class="form grid bg-light-dark">
          <div class="form__title fw-500">Remove Tenant</div>
          <label for="username">Tenant Username</label>
          <input type="text" name="username" class="bg-dark" />

          <label for="password">Password</label>
          <input type="password" name="password" class="bg-dark" />

          <input
            type="submit"
            value="Remove"
            class="bg-accent-red txt-dark fw-600"
          />
          <span class="error-msg txt-accent-red">-- 
            <?php
              if(!empty($error)) {
                echo '<span>'.$error.'</span>';
              }
            ?>
           --</span>
        </form>
      </div>
    </div>
  </body>
</html>
