<?php require_once("../../../includes/session.php");?>
<?php require_once("../../../includes/db_connection.php");?>
<?php require_once("../../../includes/functions.php");?>
<?php
if((isset( $_GET['id']))&&(isset( $_GET['council'])))
{
$id= $_GET['id'];
$council= $_GET['council']; 
if($council=="mun")
{
	$query = "DELETE FROM mun WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $query_answer = "DELETE FROM comments WHERE pid = {$id}";
    $result_answer = mysqli_query($conn, $query_answer);
    redirect_to("mun.php");
}
if($council=="ess")
{
	$query = "DELETE FROM ess WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $query_answer = "DELETE FROM esscomments WHERE pid = {$id}";
    $result_answer = mysqli_query($conn, $query_answer);
    redirect_to("ess.php");
}
if($council=="oosa")
{
	$query = "DELETE FROM oosa WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $query_answer = "DELETE FROM oosacomments WHERE pid = {$id}";
    $result_answer = mysqli_query($conn, $query_answer);
    redirect_to("oosa.php");
}
if($council=="hrc")
{
	$query = "DELETE FROM hrc WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $query_answer = "DELETE FROM hrccomments WHERE pid = {$id}";
    $result_answer = mysqli_query($conn, $query_answer);
    redirect_to("hrc.php");
}
if($council=="arab")
{
	$query = "DELETE FROM arab WHERE id = {$id} LIMIT 1";
    $result = mysqli_query($conn, $query);
    $query_answer = "DELETE FROM arabcomments WHERE pid = {$id}";
    $result_answer = mysqli_query($conn, $query_answer);
    redirect_to("arab.php");
}
}

?>