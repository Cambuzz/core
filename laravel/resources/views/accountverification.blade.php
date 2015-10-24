
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cambuzz</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" src="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" />
    <link rel="stylesheet" type="text/css" href="css/background.css" />
    <link rel="stylesheet" type="text/css" href="css/buttoncreatebuzz.css">
    <script src="js/modernizr.custom.js"></script>
</head>

<body id="page-top">
      <ul class="cb-slideshow">
        <li><span>Image 01</span>
        </li>
        <li><span>Image 02</span>
        </li>
        <li><span>Image 03</span>
        </li>
        <li><span>Image 04</span>
        </li>
        <li><span>Image 05</span>
        </li>
        <li><span>Image 06</span>
        </li>
    </ul>
  
  
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <div class="heading-text animated fadeInUp">cambu<span class="animated tada">zz</span></div>
                <p class="animated fadeInUp"><span style="font-size: 20px;">&#35; </span>VITC Chapter</p>
            </div>
        </div>
         {!! Form::open( array(
                'url' => 'confirmation',
                'method' => 'post',
                'class' => 'loginform'
            ) ) !!}
         <input type="text" style="display:none;" id="username" name="username" value="{{$data['username']}}">
          <input type="text" style="display:none;" id="secret" name="secret" value="{{$data['secret']}}">
        <div class="mockup-content">
            <div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed login">
           
                
                <button type="submit" style="color: white; background-color: #e75854;">Click to verify</button>
            
               
            </div>
            <!-- Sign Up Button -->
           
            <!-- morph-button -->
        </div>
         {!! Form::close() !!}  
    </header>
    
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="js/uiMorphingButton_fixed.js"></script>
    
    
    <script type="text/javascript">
       
    </script>

    <script  src="HTTP://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
      
          
        
    </script> 

</body>

</html>