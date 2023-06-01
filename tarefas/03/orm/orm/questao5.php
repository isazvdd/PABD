<?php

function q5()
{
    $capsule = require('app/config/connection.php');
    $sql = "
        SELECT p.codigo, p.descricao, f.nome AS nome_gerente, 
        (SELECT COUNT(*) FROM membro WHERE codEquipe = p.equipe) AS membroEquipeProj,
        DATEDIFF(CURDATE(), p.dataFim) AS diasProjetoAtrasado,
        (SELECT COUNT(*) FROM atividade_projeto WHERE codProjeto = p.codigo) AS atvProjeto,
        (SELECT COUNT(*) FROM atividade 
         JOIN atividade_projeto ON atividade.codigo = atividade_projeto.codAtividade
         WHERE atividade_projeto.codProjeto = p.codigo 
           AND (atividade.situacao = 'Planejado' OR atividade.situacao = 'Em andamento')
           AND atividade.dataFim < CURDATE()) AS atvAtrasadasProjeto,
        (SELECT SUM(DATEDIFF(CURDATE(), atividade.dataFim)) FROM atividade 
         JOIN atividade_projeto ON atividade.codigo = atividade_projeto.codAtividade
         WHERE atividade_projeto.codProjeto = p.codigo
           AND (atividade.situacao = 'Planejado' OR atividade.situacao = 'Em andamento')
           AND atividade.dataFim < CURDATE()) AS diasAtvAtrasadas
        FROM projeto AS p
        JOIN funcionario AS f ON f.codigo = p.responsavel";

    $resultados = $capsule->getPdo()->exec($sql);

    foreach ($resultados as $resultado) {
        echo "Código do projeto: " . $resultado->codigo . "\n";
        echo "Nome do projeto: " . $resultado->descricao . "\n";
        echo "Nome do gerente: " . $resultado->nome_gerente . "\n";
        echo "Quantidade de membros da equipe do projeto: " . $resultado->membroEquipeProj . "\n";
        echo "Número de dias de atraso do projeto: " . ($resultado->diasProjetoAtrasado ?? 0) . "\n";
        echo "Quantidade de atividades do projeto: " . $resultado->atvProjeto . "\n";
        echo "Quantidade de atividades atrasadas do projeto: " . ($resultado->atvAtrasadasProjeto ?? 0) . "\n";
        echo "Soma dos dias de atraso das atividades atrasadas: " . ($resultado->diasAtvAtrasadas ?? 0) . "\n";
        echo "\n";
    }
}

function deleteIndex()
{
    $capsule = require('app/config/connection.php');
    $capsule->getConnection()->getPdo()->exec("ALTER TABLE funcionario DROP INDEX IF EXISTS idx_funcionario_nome;");
    $capsule->getConnection()->getPdo()->exec("ALTER TABLE equipe DROP INDEX IF EXISTS idx_equipe_codigo;");
    $capsule->getConnection()->getPdo()->exec("ALTER TABLE atividade_projeto DROP INDEX IF EXISTS idx_atividade_codProjeto;");
    $capsule->getConnection()->getPdo()->exec("ALTER TABLE atividade DROP INDEX IF EXISTS idx_situacao_dataFim;");
}

// Exemplo de uso
q5();
deleteIndex();
