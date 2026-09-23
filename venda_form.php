<?php

require_once __DIR__ . '/db/client-db/config.php';
require_once __DIR__ . '/db/prod-db/config.php';

$clientes = carregarJson($clientesFile);
$produtos = carregarJson($produtosFile);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Venda</title>
</head>
<body>
   <h1>Nova Venda</h1>

    <form action="db/venda-db/salvar_vendas.php" method="post">
    <!-- Selecionar cliente -->
     <label>Cliente:</label><br>
    <select name="idPessoa" required>
        <option value="">-- Selecione um cliente --</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= escapar($c['idPessoa']) ?>"><?= escapar($c['nome']) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <!-- Selecionar produto -->
    <label>Produto:</label><br>
    <select name="idProduto" required>
        <option value="">-- Selecione um  produto --</option>
        <?php foreach ($produtos as $p): ?>
            <option value="<?= escapar($p['id']) ?>"><?= escapar($p['nome']) ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" value="1" min="1">
    <br><br>

    <button type="submit">Adicionar Item</button>
   </form>

   <br>
    <a href="db/venda-db/listar_venda.php">Ver Vendas</a>
</body>
</html>
