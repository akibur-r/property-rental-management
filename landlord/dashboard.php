<?php
session_start();
include("../connection.php");
include("../functions.php");

$page_id = "landlord dashboard";
$user_data = check_login($con, $page_id);
$landlord_username = $user_data['username'];
$user_name = $user_data['name'];

//calculating total rent
$query = "SELECT SUM(rent) AS total_rent FROM tenant WHERE tenant.landlord = '$landlord_username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $rent = mysqli_fetch_assoc($result);
  $total_rent = $rent['total_rent'];

  if (!$total_rent) $total_rent = 0;
}

//calculating total booked properties
$query = "SELECT COUNT(property_status) AS booked_properties FROM property WHERE property.property_status = 1 && property.property_owner = '$landlord_username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $booked = mysqli_fetch_assoc($result);
  $booked_properties = $booked['booked_properties'];

  if (!$total_rent) $booked_properties = 0;
}

//calculating total booked properties
$query = "SELECT COUNT(property_status) AS booked_properties FROM property WHERE property.property_status = 1 && property.property_owner = '$landlord_username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $booked = mysqli_fetch_assoc($result);
  $booked_properties = $booked['booked_properties'];

  if (!$booked_properties) $booked_properties = 0;
}

//calculating total available properties
$query = "SELECT COUNT(property_status) AS available_properties FROM property WHERE property.property_status = 0 && property.property_owner = '$landlord_username'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $available = mysqli_fetch_assoc($result);
  $available_properties = $available['available_properties'];

  if (!$available_properties) $available_properties = 0;
}

$total_tenant = $booked_properties;
$total_properties = $booked_properties + $available_properties;

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
      <span class="navbar__logo"><a href="dashboard.php"><img src="../resources/images/logo-light.png" alt="LOGO" /></a></span>
      <span class="navbar__text">
        <a href="../index.php" class="txt-accent-blue">Logout as
          <?php echo $landlord_username; ?>
        </a>
      </span>
    </nav>

    <div class="dashboard flex-y fs-500 txt-white">
      <!-- top part (greetings) -->
      <div class="top flex-y">
        <span class="top__greetings fw-600">Hello,
          <?php
          echo $user_name;
          ?>
        </span>
        <span class="top__details fw-400">You have <?php echo $total_properties ?> properties, <?php echo $total_tenant ?> tenants.
        </span>
      </div>

      <div class="mid flex-y">
        <div class="mid__due">Total Rent: $
          <?php
          echo $total_rent;
          ?>
        </div>
        <div class="mid__available-properties flex-x">
          Total booked properties:
          <?php
          echo $booked_properties;
          ?>
        </div>
        <div class="mid__available-properties">
          Total available properties:
          <?php
          echo $available_properties;
          ?>
        </div>
      </div>
      <div class="bottom flex-y">
        <div class="bottom__heading">Select Options</div>
        <div class="bottom__content grid">
          <a href="functions/add-property.php" class="bottom__form__btn bg-accent-blue txt-black">Add Property</a>
          <a href="functions/remove-property.php" class="bottom__form__btn bg-accent-red txt-black">Remove Property</a>
          <a href="functions/add-tenant.php" class="bottom__form__btn bg-accent-blue txt-black">Add Tenant</a>
          <a href="functions/remove-tenant.php" class="bottom__form__btn bg-accent-red txt-black">Remove Tenant</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>