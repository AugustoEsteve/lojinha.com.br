<?php

require_once 'config.php';

$funcionarios = carregarJson($funcionariosFile);

$idPessoa = $_POST['idPessoa'] ?? $_POST['idFuncionario'] ?? null;
if ($idPessoa === null || $idPessoa === '') {
	die("ID do funcionário não informado.");
}

//Remove o funcionário
$funcionarios = array_filter($funcionarios, function ($funcionario) use ($idPessoa) {
	$id = $funcionario['idPessoa'] ?? $funcionario['idFuncionario'] ?? null;
	return (string) $id !== (string) $idPessoa;
});
$funcionarios = array_values($funcionarios); //reorganiza indices

salvarJson($funcionariosFile, $funcionarios);

//Redireciona para a listagem
header("Location: listar_funcionario.php");
exit;
?>