<?php
require_once "funcionario.php";

require_once "config.php"; // Inclui o arquivo de configuração

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

// Gera o próximo ID considerando os formatos antigos e o formato atual.
$maiorId = 0;
foreach ($funcionarios as $funcionarioExistente) {
    $idExistente = $funcionarioExistente['idPessoa']
        ?? $funcionarioExistente['idFuncionario']
        ?? $funcionarioExistente['id']
        ?? 0;
    $maiorId = max($maiorId, (int) $idExistente);
}

$novoId = $maiorId + 1;

// Cria a instância do funcionário e converte para array
$funcionario = new Funcionario($novoId, $nome, $cpf, $cargo, (float)$salario);

// Adiciona no array principal
$funcionarios[] = $funcionario->toArray();

// Salva de volta no arquivo JSON
if (!file_put_contents($funcionariosFile, json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX)) {
    die('Erro ao salvar os dados no arquivo.');
}

header('Location: listar_funcionario.php');
exit;
?>