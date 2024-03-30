<?php
session_start();
  include("../../connection.php");
  include("../../functions.php");

  $page_id = "landlord remove property";
  $user_data = check_login($con, $page_id);

  $landlord_username = $user_data['username'];
  $user_password = $user_data['password'];

  $error = "";
  $success = 0;

  if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $property_name = $_POST['property_name'];  
    $password = $_POST['password'];  

    if(empty($property_name) || empty($password)) {
      $error = "Fields can't be empty";
    }
    else {
      $select = "SELECT * FROM property WHERE property_name = '$property_name' && property_owner = '$landlord_username'";
      $result = mysqli_query($con, $select);

      if(!$result || mysqli_num_rows($result) <= 0) {
        //tenant not found
        $error = "Property not Found";
      }
      else {
        if($user_password === $password) {
          //password matched
          $select = "SELECT * FROM tenant WHERE tenant.property_rented = '$property_name' && tenant.landlord = '$landlord_username'";
          $result = mysqli_query($con, $select);

          if($result && mysqli_num_rows($result) > 0) {
            //tenant is found
            $tenant = mysqli_fetch_assoc($result);
            $tenant_username = $tenant['tenant_username'];

            $query = "DELETE FROM tenant WHERE tenant.tenant_username = '$tenant_username'";
            mysqli_query($con, $query);
          }

          $query = "DELETE FROM property WHERE property.property_name = '$property_name'";
          mysqli_query($con, $query);

          $success = 1;
          // header('location: ../dashboard.php');
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
        <span class="navbar__logo">
          <a href="../dashboard.php">
            <img src="../../resources/images/logo-light.png" alt="LOGO" /></a>
        </span>
        <span class="navbar__text">
          <a href="../../index.php" class="txt-accent-blue">Logout as
            <?php echo $landlord_username; ?>
          </a>
        </span>
      </nav>

      <div class="form-container flex-y fs-400 txt-white">
        <div class="form-container__header fw-500"></div>
        <form action="" method="post" class="form grid bg-light-dark">
          <div class="form__title fw-500">Remove Property</div>
          <label for="property_name">Property Name</label>
          <input type="text" name="property_name" class="bg-dark" />

          <label for="password">Password</label>
          <input type="password" name="password" class="bg-dark" />

          <input
            type="submit"
            value="Remove"
            class="bg-accent-red txt-dark fw-600"
          />
          <span class="error-msg">
            <?php
              if(!empty($error)) {
                echo '<span>'.$error.'</span>';
              }
            ?>
          </span>
        </form>
      </div>
    </div>
  </body>
</html>
