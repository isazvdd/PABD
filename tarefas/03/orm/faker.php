<?php
require_once 'vendor/autoload.php';

use Faker\Factory;

// Cria uma instância do Faker
$faker = Factory::create('pt_BR');

// Configurações do banco de dados (colocar dados referentes ao banco de dados)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Insere registros na tabela 'funcionario'
for ($i = 0; $i < 100; $i++) {
    $nome = $faker->name;
    $sexo = $faker->randomElement(['M', 'F']);
    $dataNasc = $faker->date;
    $salario = $faker->randomFloat(2, 1000, 5000);
    $supervisor = $faker->numberBetween(1, $i); // Define um supervisor existente
    $depto = $faker->numberBetween(1, 5); // Define um departamento existente

    $sql = "INSERT INTO funcionario (nome, sexo, dataNasc, salario, supervisor, depto) 
            VALUES ('$nome', '$sexo', '$dataNasc', $salario, $supervisor, $depto)";

    if ($conn->query($sql) !== true) {
        echo "Erro ao inserir registro na tabela 'funcionario': " . $conn->error;
    }
}

// Insere registros na tabela 'departamento'
$departamentos = [
    ['sigla' => 'RH', 'descricao' => 'Recursos Humanos'],
    ['sigla' => 'TI', 'descricao' => 'Tecnologia da Informação'],
    ['sigla' => 'VND', 'descricao' => 'Vendas'],
    ['sigla' => 'FIN', 'descricao' => 'Financeiro'],
    ['sigla' => 'ADM', 'descricao' => 'Administração']
];

foreach ($departamentos as $depto) {
    $sigla = $depto['sigla'];
    $descricao = $depto['descricao'];
    $gerente = $faker->numberBetween(1, 10); // Define um gerente existente

    $sql = "INSERT INTO departamento (sigla, descricao, gerente)
            VALUES ('$sigla', '$descricao', $gerente)";

    if ($conn->query($sql) !== true) {
        echo "Erro ao inserir registro na tabela 'departamento': " . $conn->error;
    }
}

// Insere registros na tabela 'equipe'
for ($i = 0; $i < 5; $i++) {
    $nomeEquipe = $faker->company;

    $sql = "INSERT INTO equipe (nomeEquipe) 
            VALUES ('$nomeEquipe')";

    if ($conn->query($sql) !== true) {
        echo "Erro ao inserir registro na tabela 'equipe': " . $conn->error;
    }
}

// Insere registros na tabela 'membro'
for ($i = 1; $i <= 100; $i++) {
    $codEquipe = $faker->numberBetween(1, 5); // Define uma equipe existente
    $codFuncionario = $i;

    $sql = "INSERT INTO membro (codEquipe, codFuncionario) 
            VALUES ($codEquipe, $codFuncionario)";

    if ($conn->query($sql) !== true) {
        echo "Erro ao inserir registro na tabela 'membro': " . $conn->error;
    }
}

// Insere registros na tabela 'projeto'
for ($i = 0; $i < 3; $i++) {
    $descricao = $faker->sentence;
    $depto = $faker->numberBetween(1, 5); // Define um departamento existente
    $responsavel = $faker->numberBetween(1, 100); // Define um funcionário existente
    $dataInicio = $faker->date;
    $dataFim = $faker->date;
    $situacao = $faker->randomElement(['Em andamento', 'Concluído']);
    $dataConclusao = $situacao == 'Concluído' ? $faker->date : null;
    $equipe = $faker->numberBetween(1, 5); // Define uma equipe existente

    $sql = "INSERT INTO projeto (descricao, depto, responsavel, dataInicio, dataFim, situacao, dataConclusao, equipe) 
            VALUES ('$descricao', $depto, $responsavel, '$dataInicio', '$dataFim', '$situacao', '$dataConclusao', $equipe)";

    if ($conn->query($sql) !== true) {
        echo "Erro ao inserir registro na tabela 'projeto': " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
