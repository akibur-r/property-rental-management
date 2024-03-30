<?php
    include("connection.php");


    $query = "SELECT * FROM property"; //propety_name
    $result = mysqli_query($con, $query);

    $property = mysqli_fetch_assoc($result);
    
    $property_name = $property['property_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .heading {
            font-size: 2em;
            margin:auto;
        }

    </style>
</head>
<body>
    <div class="heading">Test Text 
        <table border="1">
            <tr>
                <th><?php echo 'That '.$property_name.' This';?></th>
            </tr>
        </table>
    </div>
</body>
</html>