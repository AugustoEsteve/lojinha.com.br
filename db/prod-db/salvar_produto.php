<?php
$produtosFile = "produtos.json";

// Se o arquivo não existir, criará um arquivo vazio
if(!file_exists($produtosFile)) {
    file_put_contents($produtosFile, "[]");
}

// recebe os produtos
$produtos = json_decode(file_get_contents($produtosFile), true);

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? null;
$preco = $_POST['preco'] ?? null;

// verifica se não tem nome ou preço
if(!$nome || !$preco) {
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
file_put_contents($produtosFile, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// redireciona para lista de produtos ou vendas
header("Location: listar_produtos.php");
exit;
?>