<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
//$answer = find_answer_by_id($_GET["id"]);
$username=$_POST['username'];
//$get = $_GET['id'];
//if (!$answer) {
//	redirect_to("question.php?id=$get");
//}

//$id = $answer["id"];
$query = "DELETE FROM answers WHERE id = {$username}";
$result = mysqli_query($conn, $query);
if($result)
	echo "done";
else
	echo "notdone";
//if ($result && mysqli_affected_rows($conn) == 1) {
//	redirect_to("question.php?id=$get");
//} else {
//	redirect_to("question.php?id=$get");
//}

?>