<?php
ini_set('display_errors', true);
require_once('../bootstrap/init.php');

if (!isAjaxRequest()) {
    diePage('Invalid Request !');
}

if (empty($_POST['action'])) {
    diePage('Invalid Action !');
}

$action = $_POST['action'];

switch ($action) {
    case 'addFolder':
        $folderName = $_POST['folderName'];
        addFolder($folderName);
        break;

    case 'addTask':
        if (($_POST['fid'])) {
            if (!empty($_POST['taskTitle'])) {

                $fid = $_POST['fid'];
                $taskTitle = $_POST['taskTitle'];

                addTask($taskTitle, $fid);
            } else {
                echo "Please Enter A Title For Task !";
                die();
            }
        } else {
            echo "Please Select A Folder First !";
            die();
        }
        break;

    case 'doneSwitch':
        if (isset($_POST['taskId']) && is_numeric($_POST['taskId'])) {
            $tId = $_POST['taskId'];
            doneSwitch($tId);
        }
        break;

    default:
        diePage('Invalid Action !');
        break;
}