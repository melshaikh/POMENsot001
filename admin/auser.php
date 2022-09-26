<?php include '../api/headl.inc.php';if(isUserLoggedIn() > 0){if(getUser()['type'] = 1){$school_id = 1; $admino = getUser();?><!DOCTYPE html>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="POMEN-SOT SYSTEM">
    <meta name="keywords" content="IoT Farm Dashboard">
    <meta name="author" content="Mohamed Elshaikh">
    <title>POMEN-SOT ADMIN SYSTEM</title>
    <link rel="apple-touch-icon" href="../access_temp/theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../access_temp/theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../access_temp/theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="../access_temp/theme-assets/vendors/css/charts/chartist.css">
    
    <link rel="stylesheet" type="text/css" href="../access_temp/theme-assets/css/app-lite.css">
    
    <link rel="stylesheet" type="text/css" href="../access_temp/theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../access_temp/theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../access_temp/theme-assets/css/pages/dashboard-ecommerce.css">
    <style>
            .holderi {
                height: 300px;
                width: 300px;
                border: 2px solid black;
            }
            img#blah {
                max-width: 300px;
                max-height: 300px;
                min-width: 300px;
                min-height: 300px;
            }
            inputi[type="file"] {
                margin-top: 5px;
            }
            .headingi {
                font-family: Montserrat;
                font-size: 45px;
                color: green;
            }
    </style>   
   
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
             <h2 style="color: whitesmoke; margin-top: 2%;"> Welcome [<?php echo $admino['name']; ?>]</h2>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php include 'prints.php';    printSide('users') ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Chart -->
            <!-- Table head options start -->
            <?php 
            if (isset($_POST['user_id'])) {
                $user = getUserByID($_POST['user_id']);
            } elseif (isset($_GET['user_id'])) {
                $user = getUserByID($_GET['user_id']);
            } elseif (isset($_POST['user_id2'])) {
                $user = getUserByID($_POST['user_id2']);
            }
            if(isset($_POST['user_id2']))
            {
                $sql = null;
                switch($_POST['switch'])
                {
                  case "edit name":$sql = "UPDATE `user` SET `name` = '".$_POST['val_']."' WHERE `user`.`id` = ".$_POST['user_id2'].";"; break;
                  case '1':$sql = "UPDATE `user` SET `email` = '".$_POST['val_']."' WHERE `user`.`id` = ".$_POST['user_id2'].";"; break;
                  case '0':$sql = "UPDATE `user` SET `name` = '".$_POST['val_']."' WHERE `user`.`id` = ".$_POST['user_id2'].";"; break;
                  case '2': $sql = "UPDATE `user` SET `type` = '".$_POST['val_']."' WHERE `user`.`id` = ".$_POST['user_id2'].";"; break;                  
                  case '4': $uss = hash("sha512",$sesid.'12345'); 
                      $sql = "UPDATE `user` SET `password` = '".$uss."' WHERE `user`.`id` = ".$_POST['user_id2'].";"; break;
                }
                if(!is_null($sql))
                {
                include '../api/config.php';
                $query = $dbo->prepare($sql);
                $query->execute();
                echo $sql;
                }else                    echo 'sql is null';
            }
            if (isset($_POST['uploadimg'])) {
                    include '../api/config.php';
                    $filename = $_FILES["uploadfile"]["name"];
                    $tempname = $_FILES["uploadfile"]["tmp_name"];
                    $file_type=$_FILES['uploadfile']['type'];
                    $file_ext=strtolower(end(explode('.',$_FILES['uploadfile']['name'])));
                    $newFileName = 'p'.$user['id'].'.'.$file_ext;
                    $folder = "../images/userImages/" .$newFileName;
                    if (move_uploaded_file($tempname, $folder)) {
                        $sqll = "UPDATE `user` SET `image` = '".$newFileName."' WHERE `user`.`id` = ".$user['id'].";";
                        $stmt = $dbo->prepare($sqll);
                        $stmt->execute();
                    } else {
                        echo "<h3>Failed</h3>";
                    }
                }        
            ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><?php echo $user['name']; ?></h4>
                                <p> User Profile
                                    <?php 
//                                    if(isset($_POST['user_id2'])) if(!is_null($sql)) echo $sql; else   echo 'sql is null';
                                    ?>
                                </p>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>				
			</div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col"></th>
								<th scope="col">Value</th>
                                                                <th scope="col">Edit</th>
							</tr>
						</thead>
						<tbody>
        <?php 
        $ut = getUserTypeByTypeId($user['type']);
        if(!is_null($user)){ ?>
            <tr>
                <td>ID</td>
                <td><?php echo $user['id']; ?></td>
            </tr>
            <tr>
                <td>Image</td>
                <td>
                    <span class="avatar">
                            <img src="../images/userImages/<?php echo $user['image']; ?>" alt="avatar">
                    </span>
                </td>
                <td>                    
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="holderi">
                            <img id="blah" src="../images/userImages/<?php echo $user['image']; ?>" alt="pic" />
                        </div>
                        <input type='file' name="uploadfile" onchange="readURL(this);" />
                        <input type="hidden" name="user_id2" value="<?php echo $user['id']; ?>">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="uploadimg">UPLOAD</button>
                        </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $user['name']; ?></td>
                <td>
                    <form action="auser.php" method="POST">
                        <input type="text" value="<?php echo $user['name']; ?>" name="val_">
                        <input type="hidden" name="switch" value=0 >
                        <input type="hidden" name="user_id2" value="<?php echo $user['id']; ?>">
                        <input type="submit" class="btn btn-cyan" name="SubmitChange" value="edit name">
                    </form>
                </td>
                </tr>
            <tr>
                <td>E-Mail</td>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <form action="auser.php" method="POST">
                        <input type="text" value="<?php echo $user['email']; ?>" name="val_">
                        <input type="hidden" name="user_id2" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="switch" value=1 >
                        <input type="submit" class="btn btn-cyan" name="SubmitChange" value="edit email">
                    </form>
                </td>
                </tr>
            <tr>
                 <td>Access Level</td>
                 <td><?php echo $ut['disply']; ?></td>
                 <td>
                    <form action="auser.php" method="POST">
                        <input type="hidden" name="user_id2" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="switch" value=2 >
                        <select name="val_">
                            <?php $types = getAllUsersTypes(); 
                            if(!is_null($types)){
                                while($atype = $types->fetch(PDO::FETCH_ASSOC)){ 
                                    if($user['type'] == $atype['id'])
                                    {
                                    ?>                           
                                    <option value="<?php echo $atype['id']?>" selected ><?php echo $atype['disply']?></option>
                            <?php   }else{?>
                                    <option value="<?php echo $atype['id']?>"><?php echo $atype['disply']?></option>
                            ?><?php } } } ?>
                        </select>
                        <input type="submit" class="btn btn-cyan" name="SubmitChange" value="edit name">
                    </form>
                </td>
            </tr>
            <tr>
                <td>PASSWORD</td>
                <td>
                    <form action="auser.php" method="POST">
                        <input type="hidden" name="user_id2" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="switch" value=4 >
                        <input type="submit" class="btn btn-cyan" name="SubmitChange" value="Reset to 12345">
                    </form>
                </td>
            </tr>
        <?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Table head options end -->

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php printfooter(); ?>

    <!-- BEGIN VENDOR JS-->
    <script src="../access_temp/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../access_temp/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="../access_temp/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="../access_temp/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../access_temp/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <script src="../access_temp/theme-assets/js/scripts/charts/chartjs/line/line.js" type="text/javascript"></script>
    <script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html><?php
}}else {
     echo '<form action="../index.php" method="get">
          <input type="hidden" name="err" value="Please Login"/>
          <input type="submit" name="login" value="Please Login"/>
      </form>';    
} 
?>