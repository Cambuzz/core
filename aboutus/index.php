<!DOCTYPE html>

<head>
    <title>About Us</title>
    <link rel="stylesheet" href="css/particle.css" />
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <!-- intro text -->
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/font.css" />
    <script src="js/jquery.min.js"></script>
    <!-- team bootstrapped -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- send mail -->
    <link rel="stylesheet" type="text/css" href="css/fixel.css">
    <script>
    var randoms = ['Internet/Cabin'];
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/fixel.min.js"></script>
    <!-- fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <script>
    window.smultron = {
        isMobile: false
    }
    </script>
    <style>
    .social-roll-facebook {
        background-image: url('images/fb.png');
        height: 48px;
        width: 48px;
        margin: 10px;
        float: left;
        border-radius: 50%;
        -webkit-transition: all ease 0.3s;
        -moz-transition: all ease 0.3s;
        -o-transition: all ease 0.3s;
        -ms-transition: all ease 0.3s;
        transition: all ease 0.3s;
    }
    
    .social-roll-facebook:hover {
        box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.8);
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    
    .whatwedo {
        transform: skewY(-10deg);
    }
    
    #aboutusinnercontent {
        transform: skewY(10deg);
    }
    
    .team {
        transform: skewY(-10deg);
    }
    
    #teamcontainer {
        transform: skewY(10deg);
    }
    </style>
</head>

