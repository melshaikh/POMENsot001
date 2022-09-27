<?php include '../api/headl.inc.php';if(isUserLoggedIn() > 0){if(getUser()['type'] = 1){  $pomen = getUser(); $service=Service_info();?><!DOCTYPE html>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="IoT Farm Dashboard">
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
   
  </head>
  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">
      <?php
      if (isset($_POST['uploadimg'])) {
                    $sql = "INSERT INTO `services_list` (`id`, `pomen_type_id`, `name`, `details`, `image`) VALUES "
                                . "(NULL, '".$_POST['type_id']."', '".$_POST['name']."', '".$_POST['detail']."', 'pngegg.png');";
                        $stmt = $dbo->prepare($sql);
                        $stmt->execute();
                        $id = $dbo->lastInsertId();
                        $sql = "INSERT INTO `pomen_to_service` (`id`, `pomen_id`, `service_id`) VALUES "
                                . "(NULL, '".$pomen['id']."', '".$id."');";
                        $stmt = $dbo->prepare($sql);
                        $stmt->execute();
                    include '../api/config.php';
                    $filename = $_FILES["uploadfile"]["name"];
                    $tempname = $_FILES["uploadfile"]["tmp_name"];
                    $file_type=$_FILES['uploadfile']['type'];
                    $file_ext = strtolower(pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION));
                    $newFileName = 'serv'.$id.'.'.$file_ext;
                    $folder = "../images/userImages/" .$newFileName;
                    if (move_uploaded_file($tempname, $folder)) {
                        $sqll = "UPDATE `services_list` SET `image` = '".$newFileName."' WHERE `services_list`.`id` = ".$id.";";
                        $stmt = $dbo->prepare($sqll);
                        $stmt->execute();
                    } else {
                        echo "<h3>Failed</h3>";
                    }
                }        
       ?>
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
      <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
             <h2 style="color: whitesmoke; margin-top: 2%;"> Welcome [<?php echo $pomen['name']; ?>]</h2>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php include 'prints.php';    printSide('services') ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Chart -->
            <!-- Table head options start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">New Service Form</h4>
                                <?php if(isset($_GET['err'])){ ?> 
                                <p><?php echo $_GET['err']; ?></p>
                                <?php } ?>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>				
			</div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
                                            <form method="POST" action="" enctype="multipart/form-data">
						<tbody>
                                                    <tr>
                                                        <td>Pomen Type</td>
                                                        <td>
                                                            <select name="type_id">
                                                                <?php $types = getAllPomenTypes(); 
                                                                if(!is_null($types)){
                                                                    while($atype = $types->fetch(PDO::FETCH_ASSOC)){ 
                                                            if($atype['id'] == $pomen['pomen']){?>
                                                        <option value="<?php echo $atype['id']?>" selected><?php echo $atype['display']?></option>
                                                                <?php }else {?>
                                                        <option value="<?php echo $atype['id']?>" ><?php echo $atype['display']?></option>
                                                                <?php } } }?>
                                                            </select></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Service Name</td>
                                                        <td><input type="text" name="name"></td>
                                                    </tr>                                                    
                                                    <tr>
                                                        <td>Detail/Description</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <textarea name="detail" class="form-control" rows="5" id="comment"></textarea>
                                                            </div>
                                                    </tr>
                                                    <tr>
                                                        <td>image</td>
                                                        <td>                                                        
                                                            <div class="holderi">
                                                                <img id="blah" src="../images/userImages/pngegg.png" alt="pic" />
                                                            </div>
                                                            <input type='file' name="uploadfile" onchange="readURL(this);" />
                                                            <input type="hidden" name="user_id2" value="<?php echo $user['id']; ?>">
                                                            <div class="form-group">
                                                                <button class="btn btn-primary" type="submit" name="uploadimg">Save Service</button>
                                                            </div>
                                                        </td>
                                                    </tr>
						</tbody>
                                            </form>
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