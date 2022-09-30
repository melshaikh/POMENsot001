<?php
if(isset($_POST['selectionnav']))
    if(isset ($_POST['user']))
        header("Location: user_register.php");
    elseif (isset($_POST['pomen']))
        header("Location: pomen_register.php");