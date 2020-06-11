<?php

  $dsn = "mysql:host=localhost;port=3306;dbname=feedback;charset=utf8";

  $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
  ];

  $pdo = new PDO($dsn, 'root', '1111', $options);
  $stmt = $pdo->query("SELECT * FROM {$table}");
  $result = $stmt->fetchAll();
