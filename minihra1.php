<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["match1"])) {
            $match1 = $_POST["match1"];
            $sql = "UPDATE users SET match1=$match1 WHERE user_id = $user_data[user_id]";
        if ($con->query($sql) !== TRUE) {
            echo "Chyba při aktualizaci záznamu: " . $con->error;
            }
        } 
        else if (isset($_POST["match2"])) {
            $match2 = $_POST["match2"];
            $sql = "UPDATE users SET match2=$match2 WHERE user_id = $user_data[user_id]";
        if ($con->query($sql) !== TRUE) {
            echo "Chyba při aktualizaci záznamu: " . $con->error;
        }
        } 
        else if (isset($_POST["match3"])) {
            $match3 = $_POST["match3"];
            $sql = "UPDATE users SET match3=$match3 WHERE user_id = $user_data[user_id]";
        if ($con->query($sql) !== TRUE) {
            echo "Chyba při aktualizaci záznamu: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<link rel="stylesheet" href="minihry.css">
    <link rel="stylesheet" href="minihra.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Full House | Tipáč</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
    <style>
        .input-submit-value {
            width: 35px;
            height: 37px;
            font-size: 30px;
            border-radius: 25px;
            border: none;
            margin-left: 10px;
            padding: 0;
        }

        .input-all {
            display: inline-block;
            vertical-align: top;
            height: 0;
            background-color: red;
        }

        .match-info {
            text-align: center;
            width: 95px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 20px;    
            margin-bottom: 2px;    
            background-color: #930ea4;
            padding-left: 15px;
        }

        .tiket-all {
            background-color: #7e0585;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            padding: 15px;
            border-radius: 100px;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .each {
            line-height: 40px;
        }

        .all-together {
            margin-top: 25px;
            margin-bottom: -45px;
        }
    </style>
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
                <a class="all-tokens"><p style="font-size:29px" class="info-user"><?php echo '<div id="balance" style="font-size:29px; color:white">' . number_format($user_data['money'], 0, ',', ' ') . '</div>'; ?>

                    <div title="Token" class="token-div"><img src="token-image.png" class="token-image" alt="Token" height="26px" width="27px" style="margin-left:5px;margin-top:3px"></div>
                </p></a>
                <a class="cta" href="logout.php">Odhlásit se</a>
                <p class="menu cta"><a href="logout.php"><i class="fa fa-sign-out" style="color:white"></i></a></p>
            </header>

            <script type="text/javascript" src="navbar.js"></script>
            <script type="text/javascript" src="minihry.js"></script>  
            <script type="text/javascript" src="hovermouse.js"></script>             

            <!-- Nadpis, tlačítko scroll-down, druhá sekce -->

            <div class="back-to-minihry">
                <ul class="zpet">
                    <li><a href="minihry.php">ZPĚT NA MINIHRY</a></li>
                </ul>
            </div>
            <div id="click"></div>

            <div class="nadpis-info">
            <div id="click2"></div>
                <div class="game-gui">
                    <div class="upper-bar">
                        <h1 class="nadpis-cisla">TIPÁČ</h1>
                        <i class="fa fa-info-circle helpicon"></i>
                    </div>

                    <div class="individual-game" id="individual-game">
                        <form method="post" style="margin-bottom:80px" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="all-together">
                                <div class="one-submit each">
                                    <p class="nadpis-zapas ind1">Plzeň - Slavia</p>
                                        <div class="input-all">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match1" value="1">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match1" value="0">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match1" value="2">
                                        </div>
                                </div>

                                <div class="one-submit each">
                                    <p class="nadpis-zapas ind2">Arsenal - Bayern</p>
                                        <div class="input-all">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match2" value="1">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match2" value="0">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match2" value="2">
                                        </div>
                                </div>
                                    
                                <div class="one-submit each">
                                    <p class="nadpis-zapas ind3">PSG - Barcelona</p>
                                        <div class="input-all">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match3" value="1">
                                            <input type="submit" formaction="#click" class="input-submit-value" name="match3" value="0">
                                            <input type="submit"  formaction="#click" class="input-submit-value" name="match3" value="2">
                                        </div>
                                </div>
                            </div>
                        </form>

                        <div class="tiket-all">
                            <div class="tiket-title">
                                <h2 style="font-size:20px;letter-spacing:5px;color:white;margin-bottom:6px">Tiket</h2>
                            </div>
                            <?php
                            function displayMatchResult($value) {
                                switch ($value) {
                                    case "0":
                                        return "<span style='font-size: 20px;'>RR</span>";
                                    case "1":
                                        return "<span style='font-size: 20px;'>VD</span>";
                                    case "2":
                                        return "<span style='font-size:20px;'>PD</span>";
                                    default:
                                        return "";
                                }
                            }

                            $sql = "SELECT match1, match2, match3 FROM users WHERE user_id = $user_data[user_id]";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                foreach ($row as $key => $value) {
                                    echo "<div class='match-info' style='font-size: 20px;'>Zápas " . substr($key, -1) . "<div style='display:inline-block;padding-left:4px;padding-right:4px;margin-left:7px;background-color:#de1dde;border-radius:25px;'>" . displayMatchResult($value) . "</div></div>";
                                }
                            }
                            ?>
                        </div>

                        <div class="token-status">
                            <a class="money-link">
                                <div class="all-money-link">
                                    <?php echo number_format($user_data['money'], 0, ',', ' '); ?>
                                    <img src="token-image.png" alt="Token" class="token-image" height="27px" width="27px">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="game-info" style="margin-top:100px;z-index:-15">
                        <p style="font-size: 25px">Tiket na reálně se odehrávající zápasy.</p>
                        <div class="vysledky-text" style="text-align:left;font-size:20px;margin-left:auto;margin-right:auto;width:180px;margin-top:30px">
                            <p>VD - Výhra domácího</p>
                            <p>RR - Remíza </p>
                            <p>PD - Prohra domácího</p>
                        </div>
                        <div class="vysledek-text" style="font-size:18px;margin-top:30px;margin-left:auto;margin-right:auto">
                            <p>PO ODEHRÁNÍ VŠECH ZÁPASŮ SE TIKET VYHODNOTÍ A BUDETE ODMĚNENI SYMBOLICKOU ČÁSTKOU TOKENŮ. MOŽNÉ JE SÁZET I BEZ TOHO, ANIŽ BYSTE MĚLI TOKENY.</p>
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
