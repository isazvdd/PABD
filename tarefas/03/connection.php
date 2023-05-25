<?php
$dsn = 'mysql_connection';
$user = 'root';
$password = '';

$conn = odbc_connect($dsn, $user, $password);


if ($conn) {
  echo 'Conexão estabelecida com sucesso!';
  // Faça suas operações no banco de dados aqui
  odbc_close($conn); // Feche a conexão quando terminar
} else {
  echo 'Falha ao estabelecer a conexão!';
}
