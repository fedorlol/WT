<?php

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

  $stmt = $pdo->prepare("INSERT INTO {$table} VALUES(?, ?, ?)");
  $stmt->execute($values_to_insert);
