<?php

require_once 'config.php';
require_once 'venda.php';
require_once dirname(__DIR__) . '/client-db/config.php';

$vendas = carregarJson($vendasFile);
$clientes = carregarJson($clientesFile);
$clientesPorId = [];

foreach ($clientes as $cliente) {
    $clientesPorId[(string) ($cliente['idPessoa'] ?? '')] = $cliente['nome'] ?? 'Cliente sem nome';
}

?>

<!DOCTYPE html>

<!-- Define que o documento utiliza HTML5 -->
<html lang="pt-br">

<head>

    <!-- Define a codificação dos caracteres -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título que aparece na aba do navegador -->
    <title>Lista Vendas</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { min-height: 100vh; padding: 2rem 1rem; color: white; background: #1d1d1d; background-image: radial-gradient(circle 1.2px, rgba(173, 216, 230, 0.25) 100%, transparent 100%); background-size: 1rem 1rem; }
        .container { width: min(70rem, 100%); margin: 0 auto; padding: 2rem; background: rgba(43, 43, 43, 0.72); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 1.2rem; backdrop-filter: blur(4px); }
        h1 { margin-bottom: 1.5rem; text-align: center; }
        table { width: 100%; border-collapse: collapse; background: rgba(255, 255, 255, 0.04); }
        th, td { border: 1px solid rgba(255, 255, 255, 0.15); padding: 0.75rem; text-align: left; }
        th { background: rgba(111, 111, 255, 0.4); }
        .products { margin: 0; padding-left: 1.1rem; }
        .products li { margin: 0.25rem 0; }
        .products span { margin-left: 0.35rem; color: #b9ffca; font-weight: 700; }
        small { color: #cfcfcf; }
        a { display: inline-block; margin-top: 1rem; color: white; background: rgb(111, 111, 255); border-radius: 0.5rem; padding: 0.6rem 0.9rem; text-decoration: none; }
        @media (max-width: 600px) { .container { padding: 1rem; overflow-x: auto; } table { min-width: 500px; } }
    </style>

</head>

<body>
<main class="container">

    <!-- Título principal da página -->
    <h1>Listar Vendas Registradas</h1>

    <!-- Verifica se não existe nenhuma venda -->
    <?php if (count($vendas) === 0): ?>

        <!-- Mensagem mostrada quando não existem vendas -->
        <p>Nenhuma venda registrada</p>

    <?php else: ?>

        <!-- Cria a tabela para mostrar as vendas -->
        <table>

            <!-- Cabeçalho da tabela -->
            <tr>

                <!-- Coluna do ID da venda -->
                <th>ID Venda</th>

                <!-- Coluna do cliente -->
                <th>Cliente</th>

                <!-- Coluna dos produtos -->
                <th>Produtos</th>

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
                $idCliente = (string) $venda->getIdPessoa();
                $nomeCliente = $clientesPorId[$idCliente] ?? 'Cliente não encontrado';
                $itensPorProduto = [];

                foreach ($venda->getItens() as $produto) {
                    $idProduto = (string) $produto->getId();

                    if (!isset($itensPorProduto[$idProduto])) {
                        $itensPorProduto[$idProduto] = [
                            'nome' => $produto->getNome(),
                            'quantidade' => 0,
                        ];
                    }

                    $itensPorProduto[$idProduto]['quantidade']++;
                }

                ?>

                <!-- Cria uma linha para a venda -->
                <tr>

                    <!-- Mostra o ID da venda -->
                    <td>
                        <?= escapar($venda->getId()) ?>
                    </td>

                    <td>
                        <?= escapar($nomeCliente) ?><br>
                        <small>ID: <?= escapar($venda->getIdPessoa()) ?></small>
                    </td>

                    <td>
                        <ul class="products">
                            <?php foreach ($itensPorProduto as $idProduto => $item): ?>
                                <li>
                                    <?= escapar($item['nome']) ?>
                                    <span>x<?= escapar($item['quantidade']) ?></span>
                                    <small>(ID: <?= escapar($idProduto) ?>)</small>
                                </li>
                            <?php endforeach; ?>
                        </ul>
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

</main>
</body>

</html>