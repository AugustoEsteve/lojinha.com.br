<?php

require_once "config.php";

$produtos = carregarJson($produtosFile);

//Pega o Id que foi enviado a método POST
$id = $_POST['id'] ?? null;

//Id errado, Mostra a mensagem
if ($id === null) {
    die("❌ ID do Produto não registrado.");
}

//Lê a lista e mostra os IDs de valores diferentes
$produtos = array_filter($produtos, function ($p) use ($id) {
    return $p['id'] != $id;
});

//Reorganiza o Array para o Json não ter índices quebrados
$produtos = array_values($produtos);

//Atualiza e converte para Json Novamente
salvarJson($produtosFile, $produtos);

// Redireciona o usuário de volta para a página de listagem de produtos
header("Location: listar_produto.php");
exit;
?>
