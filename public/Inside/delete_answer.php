<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
$answer = find_answer_by_id($_GET["id"]);
if (!$answer) {
	redirect_to("quora.php");
}

$id = $answer["id"];
$query = "DELETE FROM answers WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_affected_rows($conn) == 1) {

	redirect_to("question.php?id=<?php echo urlencode($id);");
} else {

	redirect_to("question.php?id=<?php echo urlencode($id);");
}

?>
