<?php
require_once "cliente.php";

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$credito = $_POST['credito'];
$saldo = $_POST['saldo'];

// Geração de ID simples
$idPessoa = time(); // timestamp como ID

$cliente = new Cliente($idPessoa, $nome, $cpf, $credito, $saldo);

// Caminho do arquivo JSON
require_once "config.php";

// Lê arquivo existente ou cria novo
$dados = file_exists($arquivo) ?json_decode(file_get_contents($arquivo), true) : [];

//Adiciona novo cliente
$dados[] = $cliente->toArray();

//Salva novamente no arquivo
file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));

echo "Cliente cadastrado com sucesso!";
?>