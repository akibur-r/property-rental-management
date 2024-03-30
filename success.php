<?php
session_start();
  include("connection.php");
  include("functions.php");

  $page_id = "success";
  $user_data = check_login($con, $page_id);
  
  $msg = "";
  
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $selection_type = $_POST['choice'];
    if($selection_type=="Add Property") {
      // header('location:landlord/functions/add-property.php');
    }
    else {
      header('location:landlord/dashboard.php');
    }
  }

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/form.css" />
    <link rel="stylesheet" href="css/success.css" />
    <title>PRMS | Success</title>
  </head>
  <body class="bg-dark">
    <div class="container flex-y">
      <nav class="navbar flex-x">
        <span class="navbar__logo"
          ><a href="
          <?php
            if($prev_page=="landlord add property") {
              echo 'landlord/dashboard.php';
            }
            else {
              echo 'index.php';
            }
          ?>
          "
            ><img src="resources/images/logo-light.png" alt="LOGO" /></a
        ></span>
        <span class="navbar__text"
          ><a href="index.php" class="txt-accent-blue">Logout</a></span
        >
      </nav>

      <div class="content-container grid fs-400 txt-white">
        <form action="#" method="post" class="form">
          <div class="form__title">Omuk is successful</div>
          <div class="form__content flex-x">
            <button onclick="history.back()">Go back</button>
            <input
              type="submit"
              name="choice"
              value="Back To Dashboard"
              class="btn bg-accent-red txt-black"
            />
            <input
              type="submit"
              name="choice"
              value="Add Another"
              class="btn bg-accent-blue txt-black"
            />
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
