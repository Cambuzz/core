<?php
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $image = $_POST['image'];
                $name = $_POST['name'];
 
  require_once("includes/db_connection.php");
 
 $sql ="SELECT id FROM volleyupload ORDER BY id ASC";
 
 $res = mysqli_query($con,$sql);
 
 $id = 0;
 
 while($row = mysqli_fetch_array($res)){
 $id = $row['id'];
 }
 
 $path = "uploads/$id.png";
 
 $actualpath = "http://http://52.66.157.113/teqniHome/$path";
 
 $sql = "INSERT INTO volleyupload (photo,name) VALUES ('$actualpath','$name')";
 
 if(mysqli_query($con,$sql)){
 file_put_contents($path,base64_decode($image));
 echo "Successfully Uploaded";
 }
 
 mysqli_close($con);
 }else{
 echo "Error";
 }