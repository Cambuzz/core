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
<p></p>
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
<p></p>
<p>
<?php


$query1 = "SELECT COUNT(live_users) FROM live";
$result1 = mysqli_query($conn, $query1);
confirm_query($result1);
$row = mysqli_fetch_array($result1);
$total1 = $row[0];
echo $total1;

?>	
</p>
</div>
</div>
<?php include("includes/layouts/footer.php");?>