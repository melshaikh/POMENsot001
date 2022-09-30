<?php
include 'api/headl.inc.php';
include 'api/config.php';
if(isset($_POST['loginaaa']))
{  
    $pass = hash("sha512",$_POST['pwd']);
    $sql = "SELECT * FROM `user` WHERE `email`= '".$_POST['email']."' AND `password` = '".$pass."' LIMIT 1";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();    
    if($stmt)
    {
        if($stmt->rowCount() > 0)
        {
            $sessionID = session_id();
            $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            //$userData = $query->fetch_assoc();
            $expires = time()+(60*60);
            //if the user in the active update only
            $ck = "SELECT `id` FROM `active_users` WHERE `active_users`.`user`= '".$userData['id']."' LIMIT 1";
            $stmt2 = $dbo->prepare($ck);
            $stmt2->execute();  
            //$ck_r = $dbo->query($ck);
            if($stmt2->rowCount() < 1)
            $new_sql = "INSERT INTO `active_users`(`user`, `session_id`, `hash`, `expires`, `level`) VALUES ('".$userData['id']."','".$sessionID."','".$hash."','".$expires."','".$userData['level']."')";
            else $new_sql = "UPDATE `active_users` SET `"
                    . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `active_users`.`user` = ".$userData['id'];
            $dbo->query($new_sql);
            $f = getUser();
            if($f['level'] < 10) {header("Location: admin/index.php");// system admins 0..9
            }else if($f['level'] < 100) {header("location: pomen/index.php");}//pomen 10..99
            else if($f['level'] < 1000){header("Location: user/index.php");}//registered user 100..999
            else header("Location: index.php#contact?err='UN-known Level of access");
        }else {header("Location: index.php?err='errore[9][".$sql."]'#contact");}    
    } else header("Location: ../index.php?err='wrong User name or Password");
}
if(isset($_POST['signup']))
{
    
   $pass1 = hash("sha512",$_POST['pwd1']); 
   $pass2 = hash("sha512",$_POST['pwd2']);
   if(strcmp($pass1,$pass2) == 0)
   {
       
   }else header("location:../index.php#signup");
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="icon" href="Favicon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar-Pomen">
    <div class="container">
    <h1 class="navbar-brand" href="#">Pomen</h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      

    </div>
    </div>
</nav>

    
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="" method="post">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input required type="email" id="email_address" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input required type="password" id="confirm_Password" class="form-control" name="pwd">
                                    </div>
                                </div>
                                

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="loginaaa">
                                        Login
                                        </button>
                                    </div>
                                    
                                
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
            </div>
        
    

</main>


<!-- initialize jQuery Library -->
 

</body>
</html>

