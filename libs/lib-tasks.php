<?php

// 1 _ 0 or die();
defined('BASE_PATH') or die('Permission Denied !');

function getTasks()
{
    global $pdo;
    $fid = $_GET['fid'] ?? null;

    if (isset($fid) && is_numeric($fid)) {
        $fidCondition = "AND `fid` = $fid";
    } else {
        $fidCondition = "";
    }
    $uid = getUserId();
    $query = $pdo->prepare("SELECT * FROM `tasks` WHERE `uid` = :uid $fidCondition ORDER BY `id` DESC");
    $query->bindParam(':uid', $uid);
    $query->execute();
    return $tasks = $query->fetchAll(PDO::FETCH_OBJ);
}

function removeTask($dtid)
{
    global $pdo;
    $query = $pdo->prepare("DELETE FROM `tasks` WHERE `id` = :id");
    $query->execute([':id' => $dtid]);
    return $query->rowCount();
}

function addTask($title, $fid)
{
    global $pdo;
    $uid = getUserId();
    $query = $pdo->prepare("INSERT INTO `tasks` (`uid`, `fid` ,`title`) VALUES (:uid , :fid ,:title)");
    $query->execute([':uid' => $uid, ':fid' => $fid, ':title' => $title]);
    echo $query->rowCount() . " " . "Task was Created.";
}

function doneSwitch($tId)
{
    global $pdo;
    $uid = getUserId();
    $query = $pdo->prepare("UPDATE `tasks` SET `is_done` = 1 - `is_done` WHERE `id` = :tId AND `uid` = :uid");
    $query->execute([':tId' => $tId, ':uid' => $uid]);
    return $query->rowCount();
}