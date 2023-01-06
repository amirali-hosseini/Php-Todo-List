<?php

defined('BASE_PATH') or die('Permission Denied !');

function diePage($msg)
{
    die("<div class='alert alert-danger m-3 p-4'>" . $msg . "</div>");
}

function isAjaxRequest()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        return true;
    }

    return false;
}

function siteUrl(string $uri = '')
{
    return BASE_URL . $uri;
}

function errMsg($Msg)
{
    echo "<div class='alert alert-danger m-3 p-4'>" . $Msg . "</div>";
}