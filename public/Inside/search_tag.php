<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php include("../includes/layouts/header.php");?>
<?php 
$tag = $_GET["word"];

$search_query="SELECT * FROM post";
$search_result=mysqli_query($conn,$search_query);
confirm_query($search_result);

while($get_comment=mysqli_fetch_assoc($search_result))
{
	//$v=-1;
	$v=stristr($get_comment['content'],$tag);
	if($v!=FALSE)echo $get_comment['content']."<br />";
	
}

?>
<?php include("../includes/layouts/footer.php");?>