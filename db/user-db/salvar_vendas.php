<?php
require_once "produto.php";
require_once "Venda.php";
//Arquivos JSON
$clienteFile = "clientes.json";
$vendaFile = "vendas.json";
$produtoFile = "produtos.json";

//Carregar arquivos JSON
$clientes = json_decode(file_get_contents($clienteFile), true);
$produtosJSON = json_decode(file_get_contents($produtoFile), true);

if(!file_exists($vendaFile)){
    file_put_contents($vendaFile, "[]");
}
$vendas = json_decode(file_get_contents($vendaFile), true);

//Dados formularios 
$idPessoa = $_POST['idPessoa'];
$produtosSelecionados = $_POST['produtos']??[];

//Buscar cliente
$clienteIndex = null;
foreach ($clientes as $i => $c) {
    if ($c['idPessoa'] == $idPessoa) {
        $clienteIndex = $i;
        break;
    }
}
if ($clienteIndex === null) ("Cliente não encontrado.");

//Criar venda 
$venda = new Venda(count ($vendas) + 1, $idPessoa);

//Adicionar produtos
foreach ($produtosSelecionados as $pid) {
    foreach ($produtosJSON as $p) {
        if ($p['id'] === $pid) {
            $produto = new Produto($p['id'], $p['nome'], $p['preco']);
            $venda->adicionarItem($produto);
            break;
        }
    }
}

//Adicionar no JSON
$vendasJSON[] = $venda->toArray();
file_put_contents($vendaFile, json_encode($vendasJSON, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));

//Atualizar saldo do cliente
$clientes[$clienteIndex]['saldo'] -= $venda->getTotal();
file_put_contents($clienteFile, json_encode($clientes, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));

//Redirecionar para extrato
header("Location: extrato.php?idPessoa=$idPessoa");
exit;