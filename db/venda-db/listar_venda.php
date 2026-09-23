<?php

require_once 'config.php';
require_once 'venda.php';

$vendas = carregarJson($vendasFile);

?>

<!DOCTYPE html>

<!-- Define que o documento utiliza HTML5 -->
<html lang="pt-br">

<head>

    <!-- Define a codificação dos caracteres -->
    <meta charset="UTF-8">

    <!-- Título que aparece na aba do navegador -->
    <title>Lista Vendas</title>

</head>

<body>

    <!-- Título principal da página -->
    <h1>Listar Vendas Registradas</h1>

    <!-- Verifica se não existe nenhuma venda -->
    <?php if (count($vendas) === 0): ?>

        <!-- Mensagem mostrada quando não existem vendas -->
        <p>Nenhuma venda registrada</p>

    <?php else: ?>

        <!-- Cria a tabela para mostrar as vendas -->
        <table border="1" cellpadding="5">

            <!-- Cabeçalho da tabela -->
            <tr>

                <!-- Coluna do ID da venda -->
                <th>ID Venda</th>

                <!-- Coluna da data -->
                <th>Data</th>

                <!-- Coluna do valor total -->
                <th>Valor Total</th>

            </tr>

            <!-- Percorre todas as vendas -->
            <?php foreach ($vendas as $dadosVenda): ?>

                <?php

                // Converte os dados da venda em um objeto da classe Venda
                $venda = Venda::fromArray($dadosVenda);

                ?>

                <!-- Cria uma linha para a venda -->
                <tr>

                    <!-- Mostra o ID da venda -->
                    <td>
                        <?= escapar($venda->getId()) ?>
                    </td>

                    <!-- Mostra a data da venda -->
                    <td>
                        <?= escapar($venda->getData()) ?>
                    </td>

                    <!-- Mostra o valor total da venda -->
                    <td>
                        <b>
                            R$ <?= number_format($venda->getTotal(), 2, ',', '.') ?>
                        </b>
                    </td>

                </tr>

            <?php endforeach; ?>

        </table>

    <?php endif; ?>

    <br>

    <!-- Link para voltar ao menu principal -->
    <a href="../../index.php">Voltar ao Menu</a>

</body>

</html>