<?php
    include("src/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="form login">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" placeholder="username" name="username">
                    <img src="img/person.svg">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="password">
                    <img src="img/password.svg">
                </div>
                <input class="btn" type="submit" name="login" value="Login"><br><br>
                <div class="output">
                    <?php include("src/login_logic.php"); ?>
                </div>
            </form>
        </div>
        <div class="info_container">
            <div class="info">
                <h1>Welcome!</h1>
                <p>If you do not have an account go <a href="registration.php">here</a></p>
            </div>
        </div>
    </div>
</body>
</html>