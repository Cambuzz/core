<!DOCTYPE html>
<?php

    if((isset($_POST['name']))&&(isset($_POST['email']))&&(isset($_POST['message'])))
    {
         $name=$_POST['name'];
         $email=$_POST['email'];
         $message=$_POST['message'];
         $email1="cambuzz.vitcc@gmail.com";
         $str="From: ".$email;
         mail($email1,$name,$message,$str);
    }

?>