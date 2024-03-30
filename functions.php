<?php
function check_login($con, $page_id) {
    if(isset($_SESSION['username'])) {

        if($page_id == "landlord dashboard" || 
            $page_id == "landlord add tenant" ||
            $page_id == "landlord remove tenant" ||
            $page_id == "landlord add property"  ||
            $page_id == "landlord remove property"
            ) {

            $username = $_SESSION['username'];
            $query = "SELECT * FROM landlord WHERE username = '$username' limit 1" ;

            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                return $user_data;
            }
        }
        else if($page_id == "tenant dashboard") {
            $username = $_SESSION['username'];
            $query = "SELECT * FROM tenant WHERE tenant_username = '$username'" ;

            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                return $user_data;
            }
        }
    }
    else {
        if($page_id=="landlord dashboard") {
            header("location:login.php");
        }
        else if($page_id == "landlord add tenant" ||
                $page_id == "landlord remove tenant" ||
                $page_id == "landlord add property" ||
                $page_id == "landlord remove property") {
            header("location: ../login.php");
        }
        die();
    }
}

function logout($con, $page_id) {
    if(isset($_SESSION['username'])) {
        session_destroy();
        if($page_id == "landlord dashboard") {  
            header('location:../index.php');
        }
        else if($page_id == "landlord dashboard" || 
        $page_id == "landlord add tenant" ||
        $page_id == "landlord remove tenant" ||
        $page_id == "landlord add property"  ||
        $page_id == "landlord remove property") {
            header('location:../../index.php');
        }
        $con->close();
    }
}


?>