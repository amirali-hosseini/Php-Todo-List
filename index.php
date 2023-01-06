<?php

require_once('./bootstrap/init.php');

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    logout();
}

if (!isLoggedIn()) {
    header('Location: ' . siteUrl('auth.php'));
    die();
}

$uid = getUserId();
$fid = $_GET['fid'] ?? null;

if (isset($_GET['dfid']) && is_numeric($_GET['dfid'])) {
    $dfid = $_GET['dfid'];
    $rowCount = removeFolder($dfid);
    // echo $rowCount;
}

if (isset($_GET['dtid']) && is_numeric($_GET['dtid'])) {
    $dtid = $_GET['dtid'];
    $rowCount = removeTask($dtid);
    // echo $rowCount;
}

$folders = getFolders();

if (!$folders) {
    $folders = "<p class='text-danger m-1'>you haven't any folders !</p>";
}

$tasks = getTasks();

$userInfo = getUserInfo();

require_once('./tpl/tpl-index.php');