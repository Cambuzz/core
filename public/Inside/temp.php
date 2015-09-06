<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php
$council="VITC INTRA MUN";
$query="SELECT * FROM app WHERE council='{$council}' ORDER BY id ASC";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$content=$row['content'];
	$picset=$row['picset'];
	$post_user=$row['post_user'];
	$post_time=$row['post_time'];
    $query1 = "INSERT INTO mun (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
    $sql = mysqli_query($conn, $query1);
    if($sql)
    	echo "done";
	
} 
?>