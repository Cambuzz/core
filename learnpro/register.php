<?php
    $con = mysqli_connect("localhost", "root", "root", "learnpro");
    
    $name = $_POST["name"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "INSERT INTO user (name, username, age, password) VALUES('{$name}', '{$username}', '{$age}', '{$password}')";
    mysqli_query($con, $query);
    
    $response = array();
    $response["success"] = true;  
    
    echo json_encode($response);
?>