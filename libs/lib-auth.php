<?php

defined('BASE_PATH') or die('Permission Denied !');

function isLoggedIn()
{
    return isset($_SESSION['isLoggedIn']);
}

function CheckingUsername($username)
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $query->execute([':username' => $username]);
    return $query->rowCount();
}

function register($params)
{
    global $pdo;
    if (isset($params['username']) && isset($params['email']) && isset($params['password'])) {
        $username = $params['username'];
        $email = $params['email'];
        $password = password_hash($params['password'], PASSWORD_BCRYPT);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $query = $pdo->prepare("INSERT INTO `users` (`username`,`email`,`password`) VALUES (:username , :email , :password)");
            if ($query->execute([':username' => $username, ':email' => $email, ':password' => $password])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getUserByUsername($username)
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $query->execute([':username' => $username]);
    $userInfo = $query->fetchAll(PDO::FETCH_OBJ);
    return $userInfo[0] ?? null;
}

function login($username, $password)
{
    $userInfo = getUserByUsername($username);

    if (is_null($userInfo)) {
        return false;
    }

    if (!password_verify($password, $userInfo->password)) {
        return false;
    }

    $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($userInfo->email)));

    $userInfo->profile = $grav_url;
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userInfo'] = $userInfo;
    return true;
}

function getUserInfo()
{
    $userInfo = $_SESSION['userInfo'];
    return $userInfo ?? null;
}

function getUserId()
{
    $userInfo = $_SESSION['userInfo'];
    return $userInfo->id ?? null;
}

function logout()
{
    session_destroy();
    header("Location: /auth.php");
}