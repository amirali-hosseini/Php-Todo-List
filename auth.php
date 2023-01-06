<?php

require_once('./bootstrap/init.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $params = $_POST;
        if ($action == 'register') {
            $CheckingUsername = CheckingUsername($params['username']);
            if (!$CheckingUsername) {
                $register = register($params);
                if ($register) {
                    $msg['msg'] = "Successfully Registered ! Please Login Now.";
                    $msg['color'] = "success";

                } else {
                    $msg['msg'] = "Error : There Is a Problem With Registration.";
                    $msg['color'] = "danger";
                }
            } else {
                $msg['msg'] = "Error : Your Username Is Not Allowed.";
                $msg['color'] = "danger";
            }
        } elseif ($action == 'login') {
            $login = login($params['username'], $params['password']);

            if ($login) {
                header('Location: /index.php');
                die();
            } else {
                $msg['msg'] = "Error : Username Or Password Is Incorrect !";
                $msg['color'] = "danger";
            }
        }

    }
}

require_once('./tpl/tpl-auth.php');

?>