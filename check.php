<?php
function checkUser() {
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        include 'database.php';
        $user = $db->query("SELECT * FROM `users` WHERE id='".intval($_COOKIE['id'])."'");
        if (($user[0]['hash'] !== $_COOKIE['hash']) or ($user[0]['id'] !== $_COOKIE['id'])) {
            setcookie("id", "", time() - 3600*24*30*12, "/");
            setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true);
            return null;
        } else {
            return $user[0]['login'];
        }
    } else {
        return null;
    }
}
?>