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
            $sname = $_POST['name'];
            $username = mysql_prep($_POST["register"]);
            $email = $_POST['email'];
            $password=$_POST['password'];
 $query_ucheck = "SELECT username FROM users WHERE username = '{$username}'";
    $result_ucheck = mysqli_query($conn, $query_ucheck);
    if (mysqli_num_rows($result_ucheck) !=0) {
        echo "Username already exists";
    } else {

        
            
            $retval1 = ereg("(@vit.ac.in$)", $email);
            $retval2 = ereg("(^@vit.ac.in)", $email);
            if( $retval1 == true && $retval2==false )
            {
                $hashed_password = password_encrypt($password); 
                $confirmcode = rand(); 
                $query = "INSERT INTO users (sname, username, email, hashed_password, confirmed, confirm_code)";
                $query .= " VALUES ('{$sname}', '{$username}', '{$email}', '{$hashed_password}', '0', '{$confirmcode}')";
                $result = mysqli_query($conn, $query);         

                if ($result) {
                    $found_user = attempt_login($username, $password);

                    if ($found_user) {

                        $message = "Confirm your email by clicking the link http://cambuzz.co.in/emailconfirm.php?username=$username&code=$confirmcode";
                        mail($email, "Confirm your email", $message, "From: pkpbhardwaj729@gmail.com");
                        echo "Registration complete, confirm your email";
                    } 
                } 
            }
            else{
                echo "Only VIT email is recognised";
            }                       
        
    }     

?>