<?php 
include 'api/headl.inc.php';
include 'api/config.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>

    </div>
    </div>
</nav>
<?php
        if(isset($_POST['submit']))
        {    
        $name = $_POST['full_name'];
        $email = $_POST['email_address'];
        $type = $_POST['type'];
        $Password = $_POST['Password'];
        $confirm_Password = $_POST['confirm_password'];
          
       $name=mysqli_real_escape_string($dbo,$_POST['full_name']);
        $email=mysqli_real_escape_string($dbo,$email);
        $type=mysqli_real_escape_string($dbo,$type);
        $Password=mysqli_real_escape_string($dbo,$confirm_Password);
        $confirm_Password=mysqli_real_escape_string($dbo,$type);

if ($_POST["Password"] === $_POST["confirm_password"]) {
  
    $sql_user = "SELECT * FROM user WHERE name='$name'";
  	$sql_email = "SELECT * FROM user WHERE email='$email'";
  	$user_query = mysqli_query($dbo, $sql_user);
  	$email_query = mysqli_query($dbo, $sql_email);
    $Password= hash("sha512",$Password);
    switch($type)
    {
        case "pomen":
            $level=50; 
            $type=1;
        break;
        case "user":
            $level=500;
            $type=1;
        break;
       
    }

    
  	if (mysqli_num_rows($user_query) > 0) {
        echo '<script>alert("name already taken")</script>';
  	}else if(mysqli_num_rows($email_query) > 0){
  	
echo '<script>alert("Email already taken")</script>'; 	
  	}else{
    $sql = "INSERT INTO user (name,email,password,level,type) VALUES ('$name','$email','$Password','$level',$type)";
    $sessionID = session_id();
        
            $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
            $stmt = $dbo->prepare($sql);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $sql="select id from user where email='$email'";
            $stmt = $dbo->prepare($sql);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            $expires = time()+(60*60);
            
            $new_sql = "INSERT INTO `active_users`(`user`, `session_id`, `hash`, `expires`, `level`) VALUES ('".$userData['id']."','".$sessionID."','".$hash."','".$expires."','".$userData['level']."')";
           $dbo->query($new_sql);
        if($level < 10) {header("Location: admin/index.php");// system admins 0..9
            }else if($level < 100 && $level>10) {header("location: pomen/index.php");}//pomen 10..99
            else if($level < 1000 && $level>100 ){header("Location: user/index.php");}//registered user 
}
}
else {
   echo '<script>alert("password does not match")</script>';
}
    
        
        }
        ?>
    
    
<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="" method="post">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input required type="text" id="full_name" class="form-control" name="full_name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input required type="email" id="email_address" class="form-control" name="email_address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">type</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="type">
                                        <option value = "user" >user</option>
                                        <option value = "pomen" >pomen</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input required type="password" id="confirm_Password" class="form-control" name="Password">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input required type="password" id="confirm_Password" class="form-control" name="confirm_password">
                                    </div>
                                </div>
                              


                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>


</body>


<!-- initialize jQuery Library -->
  <script src="templ_public/plugins/jQuery/jquery.min.js"></script>
  <!-- Bootstrap jQuery -->
  <script src="templ_public/plugins/bootstrap/bootstrap.min.js" defer></script>
  <!-- Slick Carousel -->
  <script src="templ_public/plugins/slick/slick.min.js"></script>
  <script src="templ_public/plugins/slick/slick-animation.min.js"></script>
  <!-- Color box -->
  <script src="templ_public/plugins/colorbox/jquery.colorbox.js"></script>
  <!-- shuffle -->
  <script src="templ_public/plugins/shuffle/shuffle.min.js" defer></script>


  <!-- Google Map API Key-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
  <!-- Google Map Plugin-->
  <script src="templ_public/plugins/google-map/map.js" defer></script>

  <!-- Template custom -->
  <script src="templ_public/js/script.js"></script>
</html>