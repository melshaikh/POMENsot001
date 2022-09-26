<?php include '../api/headl.inc.php';if(isUserLoggedIn() > 0){if(getUser()['type'] = 1){$school_id = 1; $admino = getUser();?><!DOCTYPE html>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="IoT Farm Dashboard">
    <meta name="keywords" content="IoT Farm Dashboard">
    <meta name="author" content="Mohamed Elshaikh">
    <title>IoT Farm Dashboard</title>
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
            <div class="row">
                    <div class="col-12">
                            <div class="card">
                                    <div class="card-header">
                                            <h4 class="card-title">Sensors List</h4>
                                            <form action="sensor_add.php" method="POST">
                                                    <input type="hidden" name="file_id" value="12">
                                                    <input type="submit" class="btn btn-amber" name="del_file" value="Add Sensor">
                                                </form>
                                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>				
                                    </div>
                                    <div class="card-content collapse show">
                                            <div class="table-responsive">
                                                    <table class="table">
                                                            <thead class="thead-dark">
                                                                    <tr>
                                                                            <th scope="col">[User ID]</th>
                                                                            <th scope="col">pic.</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">E-mail</th>
                                                                            <th scope="col">Type</th>
                                                                            <th scope="col">Show</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $sensor_list = getAllUsers(); 
                                                                if(!is_null($sensor_list)){
                                                                    while($sens = $sensor_list->fetch(PDO::FETCH_ASSOC)){ 
                                                                        $ut = getUserTypeByTypeId($sens['type']); ?>
                                                                    <tr>
                                                                            <th scope="row"><?php echo $sens['id']; ?></th>
                                                                            <td><span class="avatar">
                                                                                    <img src="../images/userImages/<?php echo $sens['image']; ?>" alt="avatar">
                                                                                </span></td>
                                                                            <td><?php echo $sens['name']; ?></td>
                                                                            <td><?php echo $sens['email']; ?></td>
                                                                            <td><?php echo $ut['disply']; ?></td>
                                                                                    <td>
                                                                                        <form action="auser.php">
                                                                                            <input type="hidden" name="user_id" value="<?php echo $sens['id']; ?>">
                                                                                            <input type="submit" class="btn btn-cyan" name="showSensor" value="Disply">
                                                                                        </form>
                                                                                    </td>
                                                                    </tr>
                                                                <?php } } ?>
                                                            </tbody>
                                                    </table>
                                            </div>
                                    </div>
                            </div>
                    </div>
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