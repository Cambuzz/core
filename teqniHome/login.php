<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>

<?php
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $response = array();
    $response["success"] = false; 

    $found_user = attempt_login($username, $password);

    if ($found_user) {
        $response["success"] = true;  
        $response["name"] = $found_user['name'];
        $response["username"] = $found_user['username'];
        echo json_encode($response);
    }
?>