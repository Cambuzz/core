<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>

<?php require_once("../includes/functions.php");?>
<?php include("../includes/layouts/header.php");?>
<?php include("/upload/src/class.upload.php");?>
<?php $tag_set = find_all_tags(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<div id="main">
<div id="navigation">
<br/><br/><ul>
<li><a href="buzz.php">Buzz</a></li><br/><br/>
<li><a href="settings.php">Settings</a></li><br/><br/>
<li><a href="logout.php">Logout</a></li><br/><br/>
</ul>
</div>
<div id="page">
<h2>Buzz</h2>
<p><b>check</b></p>
<p>
	<form method="post" action="yesnocheck4.php">
     <input type="text" name="comment">
     <input type="submit" name="submit" value="submit">
     <input type="submit" name="view" value="view">    
    </form>
</p>
<?php
if (isset($_POST['submit'])) 
{
    $comment = $_POST['comment'];
    $st=$comment;
    $sz=strlen($st);
    $disp="";
    $store="";
    $flag=0;
    for($i=0; $i<$sz; $i++)
    {
        if($st[$i]=='#')
        {
            $ind=$i;
            while($st[$ind]=='#')
            {
                if($ind+1<$sz)
                {
                    if($st[$ind+1]!='#' && $st[$ind+1]!=' ')
                    {
                        $store=$store.$st[$ind];
                    }
                }
                $ind++;
                if($ind>=$sz)break;
            }
            if($ind>=$sz)break;
            if($st[$ind]==' ')
            {
                $i=$ind;
                continue;
            }
            while($st[$ind]!=' '&& $st[$ind]!='#')
            {
                $store=$store.$st[$ind];
                $ind++;
                if($ind>=$sz)
                    {
                        if($store!="")
                        {
                            //echo $store."<br>";
                            $flag=0;
                            $search_query="SELECT * FROM hashtag WHERE tag='{$store}'";
                            $search_result=mysqli_query($conn,$search_query);
                            confirm_query($search_result);
                            $search_tag=mysqli_fetch_assoc($search_result);
                            if(!$search_tag['tag'])
                            {
                                $query="INSERT INTO hashtag (tag)  VALUES ('{$store}')";
                                $sql= mysqli_query($conn, $query);
                            }
                            $store="";
                        }
                        break;
                    }
            }
            if($ind<$sz)
            {
                if($store!="")
                {
                    $flag=0;
                    $search_query="SELECT * FROM hashtag WHERE tag='{$store}'";
                    $search_result=mysqli_query($conn,$search_query);
                    confirm_query($search_result);
                    $search_tag=mysqli_fetch_assoc($search_result);
                    if(!$search_tag['tag'])
                    {
                        $query="INSERT INTO hashtag (tag)  VALUES ('{$store}')";
                        $sql= mysqli_query($conn, $query);
                    }
                    $store="";
                }
            }
            $i=$ind-1;
        }
    }
    $query="INSERT INTO post (content)  VALUES ('{$st}')";
    $sql= mysqli_query($conn, $query);                                           
}
if(isset($_POST['view']))
{
    $search_query="SELECT * FROM post";
    $search_result=mysqli_query($conn,$search_query);
    confirm_query($search_result);
    
    while ($get_comment=mysqli_fetch_assoc($search_result)) 
    {
        $str=$get_comment['content'];
        $comment = $str;
        $st=$comment;
        $sz=strlen($st);
        $disp="";
        $store="";
        $flag=0;
        for($i=0; $i<$sz; $i++)
        {
            if($st[$i]=='#')
            {
                $ind=$i;
                while($st[$ind]=='#')
                {
                    if($ind+1<$sz)
                    {
                        if($st[$ind+1]!='#' && $st[$ind+1]!=' ')
                        {
                            $c=$ind+1;
                            $var="#";
                            while($st[$c]!='#' && $st[$c]!=' ')
                            {
                                $var=$var.$st[$c];
                                $c++;
                                if($c>=$sz)break;
                            }
                            //echo $var."<br>";
                            $disp=$disp."<a href='search_tag.php?word=".urlencode($var)."'>";

                        }
                    }
                    $disp=$disp.$st[$ind];
                    $ind++;
                    if($ind>=$sz)break;
                }
                if($ind>=$sz)break;
                if($st[$ind]==' ')
                {
                    $i=$ind;
                    $disp=$disp.$st[$ind];
                    continue;
                }
                while($st[$ind]!=' '&& $st[$ind]!='#')
                {
                    $disp=$disp.$st[$ind];
                    $ind++;
                    if($ind>=$sz)
                        {
                            $disp=$disp."</a>";
                            break;
                        }
                }
                if($ind<$sz)
                {
                    $disp=$disp."</a>";
                }
                $i=$ind-1;
            }
            else $disp=$disp.$st[$i];
        }
        echo $disp."<br>";
    }
}
?>
</div>
</div>
<script type="text/javascript">
    var file = document.getElementById('picture');

    file.onchange = function(e){
        var ext = this.value.match(/\.([^\.]+)$/)[1];
        switch(ext)
        {
            case 'jpg':
            case 'jpeg':
            case 'bmp':
            case 'png':
            case 'tif':
            case 'JPG':
            case 'JPEG':
            case 'BMP':
            case 'PNG':
            case 'TIF':
            
            break;
            default:
            alert('File type not supported, please select an image file.');
            this.value='';
        }
    };
    </script>
<?php include("../includes/layouts/footer.php");?>