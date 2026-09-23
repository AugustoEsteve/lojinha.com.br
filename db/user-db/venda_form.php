<?php
//venda_form.php
$clientes =json_decode(file_get_contents('clientes.json'), true);

//carregar produtos
$produtos = json_decode(file_get_contents('produtos.json'), true);
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

   <form action="salvar_venda.php" method="POST">
    <!-- Selecionar cliente -->
     <label>Cliente:</label><br>
     <selct name="idPessoa" required>
        <option value="">-- Selecione um cliente --</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['idPessoa'] ?>"><?= $c['nome'] ?></option>
        <?php endforeach; ?>
    <select>
    <br><br>

    <!-- Selecionar produto -->
    <label>Produto:</label><br>
    <select name="idProduto">
        <option value="">-- Selecione um  produto --</option>
        <?php foreach ($produtos as $p): ?>
            <option value="<?= $p['id'] ?>"><?= $p['nome'] ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" value="1" min="1">
    <br><br>

    <button type="submit">Adicionar Item</button>
   </form>

   <br>
   <a href="listar_vendas.php">Ver Vendas</a>
</body>
</html>
