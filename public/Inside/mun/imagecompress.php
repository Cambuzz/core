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
        $height=1;
        $width=1;                                                                                                      
        //echo '<img src="../images/' . $posterid . '.jpg "class="img-responsive">';
        list($width, $height) = getimagesize("../images/".$posterid.".jpg ");
		//echo $width." ".$height;
		$h=(500*$height)/$width;
		$w=500;
		$image = new Imagick("../images/".$posterid.".jpg ");
		$image->resizeImage( $w, $h , Imagick::FILTER_LANCZOS, 1, TRUE);
		$image->writeImage("..images/newimages/".$posterid.".jpg ");   
		echo "done";                                                             
    } 
}
?>