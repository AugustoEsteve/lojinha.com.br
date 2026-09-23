<?php
require_once "funcionario.php";

$funcionariosFile = "funcionarios.json";

// Cria o arquivo JSON inicial caso não exista
if (!file_exists($funcionariosFile)) {
    file_put_contents($funcionariosFile, "[]");
}

// Lê e decodifica o arquivo JSON
$jsonContent = file_get_contents($funcionariosFile);
$funcionarios = json_decode($jsonContent, true) ?? [];

// Captura e limpa os dados enviados
$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');
$salario = $_POST['salario'] ?? null;

// Valida se algum campo obrigatório está vazio
if (empty($nome) || empty($cpf) || empty($cargo) || $salario === null || $salario === '') {
    die("X Todos os campos são obrigatórios.");
}

// Gera o ID automático (Garante busca por 'id' ou 'idFuncionario')
$ids = array_column($funcionarios, "idFuncionario");
if (empty($ids)) {
    $ids = array_column($funcionarios, "id"); // Fallback caso no JSON esteja salvo como 'id'
}

$novoId = !empty($ids) ? max($ids) + 1 : 1;

// Cria a instância do funcionário e converte para array
$funcionario = new Funcionario($novoId, $nome, $cpf, $cargo, (float)$salario);

// Adiciona no array principal
$funcionarios[] = $funcionario->toArray();

// Salva de volta no arquivo JSON
if (file_put_contents($funcionariosFile, json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo "Funcionário cadastrado com sucesso! (ID: {$novoId})";
} else {
    echo "Erro ao salvar os dados no arquivo.";
}
?>