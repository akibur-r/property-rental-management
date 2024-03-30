<?php
session_start();
  include("connection.php");
  include("functions.php");

  $page_id = "database";

  $query = "SELECT * FROM landlord";
  $result = mysqli_query($con, $query);
  
  // $landlord = mysqli_fetch_assoc($result);

  $landlord_username = array();
  while($landlord = mysqli_fetch_assoc($result)) {
    array_push($landlord_username, $landlord['username']);
  }
  
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/form.css" />
    <link rel="stylesheet" href="css/database.css" />
    <title>PRMS | View Database</title>
  </head>

  <body class="bg-dark">
    <div class="container flex-y">
      <nav class="navbar flex-x">
        <span class="navbar__logo">
          <a href="database.php">
            <img src="resources/images/logo-light.png" alt="LOGO" />
          </a>
        </span>
      </nav>

      <div class="content-container grid fs-400 txt-white">
        <table class="outer-table bg-accent-blue txt-dark fs-400 fw-300">
          <?php
            foreach($landlord_username as $user) {
              ?>
              <tr class="outer-table__heading">
                <th colspan="2">Landlord: 
                  <?php 
                    $query = "SELECT landlord.name FROM landlord WHERE landlord.username = '$user'";
                    $result = mysqli_query($con, $query);

                    $landlord = mysqli_fetch_assoc($result);
                    
                    echo $landlord['name'];
                  ?> 
                </th>
              </tr>
              <tr class="outer-table__data">
                <td class="outer-table__data__tenant">
                  <table class="inner-table bg-accent-blue-d1 txt-white">
                    <tr class="inner-table__heading">
                      <th>Tenant Username</th>
                      <th>Tenant Name</th>
                      <th>Property Rented</th>
                      <th>Rent</th>
                    </tr>
                    <?php 
                      $query = "SELECT * FROM property WHERE property_owner = 'akib'";
                      $result = mysqli_query($con, $query);
                    ?>
                   
                    <tr class="inner-table__data">
                    <?php
                      while($property = mysqli_fetch_assoc($result)) {
                    ?>
                      <td><?php echo $property['property_name'] ?> </td>
                      <td><?php echo $property['caretaker_name'] ?> </td>
                      <td><?php 
                        if($property['property_status']==0) echo 'Available';
                        else echo "Booked";
                       ?> </td>
                      <td>
                        <?php 
                          $property_name = $property['property_name'];
                          // echo $property_name;
                          $q = "SELECT * FROM tenant WHERE property_rented = $property_name";
                          $res = mysqli_query($con, $q);

                          $rent = mysqli_fetch_assoc($res);

                          echo $rent['rent'];
                        ?> 
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </table>
                </td>
                <td class="outer-table__data__property">
                  <table class="inner-table bg-accent-blue-d1 txt-white">
                    <tr class="inner-table__heading">
                      <th>Property Name</th>
                      <th>Caretaker</th>
                      <th>Status</th>
                      <th>Rent</th>
                    </tr>
                    <tr class="inner-table__data">
                      <td>Property</td>
                      <td>this</td>
                      <td>Available</td>
                      <td>100</td>
                    </tr>
                  </table>
                </td>
              </tr>
            <?php
            }
            ?>
        </table>
      </div>
    </div>
  </body>
</html>
