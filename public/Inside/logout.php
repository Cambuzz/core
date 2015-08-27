<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-42000, '/');
}
                $query_get="SELECT * FROM live WHERE id='1'";
                $result_get= mysqli_query($conn, $query_get);
                 while ($live_users=mysqli_fetch_assoc($result_get))
                 {
                        $live = $live_users['live_users'];
                 }
                $live=$live-1;
                $query_update= "UPDATE live SET live_users='{$live}' WHERE id= '1'";
                $result = mysqli_query($conn, $query_update);
session_destroy();
redirect_to("../../index.php");
?>