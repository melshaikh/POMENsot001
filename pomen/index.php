<?php include '../api/headl.inc.php';if(isUserLoggedIn() > 0){if(getUser()['type'] = 1){  $pomen = getUser(); $service=Service_info();?><!DOCTYPE html>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Pome Dashboard">
    <meta name="keywords" content="Pome Dashboard">
    <meta name="author" content="Mohamed Elshaikh">
    <title>Pomen Dashboard</title>
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
error_reporting(0);
 
$msg = "";
 
// If upload button is clicked ...
if (isset($_POST['upload'])) {
    include '../api/config.php';
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $file_type=$_FILES['uploadfile']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['uploadfile']['name'])));
    $newFileName = 'p'.$pomen['id'].'.'.$file_ext;
    $folder = "../images/userImages/" .$newFileName;
    if (move_uploaded_file($tempname, $folder)) {
        $sqll = "UPDATE `user` SET `image` = '".$newFileName."' WHERE `user`.`id` = ".$pomen['id'].";";
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


    <?php include 'prints.php';    printSide('index') ?>

    <div class="app-content content">
        <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
          <div class="content-body">
            <div class="row">
                    <div class="col-12">
                            <div class="card">
                                    <div class="card-header">
                                            <h4 class="card-title">Welcome <?php echo $pomen['name']; ?></h4>
                                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>				
                                    </div>
                                    <div class="card-content collapse show">
                                            <div class="table-responsive">
                                            <table class="table">
                                                    <tbody>                                                     
                                                                <tr id="lg-1">
                                                                <td class="tl-1"> <div align="left" id="tb-name">id:</div> </td>
                                                                <td class="tl-4"><?php echo $pomen['id']; ?></td>
                                                                </tr>
                                                                <tr id="lg-1">
                                                                <td class="tl-1"><div align="left" id="tb-name">Username:</div></td>
                                                                <td class="tl-4"><?php echo $pomen['name']; ?></td>
                                                                </tr>
                                                                <tr id="lg-1">
                                                                <td class="tl-1"><div align="left" id="tb-name">image:</div></td>
                                                                <td class="tl-4"><?php echo "<img width='40' height='60' src=".'../images/userImages/'.$pomen['image']."  ;>";?>  </td>
                                                                <td>
                                                                    <form method="POST" action="" enctype="multipart/form-data">
                                                                        <div class="holderi">
                                                                            <img id="blah" src="../images/userImages/<?php echo $pomen['image']; ?>" alt="pic" />
                                                                        </div>
                                                                        <input type='file' name="uploadfile" onchange="readURL(this);" />
                                                                        <div class="form-group">
                                                                            <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                </tr>
                                                                <tr id="lg-1">
                                                                <td class="tl-1"><div align="left" id="tb-name">address:</div></td>
                                                                <td class="tl-4"><?php echo $pomen['address']; ?></td>
                                                                </tr>
                                                                    <tr id="lg-1">
                                                                <td class="tl-1"><div align="left" id="tb-name">service type:</div></td>
                                                                <td class="tl-4"><?php echo $service['service_type']; ?></td>
                                                                </tr>
                                                                        <tr id="lg-1">
                                                                <td class="tl-1"><div align="left" id="tb-name">service_name:</div></td>
                                                                <td class="tl-4"><?php echo $service['service_name']; ?></td>
                                                                </tr>
                                                                        <tr id="lg-1">
                                                                <td class="tl-1"><div align="left" id="tb-name">description:</div></td>
                                                                <td class="tl-4"><?php echo $service['service_description']; ?></td>
                                                                </tr>
                                                    </tbody>                                
                                            </table>
                                    </div>
                            </div>
                    </div>
            </div>
            <!-- Table head options end -->

                    </div>
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