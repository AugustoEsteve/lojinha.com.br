<?php

require_once dirname(__DIR__) . '/prod-db/produto.php';
require_once 'venda.php';
require_once 'config.php';

//Carregar arquivos JSON
$clientes = carregarJson($clientesFile);
$produtos = carregarJson($produtosFile);
$vendas = carregarJson($vendasFile);

//Dados formularios 
$idPessoa = $_POST['idPessoa'] ?? null;
$idProduto = $_POST['idProduto'] ?? null;
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

if ($idPessoa === null || $idProduto === null || $quantidade === false || $quantidade < 1) {
    die('Cliente, produto e quantidade são obrigatórios.');
}

//Buscar cliente
$clienteEncontrado = false;
foreach ($clientes as $cliente) {
    if ((string) $cliente['idPessoa'] === (string) $idPessoa) {
        $clienteEncontrado = true;
        break;
    }
}
if (!$clienteEncontrado) {
    die('Cliente não encontrado.');
}

// Usa o ID real salvo no cadastro para manter o mesmo tipo e valor no JSON.
$idPessoa = $cliente['idPessoa'];

// Gera o próximo ID com base no maior ID existente, evitando duplicidade.
$proximoId = 1;
foreach ($vendas as $vendaExistente) {
    $idExistente = (int) ($vendaExistente['id'] ?? 0);
    if ($idExistente >= $proximoId) {
        $proximoId = $idExistente + 1;
    }
}

// Criar venda
$venda = new Venda($proximoId, $idPessoa);

//Adicionar produtos
foreach ($produtos as $produtoDados) {
    if ((string) $produtoDados['id'] === (string) $idProduto) {
        $produto = Produto::fromArray($produtoDados);
        for ($indice = 0; $indice < $quantidade; $indice++) {
            $venda->adicionarItem($produto);
        }
        break;
    }
}

if (count($venda->getItens()) === 0) {
    die('Produto não encontrado.');
}

//Adicionar no JSON
$vendas[] = $venda->toArray();
salvarJson($vendasFile, $vendas);

header('Location: listar_venda.php');
exit;