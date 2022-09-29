<?php session_start();
include 'config.php';
function isLecturerLoggedIn()
{
    require 'configdbo.php';
    $sessionID = session_id();
    $expr = time()+(60*15);
    $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);
    $stmt = $db->prepare('SELECT * FROM `omr_active_lecturer` WHERE `session_id` = :sesid '
            . 'AND `hash` = :hash AND `level` = "staff" LIMIT 1');
    $ret = $stmt->execute(array('sesid' => $sessionID,'hash'=>$hash));
    if($u=$stmt->fetch())
    {
      $stmtx = $db->prepare('UPDATE`omr_active_lecturer` SET expires = :exp WHERE `id` = :uid ');
           $stmtx->execute(['uid' =>$u['id'], 'exp'=>$expr]);
                   return $u['user'];
       
    }else{
        return false;
    }
}
function doLoginAdminSession($admin)
{
include 'configdbo.php';
    $stmt = $db->prepare('SELECT id FROM `omr_active_lecturer` WHERE user= :user AND level= "admin" LIMIT 1 ');
    $stmt->execute(['user' => $admin['id']]);
    $ll = $stmt->fetch(PDO::FETCH_ASSOC);
    $uexp = time()+(60*20);
    $sesid = session_id();
    $uhas = hash("sha512",$sesid.$_SERVER['HTTP_USER_AGENT']);
    if($ll)//already in active
    {
        $actstat = $db->prepare('UPDATE omr_active_lecturer SET user = :user, session_id = :sesid, '
        . 'hash = :uhash, expires = :uexp WHERE id  = :sid');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp,'sid'=>$ll['user']]);
    }else{
       $actstat = $db->prepare('INSERT INTO omr_active_lecturer (id, user, session_id, hash, expires, level) '
        . 'VALUES (NULL, :user, :sesid, :uhash, :uexp, "admin")');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp]); 
    }
}
function doLoginLecturerSession($admin)
{
    
    include 'configdbo.php';
    $ll = isLecturerLoggedIn();
    //$stmt = $db->prepare('SELECT id FROM `omr_active_lecturer` WHERE user= :user AND level = "staff" LIMIT 1 ');
    //$stmt->execute(['user' => $admin['id']]);
    //$ll = $stmt->fetch(PDO::FETCH_ASSOC);
    $uexp = time()+(60*20);
    $sesid = session_id();
    $uhas = hash("sha512",$sesid.$_SERVER['HTTP_USER_AGENT']);
    if($ll)//already in active
    {
        $actstat = $db->prepare('UPDATE omr_active_lecturer SET user = :user, session_id = :sesid, '
        . 'hash = :uhash, expires = :uexp WHERE id  = :sid AND level = "staff"');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp,'sid'=>$ll['user']]);
    }else{
       $actstat = $db->prepare('INSERT INTO omr_active_lecturer (id, user, level, session_id, hash, expires) '
        . 'VALUES (NULL, :user, "staff" ,:sesid, :uhash, :uexp)');
        $actstat->execute(['user' => $admin['id'],'sesid'=>$sesid,'uhash'=>$uhas,'uexp'=>$uexp]); 
    }
}
function getUser()
{
    include 'config.php';
    $sql = "SELECT * FROM `user` WHERE `id` = '". isUserLoggedIn()."' LIMIT 1";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
    //$query = $db->query($sql);
    //echo $sql;
    $nr = $stmt->rowCount();
    if($nr  > 0)
    {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
          return $data;    
    }else return NULL;   
}
function getUserByID($sid)
{
    include 'config.php';
    $sql = "SELECT * FROM `user` WHERE `id` = '". $sid."' LIMIT 1";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {
        $data = $query->fetch(PDO::FETCH_ASSOC);
          return $data;    
    }return NULL;   
}
function getUserTypeByTypeId($tid)
{
    include 'config.php';
    $sql = "SELECT * FROM `user_types` WHERE `id` = '". $tid."' LIMIT 1";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {
        $data = $query->fetch(PDO::FETCH_ASSOC);
          return $data;    
    }return NULL; 
}
function getAllUsers()
{
    include 'config.php';
    $sql = "SELECT * FROM `user` WHERE  1";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {       
          return $query;    
    }return NULL; 
}
function logougt()
{
    $crnt = getUser();
    if(!is_null($crnt))
    {
    include 'config.php';
    $sql = "DELETE FROM `active_users` WHERE `active_users`.`user` = ".$crnt['id'];
    $stmt2 = $dbo->prepare($sql);
    $stmt2->execute();
    }
}
function isUserLoggedIn()
{
    include 'config.php';
    $sessionID = session_id();//mysqli_real_escape_string();
    $hash = hash("sha512",$sessionID.$_SERVER['HTTP_USER_AGENT']);//mysqli_real_escape_string();
    $sql = "SELECT * FROM `active_users` WHERE `session_id` = '".$sessionID."' AND `hash` ='".$hash."' AND `expires` > ".time()." LIMIT 1";
    $stmt2 = $dbo->prepare($sql);
    $stmt2->execute(); 
    $nr = $stmt2->rowCount();
    if($nr  > 0)
        {      
        $data = $stmt2->fetch(PDO::FETCH_ASSOC);//$data['user'];
        $expires = time()+(60*60);
        $new_sql = "UPDATE `active_users` SET `"
        . "session_id` = '".$sessionID."' , `hash` = '".$hash."', `expires` = '".$expires."' WHERE `active_users`.`user` = ".$data['user'];
        $stmt = $dbo->prepare($new_sql);
        $stmt->execute(); 
        return $data['user'];
        }
        else
        {
            return 0;
        }
} 

