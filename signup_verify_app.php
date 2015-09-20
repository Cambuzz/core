<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if(isset($_POST["username"])&&isset($_POST["name"])&&isset($_POST["email"])&&isset($_POST["password"]))
	{
    $count_query="SELECT count FROM live WHERE id = '1'";
    $result_countquery=mysqli_query($conn,$count_query);
    $cr=mysqli_fetch_assoc($result_countquery);
    $ucr=$cr['count']+1;

    $updatec_query="UPDATE live SET count='{$ucr}' WHERE id = '1'";
    $result_ucountquery=mysqli_query($conn,$updatec_query);

		$sname=$_POST['name'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$query_ucheck = "SELECT username FROM users WHERE username = '{$username}'";
    $result_ucheck = mysqli_query($conn, $query_ucheck);
    $query_echeck = "SELECT email FROM users WHERE email = '{$email}'";
	    $result_echeck = mysqli_query($conn, $query_echeck);

	    if (mysqli_num_rows($result_ucheck) !=0) 
      {

	    	 $q="username_exists";
             $data_array = array( 
                    "success" => $q,                       
              ); 

              $output=json_encode($data_array);
               print($output);
	        //echo "Username already exists";
	    }
	    else if(mysqli_num_rows($result_echeck)!=0)
	    {
	    	 $q="email_exists";
             $data_array = array( 
                    "success" => $q,                       
                    ); 

             $output=json_encode($data_array);
             print($output);
	        //echo "Email already exists";
	    } 
      else 
      {

        
            
            $retval1 = ereg("(@vit.ac.in$)", $email);
            $retval2 = ereg("(^@vit.ac.in)", $email);
            if( $retval1 == true && $retval2==false )
            {
                $hashed_password = password_encrypt($password); 
                $confirmcode = rand(); 
                //$confirmcode = MD5($email."&*@dhv1%!@90!124^%&>>?".$username);
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

                        $q="true";
			                  $data_array = array( 
			                  "success" => $q,                       
			                    ); 

    			             $output=json_encode($data_array);
    			             print($output);
                        // echo "Kindly check your VIT email and confirm your registration after closing this signup form.<br /><span style='color:red;'>Your link will be expired in 30 minutes.</span>";
                        // echo "<br>"; 
                        // echo"(Check your spam folder if you don't find it in your inbox.)";
                    } 
                } 
            }
            else{

            	 $q="only_vit";                                   
                 $data_array = array( 
                    "success" => $q,                       
                    ); 

               $output=json_encode($data_array);
               print($output);
               // echo "Only VIT email is recognised";
            }                       
        
        }     

	}
?>