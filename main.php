<?php
    session_start();

    include("database.php");
    if(!isset($_GET['page'])){
        header('Location: main.php?page=start');
        exit();
    }

    if(!isset($_SESSION['user_id'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/random-color.css.php">

</head>
<body>

    <div class="menubar">
        <h1>My Contact Book</h1>
        <div class="myName">
            <div class="avatar">
            <?php
            $first_letter = mb_substr($_SESSION['user'], 0, 1);
            echo "{$first_letter}";
            ?>
            </div>
            <?php
                 echo $_SESSION['user'];
            ?>
        </div>
    </div>
    <div class="main">
        <div class="menu">
            <a href="main.php?page=start"><img src="img/home.svg"> Start</a>
            <a href="main.php?page=addContact"><img src="img/add_circle.svg"> Add a Contact</a>
            <a href="main.php?page=contacts"><img src="img/menu.svg"> Contacts</a>
            <a href="main.php?page=legal"><img src="img/legal.svg"> Impressum</a>
            <a href="logout.php"><img src="img/logout.svg"> Logout</a>
        </div>

        <div class="content">
            <?php include("contact_view.php"); ?>
        </div>
    </div>
    <div class='footer'>
        (C) 2025 Jason GmbH
    </div>
</body>
</html>