<?php
session_start();

  $_SESSION;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/index.css" />
    <title>PRMS Home</title>
  </head>
  <body class="landing-page-body">
    <div class="container grid">
      <nav class="navbar flex-x">
        <img
          src="resources/images/logo-dark.png"
          alt="PRMS"
          class="navbar__logo"
        />
      </nav>

      <div class="brand grid fs-700">
        <span class="brand__welcome-msg grid">Welcome to</span>
        <span class="brand__name font-rowdies"
          >Property Management Service</span
        >
        <span class="brand__tagline"
          >A unified place to rent, manage and showcase properties</span
        >
      </div>
      <div class="functions grid">
        <div class="functions__space"></div>
        <div class="functions__content grid fs-500">
          <span class="functions__login-txt font-rowdies">Login/Register</span>
          <span class="functions__alt-line">as</span>
          <div class="functions__buttons flex-x">
            <span class="btn functions__btn bg-accent-blue"
              ><a href="landlord/signup.php" class="txt-dark fw-500"
                >Landlord</a
              ></span
            >
            <span class="btn functions__btn bg-accent-blue"
              ><a href="tenant/signup.php" class="txt-dark fw-500"
                >Tenant</a
              ></span
            >
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
