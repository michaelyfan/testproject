<?php

/**
  * Initializes the database
  *
  */

require "config.php";

try {
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = file_get_contents("data/init.sql");
  $connection->exec($sql);

  echo "Database and table users created successfully.";
} catch(PDOException $error) {
  echo $error->getMessage();
}