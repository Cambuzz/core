<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php require_once("../../includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
    redirect_to ("../inside/buzz.php");
}
?>
<?php

	$query_ucheck = "SELECT username FROM users WHERE username = '{$_POST['username']}'";
    $result_ucheck = mysqli_query($conn, $query_ucheck);
    $anything_found = mysqli_num_rows($result_ucheck);

    if ($anything_found>0) {
        echo "fail";
        return false;
    } else {
		echo "success";
		return false;
    }
?>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>