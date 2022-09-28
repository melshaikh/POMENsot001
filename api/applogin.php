<?php
if(isset($_GET['app_id']))
{
    if($_GET['app_id'] == 1){
        $pwd = hash("sha512",$_GET['pwd']);
    include 'config.php';
    $sql = "SELECT a.`id`,a.`name`,a.`email`,a.`image`,a.`location`,a.`address`,a.`pomen`,a.`level`,a.`type`  FROM `user` AS a "
            . "WHERE a.email = '".$_GET['email']."' AND a.password = '".$pwd."' LIMIT 1;";
     $stmt = $dbo->prepare($sql);
            $stmt->execute();           
            $data = [];
            if($stmt->rowCount() > 0)
            {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);          
                $data[] = $row;
                $response         = [];
                $response['data'] =  $data;
                echo json_encode($response, JSON_PRETTY_PRINT);
            }else echo 'nsll';
    }else echo 'nsll';           
}else echo 'nsll';
