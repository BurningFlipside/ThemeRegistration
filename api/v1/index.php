<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(file_exists(__DIR__ . '/vendor/autoload.php'))
{
    require(__DIR__ . '/vendor/autoload.php');
}
else if(file_exists(__DIR__ . '/../../../../common/Autoload.php'))
{
    require(__DIR__ . '/../../../../common/Autoload.php');
}
require('class.RegistrationAPI.php');

$site = new \Flipside\Http\WebSite();
$site->registerAPI('/themes', new RegistrationAPI());
$site->run();
/* vim: set tabstop=4 shiftwidth=4 expandtab: */
