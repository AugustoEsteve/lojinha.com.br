<?php

// Onde os dados vão ser salvos
$produtosFile = "produtos.json";

//Se o Json não existir, ele cria
if (!file_exists($produtosFile)) {
    file_put_contents($produtosFile, "[]");
}

// Transforma o Json em Array (O ??[] garante uma lista mesmo sem informações)
$produtos = json_decode(file_get_contents($produtosFile), true) ?? [];

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
file_put_contents($produtosFile, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// Redireciona o usuário de volta para a página de listagem de produtos
header("Location: listar_produtos.php");
exit;
?>
