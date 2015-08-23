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
}
if ($code==$db_code) {
	$query = "UPDATE users SET confirmed = '1', confirm_code = '0'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        redirect_to("index.php");       
    }
  }
?>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>
