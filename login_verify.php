<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
if (logged_in()) {
    redirect_to ("public/Inside/buzz.php");
}
?>
<?php 

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $query_email = "SELECT * FROM users WHERE username = '{$username}'";
        $result_email = mysqli_query($conn, $query_email);
        while ($row=mysqli_fetch_assoc($result_email)) {
            $db_confirmed = $row['confirmed'];
        }
        $found_user = attempt_login($username, $password);

        if ($found_user) {

            if ($db_confirmed==1) {
                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                echo "loggedin";
            } else {
                echo "Account not confirmed";
            }
        } else {
            echo "Invalid Username or Password.";            
        }
           
?>