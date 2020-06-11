<?php

$feedback=array();

    $feedback["Email"]=htmlentities($_POST["eMail"]);
    $feedback["Quality"]=$_POST["quality"];
    $feedback["Opinion"]=htmlentities($_POST["feedbacktext"]);

    $regexpr='/[a-z]+:\/\/(?!bsuir\.by)\S+/';
    $feedback["Opinion"] = preg_replace($regexpr, "#Внешние ссылки запрещены#", $feedback["Opinion"]);

    $table = "feedbacks";
    $values_to_insert = [$feedback["Email"], $feedback["Quality"], $feedback["Opinion"]];
    include 'pdoInsert.php';

    require_once 'vendor/autoload.php';
    Twig_Autoloader::register();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader, array(
        'cache' => 'compilation_cache',
        'auto_reload' => true
    ));

    $text = "Спасибо за ваш отзыв!";
    $link = $_SERVER["HTTP_REFERER"];
    echo $twig->render('AfterForm.html', ['text'=>$text, 'link'=>$link]);
