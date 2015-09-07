<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php

$query="SELECT * FROM app ORDER BY id ASC";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	if($row['council']=="VITC INTRA MUN")
	{
		$content=$row['content'];
		$picset=$row['picset'];
		$post_user=$row['post_user'];
		$post_time=$row['post_time'];
	    $query1 = "INSERT INTO mun (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
	    $sql = mysqli_query($conn, $query1);
	    if(!$sql)
	    	echo "done";
    }
    else if($row['council']=="UNGA-ESS")
	{
		$content=$row['content'];
		$picset=$row['picset'];
		$post_user=$row['post_user'];
		$post_time=$row['post_time'];
	    $query1 = "INSERT INTO ess (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
	    $sql = mysqli_query($conn, $query1);
	    if(!$sql)
	    	echo "done";
    }
    else if($row['council']=="UNOOSA")
	{
		$content=$row['content'];
		$picset=$row['picset'];
		$post_user=$row['post_user'];
		$post_time=$row['post_time'];
	    $query1 = "INSERT INTO oosa (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
	    $sql = mysqli_query($conn, $query1);
	    if(!$sql)
	    	echo "done";
    }
    else if($row['council']=="UNHRC")
	{
		$content=$row['content'];
		$picset=$row['picset'];
		$post_user=$row['post_user'];
		$post_time=$row['post_time'];
	    $query1 = "INSERT INTO hrc (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
	    $sql = mysqli_query($conn, $query1);
	    if(!$sql)
	    	echo "done";
    }
    else if($row['council']=="Arab League")
	{
		$content=$row['content'];
		$picset=$row['picset'];
		$post_user=$row['post_user'];
		$post_time=$row['post_time'];
	    $query1 = "INSERT INTO arab (content, picset, post_user, post_time) VALUES ('{$content}', {$picset}, '{$post_user}', '{$post_time}')";
	    $sql = mysqli_query($conn, $query1);
	    if(!$sql)
	    	echo "done";
    }
    else
    {
    	echo "failed";
    }

	
} 
?>