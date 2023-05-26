<?php

$dsn = 'mysql_connection';
$user = 'root';
$password = '';

$connection = odbc_connect($dsn, $user, $password);

if ($connection) {
  return $connection;
} else {
  echo 'Falha na conexão.';
  return null;
}
