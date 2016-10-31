<?php require_once("../../includes/session.php");?>
<?php require_once("../../includes/db_connection.php");?>
<?php require_once("../../includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);
    $first_name = explode(" ", $name_title['sname']);
    $current_id = $name_title['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login or Signup on Cambuzz. Buzz new events, Track your teacher or ask a question.">
    <meta name="keywords" content="Buzz, Events, Cambuzz, Track, Teacher, Question, Campus, Centralized information system">
    <meta name="author" content="Team Cambuzz">
    <title>Track your Teacher</title>
    <link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style-core.css">
    <link rel="stylesheet" href="assets/css/style-theme.css">
    <link rel="stylesheet" href="assets/css/style-forms.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

    <!-- styleinput -->
    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
    <script src="assets/js/search/prefixfree.min.js"></script>
    <style>
      .tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
            .tt-hint {
                width: 396px;
                height: 30px;
                padding: 8px 12px;
                font-size: 24px;
                line-height: 30px;
                border: 2px solid #ccc;
                border-radius: 8px;
                outline: none;
            }

            .tt-query { /* UPDATE: newer versions use tt-input instead of tt-query */
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            }

            .tt-hint {
                color: #999;
            }

            .tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
                width: 422px;
                margin-top: 12px;
                padding: 8px 0;
                background-color: #fff;
                border: 1px solid #ccc;
                border: 1px solid rgba(0, 0, 0, 0.2);
                border-radius: 8px;
                box-shadow: 0 5px 10px rgba(0,0,0,.2);
            }

            .tt-suggestion {
                padding: 3px 20px;
                font-size: 18px;
                line-height: 24px;
            }

            .tt-suggestion.tt-is-under-cursor { /* UPDATE: newer versions use .tt-suggestion.tt-cursor */
                color: #fff;
                background-color: #0097cf;

            }

            .tt-suggestion p {
                margin: 0;
            }

    </style>
    <script>
    $.noConflict();
    </script>
</head>

<body class="page-body  page-left-in"  style="font-family: 'Montserrat';">
<?php include_once("analyticstracking.php") ?>
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
                                if ($name_title["proset"]==0) { 
                            ?>
                                    <img src="assets/images/nopic.png" class="img-circle" height="200px" width="100px" style="border-radius: 100%;" />
                            <?php
                                } elseif ($name_title["proset"]==1) {
                                        $imageid=$name_title['id'];
                                        $dpcounter=$name_title['dpcounter'];
                                        //echo '<img src="data:image/jpeg;base64,' . base64_encode($name_title['data_propic']) . '" class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>'; 
                                        
                                        if($dpcounter>0)
                                        echo '<img src="images/' . $imageid."_".$dpcounter. '.jpg "class="img-circle" height="200px" width="100px"  style="border-radius: 100%;  min-height: 100px; min-width: 100px;"/>';
                                        else
                                        echo '<img src="images/' . $imageid. '.jpg "class="img-circle" height="200px" width="100px"  style="border-radius: 100%;"/>';
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
                    <li class="visible-xs">
                            <a href="logout.php" id="phone-logout">
                                <i class="entypo-logout"></i>
                                <span class="title">Logout</span>
                            </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
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
            <hr/>
            <div class="row">
                <div class="col-sm-12">
                    <h2 style="text-align: center; margin-top: 10%;">Enter Faculty's Name:</h2>
                    <form action="track_teacher.php" method="post">
                    <div class="search">
                        <svg version="1.1" viewBox="0 0 142.358 24.582">
                            <path id="search-path" fill="none" d="M131.597,14.529c-1.487,1.487-3.542,2.407-5.811,2.407
        c-4.539,0-8.218-3.679-8.218-8.218s3.679-8.218,8.218-8.218c4.539,0,8.218,3.679,8.218,8.218
        C134.004,10.987,133.084,13.042,131.597,14.529c0,0,9.554,9.554,9.554,9.554H0" />
                        </svg>
                        <label for="search" class="search-label"></label>
                        <input type="search" id="search" name="search_name" class="input-search"/>
                    </div>
                    </form>                      
                </div>                
            </div>

                   <div class="a-st" style="font-size: 20px; display:flex;justify-content:center;align-items:center; margin-top: 200px;">  
                    <?php
                           if (isset($_POST['search_name'])) {
                               $search_name = mysqli_real_escape_string($conn, $_POST['search_name']);
                               $search_query = "SELECT * FROM faculty_final WHERE name = '{$search_name}' LIMIT 1";
                               $search_result = mysqli_query($conn, $search_query);
                               confirm_query($search_result);
                               $search_title = mysqli_fetch_assoc($search_result);
                               //echo $search_title['period'];
                               if (!$search_title['name']) {
                                   echo "Not in database";
                               } else {
                                echo $search_title['name'];
                                echo "<br>";
                                echo $search_title['cabin'];
                                echo "<br>";
                                   $outarr = $search_title['period'];
                               $out = explode(" ", $outarr);
                               $matrix = zeros(5, 13);
                               $c = 0;
                               for ($i=0; $i < 5; $i++) { 
                                   for ($j=0; $j < 13; $j++) { 
                                       $matrix[$i][$j] = $out[$c++];                                    
                                   }                
                               }
                               date_default_timezone_set("Asia/Kolkata");
                               $day = date("l");
                               $hour = date("H");
                               $minute = date("i");
                               $matrix = array();
                               for ($rowIndx=0; $rowIndx<5; $rowIndx++){
                                    $matrix[] = array();
                                    for($colIndx=0; $colIndx<13; $colIndx++){
                                             $matrix[$rowIndx][$colIndx]=0;
                                   }
                               }
                              $c = 0;
                              for ($i=0; $i < 5; $i++) { 
                                  for ($j=0; $j < 13; $j++) { 
                                         $matrix[$i][$j] = $out[$c++];   
                                         //echo $matrix[$i][$j];
                                         //echo "<br>";
                                      }                
                              }
                              $timarr = array();
                              for ($rowIndx=0; $rowIndx<13; $rowIndx++){
                                  $timarr[] = array();
                                  for($colIndx=0; $colIndx<2; $colIndx++){
                                  $timarr[$rowIndx][$colIndx]=0;
                                }
                              }
                                   $timarr[0][0]=8;
                                   $timarr[0][1]=50;
                                   $timarr[1][0]=9;
                                   $timarr[1][1]=45;
                                   $timarr[2][0]=10;
                                   $timarr[2][1]=40;
                                   $timarr[3][0]=11;
                                   $timarr[3][1]=35;
                                   $timarr[4][0]=12;
                                   $timarr[4][1]=30;
                                   $timarr[5][0]=13;
                                   $timarr[5][1]=20;
                                   $timarr[6][0]=14; 
                                   $timarr[6][1]=05;
                                   $timarr[7][0]=14;
                                   $timarr[7][1]=55;
                                   $timarr[8][0]=15;
                                   $timarr[8][1]=50;
                                   $timarr[9][0]=16;
                                   $timarr[9][1]=45;
                                   $timarr[10][0]=17;
                                   $timarr[10][1]=40;
                                   $timarr[11][0]=18;
                                   $timarr[11][1]=35;
                                   $timarr[12][0]=19;
                                   $timarr[12][1]=30;
                  

                                   $tim_disp=array("8:50","9:45","10:40","11:35","12:30","13:20","14:05","14:55","15:50","16:45","17:40","18:35","19:30");
                   


                                   $r=10;
                                   $day_disp=array("Monday's","Tuesday's","Wednesday's","Thursday's","Friday's");
                                   if ($day=="Monday") $r=0;
                                   elseif ($day=="Tuesday") $r=1;
                                   elseif ($day=="Wednesday") $r=2;
                                   elseif ($day=="Thursday") $r=3;
                                   elseif ($day=="Friday") $r=4;
                                   $start=0;
                                   $end=0;
                                   $itr=0;
                                   if($r>4)
                                   {
                                      $r=0;
                                      $itr=0;
                                   }
                                   elseif(($hour>=19 && $minute>=30)||($hour>=20))
                                   {
                                       $r++;
                                        //$itr=0;
                                   }
                                   elseif($hour>=8)
                                   {
                                       for($i=0;$i<13;$i++)
                                        {
                                            if($hour==$timarr[$i][0])
                                            {
                                                if($minute<=$timarr[$i][1])
                                                {
                                                   $itr=$i;
                                                }
                                                else $itr=$i+1;
                                                break;
                                            }
                                        }
                                   }
                                   $r=$r%5;
                                   echo $day_disp[$r];
                                   echo "<br>";
                                   echo "Free slots:<br>";
                                   for($i=$itr;$i<13;$i++)
                                   {
                                        if($matrix[$r][$i]==0)$start=$i;
                                        else continue;
                                        while($matrix[$r][$i]==0)
                                        {
                                             $end=$i;
                                             $i++;
                                             if($i==13)break;
                                        }
                                        if($start==0)
                                        {
                                            echo "8:00-".$tim_disp[$end];
                                        }
                                        else
                                        {
                                             echo $tim_disp[$start-1]."-".$tim_disp[$end];
                                        }
                                        echo "<br>";
                                   }
                               }                            
                           }
                       ?></div>
        </div>        
        <footer>
        </footer>
    </div>
    <script src="assets/js/modernizr.custom.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>
    <script src="assets/js/search/index.js"></script>
    <!-- Imported scripts on this page --> 
    <script src="assets/js/style-custom.js"></script>
    <script src="assets/js/style-api.js"></script>
    <script src="assets/js/style-demo.js"></script>

    <script src="assets/js/typeahead.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.min.js"></script>
    <script src="assets/js/joinable.js"></script>
    <script src="assets/js/resizeable.js"></script>
    <script src="assets/js/uiMorphingButton_fixed.js"></script>


    <script>
      var substringMatcher = function(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });

        cb(matches);
      };
    };

 var teachersname = [
     'A. ASHOK ',
     'A. GIRIDHARAN ',
     'A. SURESH ',
     'A.ANURADHA ',
     'A.D. SIVAGAMI ',
     'AARTHI PRIYA S ',
     'Abdulquadir.md ',
     'ABHISHEK KUMAR SINGH ',
     'Abraham Sudharson Ponraj ',
     'ALAMELU C ',
     'Alan G ',
     'Alok.chauhan ',
     'ANANIAH DURAI ',
     'Anantha Krishnan V ',
     'Angalaeswari S ',
     'Angeline Ezhilarasi G ',
     'ANGELINE GAUTAMI FERNANDO ',
     'Anita Angeline ',
     'ANJALI GOPAKUMAR ',
     'Annamalai K ',
     'ANNIS FATHIMA ',
     'Anusooya.g ',
     'Aparna V ',
     'Arockia Selvakumar ',
     'Arockiasamy S ',
     'ARUN KUMAR A ',
     'Arun Kumar Sarma ',
     'ASHA S ',
     'ASNATHVICTY PHAMILA Y ',
     'Atanu Dutta ',
     'Augusta Sophy Beulet P ',
     'B. Nagajayanthi ',
     'BALA MURUGAN M S ',
     'BALAJI J ',
     'Balamurugan P ',
     'Berin Greeni A ',
     'BERLIN HENCY V ',
     'BHARGHA RAJARAM ',
     'Bhaskara Rao ',
     'BHUVANESWARI ',
     'Bhuvaneswari R ',
     'Bindhu V M ',
     'BINU BEN JOSE D R ',
     'Bornali Sarma ',
     'Brintha Therese A ',
     'C. UMAYAL ',
     'C. UTHIRAM ',
     'C. Vijayalakshmi ',
     'Caroline Ponraj ',
     'Chandrasekar G ',
     'Chandrasekaran N ',
     'CHITRA K ',
     'CHRISTO MICHAEL T ',
     'Christyjackson.j ',
     'CLAUDIA JEYA PUSHPA D ',
     'D.SARAVANA KUMAR ',
     'DAVID MAXIM GURURAJ A ',
     'Davidson Jebaseelan ',
     'Deivanai K ',
     'DEVAPRAKASAM D ',
     'Dhanasekar S ',
     'DINKAR V R ',
     'DIVYA P V ',
     'Dr Elavenil S ',
     'Dr. A. Peer Fathima ',
     'DR. NIRMAL THYAGU ',
     'DR. R. CHENDUR KUMARAN ',
     'DR. R. NANDHINI ',
     'DR. R. NARAYANAN ',
     'DR. S. JEYANTHI ',
     'Dr. Shyam Kumar M B ',
     'DR. SREEKANTH DONDAPATI ',
     'DR. VATITHILINGAM C ',
     'DR.AJITH ',
     'DR.AJITHL ',
     'DR.AJITHT ',
     'DR.BHARGAVI ',
     'DR.BINDU.B ',
     'DR.DEIVANATHAN ',
     'DR.MADYEVAN.B ',
     'DR.RAMESH SUNDAR.J ',
     'Dr.Saravanan K ',
     'DR.SUBHAKARA REDDY ',
     'Evangeline Sabina Rajasekar ',
     'FATHEH VEER SINGH ',
     'Febin Daya J  ',
     'Febin Daya J L ',
     'Feroskhan M ',
     'Gajendra Kumar ',
     'GANDHI M ',
     'Ganesan R ',
     'Gayathri Devi B ',
     'gayathri r ',
     'Geetha M ',
     'GEETHA S ',
     'Gnana Swathika O V ',
     'GOPINATH MUDHANA ',
     'GOPINATHAN N ',
     'Govindarajan P ',
     'Guga Priya G ',
     'GUNABALAN R ',
     'Hannah Grace G ',
     'HARI PRAKASH N ',
     'Hariharan S ',
     'Harini S ',
     'Helen Santhi M ',
     'Hema N ',
     'Hemamalini ',
     'HEMANTH C ',
     'HEPSIBA MABEL V ',
     'Ilakiyaselvan N ',
     'Indra Raja Singh ',
     'INFANT SOLOMON VINOTH S ',
     'IYSWARYA ANNAPOORANI ',
     'JAFFERSON J M ',
     'JAGADEESH KANNAN R ',
     'Jaganathan B ',
     'JAGANNATH M ',
     'James Daniel Paul P ',
     'Jamuna K ',
     'Janardhan Reddy K ',
     'Jaya Vignesh T ',
     'JAYANTA PARUI ',
     'JAYARAM B ',
     'JEBARAJ.C ',
     'Jegadeeshwaran  ',
     'Jegadeeshwaran R ',
     'Jeganathan L ',
     'Jenila Livingston L M ',
     'John Kennedy L ',
     'John Sahaya Rani Alex ',
     'Joseph Daniel ',
     'Joseph Jeya Anand S ',
     'Joseph Sathiaraj P ',
     'Justus S ',
     'K. KAVIYARASAN ',
     'K. VINISHARANI ',
     'Kaliyappan M ',
     'Kalyani Desikan ',
     'Kanchana Bhaskaran V S ',
     'Kanchana Devi ',
     'KANIMOZHI G ',
     'Kannan S ',
     'Karmel A ',
     'Karthikeyan C P ',
     'KARTHIKEYAN K ',
     'KARTHIYAINI S ',
     'KARUNAMURTHY K ',
     'KAUSTAB GHOSH ',
     'Kavya Alluru ',
     'KESAVARMOORTHY R ',
     'Khadar Nawas K ',
     'KRISHNENDU BISWAS ',
     'KRITHIGA S ',
     'Kumar R ',
     'KURUSEELAN S ',
     'Lakshmi B ',
     'Lavanya V ',
     'Lenin Babu M C ',
     'Lenin N C ',
     'Luke Gerard Christie ',
     'M SUKUMAR ',
     'M. Elango ',
     'M. Jayasudha ',
     'M. Prabhakar ',
     'M. SUNDARARAJAN ',
     'M.P. SRINIVASAN ',
     'Maddikera Kalyan Chakravarthi ',
     'Mahalakshmi S ',
     'Maheswari N ',
     'Maheswari R ',
     'Maheswari S ',
     'MALATHI G ',
     'Manavalla Sreekanth ',
     'Manikandan N ',
     'Manikandan P ',
     'Manimaran ',
     'Manoj Kumar R ',
     'MARIA EVELYN JUCUNDA ',
     'Mary Chandini Y ',
     'MAYA RATHNASABAPATHY ',
     'Meenakshi J ',
     'Meera P S ',
     'Menaka R ',
     'Mini Ghosh ',
     'MOHAMED IMRAN A ',
     'Mohan K ',
     'Mohana N ',
     'Muralidhar A ',
     'Muthulakshmi S ',
     'MUTHUMANI K ',
     'Muthunagai ',
     'N.Gobinath ',
     'Nachiyappan.s ',
     'NAGARAJ S V ',
     'NATHIYA N ',
     'NAVAMATHAVAN R ',
     'Neelanarayanan.v ',
     'NEW FACULTY - VITBS ',
     'NIKITA KONNIKAR ',
     'Niraj Kumar ',
     'Nisha V.M ',
     'Nithya Darisini P.S ',
     'Nithya P ',
     'Nithya Venkatesan ',
     'NITYARANI.B ',
     'Nivedita M ',
     'Padmanabhan R ',
     'Pankaj Shukla ',
     'PARTHIBAN V ',
     'Parvathi R ',
     'PATCHAINAYAGI S ',
     'Pattabiraman V ',
     'POORNIMA T ',
     'Prabakaran R ',
     'Prabhakar Rao B V A N S S ',
     'Prabhakar V ',
     'Prabhakaran D ',
     'Pradeep Kumar T.S ',
     'Pradeep.kv ',
     'Prakash B ',
     'Prakash R ',
     'prakash.v ',
     'Prassanna.J ',
     'Prathiba A ',
     'Pratibha Nalini R ',
     'PREMALATHA L ',
     'Priyaadharshini M ',
     'Priyadarshini J ',
     'Prof. Nilanjan Tewari ',
     'Prof.Nithyanandam P ',
     'Prof.Sakthi Ganesh M ',
     'Prof.Vijayakumar ',
     'punitha.k ',
     'Punithavelan N ',
     'QI NAICHAN ',
     'R. Senthil Kumar ',
     'RABBIRAJ C ',
     'Rabindrakumar singh ',
     'Radha R ',
     'RAGHUKIRAN NADIMPALLI ',
     'Rajarajeswari S ',
     'RAJASEKARAN V ',
     'RAJASINGH HANDAL DEVADAS ',
     'RAJAVENKATESAN P R L ',
     'Rajendra Kumar K ',
     'Rajesh Kanna B ',
     'Rajesh Kumar ',
     'Rajesh M ',
     'Rajitha K ',
     'Rajiv Vincent ',
     'Rajkumar S ',
     'Ralph Samuel Thangaraj ',
     'Ramesh Kannan M ',
     'Ramesh R ',
     'Ramesh.ragala ',
     'RAVI MEDHANKAR ',
     'Ravi Prakash Dwivedi ',
     'Ravi Sankar A ',
     'RAVI V ',
     'Reena Monica P ',
     'Reeves Wesley J ',
     'Rekha D ',
     'REVATHI G K ',
     'Revathi S ',
     'Rukmani P ',
     'Rupam Singh ',
     'S. Bharathi Raja ',
     'S. Radha ',
     'S.YUVARAJ ',
     'Sabumon P C ',
     'Sailaja V ',
     'Sajidha S.A ',
     'SAKKARAVARTHI R ',
     'SAKTHIVEL K ',
     'Sakthivel S M ',
     'Saleel Ismail ',
     'Saleena B ',
     'Sandhya P ',
     'SANGEETHA RG ',
     'SANJIT DAS ',
     'Sankary V ',
     'Saradha Rajkumar ',
     'SARANYA NAIR M ',
     'SARAVANAKUMAR R ',
     'Saroj Kumar Dash ',
     'Sasikumar M ',
     'Sasipriya P ',
     'Sathis Kumar B ',
     'SATHISH KUMAR A ',
     'Sathyarajasekaran K ',
     'Savariah Xavier Y C ',
     'SENTHIL KUMAR K ',
     'Senthil Kumar M ',
     'Senthil Kumar N ',
     'Senthilpandian M ',
     'Shankar G ',
     'Sharath Kumar Jagannathan ',
     'Sharon Sophia ',
     'Shihabudheen M Maliyekkal ',
     'Shridevi S ',
     'sivabalakrishnan.m ',
     'SIVAGAMI M ',
     'SIVAKAMI B ',
     'Sivakumar R ',
     'Sivarajan S ',
     'SIVASUBRAMANIAN.A ',
     'Sreedevi V T ',
     'SRI RAMALAKSHMI P ',
     'Sri Revathi B ',
     'Sridhar Ranganathan ',
     'Sridhar V G ',
     'SRIKANTH GOLLAPUDI ',
     'Srivatsan K ',
     'Srutha Keerthi B ',
     'Subashini S ',
     'SUBBULAKSHMI T ',
     'SUBBULEKSHMI D ',
     'Subhashini N ',
     'Subhasri Vijayakumar ',
     'SUCHETHA M ',
     'Suganya G ',
     'Sugumaran V ',
     'Sumaiya Thaseen I ',
     'SWEETLIN HEMALATHA C ',
     'SyedIbrahim.SP ',
     'T. RATNAJI ',
     'T.DEEPA ',
     'Tamil Selvan P ',
     'Tanushree Choudhry ',
     'Thomas Abraham J V ',
     'Tulasiprasad.sariki ',
     'Uma Maheswari S ',
     'Uma Maheswari V ',
     'Umadevi S ',
     'Umamaheswari E ',
     'UMASANKAR V ',
     'UMITTY SRINIVASA RAO ',
     'Usha Kiran Kommuri ',
     'V. VIGNESH ',
     'Vanchinathan P ',
     'Vasanthika S ',
     'VASUGI K ',
     'VASUGI V ',
     'VELMATHI G ',
     'Venkatasubramanian K ',
     'VENUGOPAL T ',
     'Vergin Raja Sarobin M ',
     'VETRIVELAN P ',
     'Vigneswaran T ',
     'Vijayakumar.v ',
     'Vijayalakshmi A ',
     'VIJAYALAKSHMI V ',
     'Vijayaram T R ',
     'VIJENDER NALLAPU ',
     'VINAYAGAMURTHY G ',
     'Vinitha G ',
     'VISHNU PRIYA R ',
     'VISITING FACULTY -1 ',
     'Viswanathan V ',
     'Yamini Sreevalli I ', 
    ];

    $('.search .input-search').typeahead({
      hint: false,
      highlight: true,
      minLength: 1
    },
    {
      name: 'teachersname',
      source: substringMatcher(teachersname)
    });
</script>
</body>

</html>
<?php
    mysqli_free_result($name_result);
    if (isset ($conn)){
            mysqli_close($conn);
    }
?>