<!DOCTYPE html>
<html>
<body>


<p id="dump"><?php 
//var_dump($_GET);

?></p>

<script>
    getLocation();
var x = document.getElementById("dump");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
 // x.innerHTML = "Latitude: " + position.coords.latitude + 
 // "<br>Longitude: " + position.coords.longitude;
<?php 
    if($_GET['chos']==1)
        {
        echo "window.location = 'pomen/update_profile.php?Latitude='+position.coords.latitude+'&Longitude='+position.coords.longitude;";
        }
    else if($_GET['chos']==2)
        {
        echo "window.location = 'pomen/update_profile.php?Latitude='+position.coords.latitude+'&Longitude='+position.coords.longitude;";
        }
 ?>
}
  //fetch('location.php?lan='+position.coords.longitude+'&lat='+position.coords.latitude).then;
    

    

</script>


  
    </body>
</html>


    
