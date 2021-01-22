<?php
include "../includes/db_conn.php";
?>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Verify Account</title>
    </head>
    <body>

    <?php

        if(isset($_GET['email']) && isset($_GET['token'])){
            $usermail = $_GET['email'];
            $token = $_GET['token'];
            $sql = "SELECT uid FROM job_users WHERE email='$usermail'";
            $result = $conn->query($sql);
            $row = $result->fetch();

            if($result->rowCount() > 0){
                $update = "UPDATE job_users SET active = '1', token = '' WHERE email='$usermail'";
                $result=$conn->query($update);
                if(isset($result)){
                    echo '<h3>Your account has been activated</h3> <br>
                    <a href="login.php">Click here</a> to login';
                }
            }
        }
    ?>
        
    </body>
    </html>