<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
$username = $_GET['username'];
$code = $_GET['code'];
$query = "SELECT * FROM users WHERE username = '{$username}'";
$result = mysqli_query($conn, $query);
confirm_query($result);
while ($row = mysqli_fetch_assoc($result)) {
	$db_code = $row['confirm_code'];
	$ectstamp= $row['ectstamp'];
  $confirmed=$row['confirmed'];
}
if($confirmed==0)
{
$time=time();
if(($ectstamp+1800)>$time)
{
if ($code==$db_code) {
	$query = "UPDATE users SET confirmed = '1', confirm_code = '0'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        redirect_to("index.php");       
    }
  }
}
else
{
//$username=$row['username'];
mysqli_close($result);
$query_delete="DELETE FROM users WHERE username='{$username}' LIMIT 1";
$result_delete=mysqli_query($conn,$query_delete);
//$r=mysqli_affected_rows($conn,$result_delete);
 if($result_delete)
 echo "Link Expired. Please signup again. We apologise for the inconvenience.";
  else
 echo "connection failed";
}
}
else
echo "The account is already confirmed.";

?>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>