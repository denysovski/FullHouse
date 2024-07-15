<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

$message = "Hádej barvu čísel";

if (isset($_POST['bet_amount']) && isset($_POST['color'])) {
    $bet_amount = intval($_POST['bet_amount']);
    $color = $_POST['color'];

    if ($bet_amount <= 0 || $bet_amount > $user_data['money']) {
        $x = "Nepovolená hodnota pro počáteční vklad, útočníčku!";
        echo "<script>alert('" . $x . "');</script>";  
    }
    else {
    $roulette_result = rand(0, 37); // 0-18 pro červenou, 19-36 pro černou, 37 pro zelenou

    // Kontrola, zda hráč uhodl správně
    if (($color == 'red' && ($roulette_result >= 0 && $roulette_result <= 17)) ||
    ($color == 'black' && ($roulette_result >= 19 && $roulette_result <= 36)) ||
    ($color == 'green' && ($roulette_result == 37))) {
    $new_money = $user_data['money'] + $bet_amount;
    mysqli_query($con, "UPDATE users SET money = '$new_money' WHERE user_id = '" . $user_data['user_id'] . "'");
    $message = "Gratulujeme, uhádl jsi barvu čísla!";
    } 
    else {
    $new_money = $user_data['money'] - $bet_amount;
    mysqli_query($con, "UPDATE users SET money = '$new_money' WHERE user_id = '" . $user_data['user_id'] . "'");
    $message = "Bohužel jsi neuhádl barvu čísla!";
    }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<link rel="stylesheet" href="minihry.css">
    <link rel="stylesheet" href="minihra.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Full House | Ruleta</title>
    <style>
        .options {
            font-size: 20px;
            justify-content: center;
            background-color: transparent;
        }

        .options:hover {
            transition: 0.4s;
            background-color: red;
        }

        .form-control {
            text-align: center;
            padding: 5px;
            width: 200px;
            border: 2px solid #ccc;
            border-radius: 20px;
            display: block;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        form {
            margin-top: 75px;
        }

        .button {
            color: white;
            padding: 13px;
            margin-top: 15px;
            border: none;
            cursor: pointer;
            width: 40%;
            margin-bottom: 20px;
            font-size: 25px;
            background-color: #930ea4;
            border-radius: 50px;
            transition: 0.4s;
        }

        .button:hover {
            box-shadow: rgba(167, 26, 180, 0.5) 0 1px 30px;
            transition: 0.4s;
        }

        .button a {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 500;
            color: #edf0f1;
            text-decoration: none;
        }

        .button:hover {
            background-color: rgba(164, 18, 184, 0.8);
        }

        .firstinput {
            border-radius: 20px;
            width: 70% !important;
            padding: 10px;
            box-sizing: border-box;
            font-size: 20px;
            border-radius: 8px;
            text-align: center; 
            appearance: none;
            border: none;
            outline: none;
            border-bottom: .2em solid #930ea4;
            padding: .4em;
            color: #e542faa2;
            background: transparent;
            transition: 0.4s;
        }

        .firstinput:focus {
            background: #b22cc40e;
            transition: 1s;
        }

        .firstinput:focus::placeholder {
            transition: 0.4s;
            color: transparent;
        }

        .firstinput:hover {
            border-bottom: .2em solid #e687f3a2;
            transition: 0.4s;
            color: white;
        }

        .dropdowncenter {
            left: 50% !important;
            right: auto !important;
            text-align: center !important;
            transform: translate(-50%, 0) !important;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .inputhelp {
            border-bottom: 0;
        }

        .inputhelp:hover {
            border-bottom: 0;
        }

        .helpicon {
            font-size: 40px;
            display: block;
            margin-left: -45px;
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

                    <div title="Token" class="token-div"><img src="token-image.png" alt="Token" class="token-image" height="26px" width="27px" style="margin-left:5px;margin-top:3px"></div>
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
                        <h1 class="nadpis-cisla">RULETA</h1>
                        <i class="fa fa-info-circle helpicon"></i>
                    </div>

                    <div class="individual-game" style="padding-bottom:100px">
                        <?php if (isset($message)) echo "<p style='font-size:20px;margin-top:50px'>$message</p>"; ?>
                            <form action="" method="post">
                                <input placeholder="Počáteční vklad" type="number" class="form-control firstinput" id="bet_amount" name="bet_amount" min="1" max="<?php echo $user_data['money']; ?>" value="<?php if(isset($_POST['bet_amount'])) echo $_POST['bet_amount']; ?>" required>
                                <select class="form-control firstinput inputhelp" id="color" name="color" required style="background-color:purple;color: white;text-align:center;">
                                    <option value="black" class="options">Černá</option>
                                    <option value="red" class="options">Červená</option>
                                    <option value="green" class="options">Zelená</option>
                                </select>
                                <input type="submit" formaction="#click" class="button" value="Vsadit">
                            </form>
                        <?php if (isset($_POST['newGame'])) unset($_SESSION['randomNumber']); ?>

                        <div class="token-status">
                            <a class="money-link">
                                <div class="all-money-link">
                                    <?php echo number_format($user_data['money'], 0, ',', ' '); ?>
                                    <img src="token-image.png" alt="Token" class="token-image" height="27px" width="27px">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="game-info" style="margin-top:100px">
                            <p style="font-size: 25px">Vlož počáteční vklad a uhádni barvu!</p>
                            <div class="vysledky-text" style="text-align:center;font-size:20px;margin-left:auto;margin-right:auto;width:auto;margin-top:30px">
                                <p>Zatím experimentální verze pouze s barvami, brzy ale přijdou i čísla a to bude teprv Jackpot.</p>
                            </div>
                            <div class="vysledek-text" style="font-size:18px;margin-top:30px;margin-left:auto;margin-right:auto">
                                <p>Uhádni barvu a zbohatni jako pravý gambler u rulety!</p>
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

        <script>
        function updateBalance() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var maxBalance = parseInt(this.responseText);
                    document.getElementById("bet_amount").max = maxBalance; // Aktualizace maximální hodnoty vstupního pole
                    
                    // Aktualizace prvků s ID "balance"
                    var balanceElements = document.querySelectorAll("#balance");
                    for (var i = 0; i < balanceElements.length; i++) {
                        balanceElements[i].innerHTML = maxBalance;
                    }

                    // Aktualizace prvku s třídou "money-link" a ID "balance"
                    var balanceLinkElement = document.querySelector(".money-link #balance");
                    if (balanceLinkElement) {
                        balanceLinkElement.innerHTML = maxBalance;
                    }
                }
            };
            xhttp.open("GET", "get_balance.php", true);
            xhttp.send();
        }

        window.onload = function() {
            updateBalance();
        };
        </script>

    </body>
</html>
