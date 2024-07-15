<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$result = "";

// Inicializace hry Kamen nůžky papír
if (!isset($_SESSION['randomNumber'])) {
    $_SESSION['randomNumber'] = rand(1, 50);
    $_SESSION['money'] = $user_data['money'];
} else {
    $playerChoice = isset($_POST['choice']) ? $_POST['choice'] : null;
    $betAmount = isset($_POST['betAmount']) ? intval($_POST['betAmount']) : 1;

    if ($playerChoice !== null) {
    if ($betAmount <= 0 || $betAmount > $user_data['money']) {
        $message = "Nepovolená hodnota pro počáteční vklad, útočníčku!";
        echo "<script>alert('" . $message . "');</script>";
    } elseif ($playerChoice !== null && in_array($playerChoice, ['rock', 'paper', 'scissors'])) {
        $playerChoice = htmlspecialchars($playerChoice);
        $betAmount = htmlspecialchars($betAmount);

        $query = "SELECT money FROM users WHERE user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $user_data['user_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userMoney);
        $stmt->fetch();

        if ($betAmount > $userMoney) {
            $message = "Sorry bráško, tohle je nepovolená hodnota pro počáteční vklad.";
            echo "<script>alert('" . $message . "');</script>";
        } else {
            $computerChoice = ['rock', 'paper', 'scissors'][rand(0, 2)];

            if ($playerChoice === $computerChoice) {
                $result = "Je to remíza!";
            } elseif (
                ($playerChoice === 'rock' && $computerChoice === 'scissors') ||
                ($playerChoice === 'paper' && $computerChoice === 'rock') ||
                ($playerChoice === 'scissors' && $computerChoice === 'paper')
            ) {
                $result = "Vyhráváš!";
                doubleDeposit($con, $user_data['user_id'], $betAmount);
            } else {
                $result = "Prohráváš!";
                deductMoney($con, $user_data['user_id'], $betAmount);
            }
        }
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
    <title>Full House | Kámen nůžky papír</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
    <style>
        #betAmount {
            text-align: center;
            padding: 5px;
            width: 200px;
        }

        .submit-button {
            background-size: cover;
            border: none;
            color: transparent;
            width: 120px;
            height: 100px;
            cursor: pointer;
            border-radius: 25px;
            padding: 15px;
            background-color: transparent;
        }

        .b1 {
            background-image: url(rock.png);
        }

        .b2 {
            background-image: url(paper.png);
            height: 120px;
        }

        .b3 {
            background-image: url(scissors.png);
        }
 
        .last-button {
            visibility: hidden;
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

        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
                        <h1 class="nadpis-cisla">KÁMEN, NŮŽKY, PAPÍR</h1>
                        <i class="fa fa-info-circle helpicon"></i>
                    </div>

                    <div class="individual-game" id="individual-game" style="padding-bottom:100px">
                        <div>
                            <form method="post">
                            <input type="number" id="betAmount" class="firstinput" name="betAmount" min="1" value="<?php if(isset($_POST['betAmount'])) echo $_POST['betAmount']; ?>" placeholder="Počáteční vklad" max="<?= $user_data['money'] ?>" required>

                                <div id="choices" style="margin-bottom:40px">
                                    <input type="submit" formaction="#click" class="submit-button b1" name="choice" value="rock">
                                    <input type="submit" formaction="#click" class="submit-button b2" name="choice" value="paper">
                                    <input type="submit" formaction="#click" class="submit-button b3" name="choice" value="scissors">
                                    <div class="last-button">
                                        <input type="submit" class="submit-button b4" name="choice" value="scissors">
                                    </div>
                                </div>
                                <div id="result"><?= $result ?></div>
                            </form>
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
                            <p style="font-size: 25px">Klasická hra kámen, nůžky, papír</p>
                            <div class="vysledky-text" style="text-align:left;font-size:20px;margin-left:auto;margin-right:auto;width:250px;margin-top:30px">
                                <p>Remíza - nezískáš nic</p>
                                <p>Výhra - získáš dvojnásobek vkladu</p>
                                <p>Prohra - prohráváš vklad</p>
                            </div>
                            <div class="vysledek-text" style="font-size:18px;margin-top:30px;margin-left:auto;margin-right:auto">
                                <p>HRA, U KTERÉ JE MENŠÍ ŠANCE, ŽE PROHRAJEŠ. ŠANCE NA VÝHRU NEBO REMÍZU JE 66%, zatímco prohra pouze 33%.</p>
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

<?php
function doubleDeposit($con, $user_id, $amount) {
    $query = "UPDATE users SET money = money + ? WHERE user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $amount, $user_id);
    $stmt->execute();
}

function deductMoney($con, $user_id, $amount) {
    $query = "UPDATE users SET money = money - ? WHERE user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $amount, $user_id);
    $stmt->execute();
}
?>
