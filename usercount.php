<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php include("includes/layouts/header.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head><title>Cambuzz</title>
<link href="css/public.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="header">
<h1>Cambuzz</h1>
</div>
<div id="main">
<div id="page">
<h2>User Count</h2> 
<p></p><br/><br/>
<p>
<?php
$query = "SELECT COUNT(username) FROM users";
$result = mysqli_query($conn, $query);
confirm_query($result);
$row = mysqli_fetch_array($result);
$total = $row[0];
echo $total;
?>	
</p>


<h2>Live users</h2> 
<p></p><br/><br/>
<p>
<?php

 $query_get="SELECT * FROM live WHERE id='1'";
 $result_get= mysqli_query($conn, $query_get);
 $live_users=mysqli_fetch_assoc($result_email);
 echo $live_users['live_users'];
?>	
</p>
</div>
</div>
<?php include("includes/layouts/footer.php");?>