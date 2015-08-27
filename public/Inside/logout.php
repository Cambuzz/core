<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
//session_start();
$username=$_SESSION["username"];
$query_delete="DELETE FROM live WHERE live_users='{$username}' LIMIT 1";
$result_delete=mysqli_query($conn,$query_delete);

$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-42000, '/');
}
               
session_destroy();
redirect_to("../../index.php");
?>