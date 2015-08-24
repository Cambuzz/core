<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>

<?php
$event_set = find_all_events();
?>
<?php
    $query = "SELECT * FROM notify ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<body >
    <?php
        while($notification = mysqli_fetch_assoc($result)) $output[]=$notification;
        print(json_encode($output));
    ?>                       
</body>
</html>
<?php
    
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>