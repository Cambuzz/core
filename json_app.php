<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>

    <?php
        $current_user = $_SESSION['username'];
        $data_array = array( 
                    "username" => $current_user,                       
                    ); 

        $output=$data_array;
        print(json_encode($output));
    ?>                   

<?php
    
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>