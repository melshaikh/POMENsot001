<?php
if (isset($_POST['submitOK'])){
    include '../api/config.php';
    if ($_POST['pwd1'] === $_POST['pwd2']) {
        include '../api/headl.inc.php';
        $level = getAccessLevelByTypeID($_POST['type_id']);
        if ($level < 100 AND $level > 1) $isPomen = 1; else $isPomen = 0;
        $sql = "INSERT INTO `user` (`id`, `name`, `password`, `email`,"
                . " `image`, `type`, `location`,"
                . " `address`, `pomen`, `level`) "
                . "VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['pwd1'] . "', '" . $_POST['email'] . "',"
                . " '', '" . $_POST['type_id'] . "', '" . $_POST['location'] . "',"
                . " '" . $_POST['address'] . "', '" . $isPomen . "', '" . $level . "');";
        $query = $dbo->prepare($sql);
        if ($query->execute()) {
            header("location:user_add.php?err=ADD GOOD");
        }return NULL;
    } else {
        header("location:user_add.php?err='Password NOT MATCH");
    }
} else {
    header("location:user_add.php?err='UNKKNOWN ACTION");
}