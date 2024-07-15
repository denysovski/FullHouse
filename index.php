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
	<meta name="description" content="Fullhouse je revoluční webová gambling stránka, na které naleznete spoustu zajímavých miniher.">
    <meta name="keywords" content="Fullhouse, spšt, Full, House, Gambling, Gamba, Hry">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="google-site-verification" content="6hi5mt9x3JJdaH31mIornmxW5Mi8mBkiKIe3qjEJmDM" />
    <title>Full House | Domovská stránka</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png" alt="logo">
</head>
<body tabIndex=0>
	<div class="background-pozadi">
        <video autoplay muted loop>
          <source src="background-test.mp4" type="video/mp4"/>
        </video>
    </div>
        <div class="all-in">
            <header>
                <a class="logo" href="index.php"><img src="logo-web1.png" alt="Logo" class="header-image"></a>
                <nav>
                    <ul class="nav__links">
                        <li><a href="#">Úvod</a></li>
                        <li><a href="minihry.php">Minihry</a></li>
                        <li><a href="kontakt.php">Kontakt</a></li>
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
                    <a href="#" class="focus1">Úvod</a>
                    <a href="minihry.php" class="focus1">Minihry</a>
                    <a href="kontakt.php" class="focus1">Kontakt</a>
                    <a href="leaderboard.php" class="focus1">Top 10</a>
                    <a style="font-size:40px;margin-top:60px"><?php echo number_format($user_data['money'], 0, ',', ' '); ?><img src="token-image.png" alt="Token" height="32px" style="padding-left:9px"></a>
                    <a class="cta" href="logout.php" style="font-size:25px;margin-top:15px;focus:white">Odhlásit se</a>
                </div>
            </div>

            <script type="text/javascript" src="navbar.js"></script>
            <script type="text/javascript" src="minihry.js"></script>   

            <div class="nadpis-info">
                <div class="glow"><h1>FULL HOUSE</h1></div>
                <a href="minihry.php"><p style="font-size: 20px" class="learn-more">Chci gamblit</p></a>
            </div>

            <div class="container reveal">
                <div class="all-cards">
                    <div class="card-home number1 all">
                        <div class="image-source">
                            <img src="joystick.png" alt="Joystick">
                        </div>
                        <div class="content-info-card">
                            <h1>HERNA</h1>
                            <p>Využijte své tokeny napříč všemi minihrami. Soutěžte
                                se svými přáteli o první místo v žebříčku těch nejlepších
                                hráčů na naší platformě.
                            </p>
                        </div>
                    </div>

                    <div class="card-home number2 all">
                        <div class="image-source">
                            <img src="caution.png" alt="Caution">
                        </div>
                        <div class="content-info-card">
                            <h1>HAZARD</h1>
                            <p>Webová stránka slouží jako simulátor hazardních
                                her. Na vlastní kůži si můžete vyzkoušet výběr několika
                                miniher, které záleží především na vašem štěstí. 
                            </p>
                        </div>
                    </div>

                    <div class="card-home number3 all">
                        <div class="image-source">
                            <img src="money.png" alt="Money">
                        </div>
                        <div class="content-info-card">
                            <h1>TOKENY</h1>
                            <p>Na naši webové stránce využíváme měnu zvanou
                                tokeny. Poslouží vám jako platidlo pro hraní 
                                miniher. Nezoufejte, pokud všechny své tokeny
                                prohrajete. Každý den vám bude přiděleno 10
                                nových tokenů.
                            </p>
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

        <!-- <div class="loader-wrapper">
            <span class="loader"><span class="loader-inner"></span></span>
        </div>

        <script>
        // Wait for the DOM to be fully loaded
            document.addEventListener("DOMContentLoaded", function() {
                // Wait for 2 seconds (2000 milliseconds) before fading out the loader
                setTimeout(function() {
                    // Get the loader element
                    var loader = document.querySelector('.loader-wrapper');
                    
                    // Check if the loader exists
                    if(loader) {
                        // Add a CSS class to initiate the fade out animation
                        loader.classList.add('fade-out');
                        
                        // After the animation completes, remove the loader from the DOM
                        loader.addEventListener('animationend', function() {
                            loader.parentNode.removeChild(loader);
                        });
                    }
                }, 2000); // 2000 milliseconds = 2 seconds
            });
        </script> -->
    </body>
</html>
