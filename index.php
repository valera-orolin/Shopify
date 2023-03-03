<?php
use LDAP\Result;
require 'vendor/mustache/mustache/src/Mustache/Autoloader.php';
include 'check.php';
Mustache_Autoloader::register();

$mustache = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates')
));

$name = checkUser();
if ($name !== null) {
    $header = $mustache->loadTemplate('header_name');
    echo $header->render(array ( 'name' => $name ));
} else {
    $header = $mustache->loadTemplate('header');
    echo $header->render();
}
$base = $mustache->loadTemplate('base_index');
$footer = $mustache->loadTemplate('footer');

echo $base->render();
echo $footer->render();
