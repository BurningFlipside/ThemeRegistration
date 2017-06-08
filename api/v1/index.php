<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('Autoload.php');
require('class.RegistrationAPI.php');

$site = new \Http\WebSite();
$site->registerAPI('/themes', new RegistrationAPI());
$site->run();
/* vim: set tabstop=4 shiftwidth=4 expandtab: */
