<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
    redirect_to ("public/Inside/buzz.php");
}
?>
<?php
           
            $username = $_POST["username"];
            
            $query_ucheck = "SELECT username FROM users WHERE username = '{$username}'";
            $result_ucheck = mysqli_query($conn, $query_ucheck);
            $query_c = "SELECT * FROM users WHERE username = '{$username}'";
            $result_c = mysqli_query($conn, $query_c);
            while ($row=mysqli_fetch_assoc($result_c)) 
            {
                $db_confirmed = $row['confirmed'];
                $email=$row['email'];
            }
    if (mysqli_num_rows($result_ucheck) ==0) 
    {
        echo "Registration Number Not Found";
    }
    else if ($db_confirmed==0) 
    {
        echo "Account is not confirmed";
    }
    else 
    {

                        $ectstamp=time();
                        $confirmcode = rand();
                        $query_update="UPDATE users SET confirm_code='{$confirmcode}',ectstamp='{$ectstamp}' WHERE username = '{$username}'";
                        $result_update=mysqli_query($conn,$query_update); 
                        $message = "Change your password by clicking the link http://cambuzz.co.in/forgotpassword1.php?username=$username&code=$confirmcode";
                        mail($email, "Change Password", $message, "From: cambuzz.vitcc@gmail.com");
                        echo "Kindly check your VIT email and confirm your registration after closing this signup form.<br /><span style='color:red;'>Your link will be expired in 30 minutes.</span>";
                        echo "<br>"; 
    }     

?>