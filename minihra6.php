<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
echo $user_data['money'];

$packs = [
    1 => ["name" => "Malý (100)", "price" => 100, "range" => "0-200"],
    2 => ["name" => "Velký (250)", "price" => 250, "range" => "0-500"],
    3 => ["name" => "Mega (500)", "price" => 500, "range" => "100-900"],
    4 => ["name" => "VIP (1000)", "price" => 1000, "range" => "0-2000"]
];
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
    <title>Full House | Balíčky</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
    <style>
        input[type=number] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .button-container {
            display: inline-block; /* Change from margin to inline-block */
            margin-right: 10px; /* Increase the margin between buttons */
            margin-bottom: 5px; 
            vertical-align: top; /* Align buttons to the top of the container */
        }

        .row {
            margin-bottom: 20px;
            font-size: 0;
        }

        .button-container button {
            color: transparent;
            font-size: 0;
            background-color: rgba(0,0,0, 0.2);
            padding: 5px;
            transition: 0.4s;
            border-radius: 150px;
            border: 2px solid #930ea4;
            position: relative;
            height: 150px;
        }

        .text-hover {
            width: 145px;
        }

        .button-container button:hover .hover-text {
            opacity: 1;
            transition: 1.5s;
        }

        .button-container button:hover .image-back {
            display: none;
            transition: 0.8s;
        }

        .hover-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .button-container button:hover {
            background-color: #930ea4;
            transition: 2s;
        }

        .button-container img {
            height: 130px;
            transition: 0.4s;
        }

        .helpicon {
            font-size: 40px;
            display: block;
            margin-left: -45px;
        }

        #result1 {
            font-size: 30px;
            opacity: 1;
            background-color: #bf42cf;
            width: 300px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 15px;   
            color: black; 
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

            <div class="nadpis-info">
                <div class="game-gui">
                    <div class="upper-bar">
                        <h1 class="nadpis-cisla">BALÍČKY</h1>
                        <i class="fa fa-info-circle helpicon"></i>
                    </div>

                    <div class="individual-game ind55" style="padding-bottom:100px">
                        <div class="row">
                            <?php foreach ($packs as $pack_id => $pack) { ?>
                                <div class="button-container">
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-method">
                                        <input type="hidden" name="pack_id" value="<?php echo $pack_id; ?>">
                                        <button type="submit" class="btn btn-dark" data-price="<?php echo $pack['price']; ?>" data-range="<?php echo $pack['range']; ?>">
                                            <div class="image-back"><?php echo $pack['name']; ?><br><img src="<?php echo getImageSrc($pack_id); ?>" alt="<?php echo $pack['name']; ?>"></div>
                                            <div class="text-hover"><p class="hover-text">Cena: <?php echo $pack['price']; ?><br>WIN: <?php echo $pack['range']; ?></p></div>
                                        </button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>

                        <?php
                        function getImageSrc($pack_id) {
                            switch ($pack_id) {
                                case 1:
                                    return "silver.png";
                                case 2:
                                    return "gold.png";
                                case 3:
                                    return "dia.png";
                                case 4:
                                    return "ruby.png";
                                default:
                                    return "placeholder.png";
                            }
                        }
                        ?>

                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $pack_id = $_POST['pack_id'];

                                if (isset($packs[$pack_id])) {
                                    $pack = $packs[$pack_id];
                                    $price = $pack["price"];
                                    $range = explode("-", $pack["range"]);
                                    $minRange = intval($range[0]);
                                    $maxRange = intval($range[1]);

                                    $money = intval($user_data['money']);

                                    if ($money >= $price) {
                                        $moneyGained = rand($minRange, $maxRange);
                                        $totalMoney = $money + $moneyGained - $price;
                                        deposit($con, $user_data['user_id'], $totalMoney);
                                        // Instead of alert, echo out a <p> message
                                        echo "<p id='result1' class='ress'>Vyhrál jsi $moneyGained tokenů!</p>";
                                    } else {
                                        // Instead of alert, echo out a <p> message
                                        echo "<p id='result1' class='ress'>Nemáš dostatek tokenů</p>";
                                    }
                                } else {
                                    // Instead of alert, echo out a <p> message
                                    echo "<p id='result1' class='ress'>Nemáš validní ID, brácho</p>";
                                }
                            }
                        ?>

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
                            <p style="font-size: 25px">KUP BALÍČEK ZA BODY A VYHRAJ NÁHODNÝ POČET BODŮ Z ROZMEZÍ!</p>
                            <div class="vysledky-text" style="text-align:center;font-size:20px;margin-left:auto;margin-right:auto;width:auto;margin-top:30px">
                                <p>Jestli se cítíš, že máš dnes opravdové štěstí, kup si balíček a udělej si radost.</p>
                            </div>
                            <div class="vysledek-text" style="font-size:18px;margin-top:30px;margin-left:auto;margin-right:auto">
                                <p>Čím dražší balíček je, tím roste risk. Ale pamatuj, u dražších můžeš zbohatnout velmi rychle.</p>
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

    <?php
        function deposit($con, $user_id, $amount) {
            $query = "UPDATE users SET money = ? WHERE user_id = ?";
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $amount, $user_id);
            $stmt->execute();
        }
    ?>

</html>
