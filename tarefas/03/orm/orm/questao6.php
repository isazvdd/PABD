<?php


// Criando conexão com o database e colocando na variavel pdo
$pdo = require('app/config/connection.php');

// Função que calcula tempo que a consulta demora pra retornar
function calculateExecutionTime($pdo, $query)
{
    $start = microtime(true);

    // Realiza a consulta
    $pdo->query($query);

    $end = microtime(true);
    $executionTime = $end - $start;

    return $executionTime;
}

//Consula que retorna o tempo de resposta da consulta
$query = "SELECT * FROM funcionario JOIN departamento ON funcionario.depto = departamento.codigo";
$executionTime = calculateExecutionTime($pdo, $query);

//Criando documento log com as informações da consulta
$logQuery = "INSERT INTO log (query, execution_time) VALUES (?, ?)";
$logStatement = $pdo->prepare($logQuery);
$logStatement->execute([$query, $executionTime]);

//Finalizar conexão com o banco
$pdo = null;
?>
