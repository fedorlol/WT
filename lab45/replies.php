<?php
require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache'       => 'compilation_cache',
    'auto_reload' => true
));

$table = "reviews";
include 'pdoGet.php';
$res_reviews = $result;

echo $twig->render('replies.html', ['res_reviews'=>$res_reviews]);
