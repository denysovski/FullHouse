<?php 
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = htmlspecialchars($_POST['user_name']);
    $password = htmlspecialchars($_POST['password']);

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Read from database using prepared statement
        $query = "SELECT * FROM users WHERE user_name = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $user_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result) {
            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data && password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: loading.php");
                    die;
                }
            }
        }
        
        echo '<script>alert("Nesprávné uživatelské údaje");</script>';
    } else {
        echo '<script>alert("Nesprávné uživatelské údaje");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Full House | Nový rozměr sázení</title>
    <link rel="icon" type="image/x-icon" href="fullhouse-logo3.png">
    <meta name="google-site-verification" content="6hi5mt9x3JJdaH31mIornmxW5Mi8mBkiKIe3qjEJmDM" />

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
        <div class="blurry-background"></div>
        <form method="post">
            <div class="nadpis"><img src="logo-web1.png" alt="logo" class="header-image" height="100px"></div>

            <input class="input" type="text" name="user_name" placeholder="Uživatelské jméno" value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : ''; ?>"><br><br>
            <input class="input" type="password" name="password" placeholder="Heslo"><br><br>

            <button type="submit" class="button15"><p>Přihlásit se</p></button><br><br>

            <a class="switch-btn" href="signup.php" style="font-size:18px">Ještě nemáš účet? Registruj se zde</a><br><br>
        </form>
    </div>
</body>
</html>