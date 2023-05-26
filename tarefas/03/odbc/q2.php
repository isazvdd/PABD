<?php

include('connection.php');

$projetoCodigo = 2;

$query = "SELECT a.codigo, a.descricao, a.dataInicio, a.dataFim, a.situacao, a.dataConclusao
          FROM atividade a
          INNER JOIN atividade_projeto ap ON a.codigo = ap.codAtividade
          WHERE ap.codProjeto = ?";

$statement = odbc_prepare($connection, $query);

$result = odbc_execute($statement, array($projetoCodigo));

if ($result) {
  while ($row = odbc_fetch_array($statement)) {
    echo "{$row['descricao']}\n";
  }
} else {
  echo "Erro na consulta: " . odbc_errormsg($connection);
}

odbc_close($connection);
