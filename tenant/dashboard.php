<?php
session_start();
  include("../connection.php");
  include("../functions.php");

  $page_id = "tenant dashboard";
  $user_data = check_login($con, $page_id);
  $username = $user_data['tenant_username'];
  $user_info = mysqli_query($con, "select * from tenant where tenant_username = '$username'");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <title>PRMS | Tenant Dashboard</title>
  </head>
  <body class="bg-dark">
    <div class="container flex-y">
      <nav class="navbar flex-x">
        <span class="navbar__logo"
          ><a href="dashboard.php"
            ><img src="../resources/images/logo-light.png" alt="LOGO" /></a
        ></span>
        <span class="navbar__text"
          ><a href="../index.php" class="txt-accent-blue">Logout</a></span
        >
      </nav>

      <div class="dashboard flex-y fs-500 txt-white">
        <!-- top part (greetings) -->
        <div class="top flex-y">
        <span class="top__greetings fw-600">Hello, 
            <?php
              echo $user_data['tenant_name'];
            ?>
          </span>
          <span class="top__details fw-400"
            >Your rented property is Omuk Building</span
          >
        </div>

        <div class="mid flex-y">
          <div class="mid__due">Rental due: $1</div>
          <div class="mid__due-date">Expected Payment Date: 01/04/2024</div>
          <div class="mid__checkout">
            <form action="#" class="mid__form form">
              <label for="checkout_token">Checkout</label>
              <input
                type="text"
                name="checkout_token"
                class="bg-light-dark"
                placeholder="XXXX-XXXX-XXXX"
              />
              <input
                type="submit"
                value="Verify"
                class="mid__form__submit btn bg-accent-blue fw-500"
              />
            </form>
          </div>
        </div>
        <div class="bottom flex-x">
          <div class="bottom__left">
            <div class="bottom__heading">Landlord Details</div>
            <div class="bottom__content">
              <span>Mr. Omuk Mia</span> <br />
              <span>10/12 Tomuk Road, Ei Thana, Sei District</span> <br />
              <span>Contact: +8801234567890</span>
            </div>
          </div>
          <div class="bottom__right">
            <div class="bottom__heading">Caretaker Details</div>
            <div class="bottom__content">
              <span>Mr. Tomuk Mia</span> <br />
              <span>10/12 Somuk Road, Oi Thana, Sei District</span> <br />
              <span>Contact: +8801234567891</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
