<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
$arab = find_arab_by_id($_GET["id"]);
if (!$arab) {
	redirect_to("arab.php");
}

$id = $arab["id"];
$query = "DELETE FROM arab WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);
$query_answer = "DELETE FROM arabcomments WHERE pid = {$id}";
$result_answer = mysqli_query($conn, $query_answer);

if ($result && $result_answer && mysqli_affected_rows($conn) == 1) {

	redirect_to("arab.php");
} else {

	redirect_to("arab.php");
}

?>
