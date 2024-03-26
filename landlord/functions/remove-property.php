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
          ><a href="../../index.html"
            ><img src="../../resources/images/logo-light.png" alt="LOGO" /></a
        ></span>
        <span class="navbar__text"
          ><a href="../../index.html" class="txt-accent-blue">Logout</a></span
        >
      </nav>

      <div class="form-container flex-y fs-400 txt-white">
        <div class="form-container__header fw-500"></div>
        <form action="" class="form grid bg-light-dark">
          <div class="form__title fw-500">Remove Property</div>
          <label for="property-name">Property Name</label>
          <input type="text" name="property-name" class="bg-dark" />

          <label for="password">Password</label>
          <input type="password" name="password" class="bg-dark" />

          <input
            type="submit"
            value="Remove"
            class="bg-accent-red txt-dark fw-600"
          />
          <p class="form__msg">Test</p>
        </form>
      </div>
    </div>
  </body>
</html>
