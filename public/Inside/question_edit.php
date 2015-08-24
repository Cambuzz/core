<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>

<?php
$id=$_POST['id'];
$content= mysqli_real_escape_string($conn, $_POST['content']);
$query = "UPDATE quora SET question = '{$content}' WHERE id = {$id} ";
$result = mysqli_query($conn, $query);
echo "done";
?>
<?php
    mysqli_free_result($name_result);
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>
