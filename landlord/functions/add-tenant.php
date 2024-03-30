<?php
session_start();
  include("../../connection.php");
  include("../../functions.php");
  
  $page_id = "landlord add tenant";
  $user_data = check_login($con, $page_id);
  $landlord_username = $user_data['username'];

  $error = "";
  
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $tenant_name = $_POST['tenant_name'];
    $phone_number = $_POST['phone_number'];
    $tenant_username = $_POST['tenant_username'];
    $tenant_password = $_POST['tenant_password'];
    $property_name = $_POST['property_name'];
    $rent = $_POST['rent'];
    
  
    if(empty($tenant_name) ||
      empty($phone_number) ||
      empty($tenant_username) ||
      empty($tenant_password) ||
      empty($property_name) ||
      empty($rent)
    ) {
      $error = "No value can be empty";
    }
    else {
      //no value is empty
      if(!is_numeric($rent)) {
        $error = "Rent must be a positive number";
      }
      else {
        //rent is a number
        if(intval($rent) < 0) {
          $error = "Rent can not be negative";
        }
        else {
          //rent is okay
          if(is_numeric($tenant_name)) {
            $error = "Invalid tenant name";
          }
          else {
            //tenant name is okay
            if(!is_numeric($phone_number)) {
              $error = "Invalid phone number";
            }
            else {
              //phone number is okay
              $select = "SELECT * FROM tenant CROSS JOIN property WHERE tenant.tenant_username = '$tenant_username'";
              $result = mysqli_query($con, $select);
          
          
              if(mysqli_num_rows($result) > 0) {
                $error = "Tenant username already exists";
              }
              else {
                //user is all set to rent
                $select = "SELECT * FROM property WHERE property_name = '$property_name' && property_owner = '$landlord_username' ";
                $result = mysqli_query($con, $select);
                
                if(!$result || mysqli_num_rows($result) <=0) {
                  $error = "Property not found";
                }
                else {
                  //property is in the database
                  $property_info = mysqli_fetch_assoc($result);
                  if($property_info['property_status']==1) {
                    $error = "This property is already rented";
                  }
                  else {
                    //property is available to rent
                    $tenant_query = "INSERT INTO 
                    tenant(tenant_username, tenant_password, tenant_name, phone_number, rent, property_rented, landlord) 
                    VALUES('$tenant_username', '$tenant_password', '$tenant_name', '$phone_number', '$rent', '$property_name', '$landlord_username') ";

                    $property_query = "UPDATE property SET property_status = 1 WHERE property.property_name = '$property_name' && property.property_owner = '$landlord_username'";

                    mysqli_query($con, $tenant_query);
                    mysqli_query($con, $property_query);

                    // $ = 1;
                    header('location:../dashboard.php');
                  }
                }
              }
            }
          }
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
    <link rel="stylesheet" href="../../css/add-tenant.css" />
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>PRMS | Add Tenant</title>
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

      <div class="form-container flex-y txt-white fs-400">
        <div class="form-container__header fw-500">Add Tenant</div>
        <div class="form-container__content grid">
          <form action="" method="post" class="form flex-y fs-300">
            <div class="upper-section">
              <div class="form__title fw-500">Property Info</div>

              <div class="form__content flex-y">
                <div class="upper">
                  <span class="upper-section__left flex-x">
                    <span>
                      <label for="tenant_name">Name</label>
                      <input
                        type="text"
                        name="tenant_name"
                        class="block bg-dark"
                      />
                    </span>

                    <span>
                      <label for="phone_number">Phone Number</label>
                      <input
                        type="text"
                        name="phone_number"
                        class="block bg-dark"
                      />
                    </span>
                  </span>

                  <span class="upper-section__right flex-x">
                    <span>
                      <label for="tenant_username">Set Username</label>
                      <input
                        type="text"
                        name="tenant_username"
                        class="block bg-dark"
                      />
                    </span>

                    <span>
                      <label for="tenant_password">Set Password</label>
                      <input
                        type="password"
                        name="tenant_password"
                        class="block bg-dark"
                      />
                    </span>
                  </span>
                </div>
              </div>
            </div>
            <div class="lower-section">
              <div class="form__title fw-500">Caretaker Info</div>

              <div class="form__content flex-x">
                <span class="lower-section__left">
                  <span>
                    <label for="property_name">Property Name</label>
                    <input
                      type="text"
                      name="property_name"
                      class="block bg-dark"
                    />
                  </span>

                  <span>
                    <label for="rent">Rent</label>
                    <input type="text" name="rent" class="block bg-dark" />
                  </span>
                </span>

                <span class="lower-section__right flex-y fw-500">
                <span class="error-msg">
                  <?php
                    // if($success) {
                    //   echo 
                    //   '<span class="txt-white">
                    //     Operation successful.
                    //     <a href="../dashboard.php" class="txt-accent-red">Go Back</a>
                    //   </span>';
                    // }
                    // else 
                    if(!empty($error)) {
                      echo '<span>'.$error.'</span>';
                    }
                  ?>
                </span>
                
                <input
                    type="submit"
                    value="Add Tenant"
                    class="bg-accent-blue"
                  />
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
