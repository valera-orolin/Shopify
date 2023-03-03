<?php
require 'vendor/mustache/mustache/src/Mustache/Autoloader.php';
include 'database.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/templates') 
));

$name;
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
    $user = $db->query("SELECT * FROM `users` WHERE id='".intval($_COOKIE['id'])."'");
    if (($user[0]['hash'] !== $_COOKIE['hash']) or ($user[0]['id'] !== $_COOKIE['id'])) {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true);
        $name = null;
    } else {
        $name = $user[0]['login'];
    }
} else {
        $name = null;
}
if ($name !== null) {
    $header = $mustache->loadTemplate('header_name');
    echo $header->render(array ( 'name' => $name ));
} else {
     $header = $mustache->loadTemplate('header');
    echo $header->render();
}

$slot = $mustache->loadTemplate('slot');
$footer = $mustache->loadTemplate('footer');

$slots = $db->query("SELECT * FROM `coats`");

for ($i = 0; $i < count($slots); $i++) {
    echo $slot->render($slots[$i]);
}
echo $footer->render();