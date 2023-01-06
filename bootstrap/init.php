<?php

session_start();
ini_set('display_errors', true);

require_once('constants.php');

require_once(BASE_PATH . 'libs/helpers.php');
require_once(BASE_PATH . 'libs/lib-auth.php');
require_once(BASE_PATH . 'libs/lib-folders.php');
require_once(BASE_PATH . 'libs/lib-tasks.php');
require_once(BASE_PATH . 'libs/lib-users.php');
require_once(BASE_PATH . 'config/config.php');
require_once(BASE_PATH . 'vendor/autoload.php');

try {
    $pdo = new PDO("mysql:host={$dbInfo->host};dbname={$dbInfo->dbname}", $dbInfo->user, $dbInfo->pass);
} catch (Exception $exception) {
    diePage("Connection Failed : " . $exception->getMessage());
}