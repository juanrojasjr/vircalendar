<?php

$config = include 'core/config.php';

try {
  $conexion = new PDO($config['db']['start'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);
  $sql = file_get_contents("core/sqlDataBase.sql");

  $conexion->exec($sql);

  echo "La base de datos y las tablas necesarias han sido creadas con éxito.";
} catch(PDOException $error) {
  echo $error->getMessage();
}