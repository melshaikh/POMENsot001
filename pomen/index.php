<?php include '../api/headl.inc.php';if(isUserLoggedIn() > 0){if(getUser()['type'] = 1){  $pomen = getUser(); $service=Service_info();?><!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="IoT Farm Dashboard">
    <meta name="keywords" content="IoT Farm Dashboard">
    <meta name="author" content="Mohamed Elshaikh">
    <title>pomen page</title>
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

 

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div id="center">
<div id="center-set">
<h1 align='center'>Welcome <?php echo $pomen['name']; ?>
    </h1>
    <h1>    You are now logged in.
</h1>
    </div>
<div id="contentbox">
<div id="signup">
<div id="signup-st">
<form action="" method="POST" id="signin" id="reg">
<div id="reg-head" class="headrg"><h1>your profile</h1></div>
<table border="0" align="center" cellpadding="2" cellspacing="0">
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
<td class="tl-4"><?php echo "<img width='40' height='60' src=".'../images/'.$pomen['image']."  ;>";?>  </td>
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
</table>

</form>
</div>
</div>


</div>
</div>
</body>
</html>
<?php
}else {echo isUserLoggedIn()."<br>";
        echo '<form action="../index.php" method="get">
          <input type="hidden" name="err" value="Please Login"/>
          <input type="submit" name="login" value="Please Login1"/>
      </form>'; } }else {echo isUserLoggedIn()."<br>";
     echo '<form action="../index.php" method="get">
          <input type="hidden" name="err" value="Please Login"/>
          <input type="submit" name="login" value="Please Login2"/>
      </form>';    
} 
?>