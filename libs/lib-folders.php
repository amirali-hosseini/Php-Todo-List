<?php

defined('BASE_PATH') or die('Permission Denied !');

function getFolders()
{
    global $pdo;
    $uid = getUserId();
    $query = $pdo->prepare("SELECT * FROM `folders` WHERE `uid` = :uid");
    $query->bindParam(':uid', $uid);
    $query->execute();
    return $folders = $query->fetchAll(PDO::FETCH_OBJ);
}

function removeFolder($dfid)
{
    global $pdo;
    $query = $pdo->prepare("DELETE FROM `folders` WHERE `id` = :id");
    if ($query->execute([':id' => $dfid])) {
        return $query->rowCount();
    }
}

function addFolder($folderName)
{
    global $pdo;
    $uid = getUserId();
    $query = $pdo->prepare("INSERT INTO `folders` (`uid`,`name`) VALUES (:uid,:folderName)");
    if ($query->execute([':uid' => $uid, ':folderName' => $folderName])) {
        echo $query->rowCount() . " " . "Folder was Created.";
    }
}