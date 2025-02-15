<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($username)){
            echo "Please enter a username!";
        }else if (empty($password)){
            echo "Please enter a password!";
        }else{
            $sql = "SELECT * FROM users WHERE user = '$username'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_assoc($result);
                    $passwordDb = $row['password'];

                    if(password_verify($password, $passwordDb)){
                        echo "Login successful";
                        header("refresh:2; url=main.php");
                    } else {
                        echo "Wrong password!";
                    }
                }else{
                    echo "User not found";
                }
        }
    }
?>