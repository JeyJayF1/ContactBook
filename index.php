<?php
    if(!isset($_GET['page']) || $_GET['page'] !== 'start'){
        header('Location: index.php?page=start');
        exit();
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

    <style>
        .footer {
            display: flex;
            text-align: center;
            justify-content: center;
            background-color: #343434;
            color: white;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        body {
            font-family: "Roboto", serif;
            background-color: #EAEDF8;
            margin: 0;
        }
        .main{
            display: flex;
        }
        .menu{
            width: 20%;
            background-color: #746CF5;
            margin-right: 32px;
            padding-top: 150px;
            height: 100vh;
        }

        .content{
            width: 80%;
            margin-top: 100px;
            margin-right: 32px;
            background-color: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .content ~ *{
            margin-top: 4px;
        }

        .menu a{
            display: block;
            text-decoration: none;
            color: white;
            padding: 8px;
            display: flex;
            align-items: center;
        }

        .menu img{
            margin-right: 8px;
        }

        .menu a:hover{
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menubar{
            background-color: white;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 80px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
            padding-left: 50px;
            display: flex;
            justify-content: space-between;
        }
    
        .avatar{
            border-radius: 100%;
            background-color: yellowgreen;
            padding: 16px;
            width: 16px;
            height: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 8px;
        }

        .myName{
            display: flex;
            margin-right: 50px;
            align-items: center;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.05);
            margin-bottom: 16px;
            border-radius: 8px; 
            padding: 16px;
            padding-left: 64px;
            position: relative;
        }

        .profile-picture{
            height: 48px;
            width: 48px;
            position: absolute;
            left: 8px;
            bottom: 10px;
        }

        .phone {
            background-color: #746CF5;
            text-decoration: none;
            padding: 4px;
            color: white;
            border-radius: 4px;
            position: absolute;
            right: 0;
            top: 0;
            width: 60px;
            text-align: center;
        }

        .delete{
            background-color: #DC143C;
            text-decoration: none;
            padding: 4px;
            color: white;
            border-radius: 4px;
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60px;
            text-align: center;
        }

        .phone:hover {
            background-color: #A9A4EB;
        }

        .add{
            margin-top: 5px;
        }


    </style>
</head>
<body>

    <div class="menubar">
        <h1>My Contact Book</h1>
        <div class="myName">
            <div class="avatar">J</div>Jason Fahlen
        </div>
    </div>
    <div class="main">
        <div class="menu">
            <a href="index.php?page=start"><img src="img/home.svg"> Start</a>
            <a href="index.php?page=addContact"><img src="img/add_circle.svg"> Add a Contact</a>
            <a href="index.php?page=contacts"><img src="img/menu.svg"> Contacts</a>
            <a href="index.php?page=legal"><img src="img/legal.svg"> Impressum</a>
        </div>

        <div class="content">
            <?php 

                $headline = 'Welcome';
                $contacts = [];

                if(file_exists('contacts.txt')){
                    $contacts = json_decode(file_get_contents('contacts.txt', true), true);
                }

                if(isset($_POST['name']) && isset($_POST['phone'])){
                    echo 'Contact <b>' . $_POST['name'] . '</b> was added';
                    $newContact = [
                        'name' => $_POST['name'],
                        'phone' => $_POST['phone']
                    ];
                    array_push($contacts, $newContact);
                    file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
                }
                
                if($_GET['page'] == 'contacts'){
                    $headline = 'Your contacts';
                }
                
                if($_GET['page'] == 'legal'){
                    $headline = 'Legal page';
                }

                if($_GET['page'] == 'addContact'){
                    $headline = 'Add a Contact';
                }

                if($_GET['page'] == 'delete'){
                    $headline = 'Deletion Page';
                }


                echo '<h1>' . $headline . '</h1>';

                if($_GET['page'] == 'contacts'){
                    echo "
                        <p>On this page you have a overview of your <b>contacts</b></p>
                        ";

                        foreach ($contacts as $key=>$row) {
                            $name = $row['name'];
                            $phone = $row['phone'];
                            echo "
                            <div class='card'>
                                <img class='profile-picture' src='img/profile-picture.svg'>
                                <b>$name</b><br>
                                $phone

                                <a class='phone' href='tel:$phone'>Call</a>
                                <a class='delete' href='?page=delete&delete=$key'>Delete</a>
                            </div>
                            ";
                        }
                } else if($_GET['page'] == 'legal') {
                    echo "
                    <p>This is the legal page</p>
                    ";
                } else if($_GET['page'] == 'addContact'){
                    echo "
                    <div class='add'>
                        Here you can add another contact
                    </div>

                    <form action='?page=contacts' method='POST'>
                        <div class='add'>
                            <input placeholder='Enter your name' name='name'>
                        </div>

                        <div class='add'>
                            <input placeholder='Enter your phone number' name='phone'>
                        </div>

                        <button class='add' type='submit'>Enter</button>
                    </form>
                    ";
                } else if($_GET['page'] == 'delete'){
                    echo "
                    <p>You Contact got deleted</p>
                    ";

                    $delete = $_GET['delete'];
                    array_splice($contacts, $delete, 1);
                    file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
                    
                } else {
                    echo "
                    <p>You are on the start page</p>
                    ";
                } 

            ?>
        </div>
    </div>
    <div class='footer'>
        (C) 2025 Jason GmbH
    </div>
</body>
</html>