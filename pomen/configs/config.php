<?php
$db = mysqli_connect("localhost","root","","4178737_pomendb01");
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');}

?>

