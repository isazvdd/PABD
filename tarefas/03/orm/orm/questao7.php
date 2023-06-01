<?php

function createIndexes()
{
    $capsule = require('app/config/connection.php');
    $capsule->getConnection()->getPdo()->exec("CREATE INDEX idx_funcionario_nome ON funcionario (nome);");
    $capsule->getConnection()->getPdo()->exec("CREATE INDEX idx_equipe_codigo ON equipe (codigo);");
    $capsule->getConnection()->getPdo()->exec("CREATE INDEX idx_atividade_codProjeto ON atividade_projeto (codProjeto);");
    $capsule->getConnection()->getPdo()->exec("CREATE INDEX idx_situacao_dataFim ON atividade (situacao, dataFim);");
}

// Exemplo de uso
createIndexes();
q5();

?>