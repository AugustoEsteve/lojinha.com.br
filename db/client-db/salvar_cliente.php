<?php
require_once "cliente.php";
require_once "config.php";

$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$credito = $_POST['credito'] ?? 0;
$saldo = $_POST['saldo'] ?? 0;

if ($nome === '' || $cpf === '' || !is_numeric($credito) || !is_numeric($saldo)) {
	die('Nome, CPF, crédito e saldo são obrigatórios e devem ser válidos.');
}

// Gera um ID numérico único sem depender do horário do cadastro.
$dados = carregarJson($clientesFile);
$maiorId = 0;
foreach ($dados as $clienteExistente) {
	$idExistente = (int) ($clienteExistente['idPessoa'] ?? 0);
	$maiorId = max($maiorId, $idExistente);
}
$idPessoa = $maiorId + 1;

$cliente = new Cliente($idPessoa, $nome, $cpf, (float) $credito, (float) $saldo);
$dados[] = $cliente->toArray();

salvarJson($clientesFile, $dados);

header('Location: listar_cliente.php');
exit;
?>