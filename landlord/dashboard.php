<?php
session_start();
  include("../connection.php");
  include("../functions.php");

  $page_id = "landlord dashboard";
  $user_data = check_login($con, $page_id);
  $username = $user_data['username'];
  $user_info = mysqli_query($con, "select * from landlord where username = '$username'");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/form.css" />
    <link rel="stylesheet" href="../css/dashboard.css" />
    <title>PRMS | Landlord Dashboard</title>
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
              echo $user_data['name'];
            ?>
          </span>
          <span class="top__details fw-400"
            >You have 4 properties, 2 tenants</span
          >
        </div>

        <div class="mid flex-y">
          <div class="mid__due">Total Rent: $400</div>
          <div class="mid__available-properties">
            Total booked properties: 2
          </div>
          <div class="mid__available-properties">
            Total available properties: 1
          </div>
        </div>
        <div class="bottom flex-y">
          <div class="bottom__heading">Select Options</div>
          <div class="bottom__content grid">
            <a
              href="functions/add-property.php"
              class="bottom__form__btn bg-accent-blue txt-black"
              >Add Property</a
            >
            <a
              href="functions/remove-property.php"
              class="bottom__form__btn bg-accent-red txt-black"
              >Remove Property</a
            >
            <a
              href="functions/add-tenant.php"
              class="bottom__form__btn bg-accent-blue txt-black"
              >Add Tenant</a
            >
            <a
              href="functions/remove-tenant.php"
              class="bottom__form__btn bg-accent-red txt-black"
              >Remove Tenant</a
            >
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
