<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php require_once("../../includes/validation_functions.php");?>
<?php confirm_logged_in(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['sname']);
?>
<?php
$user = find_user_by_username($_SESSION["username"]);

if (!$user) {
    redirect_to("buzz.php");
}
?>
<?php
    $default_branch = "CSE ECE ME EEE CIVIL MBA MCA MS LAW";
    $default_club = "LUG NSS Dance Music Sports DebSoc Automotive Dramatic Health Arts English Android Code Event Robotics Woman Entrepreneurship VITeach Quiz NCC";
    $sent1 = $default_branch." ".$default_club;
    $sent2 = $name_title['filter_branch']." ".$name_title['filter_club'];
    $out = explode(" ", $sent1);
    $size_array = sizeof($out);
    $tobeDisplayed = new SplFixedArray($size_array);
    for ($m=0; $m < $size_array; $m++) { 
        $sry = array("$out[$m] $sent2");
        $temp = $out[$m];
        $n2 = strlen($temp);
        $s = implode(" ", $sry);
        $n = strlen($s);
        $Z = new SplFixedArray($n);
        $Z[0] = $n;
        $L = 0;
        $R = 0;
        for ($i= 1; $i < $n; $i++) { 
            if ($i> $R) {
                $L = $R = $i;
                while ($R < $n && $s[$R-$L+$i]==$s[$R-$L]) {
                    $R++;
                }
                $Z[$i] = $R-$L;
                $R--;           
            } else {
                $k = $i-$L;
                if ($Z[$k]<$R-$i+1) {
                    $Z[$k] = $Z[$i];
                } else {
                    $L = $i;
                    while ($R < $n && $s[$R-$L+$i]==$s[$R-$L]) {
                        $R++;
                    }
                    $Z[$i] = $R-$L;
                    $R--;
                }
            }
        } 
        $flag=0;    
        for ($i=1; $i < $n ; $i++) { 
            if ($Z[$i]>=$n2) { 
                $tobeDisplayed[$m]=1;
                break;
            } else {
                $tobeDisplayed[$m] = 0;
            }
        }
    }       