function service_info()
{
    include 'config.php';
    $sql = "SELECT * FROM `service_info` WHERE `user_id` = '". isUserLoggedIn()."' LIMIT 1";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
    //$query = $db->query($sql);
    //echo $sql;
    $nr = $stmt->rowCount();
    if($nr  > 0)
    {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
          return $data;    
    }else return NULL;
}
function getAllUsersTypes()
{
   include 'config.php';
    $sql = "SELECT * FROM `user_types` WHERE  1";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {       
          return $query;    
    }return NULL;  
}
function getAllServices(){
    include 'config.php';
    $sql = "SELECT * FROM `services_list` WHERE  1";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {       
          return $query;    
    }return NULL; 
}
function getPomenTypeforServiceId($ptID)
{
    include 'config.php';
    $sql = "SELECT * FROM `poment_type` WHERE `id` = '". $ptID."' LIMIT 1";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
    //$query = $db->query($sql);
    //echo $sql;
    $nr = $stmt->rowCount();
    if($nr  > 0)
    {
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
          return $data;    
    }else return NULL;
}
function getAllPomenTypes()
{
   include 'config.php';
    $sql = "SELECT * FROM `poment_type` WHERE  1";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {       
          return $query;    
    }return NULL;  
}
function getServiceDetailByID($del_serv_id)
{
    include 'config.php';
    $sql = "SELECT * FROM `services_list` WHERE  `id` = '".$del_serv_id."'";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
    $nr = $stmt->rowCount();
    if($nr  > 0)
    {       
          $data = $stmt->fetch(PDO::FETCH_ASSOC);
          return $data; 
    }return NULL; 
}
function delServiceByID($sid)
{
    include 'config.php';
    $sql = "DELETE FROM `services_list` WHERE `services_list`.`id` = ".$sid;
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
}
function delServiceFromPomenList($serv_id,$pomen_id)
{
    include 'config.php';
    $sql = "DELETE FROM `pomen_to_service` WHERE `service_id` = '".$serv_id."' AND `pomen_id` = '".$pomen_id."'";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
}
function getServicesByUserID($userid)
{
    include 'config.php';
    $sql = "SELECT s.* FROM `services_list` AS s INNER JOIN `pomen_to_service` AS p WHERE  p.`pomen_id` = '".$userid."' AND p.`service_id` = s.`id`";
    $query = $dbo->prepare($sql);
    $query->execute();
    $nr = $query->rowCount();
    if($nr  > 0)
    {       
          return $query;    
    }return NULL;  
}
function getServiceListByPomenType($ptid)
{
    include 'config.php';
    $sql = "SELECT * FROM `services_list` WHERE  `pomen_type_id` = '".$ptid."'";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
    $nr = $stmt->rowCount();
    if($nr  > 0)
    {     
          return $stmt; 
    }return NULL;
}
function getPomenTypeByUserID($pomenID)
{
  include 'config.php';
    $sql = "SELECT pt.* FROM poment_type AS pt INNER JOIN user AS u WHERE  u.id = '".$pomenID."' AND `pt`.id = u.pomen";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();
    $nr = $stmt->rowCount();
    if($nr  > 0)
    {       
          $data = $stmt->fetch(PDO::FETCH_ASSOC);
          return $data; 
    }return NULL;   
}
function setPomentTypetoUser($userID,$pomenTypeID)
{
  include 'config.php';
    $sql = "UPDATE `user` SET `pomen` = '".$pomenTypeID."' WHERE `id`= '".$userID."'";
    $stmt = $dbo->prepare($sql);
    $stmt->execute();  
}

