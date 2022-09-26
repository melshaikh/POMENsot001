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
                                <form action="service_add.php" method="POST">
                                        <input type="hidden" name="file_id" value="12">
                                        <input type="submit" class="btn btn-amber" name="del_file" value="Add Service">
                                    </form>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <?php if(isset($_POST['del_serv_id'])){ $del_serv = getServiceDetailByID($_POST['del_serv_id']); ?>
                                <h1 class="text-danger">ARE YOU SURE WONTO DELETE (<?php echo $del_serv['name']; ?> SERVICE TYPE
                                <form action="services.php" method="POST">
                                        <input type="hidden" name="del_id" value="<?php echo $del_serv['id']; ?>">
                                        <input type="submit" class="btn btn-danger" name="del_file_yes" value="YES">
                                        <input type="submit" class="btn btn-green" name="del_file" value="No">
                                    </form>
                                </h1>
                                <?php } 
                                if(isset($_POST['del_file_yes']))
                                       delServiceByID($_POST['del_id']);                                        
                                        ?>
			</div>
			<div class="card-content collapse show">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th scope="col">[ID]</th>
								<th scope="col">Service Name.</th>
                                                                <th scope="col">Pomen Type</th>
								<th scope="col">Service Image</th>
                                                                <th scope="col">details</th>
                                                                <th scope="col">Edit</th>
                                                                <th scope="col">Delete</th>
							</tr>
						</thead>
						<tbody>
                                                    <?php $service_list = getAllServices(); 
                                                    if(!is_null($service_list)){
                                                        while($sens = $service_list->fetch(PDO::FETCH_ASSOC)){ 
                                                            $st = getPomenTypeforServiceId($sens['pomen_type_id']); ?>
							<tr>
								<td><?php echo $sens['id']; ?></td>
                                                                <td><?php echo $sens['name']; ?></td>
                                                                <td><?php echo $st['name']; ?></td>
                                                                <td><span class="avatar">
                                                                        <img src="../images/userImages/<?php echo $sens['image']; ?>" alt="avatar">
                                                                    </span>
                                                                </td>
								<td><?php echo $sens['details']; ?></td>
                                                                <td>
                                                                    <form action="aservice.php">
                                                                        <input type="hidden" name="user_id" value="<?php echo $sens['id']; ?>">
                                                                        <input type="submit" class="btn btn-cyan" name="showSensor" value="Disply">
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                    <form action="" method="POST">
                                                                        <input type="hidden" name="del_serv_id" value="<?php echo $sens['id']; ?>">
                                                                        <input type="submit" class="btn btn-danger" name="showSensor" value="DELETE">
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