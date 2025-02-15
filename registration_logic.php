<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username)){
            echo "Please enter a username!";
        }else if (empty($password)){
            echo "Please enter a password!";
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user, password)
                        VALUES ('$username','$hash')";
            try{
                mysqli_query($conn, $sql);
                echo "Registered successfully!";
                header("refresh:2; url=index.php");
            }catch(mysqli_sql_exception){
                echo "User already exist!";
                return;
            }
        }
    }

    mysqli_close($conn);
?>