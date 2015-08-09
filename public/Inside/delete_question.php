<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
$question = find_question_by_id($_GET["id"]);
if (!$question) {
	redirect_to("quora.php");
}

$id = $question["id"];
$query = "DELETE FROM quora WHERE id = {$id} LIMIT 1";
$result = mysqli_query($conn, $query);
$query_answer = "DELETE FROM answers WHERE qid = {$id}";
$result_answer = mysqli_query($conn, $query_answer);

if ($result && $result_answer && mysqli_affected_rows($conn) == 1) {

	redirect_to("quora.php");
} else {

	redirect_to("quora.php");
}

?>
