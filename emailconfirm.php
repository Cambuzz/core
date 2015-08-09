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
    if ($result && mysqli_affected_rows($conn) == 1) {
       redirect_to("public/Inside/buzz.php");
     else {
        $_SESSION["message"] = "Updation failed.";
    }
} else {
	echo "username and code does not match.";	
}
?>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>
