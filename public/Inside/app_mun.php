<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>

<?php
$app_mun_set = find_all_app_muns();
?>
<?php
    $query = "SELECT * FROM app ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    confirm_query($result);
?>

    <?php
        while($mun = mysqli_fetch_assoc($result)) $output[]=$mun;
        print(json_encode($output));
    ?>                       

<?php
    
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>