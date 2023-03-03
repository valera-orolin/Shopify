<?php
setcookie("id", "", time()+60*60*24*30, "/");
setcookie("hash", "", time()+60*60*24*30, "/", null, null, true);
header('location: ' . $_SERVER['HTTP_REFERER']);