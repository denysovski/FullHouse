<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Inicializace hry
if (!isset($_SESSION['randomNumber'])) {
    $_SESSION['randomNumber'] = rand(1, 50);
    $_SESSION['attempts'] = 0;
    $message = "";
} else {
    $guess = isset($_POST['guess']) ? intval($_POST['guess']) : null;

    if ($guess !== null) {
        $initialDeposit = isset($_POST['initialDeposit']) ? intval($_POST['initialDeposit']) : null;

        if (!is_numeric($initialDeposit) || $initialDeposit <= 0 || $initialDeposit > $user_data['money']) {
            $x = "Nepovolená hodnota pro počáteční vklad, ty hlavo!";
            echo "<script>alert('" . $x . "');</script>";  
        } else {
            $_SESSION['attempts']++; // Zvýšení počtu pokusů
            
            if ($_SESSION['attempts'] >= 5 && $guess !== $_SESSION['randomNumber']) {
                $message = "Neuhádl jsi číslo " . $_SESSION['randomNumber'];
                deductMoney($con, $user_data['user_id'], $initialDeposit);
                // Reset hry
                unset($_SESSION['randomNumber']);
            } else {
                if ($guess < $_SESSION['randomNumber']) {
                    $message = "Hádané číslo je větší.";
                } elseif ($guess > $_SESSION['randomNumber']) {
                    $message = "Hádané číslo je menší.";
                } else {
                    $message = "Gratulace! Uhádl jsi číslo " . $_SESSION['randomNumber'] . " na " . $_SESSION['attempts'] . ". pokus!";
                    doubleDeposit($con, $user_data['user_id'], $initialDeposit);
                    unset($_SESSION['randomNumber']);
                }
            }
        }
    } else {
        $message = "Zadej platné číslo.";
    }
}

// Funkce pro zdvojnásobení vkladu v případě výhry
function doubleDeposit($con, $user_id, $amount) {
    $query = "UPDATE users SET money = money + ? WHERE user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("di", $amount, $user_id);
    $stmt->execute();
}

// Funkce pro odečtení peněz z vkladu v případě prohry
function deductMoney($con, $user_id, $amount) {
    $query = "UPDATE users SET money = money - ? WHERE user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("di", $amount, $user_id);
    $stmt->execute();
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
    <link rel="stylesheet" href="individual-game.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Full House | Hádání čísel</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
    <style>
        .input-container {
            justify-content: space-between;
            display: block;
            margin-top: 50px;
            margin-bottom: -30px;
        }

        .form-control {
            text-align: center;
            padding: 5px;
            width: calc(50% - 5px); /* Adjust width as needed */
            border: 2px solid #ccc;
            border-radius: 5px;
            display: block;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
        }

        .firstinput {
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

        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .button1 {
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

        .button1:hover {
            box-shadow: rgba(167, 26, 180, 0.5) 0 1px 30px;
            transition: 0.4s;
        }

        .button1 a {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 500;
            color: #edf0f1;
            text-decoration: none;
        }

        .button1:hover {
            background-color: rgba(164, 18, 184, 0.8);
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
            <div  id="click"></div>

            <div class="nadpis-info">
            <div  id="click2"></div>
                <div class="game-gui">
                    <div class="upper-bar" style="margin-bottom: 40px">
                        <h1 class="nadpis-cisla">HÁDÁNÍ ČÍSEL</h1>
                        <i class="fa fa-info-circle helpicon"></i>
                    </div>

                    <div class="individual-game" style="padding-bottom:100px">
                        <?php
                            if (isset($message)) {
                                echo "<p style='font-size: 20px;'>$message</p>";
                            }

                            if (!isset($_SESSION['randomNumber'])) {
                                echo '<form method="post">
                                    <input type="submit" class="button1" name="newGame" value="Hrát znovu">
                                </form>';
                                // Resetovat hodnotu počátečního vkladu
                                unset($_SESSION['initialDeposit']);
                            } else {
                                $previousGuess = isset($_POST['guess']) ? htmlspecialchars($_POST['guess']) : '';
                                if (!isset($_SESSION['initialDeposit']) && empty($_POST['guess'])) {
                                    $_SESSION['initialDeposit'] = isset($_POST['initialDeposit']) ? intval($_POST['initialDeposit']) : '';
                                }
                                $attemptsMade = $_SESSION['attempts'] > 0;
                                $minValue = 1;
                                $maxValue = $user_data['money'];
                                
                                $initialDepositField = $attemptsMade ? 
                                '<input type="number" id="betAmount" class="form-control firstinput" name="initialDeposit" value="' . $_POST['initialDeposit'] . '" placeholder="Počáteční vklad" readonly>' 
                            : '<input type="number" id="betAmount" class="form-control firstinput" name="initialDeposit" placeholder="Počáteční vklad" value="' . 

                            (isset($_SESSION['initialDeposit']) ? $_SESSION['initialDeposit'] : '') . '" min="' . $minValue . '" max="' . $user_data['money'] . '" required>';

                                echo '<p style="font-size: 20px">Zbývající počet pokusů: ' . (5 - $_SESSION['attempts']) . '</p>';
                                echo '<form method="post">
                                    <div class="form-group">
                                        <div class="input-container">
                                            <input type="number" class="form-control firstinput" name="guess" placeholder="Zadej číslo" value="' . $previousGuess . '" min="1" max="50" required>
                                            ' . $initialDepositField . '
                                        </div>
                                    </div>
                                    <input type="submit" formaction="#click" class="button" name="submit" value="Hádat">
                                </form>';
                            }
                            
                            if (isset($_POST['newGame'])) {
                                unset($_SESSION['randomNumber']);
                                header("Location: " . $_SERVER['PHP_SELF']);
                            }
                        ?>

                        <div class="token-status">
                            <a class="money-link">
                                <div class="all-money-link">
                                    <?php echo number_format($user_data['money'], 0, ',', ' '); ?>
                                    <img src="token-image.png" class="token-image" height="27px" width="27px">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="game-info" style="margin-top:100px">
                            <p style="font-size: 25px">Uhádni náhodně vygenerované číslo!</p>
                            <div class="vysledky-text" style="text-align:center;font-size:20px;margin-left:auto;margin-right:auto;width:auto;margin-top:30px">
                                <p>Správně zvaž, jaké číslo zrovna hádat. Zkus své štěstí a zbohatni jednoduše</p>
                            </div>
                            <div class="vysledek-text" style="font-size:18px;margin-top:30px;margin-left:auto;margin-right:auto">
                                <p>Uhádni automaticky vygenerované číslo a vyhraj dvojnásobek vkladu!</p>
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
                    document.getElementById("betAmount").max = maxBalance; 
                    
                    var balanceElements = document.querySelectorAll("#balance");
                    for (var i = 0; i < balanceElements.length; i++) {
                        balanceElements[i].innerHTML = maxBalance;
                    }

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