?>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['pass_check'])) { $pass_check = $_POST['pass_check'];    }
    if (isset($_POST['propic_check'])) { $propic_check = $_POST['propic_check'];    }
    if (($pass_check=="yes")&&($propic_check=="yes")&&(isset($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
                $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
                $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
                $size_propic = intval($_FILES['propic']['size']);
                $filter_branch = implode(" ", $_POST['branch']);
                $filter_club = implode(" ", $_POST['club']);
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', filter_branch = '{$filter_branch}', filter_club = '{$filter_club}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="yes")&&(isset($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
                $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
                $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
                $size_propic = intval($_FILES['propic']['size']);
                $filter_branch = implode(" ", $_POST['branch']);
                
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', filter_branch = '{$filter_branch}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="yes")&&(empty($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
                $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
                $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
                $size_propic = intval($_FILES['propic']['size']);
                
                $filter_club = implode(" ", $_POST['club']);
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', filter_club = '{$filter_club}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="yes")&&(empty($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
                $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
                $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
                $size_propic = intval($_FILES['propic']['size']);
                
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="no")&&(isset($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                
                $filter_branch = implode(" ", $_POST['branch']);
                $filter_club = implode(" ", $_POST['club']);
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', filter_branch = '{$filter_branch}', filter_club = '{$filter_club}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="no")&&(isset($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                
                $filter_branch = implode(" ", $_POST['branch']);
                
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', filter_branch = '{$filter_branch}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="no")&&(empty($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                
                $filter_club = implode(" ", $_POST['club']);
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}', filter_club = '{$filter_club}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="yes")&&($propic_check=="no")&&(empty($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("new_password", "password");
        validate_presence($required_fields);
    
        if (empty($errors)) {

            $username = $_SESSION["username"];
            $password = $_POST["password"];
            $found_user = attempt_login($username, $password);

            if ($found_user) {

                $_SESSION["user_id"] = $found_user["id"];
                $_SESSION["username"] = $found_user["username"];
                $sname = $_POST['sname'];
                $email = $_POST['email'];                
                $hashed_password = password_encrypt($_POST["new_password"]);
                
                $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', hashed_password = '{$hashed_password}' WHERE username = '{$current_user}' LIMIT 1";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_affected_rows($conn) == 1) {
                    redirect_to("buzz.php");
                } else {
                    $_SESSION["message"] = "Updation failed.";
                }
            } else {
                $_SESSION["message"] = "Incorrect old password";
            }
        }
    } elseif (($pass_check=="no")&&($propic_check=="yes")&&(isset($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];                
            
            $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
            $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
            $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
            $size_propic = intval($_FILES['propic']['size']);
            $filter_branch = implode(" ", $_POST['branch']);
            $filter_club = implode(" ", $_POST['club']);
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', filter_branch = '{$filter_branch}', filter_club = '{$filter_club}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="yes")&&(isset($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];                
            
            $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
            $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
            $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
            $size_propic = intval($_FILES['propic']['size']);
            $filter_branch = implode(" ", $_POST['branch']);
            
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', filter_branch = '{$filter_branch}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="yes")&&(empty($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];                
            
            $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
            $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
            $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
            $size_propic = intval($_FILES['propic']['size']);
            $filter_branch = implode(" ", $_POST['branch']);
            $filter_club = implode(" ", $_POST['club']);
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', filter_club = '{$filter_club}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="yes")&&(empty($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];                
            
            $name_propic = $conn->real_escape_string ($_FILES['propic']['name']);
            $mime_propic = $conn->real_escape_string ($_FILES['propic']['type']);
            $data_propic = $conn->real_escape_string(file_get_contents($_FILES ['propic']['tmp_name']));
            $size_propic = intval($_FILES['propic']['size']);
            
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', name_propic = '{$name_propic}', mime_propic = '{$mime_propic}', data_propic = '{$data_propic}', size_propic = '{$size_propic}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="no")&&(isset($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];           
            
            $filter_branch = implode(" ", $_POST['branch']);
            $filter_club = implode(" ", $_POST['club']);
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', filter_branch = '{$filter_branch}', filter_club = '{$filter_club}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="no")&&(isset($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];
            $filter_branch = implode(" ", $_POST['branch']);
            
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', filter_branch = '{$filter_branch}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="no")&&(empty($_POST['branch']))&&(isset($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];
            
            $filter_club = implode(" ", $_POST['club']);
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}', filter_club = '{$filter_club}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } elseif (($pass_check=="no")&&($propic_check=="no")&&(empty($_POST['branch']))&&(empty($_POST['club']))) {
        $required_fields = array("sname", "email");
        validate_presence($required_fields);
    
        if (empty($errors)) {                
            $sname = $_POST['sname'];
            $email = $_POST['email'];
            $query = "UPDATE users SET sname = '{$sname}', email = '{$email}' WHERE username = '{$current_user}' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_affected_rows($conn) == 1) {
                redirect_to("buzz.php");
            } else {
                $_SESSION["message"] = "Updation failed.";
            }
        }        
    } 
} 
?>
<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Cambuzz" />
    <meta name="author" content="" />
    <title>Campbuzz</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    
    <!-- Buzz button -->
    <link rel="stylesheet" type="text/css" href="assets/css/buttoncreatebuzz.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    
    
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/stylingtextinput.css" /> -->
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    
    <script>
    $.noConflict();
    </script>
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="page-body page-fade-only">
    <div class="page-container">
        <div class="sidebar-menu">
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="buzz.php">
                            <h1 style="font-family: 'Pacifico', sans-serif; font-weight: 200px; color: white; margin-top: -2px; font-size:25px;">vitcc cambuzz</h1>
                        </a>
                    </div>
                    <!-- logo collapse icon -->
                    <div class="sidebar-collapse">
                        <a href="#" class="sidebar-collapse-icon">
                            <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                    <div class="sidebar-mobile-menu visible-xs">
                        <a href="#" class="with-animation">
                            <!-- add class "with-animation" to support animation -->
                            <i class="entypo-menu"></i>
                        </a>
                    </div>
                </header>
                <div class="sidebar-user-info">
                    <div class="sui-normal">
                        <div class="user-link">
                            <?php
                                if (empty($name_title["data_propic"])) { 
                            ?>
                                    <img src="assets/images/nopic.png" class="img-circle" height="200px" width="100px" style="border-radius: 100%;" />
                            <?php
                                } elseif (isset($name_title["data_propic"])) {
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>';        
                                }
                            ?>
                            <span>Welcome,</span>
                            <strong><?php echo htmlentities($first_name[0]); ?></strong>
                        </div>
                    </div>
                    <div class="sui-hover inline-links animate-in">
                        <a href="settings.php">
                            <i class="entypo-pencil"></i> Account Settings
                        </a>
                        <span class="close-sui-popup">&times;</span>
                       
                    </div>
                </div>
                <ul id="main-menu" class="main-menu">
                    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                    <li>
                        <a href="buzz.php">
                            <i class="entypo-megaphone"></i>
                            <span class="title">Buzz</span>
                        </a>
                    </li>
                    <li>
                        <a href="track_teacher.php">
                            <i class="entypo-graduation-cap"></i>
                            <span class="title">Track Teacher</span>
                        </a>
                    </li>
                    <li>
                        <a href="quora.php">
                            <i class="entypo-publish"></i>
                            <span class="title">Ask a question</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content" style="overflow: hidden;">
            <div class="row">
                 <div class="col-md-6 col-sm-8 clearfix">
                    <ul class="user-info pull-left pull-right-xs pull-none-xsm">
            
                        <!--  Notifications -->
                        <li class="notifications dropdown">
            
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="entypo-attention"></i>
                                <span class="badge badge-info">2</span>
                            </a>
            
                            <ul class="dropdown-menu">
                                <li class="top">
                                    <p class="small">
                                        <a href="#" class="pull-right">Mark all Read</a>
                                        You have <strong>2</strong> new notifications.
                                    </p>
                                </li>
                                
                                <li>
                                    <ul class="dropdown-menu-list scroller">
                                        <li class="unread notification-success">
                                            <a href="#">
                                                <i class="entypo-user-add pull-right"></i>
                                                
                                                <span class="line">
                                                    <strong>Sharad Sharad</strong>
                                                </span>
                                                
                                                <span class="line small">
                                                    30 seconds ago
                                                </span>
                                            </a>
                                        </li>
                                        
                                        <li class="unread notification-secondary">
                                            <a href="#">
                                                <i class="entypo-heart pull-right"></i>
                                                
                                                <span class="line">
                                                    <strong>You gotta answer</strong>
                                                </span>
                                                
                                                <span class="line small">
                                                    2 minutes ago
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="external">
                                    <a href="#">View all notifications</a>
                                </li>
                            </ul>
            
                        </li>       
                    </ul>
                </div>
                <div class="col-md-6 col-sm-4 clearfix hidden-xs" style="float: right;">
                    <ul class="list-inline links-list pull-right">
                        <!-- Language Selector -->
                        <li>
                            <a href="settings.php">
                            Settings <i class="entypo-cog right"></i>
                        </a>
                            <li>
                                <a href="logout.php">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                            </li>
                    </ul>
                </div>
            </div>
            <hr />
            <!-- main content starts here -->
            <div class="container">
                <div class="row">
                    <form role="form" method="post"  class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" action="settings.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary" data-collapsed="0">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            General Settings
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" name="sname" value="<?php echo $name_title['sname']; ?>" class="form-control" id="field-1" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-4" class="col-sm-3 control-label">Email address</label>
                                            <div class="col-sm-5">
                                                <input type="email" class="form-control" name="email" id="field-4" data-validate="required,email" value="<?php echo $name_title['email']; ?>" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-1" class="col-sm-3 control-label">Change Password?</label>
                                            <div class="col-sm-5">
                                                <ul class="icheck-list" style="display: inline-flex;">
                                                    <li style="margin-right: 10px; margin-left: 30px;">
                                                        <input tabindex="7" class="icheck" type="radio" value="yes" id="yes" name="pass_check">
                                                        <label for="minimal-radio-1">Yes</label>
                                                    </li>
                                                    <li>
                                                        <input tabindex="8" class="icheck" type="radio" value="no" id="no" name="pass_check" checked>
                                                        <label for="minimal-radio-1">No</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="password_form" style="display: none;">
                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label">Old Password</label>
                                                <div class="col-sm-5">
                                                    <input type="password" name="password" class="form-control" id="require">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-5">
                                                    <input type="password" name="new_password" class="form-control" id="txtNewPassword">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label">Retype Password</label>
                                                <div class="col-sm-5">
                                                    <input type="password" class="form-control" id="txtConfirmPassword">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="registrationFormAlert" id="divCheckPasswordMatch" style="margin-left: 160px;"></div>
                                        <div class="form-group">                                    
                                            <label for="field-1" class="col-sm-3 control-label">Change Profile Picture?</label>
                                            <div class="col-sm-5">
                                                <ul class="icheck-list" style="display: inline-flex;">
                                                    <li style="margin-right: 10px; margin-left: 30px;">
                                                        <input tabindex="7" class="icheck" type="radio" value="yes" id="yes_propic" name="propic_check">
                                                        <label for="minimal-radio-1">Yes</label>
                                                    </li>
                                                    <li>
                                                        <input tabindex="8" class="icheck" type="radio" value="no" id="no_propic" name="propic_check" checked>
                                                        <label for="minimal-radio-1">No</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="propic_form" style="display: none;">
                                            <div class="form-group">
                                                <div class="col-sm-5">
                                                    <input type="file" name="propic" accept=".jpeg, .jpg, .bmp, .png" class="form-control" id="propic">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-primary" data-collapsed="0">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            Edit Branch Preferences
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="scrollable" data-height="200" data-scroll-position="right" data-rail-color="#333" data-rail-opacity=".9" data-rail-width="8" data-rail-radius="10" data-autohide="0">
                                            <ul class="icheck-list" style="text-align: left;">
                                                <li>
                                                    <input tabindex="5" type="checkbox" name="branch[]" value="CSE" <?php if($tobeDisplayed[0]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-1">
                                                    <label for="minimal-checkbox-1">CSE</label>
                                                </li>
                                                <li>
                                                    <input tabindex="6" type="checkbox" class="icheck" id="minimal-checkbox-2" name="branch[]" value="ECE" <?php if($tobeDisplayed[1]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-2">ECE</label>
                                                </li>
                                                <li>
                                                    <input tabindex="6" type="checkbox" name="branch[]" value="ME" class="icheck" id="minimal-checkbox-2" <?php if($tobeDisplayed[2]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-2">ME</label>
                                                </li>
                                                <li>
                                                    <input tabindex="6" type="checkbox" class="icheck" id="minimal-checkbox-2" name="branch[]" value="EEE" <?php if($tobeDisplayed[3]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-2">EEE</label>
                                                </li>
                                                <li>
                                                    <input tabindex="5" type="checkbox" class="icheck" id="minimal-checkbox-1" name="branch[]" value="CIVIL" <?php if($tobeDisplayed[4]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-1">CIVIL</label>
                                                </li>
                                                <li>
                                                    <input tabindex="5" type="checkbox" class="icheck" id="minimal-checkbox-1" name="branch[]" value="MBA" <?php if($tobeDisplayed[5]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-1">MBA</label>
                                                </li>
                                                <li>
                                                    <input tabindex="5" type="checkbox" class="icheck" id="minimal-checkbox-1" name="branch[]" value="MCA" <?php if($tobeDisplayed[6]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-1">MCA</label>
                                                </li>
                                                <li>
                                                    <input tabindex="5" type="checkbox" class="icheck" id="minimal-checkbox-1" name="branch[]" value="MS" <?php if($tobeDisplayed[7]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-1">MS</label>
                                                </li>
                                                <li>
                                                    <input tabindex="5" type="checkbox" class="icheck" id="minimal-checkbox-1" name="branch[]" value="LAW" <?php if($tobeDisplayed[8]==1) echo "checked"; ?> >
                                                    <label for="minimal-checkbox-1">LAW</label>
                                                </li>                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel panel-primary" data-collapsed="0">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            Edit Club Preferences
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="scrollable" data-height="200" data-scroll-position="right" data-rail-color="#333" data-rail-opacity=".9" data-rail-width="8" data-rail-radius="10" data-autohide="0">
                                            <ul class="icheck-list" style="text-align: left;">
                                                <li>
                                                                        <input tabindex="5" type="checkbox" name="club[]" value="LUG" <?php if($tobeDisplayed[9]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-1">
                                                                        <label for="minimal-checkbox-1">Linux User Group (LUG)</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="NSS" <?php if($tobeDisplayed[10]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">National Service Scheme</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Dance" <?php if($tobeDisplayed[11]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Dance Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Music" <?php if($tobeDisplayed[12]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Music Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Sports" <?php if($tobeDisplayed[13]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Sports Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="DebSoc" <?php if($tobeDisplayed[14]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Debate Society</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Automotive" <?php if($tobeDisplayed[15]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Society of Automotive Engineers</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Dramatic" <?php if($tobeDisplayed[16]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Dramatic Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Health" <?php if($tobeDisplayed[17]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Health Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Arts" <?php if($tobeDisplayed[18]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">The Fine Arts Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="English" <?php if($tobeDisplayed[19]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">English Literary Association</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Android" <?php if($tobeDisplayed[20]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Android Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Code" <?php if($tobeDisplayed[21]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Code Y-Gen Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Event" <?php if($tobeDisplayed[22]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Event Managers' Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Robotics" <?php if($tobeDisplayed[23]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Robotics Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Woman" <?php if($tobeDisplayed[24]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Woman Development Cell</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Entrepreneurship" <?php if($tobeDisplayed[25]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">National Entrepreneurship Network</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="VITeach" <?php if($tobeDisplayed[26]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">VITeach</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="Quiz" <?php if($tobeDisplayed[27]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">Quiz Club</label>
                                                                    </li>
                                                                    <li>
                                                                        <input tabindex="6" type="checkbox" name="club[]" value="NCC" <?php if($tobeDisplayed[28]==1) echo "checked"; ?> class="icheck" id="minimal-checkbox-2">
                                                                        <label for="minimal-checkbox-2">NCC</label>
                                                                    </li>                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                 <div class="form-group default-padding" style="display: flex; justify-content: center; align-items: center;">
                    <input type="submit" name="submit" class="btn btn-success" value="Save Changes" style="margin-right: 5px;">
                    <button class="btn"><a href="buzz.php">Cancel</a></button>
                </div>
            </div>
        </div>
    </div>
    <footer>
    </footer>
    </div>
    </article>
    </div>
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  

    <script src="assets/js/fileinput.js"></script>
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js"></script>

    <!-- Bottom scripts (common) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/uiMorphingButton_fixed.js"></script>
    <script src="assets/js/style-api.js"></script>
   
   
    <script type="text/javascript">
    var file = document.getElementById('propic');

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
    <script type="text/javascript"><!--
    $(function() {
        $("#txtConfirmPassword").keyup(function() {
            var password = $("#txtNewPassword").val();
            $("#divCheckPasswordMatch").html(password == $(this).val() ? "Passwords match." : "Passwords do not match!");
        });
    });
</script>
</body>

</html>
<?php
if (isset ($conn)){
    mysqli_close($conn);
}
?>