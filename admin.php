<?php
use LDAP\Result;
require 'vendor/mustache/mustache/src/Mustache/Autoloader.php';
include 'check.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
));

$name = checkUser();
if ($name === 'admin') {
    $header = $mustache->loadTemplate('header_name');
    echo $header->render(array ( 'name' => $name ));
} else {
    //header('location: ' . $_SERVER['HTTP_REFERER']);    // todo страница 403
    header('HTTP/1.0 403 Forbidden');
    exit;
}
$base = $mustache->loadTemplate('admin');

echo $base->render();
