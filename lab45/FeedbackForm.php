<?php

    $feedback=array();


    $feedback["Email"]=htmlentities($_POST["eMail"]);
    $feedback["Quality"]=$_POST["quality"];
    $feedback["Opinion"]=htmlentities($_POST["feedbacktext"]);

    $text = "Номер заказа указан неверно, отзыв не отправлен.";


    $regexpr='/[a-z]+:\/\/(?!bsuir\.by)\S+/';
    $feedback["Opinion"] = preg_replace($regexpr, "#Внешние ссылки запрещены#", $feedback["Opinion"]);
  
    $dsn = "mysql:host=localhost;port=3306;dbname=feedback;charset=utf8";


    $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

    try {
          $pdo = new PDO($dsn, 'root', '1111', $options);
    } catch (PDOException $e) {
          die($e->getMessage());
    }
    $pdo->query("SET NAMES utf8");
    $pdo->query("SET CHARACTER SET utf8");
    $pdo->query("SET character_set_client = utf8");
    $pdo->query("SET character_set_connection = utf8");
    $pdo->query("SET character_set_results = utf8");

    $stmt = $pdo->prepare("INSERT INTO feedbacks(name, quality, opinion) VALUES(?, ?, ?)");
    $stmt->execute([$feedback["Email"], $feedback["Quality"], $feedback["Opinion"]]);

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
