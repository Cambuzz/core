<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
$id= $_GET['id'];
$council= $_GET['council']; 
if($council=="mun")
{
	$query = "DELETE FROM mun WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $query_answer = "DELETE FROM arabcomments WHERE pid = {$id}";
    $result_answer = mysqli_query($conn, $query_answer);
}
?>