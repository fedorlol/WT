<?php

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'cache'       => 'compilation_cache',
    'auto_reload' => true
));

$dsn = "mysql:host=localhost;port=3306;dbname=feedback;charset=utf8";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
];

$pdo = new PDO($dsn, 'root', '1111', $options);
$stmt = $pdo->query("SELECT * FROM feedbacks");

$results=$stmt->fetchAll();



echo $twig->render("FBcs.html.twig",['results'=>$results]);
