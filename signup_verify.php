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
            $query_echeck = "SELECT email FROM users WHERE email = '{$email}'";
    $result_echeck = mysqli_query($conn, $query_echeck);
    if (mysqli_num_rows($result_ucheck) !=0) {
        echo "Username already exists";
    }
    else if(mysqli_num_rows($result_echeck)!=0)
    {
        echo "Email already exists";
    } else {

        
            
            $retval1 = ereg("(@vit.ac.in$)", $email);
            $retval2 = ereg("(^@vit.ac.in)", $email);
            if( $retval1 == true && $retval2==false )
            {
                $hashed_password = password_encrypt($password); 
                //$confirmcode = rand(); 
                $confirmcode = MD5($email."&*@dhv1%!@90!124^%&>>?".$username);
                $ectstamp=time();
                $query = "INSERT INTO users (sname, username, email, hashed_password, confirmed, confirm_code,ectstamp)";
                $query .= " VALUES ('{$sname}', '{$username}', '{$email}', '{$hashed_password}', '0', '{$confirmcode}','{$ectstamp}')";
                $result = mysqli_query($conn, $query);         

                if ($result) {
                    $found_user = attempt_login($username, $password);

                    if ($found_user) {
                        // $header= array(
                        //     'From: cambuzz.vitcc@gmail.com',
                        //     'Content-Type: text/html'
                        // );
                        // $html = '<html lang="en"><head><meta charset="UTF-8"><title>Document</title><style>.hello{font-size: 15px;}</style></head><body><div class="hello"><h1>Hello H1</h1></div></body></html>';
                        // $message = $html. "Confirm your email by clicking the link http://cambuzz.co.in/emailconfirm.php?username=$username&code=$confirmcode";
                        $message = "Confirm your email by clicking the link http://cambuzz.co.in/emailconfirm.php?username=$username&code=$confirmcode";
                        mail($email, "Confirm your email", $message, "From: cambuzz.vitcc@gmail.com");
                        echo "Kindly check your VIT email and confirm your registration after closing this signup form.";
                        echo "<br>"; 
                        echo"(Check your spam folder if you don't find it in your inbox.)";
                    } 
                } 
            }
            else{
                echo "Only VIT email is recognised";
            }                       
        
    }     

?>