<body class="home blog">
    <!-- cookies -->
    <!-- page header -->
    <header role="banner" class="pageHeader">
        <!-- nav -->
        <!-- what we do simple -->
        <section class="whatwedoSimple">
            <div class="pad">
                <section class="intro" id="intro">
                    <div class="row" id="middle_row">
                        <div class="medium-6 columns">
                            <section class="cd-intro">
                                <div class="container">
                                    <section class="intro1" id="intro1" style="margin-top: 50px;">
                                        <p style="line-height: 0.7;"> <span class="design" style="font-family: 'Montserrat', sans-serif !important; font-size: 40px; margin-right: 200px;">we at</span>
                                            <br>
                                            <span class="design" style="font-family: 'Pacifico', sans-serif !important;font-size: 120px !important;">cambuzz</span>
                                            <br>
                                        </p>
                                    </section>
                                    <h1 class="cd-headline clip is-full-width">

                            <span class="cd-words-wrapper" style="font-family: 'Montserrat', sans-serif !important; font-size: 35px !important;">
                                                                 <b class="is-visible">&nbsp;&nbsp;love to code. innovate. repeat<span class="dot">.</span></b>
                            <b>&nbsp;&nbsp;have a side business of rating EDMs<span class="dot">.</span></b>
                            <b>&nbsp;&nbsp;love to dance (occasionaly). Now let's erase this<span class="dot">.</span></b>
                            <b>&nbsp;&nbsp;and yes we have an anthem. Check below<span class="dot">.</span></b>
                            </span>
                            </h1>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- animation board -->
        <div id="anim">
            <div id="fps">FPS: 0</div>
            <canvas id="pixie"></canvas>
        </div>
    </header>
    <!-- /role:banner -->
    <!-- page main -->
    <main role="main">
        <!-- fixed nav -->
        <div class="fixedNav">
            <div class="navContainer">
                <!-- /.layout -->
                <div class="morphShape" id="morphShape" data-morph-open="m 1000,0 -1000,0 -0.0014,100.00907 1000.113491,0.56111 c 0,0 0.6476,0.1456 -0.1121,-100.57018 z">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1000 100" preserveAspectRatio="none">
                        <path d="m 1000,0 -1000,0 c 0,0 115.817891,96.80886 393.043471,99.88694 287.67859,3.19414 200.00002,-62.05098 606.95652,-99.88694 z" />
                    </svg>
                </div>
            </div>
            <!-- /.navContainer -->
        </div>
        <!-- /.fixedNav -->
        <!-- section: what we do -->
        <div class="fixbg" style="background-color: #20202F;">
            <section id="what_we_do" class="whatwedo group" style="background-color: #20202F; padding-bottom: 100px;">
                <div class="container" id="aboutusinnercontent" style="margin-top: 40px;">
                    <div class="row">
                        <div class="w-section section process">
                            <div style="font-family: 'Josefin Slab', sans-serif;">
                                <div class="col-sm-6 ">
                                    <h2 class="h2-process" style="font-size: 100px; font-weight: 800; color: white;">About Us</h2>
                                    <p class="p-intro" style="font-size: 30px; color: #e85657; font-family: 'Open Sans', sans-serif; font-weight: 300;">Amidst late night maggi sessions, the idea of Cambuzz was born.
                                        <br/>Headquartered in VIT Chennai, <span style="font-family: 'Pacifico', cursive;">cambuzz</span> began as a side project and is now a tiny, bootstrapped idea helping the VIT Chennai family to share their events and is trying to become a go-to resource for discovering and connecting with everyone in the campus.</p>
                                </div>
                                <div class="col-sm-6" style="margin-top: 100px; color:white;">
                                    <div style="font-family: 'Montserrat', sans-serif !important;">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img class="img-process" src="images/buzz_bulb_icon.png" width="120">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <h3 class="h3-process">Buzz around</h3>
                                                        <p class="p-process">
                                                            Post all the events happening near you.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 40px;">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img class="img-process" src="images/question-flat.png" width="120">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <h3 class="h3-process">Track Teacher</h3>
                                                        <p class="p-process">
                                                            Know when is the right time to meet your teacher.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 40px;">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <img class="img-process" src="images/trackteacher.png" width="120">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <h3 class="h3-process">Ask Questions</h3>
                                                        <p class="p-process">
                                                            Solve your problems. Get answers right away. Need More?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- section: projects -->
        <section class="projects group" style: "display: none;">
        </section>
        <!-- section: team -->
        <section class="team group" style="background-color: #2292A4; padding-bottom: 100px;">
            <div class="container" id="teamcontainer">
                <div class="row">
                    <div class="w-section section process">
                        <div style="font-family: 'Josefin Slab', sans-serif;">
                            <div class="col-sm-4 teamcontent" style="margin-top: 125px; display: inline">
                                <div class="teamgeneralcontent" style="padding: 10px; ">
                                    <h1 style="color:white; padding-top: 20px;"></h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <div style="display: flex; align-items: center; justify-content: center;">
                                            <p style="font-family: 'Josefin Slab', sans-serif;">"We work in a safe environment. There is absolutely no kicking, biting and rapid punches."
                                            <br>
                                            Though the person who wrote this, probably can't see right now.
                                            <br> 
                                            Check us out by clicking on any of our lovely faces. :D</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent1" style="padding: 10px; ">
                                    <h1 style="color:white; padding-top: 20px;">Prashant Bhardwaj</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Backend Developer</p>
                                        <p>He is the one who made this team come around. A highly ambitious person, he makes sure that he sleeps the last and wakes up the first. You can find him either thinking of new ideas for starting up or singing along our team's anthem (*cringe*) And oh! Ask him to play Sardar Khan from the Wasseypur fame.
                                            <br><em>"Goongi ho kya"</em> xD
                                            <br>
                                            <br> P.s. He gets down in one shot. Period.
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/prashantkb2" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://in.linkedin.com/pub/prashant-bhardwaj/104/22a/b3b" class="social-roll-facebook" target="_blank"><img src="images/Linked-in.png" height="50" width="50"></a>
                                            <a href="https://instagram.com/prashantkbhardwaj/" target="_blank" class="social-roll-facebook"><img src="images/Instgram.png" height="50" width="50"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent2" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Prastut Kumar</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>UI/UX Designer &amp; Frontend Developer</p>
                                        <p>He has donned so many hats for the team, we sure have lost count. The team feels indebted to him for crafting the user interface for the website, as well as writing all the about us snippets, though he took a large pizza for that. :/ While not designing posters or reading books about design, he is busy trying to practise the famous step from "<em>Lean On</em>".
                                            <br>
                                            <br> P.s.
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/prastut.kumar" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://in.linkedin.com/in/prastut" class="social-roll-facebook" target="_blank"><img src="images/Linked-in.png" height="50" width="50"></a>
                                            <a href="https://www.behance.net/prastutkumar" target="_blank" class="social-roll-facebook"><img src="images/Behance.png" height="50" width="50"></a>
                                            <a href="http://prastut.github.io/" target="_blank" class="social-roll-facebook"><img src="images/WWW.png" height="50" width="50"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent3" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Fenil Patel</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Backend Developer</p>
                                        <p>The team is so incomplete without a gujju bhai! Fondly called as "Patel bhai", but he is <em>the</em> devil when it comes to Fifa. A true Madrid supporter, we challenge you for a game with him. Nobody in the team can believe that he started coding when he joined VIT, and you also wouldn't. An IQ level over 9000, while not hacking away at code (which he is damn good at), he is busy reciting dialogues like Harvey Specter!
                                            <br>
                                            <br> P.s. <em>"Life is like this, I like this"</em>
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/patel.fenil.1238?fref=ts" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://in.linkedin.com/pub/fenil-patel/ba/417/a7a" class="social-roll-facebook" target="_blank"><img src="images/Linked-in.png" height="50" width="50"></a>
                                            <a href="https://instagram.com/fenil_patel96/" target="_blank" class="social-roll-facebook"><img src="images/Instgram.png" height="50" width="50"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent4" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Shantanu Tripathi</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Algorithmic Head</p>
                                        <p>He has probably spent more nights than any of us hacking at code. A passionate dramatist by nature, you can usually find him antagonizing the mirror by practising for the next role. He is known around the campus as "Baba" for topping in everything possible, but there is never a dull moment when he is in the house.
                                            <br>
                                            <br>P.s. He loves green ticks.
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/shantanu.tripathi.967?fref=ts" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://in.linkedin.com/pub/shantanu-tripathi/a2/27a/283" class="social-roll-facebook" target="_blank"><img src="images/Linked-in.png" height="50" width="50"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent5" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Prasang Sharma</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Android App Developer</p>
                                        <p>He believes in a world where all work is done by android-bots. When android finally wins the world over, you'll find him improving his dance moves or lifting weights on moon for personal records six times his early ones. Till that time, you can find him doodling and creating apps and mean viruses (shudder). Ask him if you need some.
                                            <br>
                                            <br>P.s. He likes to cook, especially for his team.
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/prasang.sharma.39?fref=ts" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://in.linkedin.com/pub/prasang-sharma/102/aa8/9a2" class="social-roll-facebook" target="_blank"><img src="images/Linked-in.png" height="50" width="50"></a>
                                            <a href="https://instagram.com/prasangsharma/" target="_blank" class="social-roll-facebook"><img src="images/Instgram.png" height="50" width="50"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent6" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Divyang Duhan</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Android App Developer</p>
                                        <p>Do you feel you know about cricket? Shoot! Pizza on the house if you can beat him (Though you won't. B). You can find him petting every animal in the campus (and we have a lot of variety!). In the meantime, he is busy coding android bots to solve the biggest problem for the team: to find the best pizzas in the town.
                                            <br>
                                            <br> P.s. He loves to sing in a high pitched voice and regularly takes breaks to record a punk rock album.
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/divyang.duhan?fref=ts" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://instagram.com/divyang_07/" target="_blank" class="social-roll-facebook"><img src="images/Instgram.png" height="50" width="50"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="teamcontent7" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Inderpratap Singh Cheema</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Frontend Developer</p>
                                        <p>Fondly called as IPS, he is an artist by nature but took frontend development to mix art with code. Most of his time is spent creating impressive landing pages while in the meantime he loves reading novels &amp; sketching. Probably the biggest fan of Minions from the "Despicable me" fame, he wishes to have his own minions to twirl his famous moustache.
                                            <br>
                                            <br> P.s. He really really loves to sleep.
                                            <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                                <a href="www.facebook.com/inderpartap.cheema" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                                <a href="in.linkedin.com/in/inderpartapcheema" class="social-roll-facebook" target="_blank"><img src="images/Linked-in.png" height="50" width="50"></a>
                                                <a href="twitter.com/bhola_gabbar" target="_blank" class="social-roll-facebook"><img src="images/Twitter.png" height="50" width="50"></a>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="teamcontent8" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 20px;">Speakers</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p><em>"Foo"</em></p>
                                        <p>
                                            The speaker is an integral part of the lab. He likes to 10001110100101101 (Oopss! it's binary, but that's how he gets it going). The best thing he does is play our team anthem. Once he gets free from his job, you'll find him ... what would you expect from a speaker? He is good at the base-ics of EDMs.
                                            <br>
                                            <br> P.s. Our team anthem: <a href="https://www.youtube.com/watch?v=xGiBiHocSZM" target="_blank" style="color: white;"><em><u>Redfoo</u>: New Thang</em></a>
                                        </p>
                                    </div>
                                </div>
                                <div class="teamcontent9" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 250px;">Angad Sachdave</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Marketing Head</p>
                                        <p>He's the guy who knows 'stuff'. Usually found sleeping peacefully on his bed, desk, bathroom and every other place you can possibly think of, he can turn into a raging green monster when hungry. What he lacks in normal 'human' attributes, he more than makes up in his marketing and social skills.
                                            <br>
                                            <br>P.s. His biggest achievement has been keeping his attendance above 75%.
                                        </p>
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">                         
                                            <a href="https://www.facebook.com/Angad29081994?fref=ts" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                         </div>
                                    </div>
                                </div>
                                <div class="teamcontent10" style="padding: 10px;">
                                    <h1 style="color:white; padding-top: 250px;">Ankita Negi</h1>
                                    <div class="content" style="font-family: 'Montserrat'; color: white;">
                                        <p>Marketing</p>
                                        <p>Whilst thinking new marketing strategies for the team, she is busy talking about clothes. When it comes to bargaining, she feels she is the Jordan Belfort of our generation. A true foodie by nature, she is carefree and a melodramatic person.
                                            <br>
                                            <br> P.s. She loves to sing but you probably wouldn't want to hear her.
                                        <div class="social-icons" style="display: flex; align-items: center; justify-content: center;">
                                            <a href="https://www.facebook.com/ankita.negi.1654?fref=ts" class="social-roll-facebook" target="_blank"><img src="images/Facebook.png" height="50" width="50"></a>
                                            <a href="https://instagram.com/negiankita/" target="_blank" class="social-roll-facebook"><img src="images/Instgram.png" height="50" width="50"></a>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 ">
                                <h2 class="h2-process" style="font-size: 100px; font-weight: 800; color: white; text-align: right">The Team</h2>
                                <div class="row" style="color: white">
                                    <div class="col-sm-3 team1">
                                        <img class="img-process" src="images/pkb.jpg" width="200" height="200" style="border-width:5px; border-style: solid; border-color: white">
                                    </div>
                                    <div class="col-sm-3 team2">
                                        <img class="img-process" src="images/prastut.jpg" width="200" height="200" style="border: 5px solid white;">
                                    </div>
                                    <div class="col-sm-3 team3">
                                        <img class="img-process" src="images/fenil.jpg" width="200" height="200" style="border: 5px solid white;">
                                    </div>
                                    <div class="col-sm-3 team4">
                                        <img class="img-process" src="images/Shantanu.jpg" width="200" height="200" style="border: 5px solid white;">
                                    </div>
                                    <div class="col-sm-3 team5">
                                        <img class="img-process" src="images/prasang.jpg" width="200" height="200" style="border-bottom-style: solid; border-left-style: solid; border-right-style: solid;border-width: 5px;">
                                    </div>
                                    <div class="col-sm-3 team6">
                                        <img class="img-process" src="images/divyang.jpg" width="200" height="200" style="border-bottom-style: solid; border-left-style: solid; border-right-style: solid;border-width: 5px;">
                                    </div>
                                    <div class="col-sm-3 team7">
                                        <img class="img-process" src="images/ip.png" width="200" height="200" style="border-bottom-style: solid; border-left-style: solid; border-right-style: solid;border-width: 5px;">
                                    </div>
                                    <div class="col-sm-3 team8">
                                        <img class="img-process" src="images/speaker.jpg" width="200" height="200" style="border-bottom-style: solid; border-left-style: solid; border-right-style: solid;border-width: 5px;">
                                    </div>
                                    <div class="marketing">
                                        <div class="col-sm-3 col-md-offset-3 team9">
                                            <img class="img-process" src="images/angad.jpg" width="200" height="200" style="border-width:5px; border-style: solid; border-color: white; margin-top: 40px;">
                                        </div>
                                        <div class="col-sm-6 team10">
                                            <img class="img-process" src="images/ankita.PNG" width="200" height="200" style="border-width:5px; border-style: solid; border-color: white; margin-top: 40px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--section: contact -->
        <section class="contact group" style: "display: none;">
        </section>
    </main>
    <div class="ips home">
        <div id="contact" class="contact">
            <div class="contact-form-container">
                <div class="contact-form form-container">
                    <form  id="contactform">
                        <h3 class="form-title">Get in Touch</h3>
                        <div class="field">
                            <input type="text" placeholder="Name" name="name" id="name">
                        </div>
                        <div class="field">
                            <input type="text" placeholder="Email" name="email" id="email">
                        </div>
                        <div class="field">
                            <textarea placeholder="Message" name="message" id="message"></textarea>
                        </div>
                        <div id="tempdiv"></div>
                        <div class="field">
                            <input type="submit" value="Send it!" name="submit">
                        </div>
                    </form>
                </div>
                <div id="thanks" class="thanks">
                    <h3>Thanks! </h3>
                    <p>We&rsquo;ll get back to you soon!</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/textRotate.js"></script>
    <script>
    (function() {

        function init() {
            var speed = 330,
                easing = mina.backout;

            [].slice.call(document.querySelectorAll('#grid > a')).forEach(function(el) {
                var s = Snap(el.querySelector('svg')),
                    path = s.select('path'),
                    pathConfig = {
                        from: path.attr('d'),
                        to: el.getAttribute('data-path-hover')
                    };

                el.addEventListener('mouseenter', function() {
                    path.animate({
                        'path': pathConfig.to
                    }, speed, easing);
                });

                el.addEventListener('mouseleave', function() {
                    path.animate({
                        'path': pathConfig.from
                    }, speed, easing);
                });
            });
        }

        init();

    })();
    </script>
    <script>
    cancel = false;
    $(".teamcontent1").hide();
    $(".teamcontent2").hide();
    $(".teamcontent3").hide();
    $(".teamcontent4").hide();
    $(".teamcontent5").hide();
    $(".teamcontent6").hide();
    $(".teamcontent7").hide();
    $(".teamcontent8").hide();
    $(".teamcontent9").hide();
    $(".teamcontent10").hide();
    $(".team1").click(function() {


        $(".teamcontent1").fadeIn();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();

    });

    $(".team2").click(function() {


        $(".teamcontent2").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });

    $(".team3").click(function() {


        $(".teamcontent3").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide()
        $(".teamgeneralcontent").hide();


    });

    $(".team4").click(function() {


        $(".teamcontent4").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });

    $(".team5").click(function() {


        $(".teamcontent5").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });

    $(".team6").click(function() {


        $(".teamcontent6").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });
    $(".team7").click(function() {


        $(".teamcontent7").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });
    $(".team8").click(function() {


        $(".teamcontent8").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent9").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });
    $(".team9").click(function() {


        $(".teamcontent9").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent10").hide();
        $(".teamgeneralcontent").hide();


    });

    $(".team10").click(function() {


        $(".teamcontent10").fadeIn();
        $(".teamcontent1").hide();
        $(".teamcontent2").hide();
        $(".teamcontent3").hide();
        $(".teamcontent4").hide();
        $(".teamcontent5").hide();
        $(".teamcontent6").hide();
        $(".teamcontent7").hide();
        $(".teamcontent8").hide();
        $(".teamcontent9").hide();
        $(".teamgeneralcontent").hide();


    });
    </script>
    <div class="md-overlay"></div>
    <!-- the overlay element -->
    <!-- classie.js by @desandro: https://github.com/desandro/classie -->
    <script src="js/classie.js"></script>
    <script src="js/modalEffects.js"></script>
    <!-- for the blur effect -->
    <!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
    <script>
    // this is important for IEs
    var polyfilter_scriptpath = '/js/';
    </script>
    <script src="js/cssParser.js"></script>
    <script src="js/css-filters-polyfill.js"></script>
    <!-- javascript dor development -->
    <script src="js/lib/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
     <script src="https://code.jquery.com/jquery-2.1.4.js"></script>

    <script type="text/javascript">
        
        
        $(document).ready(function(){
           
            $('#contactform').on('submit',function()
            {

                var name=$("#name").val();
                 var email=$("#email").val();
                  var message=$("#message").val();
                
               
               var msg;
                
                $.ajax({
                    method: "POST",
                    url: "sendmail.php",
                    data: {name:name,email:email,message,message}
                    })
                    .done(function() {

                        if(mag=="done")
                        {
                            $("#tempdiv").html("The email has been successfully sent.");
                        }
                        
                    });
                    

                return false;

                
            });
        });
        </script>

</body>

</html>
