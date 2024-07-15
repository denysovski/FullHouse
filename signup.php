<?php 
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = htmlspecialchars($_POST['user_name']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    
    // Kontrola, zda uživatelské jméno již existuje
    $check_query = "SELECT * FROM users WHERE user_name = ?";
    $stmt = mysqli_prepare($con, $check_query);
    mysqli_stmt_bind_param($stmt, "s", $user_name);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo '<script>alert("Uživatelské jméno již existuje, zvol prosím jiné");</script>';
    } elseif (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        if (strlen($user_name) <= 15) {
            if ($password === $confirm_password && strlen($password) >= 8) {
                
                // Uložení do DB
                $user_id = random_num(20);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Zaheshované heslo
                $query = "INSERT INTO users (user_id, user_name, password) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "sss", $user_id, $user_name, $hashed_password);
                mysqli_stmt_execute($stmt);
                
                header("Location: login.php");
                die;
            } elseif ($password !== $confirm_password) {
                echo '<script>alert("Hesla se neshodují");</script>';
            } elseif (strlen($password) < 8) {
                echo '<script>alert("Heslo musí obsahovat alespoň 8 znaků");</script>';
            }
        } else {
            echo '<script>alert("Uživatelské jméno může mít maximálně 15 znaků");</script>';
        }
    } else {
        echo '<script>alert("Prosím, zadejte platné informace");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <script src="script.js" defer></script>
    <title>Full House | Nový rozměr sázení</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">

    <!-- SEO -->
    <meta property="og:type" content="website" />
     <meta property="og:url" content="https://full-house.mzf.cz"/>
     <meta property="og:title" content="Full House | Nový rozměr sázení" />
     <meta property="og:description" content="Fullhouse je revoluční webová gambling stránka, na které naleznete spoustu zajímavých miniher." />
     <meta property="og:image" content="fullhouse-logo3.png"/>
 
     <meta property="twitter:card" content="summary_large_image" />
     <meta property="twitter:url" content="https://full-house.mzf.cz"/>
     <meta property="twitter:title" content="Full House | Nový rozměr sázení" />
     <meta property="twitter:description" content="Fullhouse je revoluční webová gambling stránka, na které naleznete spoustu zajímavých miniher." />
     <meta property="twitter:image" content="fullhouse-logo3.png" />
</head>
<body>
<div class="background-pozadi">
        <video autoplay muted loop>
          <source src="background-test.mp4" type="video/mp4"/>
        </video>
    </div>
    <div class="container">
        <form method="post">
            <div class="nadpis"><img src="logo-web1.png" alt="logo" class="header-image" height="100px"></div>

            <input class="input" type="text" name="user_name" placeholder="Uživatelské jméno" value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : ''; ?>"><br><br>
            <input class="input" type="password" name="password" value="" id="password" placeholder="Heslo"><br><br>
            <input class="input" type="password" name="confirm_password" value="" id="confirm_password" placeholder="Heslo znovu"><br><br>

            <button type="submit">Registrovat se</button><br><br>

            <a class="switch-btn" href="login.php" style="font-size:18px">Už máš účet? Přihlas se zde</a><br><br>
        </form>
    </div>
</body>
</html>
