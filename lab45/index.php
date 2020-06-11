<?php

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache'       => 'compilation_cache',
    'auto_reload' => true
));

$table = "features";
include 'pdoGet.php';
$res_features = $result;

$table = "team";
include 'pdoGet.php';
$res_team = $result;

echo $twig->render('FirstPage.html',['res_features'=>$res_features, 'res_team'=>$res_team]);
