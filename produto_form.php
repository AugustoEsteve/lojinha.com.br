<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Define que a página usa caracteres especiais do português -->
    <meta charset="UTF-8">
    
    <!-- Título que aparece na aba do navegador -->
    <title>Cadastro de Produto</title>
</head>
<body>
    
    <!-- Título principal da página -->
    <h1>Cadastro de Produto</h1>
    
    <!-- Formulário para cadastro de produto -->
    <form action="db/prod-db/salvar_produto.php" method="post">

        <!-- Texto que identifica o campo do nome -->
        <label for="nome">Nome do Produto:</label><br>
        
        <!-- Campo para digitar o nome do produto -->
        <input type="text" id="nome" name="nome" required><br><br>

        <!-- Texto que identifica o campo do preço -->
        <label for="preco">Preço (R$):</label><br>
        
        <!-- Campo para informar o preço -->
        <input type="number" id="preco" step="0.01" min="0" name="preco" required><br><br>

        <!-- Texto que identifica o campo da quantidade -->
        <button type="submit">Salvar Produto</button>
</form>
        
<br>

<a href="db/prod-db/listar_produto.php">Ver produtos</a>

<br><br>

<!-- Link para voltar para a página de vendas -->
<a href="venda_form.php"> Voltar para vendas</a>

</body>
</html>