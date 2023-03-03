<?php
include 'database.php';
$collection = $_POST['collection'];
$name = $_POST['name'];
$price = $_POST['price'];
$colors = $_POST['colors'];
$image = $_POST['image'];
if (isset($_POST['add'])) {
    if (!(empty($price) || empty($colors) || empty($image)) && (in_array($collection, array ('offers', 'jeans', 'acces', 'coats')))) {
        $slot= $db->query("SELECT * FROM `$collection` WHERE name='$name'");
        if (count($slot) == 0) {
            $db->execute("INSERT INTO `$collection` SET `name`='$name', `price`='$price', `colors`='$colors', `image`='$image'");
        }
    }
} elseif(isset($_POST['delete'])) {
    $db->execute("DELETE FROM `$collection` WHERE `name`='$name'");
}
header('location: ' . $_SERVER['HTTP_REFERER']);