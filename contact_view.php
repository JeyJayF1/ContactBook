<?php 

                $headline = 'Welcome';
                
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

                        $user_id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM contacts WHERE user_id = '$user_id'";
                        $contacts = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($contacts) > 0){
                            while($row = mysqli_fetch_assoc($contacts)){
                                $name = $row['name'];
                                $phone = $row['phone'];
                                $contact_id = $row['id'];
                                
                                echo "
                                <div class='card'>
                                    <img class='profile-picture' src='img/profile-picture.svg'>
                                    <b>$name</b><br>
                                    $phone

                                    <a class='phone' href='tel:$phone'>Call</a>
                                    <a class='delete' href='?page=delete&contact=$contact_id'>Delete</a>
                                </div>
                                ";
                            }
                        } else {
                            echo "No contacts";
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

                    <form action='?page=addContact' method='POST'>
                        <div class='add'>
                            <input placeholder='Enter your name' name='name'>
                        </div>

                        <div class='add'>
                            <input placeholder='Enter your phone number' name='phone'>
                        </div>

                        <button class='add' type='submit'>Enter</button>
                    </form>
                    ";

                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
                        $phone_number = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
                        $user_id = $_SESSION['user_id'];

                        $sql = "INSERT INTO contacts (user_id, name, phone) VALUES ('$user_id', '$name', '$phone_number')";

                        try{
                            mysqli_query($conn, $sql);
                            echo "Added contact {$name}";
                            header("refresh:1; url=main.php?page=contacts");
                        }catch(mysqli_sql_exception){
                            echo "Error adding a contact";
                        }

                    }
                } else if($_GET['page'] == 'delete'){
                    $contact_id = $_GET['contact'];
                    $user_id = $_SESSION['user_id'];

                    $sql = "DELETE FROM contacts WHERE id = '$contact_id' AND user_id = '$user_id'";

                    try{
                        mysqli_query($conn, $sql);
                        echo "
                        <p>You Contact got deleted</p>
                        ";
                    }catch(mysqli_sql_exception){
                        echo "Error deleting contact";
                    }

                    
                } else {
                    echo "
                    <p>You are on the start page</p>
                    ";
                } 
                mysqli_close($conn);
            ?>