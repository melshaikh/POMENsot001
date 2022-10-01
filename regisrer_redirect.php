<?php

include 'api/headl.inc.php';
include 'api/config.php';


if (isset($_POST['submit']))
{
$level=$_GET['level'];
if (($level < 1000 && $level > 100))
{     
        $name = $_POST['full_name'];
        $email = $_POST['email_address'];
        $Password = $_POST['Password'];
        $confirm_Password = $_POST['confirm_password'];
    
        if ($_POST["Password"] === $_POST["confirm_password"]) 
        {
            $name_user = "SELECT * FROM user WHERE name='$name' or email ='$email'";
            $stmt = $dbo->prepare($name_user);
            $stmt->execute();
            $name_gmail = $stmt->rowCount();
            $Password = hash("sha512", $Password);

            if ( $name_gmail > 0) 
            {
                echo '<script>alert("name or gmail already taken")</script>';
            } else 
            {   
                $level = "500";
                $type = "3";
                $sql = "INSERT INTO user (name,email,password,level,type) VALUES ('$name','$email','$Password','$level','$type')";
                $sessionID = session_id();
                $hash = hash("sha512", $sessionID . $_SERVER['HTTP_USER_AGENT']);
                $stmt = $dbo->prepare($sql);
                $stmt->execute();
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                $sql = "select * from user where email='$email'";
                $stmt = $dbo->prepare($sql);
                $stmt->execute();
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                $expires = time() + (60 * 60);
                $new_sql = "INSERT INTO `active_users`(`user`, `session_id`, `hash`, `expires`, `level`) VALUES ('" . $userData['id'] . "','" . $sessionID . "','" . $hash . "','" . $expires . "','" . $userData['level'] . "')";
                $dbo->query($new_sql);
                header("location: user/index.php");
                }  
            }
        } else {
            echo '<script>alert("password does not match")</script>';
            header("location: user_register.php");
        }
    }
else header("location: user_register.php")
    ?>   

