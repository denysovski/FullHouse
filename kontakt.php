<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Zde naleznete tvůrce revoluční webové gambling stránky Fullhouse.">
	<link rel="stylesheet" href="kontakt.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Full House | Kontakty</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
</head>
<body tabIndex=0>
    <div class="background-pozadi">
        <video autoplay muted loop>
          <source src="background-test.mp4" type="video/mp4"/>
        </video>
    </div>
        <div class="all-in">
            <header>
                <a class="logo" href="index.php"><img src="logo-web1.png" alt="logo" class="header-image"></a>
                <nav>
                    <ul class="nav__links">
                        <li><a href="index.php">Úvod</a></li>
                        <li><a href="minihry.php">Minihry</a></li>
                        <li><a href="#">Kontakt</a></li>
                        <li><a href="leaderboard.php">Top 10</a></li>
                    </ul>
                </nav>
                <a style="display:flex;margin-left:-120px;margin-right:-120px"><p style="font-size:29px" class="info-user"><?php echo number_format($user_data['money'], 0, ',', ' '); ?>
                    <div title="Token" class="token-div"><img src="token-image.png" alt="Token" class="token-image" height="26px" width="27px" style="margin-left:5px;margin-top:3px"></div>
                </p></a>
                <a class="cta" href="logout.php">Odhlásit se</a>
                <p class="menu cta">Menu</p>
            </header>
            <div id="mobile__menu" class="overlay">
                <a class="close">&times;</a>
                <div class="overlay__content">
                    <a href="index.php" class="focus1">Úvod</a>
                    <a href="minihry.php" class="focus1">Minihry</a>
                    <a href="#" class="focus1">Kontakt</a>
                    <a href="leaderboard.php" class="focus1">Top 10</a>
                    <a style="font-size:40px;margin-top:60px"><?php echo number_format($user_data['money'], 0, ',', ' '); ?><img src="token-image.png" alt="Token" height="32px" style="padding-left:9px"></a>
                    <a class="cta" href="logout.php" style="font-size:25px;margin-top:15px;focus:white">Odhlásit se</a>
                </div>
            </div>

            <script type="text/javascript" src="navbar.js"></script>
            <script type="text/javascript" src="minihry.js"></script>   

            <div class="nadpis-info">
                <div class="glow"><h1>KONTAKT</h1></div>
            </div>

            <div class="mouse_scroll">
                <div>
                    <a href="#cont">
                    <span class="m_scroll_arrows unu"></span>
                    <span class="m_scroll_arrows doi"></span>
                    <span class="m_scroll_arrows trei"></span>
                    </a>
                </div>
            </div> 
            
        <div class="contact-container" id="cont">
            <div class="container-all-cards reveal">
                <div class="whole-card">
                    <!-- Daniel -->
                    <div class="card-home number2 all">
                        <div class="image-contact">
                            <img src="kontakt2.png" alt="Gamepad">
                        </div>

                        <div class="name-person">
                            <h1>Daniel Svoboda</h1>
                        </div>
                    </div>

                    <div class="links-contact">
                        <div class="icon-each"><a href="https://www.instagram.com/denysovski/"><i class="fa fa-instagram"></i></a></div>
                        <div class="icon-each"><a href="https://github.com/denysovski"><i class="fa fa-github"></i></a></div>
                    </div>
                    </div>

                    <!-- David -->
                    <div class="whole-card">
                    <div class="card-home number1 all">
                        <div class="image-contact">
                            <img src="kontakt1.png" alt="Football">
                        </div>

                        <div class="name-person">
                            <h1>David Švaříček</h1>
                        </div>
                    </div>

                    <div class="links-contact">
                        <div class="icon-each"><a href="https://www.instagram.com/david_svaricek9/"><i class="fa fa-instagram"></i></a></div>
                        <div class="icon-each"><a href="https://www.linkedin.com/in/david-%C5%A1-08a0a3292/"><i class="fa fa-linkedin"></i></a></div>
                    </div>
                    </div>


                    <!-- Tomáš -->
                    <div class="whole-card">
                        <div class="card-home number3 all">
                            <div class="image-contact">
                                <img src="kontakt3.png" alt="Guitar">
                            </div>

                            <div class="name-person">
                                <h1>Tomáš Buriánek</h1>
                            </div>
                        </div>

                        <div class="links-contact">
                            <div class="icon-each"><a href="https://www.instagram.com/tomas_lipanek/"><i class="fa fa-instagram"></i></a></div>
                            <div class="icon-each"><a href="https://github.com/tomasburiankek"><i class="fa fa-github"></i></a></div>
                        </div>
                    </div>

                    <!-- Martin -->
                    <div class="whole-card">
                            <div class="card-home number4 all">
                                <div class="image-contact">
                                    <img src="kontakt4.png" alt="Person">
                                </div>

                                <div class="name-person">
                                    <h1>Martin Ošmera</h1>
                                </div>
                            </div>
                    
                            <div class="links-contact">
                                <div class="icon-each"><a href="https://www.instagram.com/martin_osmera5/"><i class="fa fa-instagram"></i></a></div>
                                <div class="icon-each"><a href="https://open.spotify.com/artist/3yg1s4MjZKx8Vm469sO3E7"><i class="fa fa-spotify"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <footer>
            <div class="footer">
                <div class="row icon-item">
                    <a href="https://www.instagram.com/fullhousecz/"><i class="fa fa-instagram"></i></a>
                </div>

            <div class="row">
                <ul>
                    <li><a href="index.php">Úvod<a></li>
                    <li><a href="minihry.php">Minihry</a></li>
                    <li><a href="leaderboard.php">TOP 10</a></li>
                    <li><a href="kontakt.php">Kontakt</a></li>
                </ul>
            </div>

                <div class="row last-text">Střední průmyslová škola Třebíč | DDMT 2024 ©</div>
            </div>
        </footer>
    </body>
</html>