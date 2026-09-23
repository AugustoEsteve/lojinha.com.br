<?php

require_once 'config.php';

$funcionarios = carregarJson($funcionariosFile);

$idPessoa = $_POST['idPessoa'] ?? $_POST['idFuncionario'] ?? null;
if ($idPessoa === null || $idPessoa === '') {
	die("ID do funcionário não informado.");
}

//Remove o funcionário
$encontrado = false;
$funcionarios = array_filter($funcionarios, function ($funcionario) use ($idPessoa, &$encontrado) {
	$id = $funcionario['idPessoa']
		?? $funcionario['idFuncionario']
		?? $funcionario['id']
		?? null;

	if ((string) $id === (string) $idPessoa) {
		$encontrado = true;
		return false;
	}

	return true;
});
$funcionarios = array_values($funcionarios); //reorganiza indices

if (!$encontrado) {
	die('Funcionário não encontrado.');
}

salvarJson($funcionariosFile, $funcionarios);

//Redireciona para a listagem
header("Location: listar_funcionario.php");
exit;
?>