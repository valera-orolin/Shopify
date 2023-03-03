<?php
include 'database.php';

function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

$login = $_POST['login'];
$password = $_POST['password'];
$user = $db->query("SELECT * FROM `users` WHERE login='$login'");
if ((count($user) > 0) && ($user[0]['password'] === md5(md5($password)))) {

    $hash = md5(generateCode(10));

    $id = $user[0]['id'];
    $db->execute("UPDATE `users` SET hash='$hash' WHERE id='$id'");
    setcookie("id", $id, time()+60*60*24*30, "/");
    setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);

}
header('location: ' . $_SERVER['HTTP_REFERER']);