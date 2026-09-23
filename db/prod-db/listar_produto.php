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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título que aparece na aba do navegador -->
    <title>Lista de Produtos</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { min-height: 100vh; padding: 2rem 1rem; color: white; background: #1d1d1d; background-image: radial-gradient(circle 1.2px, rgba(173, 216, 230, 0.25) 100%, transparent 100%); background-size: 1rem 1rem; }
        .container { width: min(70rem, 100%); margin: 0 auto; padding: 2rem; background: rgba(43, 43, 43, 0.72); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 1.2rem; backdrop-filter: blur(4px); }
        h1 { margin-bottom: 1.5rem; text-align: center; }
        table { width: 100%; border-collapse: collapse; background: rgba(255, 255, 255, 0.04); }
        th, td { border: 1px solid rgba(255, 255, 255, 0.15); padding: 0.75rem; text-align: left; }
        th { background: rgba(111, 111, 255, 0.4); }
        button, a { display: inline-block; color: white; background: rgb(111, 111, 255); border: none; border-radius: 0.5rem; padding: 0.6rem 0.9rem; text-decoration: none; cursor: pointer; }
        .links { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1rem; }
        @media (max-width: 600px) { .container { padding: 1rem; overflow-x: auto; } table { min-width: 600px; } }
    </style>

</head>

<body>
<main class="container">

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

    <div class="links">
        <a href="../../produto_form.php">Cadastrar Novo Produto</a>
        <a href="../../venda_form.php">Ir para Vendas</a>
        <a href="../../index.php">Voltar ao Menu</a>
    </div>

</main>
</body>
</html>