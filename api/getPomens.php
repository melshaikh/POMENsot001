<?php
if(isset($_GET['app_id']))
{
    include 'config.php';
    $sql = "SELECT `id`,`name`,`email`,`image`,`location`,`address`  FROM `user` "
            . "WHERE `pomen` = ".$_GET['ptype']." ;";
     $stmt = $dbo->prepare($sql);
            $stmt->execute();           
            $data = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {          
                 $data[] = $row;  
            } 
           $response         = [];
           $response['data'] =  $data;
           echo json_encode($response, JSON_PRETTY_PRINT);           
    }else echo 'ER2';
