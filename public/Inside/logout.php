<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-42000, '/');
}
                $query_delete="DELETE FROM live WHERE live_users='{$username}'";
                $result_delete=mysqli_query($conn,$query_delete);
session_destroy();
redirect_to("../../index.php");
?>