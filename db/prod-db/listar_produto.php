<?php

// Define o nome do arquivo JSON onde os produtos estão armazenados
require_once "config.php";

$produtos = carregarJson($produtosFile);

?>

<!DOCTYPE html>

<!-- Define que o documento utiliza HTML5 -->
<html lang="pt-br">

<head>

    <!-- Define a codificação de caracteres para aceitar acentos -->
    <meta charset="UTF-8">

    <!-- Título que aparece na aba do navegador -->
    <title>Lista de Produtos</title>

</head>

<body>

    <!-- Título principal da página -->
    <h1>Produtos Cadastrados</h1>

    <!-- Cria uma tabela para mostrar os produtos -->
    <!-- border="1" coloca uma borda na tabela -->
    <!-- cellpadding="5" cria espaço interno nas células -->
    <table border="1" cellpadding="5">

        <!-- Primeira linha da tabela, contendo os títulos das colunas -->
        <tr>

            <!-- Coluna que mostra o ID do produto -->
            <th>ID</th>

            <!-- Coluna que mostra o nome do produto -->
            <th>Nome</th>

            <!-- Coluna que mostra o preço do produto -->
            <th>Preço (R$)</th>

            <!-- Coluna que contém as ações disponíveis -->
            <th>Ações</th>

        </tr>

        <?php
        // Percorre todos os produtos armazenados no array
        // A variável $p representa o produto atual
        foreach ($produtos as $p):
        ?>

        <!-- Cria uma nova linha para cada produto -->
        <tr>

            <!-- Mostra o ID do produto -->
            <td><?= escapar($p['id']) ?></td>

            <!-- Mostra o nome do produto -->
            <td><?= escapar($p['nome']) ?></td>

            <!-- Mostra o preço do produto formatado
                 Exemplo: 10.50 vira 10,50 -->
            <td>
                R$ <?= number_format($p['preco'], 2, ',', '.') ?>
            </td>

            <!-- Coluna das ações -->
            <td>

                <!--
                Formulário responsável por excluir o produto.
                Os dados serão enviados para excluir_produtos.php
                utilizando o método POST.
                -->
                <form
                    action="excluir_produtos.php"
                    method="post"
                    style="display:inline;"
                    onsubmit="return confirm('Tem certeza que deseja excluir este produto?');"
                >

                    <!--
                    Campo escondido que envia o ID do produto
                    para o arquivo excluir_produtos.php.
                    -->
                    <input
                        type="hidden"
                        name="id"
                        value="<?= escapar($p['id']) ?>"
                    >

                    <!-- Botão responsável por excluir o produto -->
                    <button type="submit">Excluir</button>

                </form>

            </td>

        </tr>

        <?php
        // Finaliza o foreach
        endforeach;
        ?>

    </table>

    <br>

    <!-- Link para a página de cadastro de novos produtos -->
    <a href="../../produto_form.php">
        Cadastrar Novo Produto
    </a>

    <br>

    <!-- Link para acessar a página de vendas -->
    <a href="../../venda_form.php">
        Ir para Vendas
    </a>

</body>
</html>