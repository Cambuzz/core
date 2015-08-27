<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
$event = find_event_by_id($_GET["id"]);
if (!$event) {
	redirect_to("buzz.php");
}

$id = $event["id"];
$query = "DELETE FROM notify WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_affected_rows($conn) == 1) {

	redirect_to("buzz.php");
} else {

	redirect_to("buzz.php");
}
?>
