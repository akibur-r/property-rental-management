<?php
session_start();
include("connection.php");
include("functions.php");

$page_id = "database";

$query = "SELECT * FROM landlord";
$result = mysqli_query($con, $query);

// $landlord = mysqli_fetch_assoc($result);

$landlord_username = array();
while ($landlord = mysqli_fetch_assoc($result)) {
  $user = "";
  $user .= $landlord['username'];
  array_push($landlord_username, $user);
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

    <div class="content-container  fs-400 txt-white">
      <table class="outer-table bg-accent-blue txt-dark fs-400 fw-300">
        <?php
        $master_cnt = 1;
        foreach ($landlord_username as $user) {
          $master_cnt++;
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
                  <th>SL.</th>
                  <th>Tenant Username</th>
                  <th>Tenant Name</th>
                  <th>Property Rented</th>
                  <th>Rent</th>
                </tr>
                <?php
                $user_username = "";
                $user_username .= $user;
                $query = "SELECT * FROM tenant WHERE tenant.landlord = '$user_username'";
                $result = mysqli_query($con, $query);
                ?>

                <tr class="inner-table__data">
                  <?php
                  $cnt = 0;
                  $porperty_cnt = 1;
                  while ($tenant = mysqli_fetch_assoc($result)) {
                    $cnt++;
                  ?>
                    <td><?php echo $porperty_cnt++ ?> </td>
                    <td><?php echo $tenant['tenant_username'] ?> </td>
                    <td><?php echo $tenant['tenant_name'] ?> </td>
                    <td><?php echo $tenant['property_rented'] ?> </td>
                    <td><?php echo $tenant['rent'] ?> </td>
                </tr>
              <?php
                  }
                if($cnt==0) {
                  echo '
                    <tr>
                      <td colspan="5" style="text-align: center;" class="fw-500"> No Tenant </td>
                    </tr>
                  ';
                }
              ?>
              </table>
            </td>
            <td class="outer-table__data__property">
              <table class="inner-table bg-accent-blue-d1 txt-white">
                <tr class="inner-table__heading">
                  <th>SL.</th>
                  <th>Property Name</th>
                  <th>Caretaker</th>
                  <th>Status</th>
                  <th>Rent</th>
                </tr>
                <?php
                $user_username = "";
                $user_username .= $user;
                $query = "SELECT * FROM property WHERE property.property_owner = '$user_username'";
                $result = mysqli_query($con, $query);
                ?>

                <tr class="inner-table__data">
                  <?php
                  $cnt = 0;
                  $porperty_cnt = 1;
                  while ($property = mysqli_fetch_assoc($result)) {
                    // $property_cnt++;
                  ?>
                    <td><?php echo $porperty_cnt++ ?> </td>
                    <td><?php echo $property['property_name'] ?> </td>
                    <td><?php echo $property['caretaker_name'] ?> </td>
                    <td><?php
                        if ($property['property_status'] == 0) echo 'Available';
                        else echo "Booked";
                        ?> </td>
                    <td>
                      <?php
                      $property_name = $property['property_name'];
                      $cnt++;
                      // echo $property_name;
                      $q = "SELECT * FROM tenant WHERE property_rented = '$property_name' && landlord = '$user'";
                      $res = mysqli_query($con, $q);

                      $rent = mysqli_fetch_assoc($res);

                      if ($rent) {
                        echo $rent['rent'];
                      } else {
                        echo '--';
                      }
                      ?>
                    </td>
                </tr>
              <?php
                  }
                if($cnt==0) {
                  echo '
                    <tr>
                      <td colspan="5" style="text-align: center;" class="fw-500"> No Property </td>
                    </tr>
                  ';
                }
              ?>
              
              </table>

            </td>
          </tr>
        <?php
        }
        if($cnt==0) {
          echo '<h1 class="txt-dark fs-600"> The Database is Empty </h1>';
        }
        ?>

        
      </table>
    </div>
  </div>
</body>

</html>