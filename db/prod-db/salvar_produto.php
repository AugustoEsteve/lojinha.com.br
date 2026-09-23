<?php
require_once "config.php";

$produtos = carregarJson($produtosFile);

// Recebe os dados do formulário
$nome = trim($_POST['nome'] ?? '');
$preco = $_POST['preco'] ?? null;

// verifica se não tem nome ou preço
if ($nome === '' || !is_numeric($preco) || (float) $preco < 0) {
    die("Nome e preço são obrigatórios!");
}

// Gera um ID automáticamente e adiciona + 1 no contador
$novoID = count($produtos) > 0 ? max(array_column($produtos, "id")) + 1 : 1;


// Cria um novo produto
$novoProduto = [
    "id" => $novoID,
    "nome" => $nome,
    "preco" => (float)$preco
];

$produtos[] = $novoProduto;

// salva o produto no .json
salvarJson($produtosFile, $produtos);

// redireciona para lista de produtos ou vendas
header("Location: listar_produto.php");
exit;
?>