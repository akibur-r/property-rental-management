<?php
session_start();
  include("../../connection.php");
  include("../../functions.php");

  $page_id = "landlord add property";
  $user_data = check_login($con, $page_id);

  $error = "";
  
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $landlord_username = $user_data['username'];
    $property_name = $_POST['property_name'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $property_type = intval($_POST['property_type']);
    $caretaker_name = $_POST['caretaker_name'];
    $contact_num = $_POST['contact_num'];

    if(empty($property_name)) {
      $error = "Property name can't be empty";
    }
    else if(empty($address)) {
      $error = "Address can't be empty";
    }
    else if(empty($caretaker_name)) {
      $error = "Caretaker name can't be empty";
    }
    else if(empty($contact_num)) {
      $error = "Contact number can't be empty";
    }
    else {
      //no field is empty
      if(!is_numeric($contact_num)) {
        $error = "Invalid contact number";
      }
      else {
        //contact number and other fields are okay
        $select = "SELECT * FROM property WHERE property_name = '$property_name' && property_owner = '$landlord_username'";
        $result = mysqli_query($con, $select);

        if(!$result || mysqli_num_rows($result) > 0) {
          //property is already there
          $error = "This property already exists";
        }
        else {
          //everything is okay
          $query = "INSERT INTO 
          property(property_name, property_address, property_type, property_status, caretaker_name, contact_num, note, property_owner) 
          values('$property_name', '$address', $property_type, 0, '$caretaker_name', '$contact_num', '$note', '$landlord_username')";

          mysqli_query($con, $query);

          header('location:../dashboard.php');
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
    <link rel="stylesheet" href="../../css/add-property.css" />
    <link rel="stylesheet" href="../../css/radio-style.css" />
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>PRMS | Add Property</title>
  </head>
  <body class="bg-dark">
    <div class="container flex-y">
      <nav class="navbar flex-x">
        <span class="navbar__logo"
          ><a href="../dashboard.php"
            ><img src="../../resources/images/logo-light.png" alt="LOGO" /></a
        ></span>
        <span class="navbar__text"
          ><a href="../../index.php" class="txt-accent-blue">Logout</a></span
        >
      </nav>

      <div class="form-container flex-y txt-white fs-400">
        <div class="form-container__header fw-500">Add Property</div>
        <div class="form-container__content grid">
          <form action="" method="post" class="form flex-y">
            <div class="upper-section">
              <div class="form__title fw-500">Property Info</div>

              <div class="form__content flex-x">
                <span class="upper-section__left">
                  <input
                    type="text"
                    name="property_name"
                    class="block bg-dark"
                    placeholder="Property Name"
                  />

                  <input
                    type="text"
                    name="address"
                    class="block bg-dark"
                    placeholder="Address"
                  />

                  <input
                    type="text"
                    name="note"
                    class="block bg-dark"
                    placeholder="Note"
                  />
                </span>

                <span class="upper-section__right flex-y">
                  <p class="upper-section__right__title fw-500">Type</p>
                  <div class="upper-section__right__content flex-x">
                    
                    <input type="radio" name="property_type" id="residential" value="0" checked>
                    <label for="residential">
                      <iconify-icon
                        icon="carbon:home"
                        class="icon"
                      ></iconify-icon>
                      <p>Residential</p>
                    </label>

                    <input type="radio" name="property_type" id="commercial" value="1">
                    <label for="commercial">
                      <iconify-icon
                        icon="vaadin:office"
                        class="icon"
                      ></iconify-icon>
                      <p>Commercial</p>
                    </label>
                    
                    
                  </div>
                </span>
              </div>
            </div>
            <div class="lower-section">
              <div class="form__title fw-500">Caretaker Info</div>

              <div class="form__content flex-x">
                <span class="lower-section__left">
                  <input
                    type="text"
                    name="caretaker_name"
                    class="block bg-dark"
                    placeholder="Name"
                    title="Caretaker Name"
                  />

                  <input
                    type="text"
                    name="contact_num"
                    class="block bg-dark"
                    placeholder="Contact Number"
                  />
                </span>

                <span class="lower-section__right flex-y">
                  <p class="error-msg" style="width: 8rem; padding-bottom: 0.5rem;">
                    <?php
                      if(!empty($error)) {
                        echo '<span>'.$error.'</span>';
                      }
                    ?>
                  </p>
                  <input
                    type="submit"
                    value="Add Property"
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
