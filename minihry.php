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
	<meta name="description" content="">
	<link rel="stylesheet" href="minihry.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Full House | Minihry</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
</head>
<body>
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
                        <li><a href="#">Minihry</a></li>
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
                    <a href="index.php" class="focus1">Úvod</a>
                    <a href="#" class="focus1">Minihry</a>
                    <a href="kontakt.php" class="focus1">Kontakt</a>
                    <a href="leaderboard.php" class="focus1">Top 10</a>
                    <a style="font-size:40px;margin-top:60px"><?php echo number_format($user_data['money'], 0, ',', ' '); ?><img src="token-image.png" alt="Token" height="32px" style="padding-left:9px"></a>
                    <a class="cta" href="logout.php" style="font-size:25px;margin-top:15px;focus:white">Odhlásit se</a>
                </div>
            </div>

            <script type="text/javascript" src="navbar.js"></script>
            <script type="text/javascript" src="minihry.js"></script>            

            <!-- Nadpis, tlačítko scroll-down, druhá sekce -->

            <div class="nadpis-info">
                <div class="glow"><h1>MINIHRY</h1></div>
            </div>    

            <div class="mouse_scroll">
                <div>
                    <a href="#minihry">
                    <span class="m_scroll_arrows unu"></span>
                    <span class="m_scroll_arrows doi"></span>
                    <span class="m_scroll_arrows trei"></span>
                    </a>
                </div>
            </div>   

            <div class="minihry-sekce" id="minihry">
                <div class="sekce reveal">

                    <div class="card minihra1" onclick="location.href='minihra1.php'" style="cursor:pointer;margin-top:190px">
                        <div class="karta">
                            <img src="minihra1.png" alt="Ticket">
                        </div>
                        <div class="info-karta">
                            <h1>SÁZKA NA SPORT</h1>
                        </div>
                    </div>
                    

                    <div class="card minihra2" onclick="location.href='minihra2.php'" style="cursor:pointer">
                        <div class="karta">
                            <img src="minihra2.png" alt="Rock paper scissors">
                        </div>
                        <div class="info-karta">
                            <h1>KÁMEN, NŮŽKY, PAPÍR</h1>
                        </div>
                    </div>


                    <div class="card minihra3" onclick="location.href='minihra3.php'" style="cursor:pointer">
                        <div class="karta">
                            <img src="minihra3.png" alt="Skořápky">
                        </div>
                        <div class="info-karta">
                            <h1>SKOŘÁPKY</h1>
                        </div>
                    </div>


                    <div class="card minihra4" onclick="location.href='minihra4.php'" style="cursor:pointer">
                        <div class="karta">
                            <img src="minihra4.png" alt="123">
                        </div>
                        <div class="info-karta">
                            <h1>HAZARD</h1>
                        </div>
                    </div>


                    <div class="card minihra5" onclick="location.href='minihra5.php'" style="cursor:pointer">
                        <div class="karta">
                            <img src="minihra5.png" alt="Roulette">
                        </div>
                        <div class="info-karta">
                            <h1>HAZARD</h1>
                        </div>
                    </div>


                    <div class="card minihra6" onclick="location.href='minihra6.php'" style="cursor:pointer">
                        <div class="karta">
                            <img src="minihra6.png">
                        </div>
                        <div class="info-karta">
                            <h1>HAZARD</h1>
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