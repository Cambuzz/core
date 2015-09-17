<?php require_once("../../../includes/session.php");?>
<?php require_once("../../../includes/db_connection.php");?>
<?php require_once("../../../includes/functions.php");?>
<?php
$query = "SELECT * FROM mun ORDER BY id DESC";
$result = mysqli_query($conn, $query);
confirm_query($result);
while ($mun_list = mysqli_fetch_assoc($result)) 
{
	if ($mun_list['picset']==1)
    {                                                                                                                             
        $poster_time = strtotime($mun_list['post_time']);                                                    
        $posterid=$mun_list['post_user'].date("Y-m-d H-i-s", $poster_time);  
        $path="../images/". $posterid .".jpg ";                                                                                                    
        //echo '<img src="../images/' . $posterid . '.jpg "class="img-responsive">';
        list($width, $height) = getimagesize($path);
		$h=500*$height/$width;
		$w=500;
		
		$image = new Imagick($path);
		$image->resizeImage( $w, $h , Imagick::FILTER_LANCZOS, 1, TRUE);
		$image->writeImage("..images/newimages/". $posterid .".jpg ");                                                                
    } 
}
?>