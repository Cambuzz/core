<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php

if(isset($_POST['username'])&&isset($_POST['password']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    
         $password1 = password_encrypt($password);
         $query_update="UPDATE users SET ectstamp='0',confirm_code='0',hashed_password=$password1 WHERE username='{$username}'";
         $result_update=mysqli_query($conn,$query_update);
         redirect_to("index.php");
    
} 
?>