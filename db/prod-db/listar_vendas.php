<?php

// listar_vendas.php

// Importa a classe Venda
require_once "vendas.php";

// Importa a classe Produto
require_once "produtos.php";

// Define o arquivo onde as vendas estão armazenadas
$vendasFile = "vendas.json";

// Define o arquivo onde os clientes estão armazenados
$clienteFile = "clientes.json";

// Carregar arquivos

// Lê o arquivo de vendas e transforma o JSON em array
$vendasJSON = json_decode(file_get_contents($vendasFile), true);

// Lê o arquivo de clientes e transforma o JSON em array
$clientesJSON = json_decode(file_get_contents($clienteFile), true);

// Índice de clientes
// Cria um array vazio para armazenar os clientes
$clientesIndex = [];

// Percorre os clientes cadastrados
foreach ($clientesJSON as $C) {

    // Usa o ID do cliente como índice
    // e guarda o nome do cliente
    $clientesIndex[$C['idPessoa']] = $C['nome'];
}

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
    <?php if (count($vendasJSON) === 0): ?>

        <!-- Mensagem mostrada quando não existem vendas -->
        <p>Nenhuma venda registrada</p>

    <?php else: ?>

        <!-- Cria a tabela para mostrar as vendas -->
        <table border="1" cellpadding="5">

            <!-- Cabeçalho da tabela -->
            <tr>

                <!-- Coluna do ID da venda -->
                <th>ID Venda</th>

                <!-- Coluna do cliente -->
                <th>Cliente</th>

                <!-- Coluna da data -->
                <th>Data</th>

                <!-- Coluna dos itens -->
                <th>Itens</th>

                <!-- Coluna do valor total -->
                <th>Valor Total</th>

            </tr>

            <!-- Percorre todas as vendas -->
            <?php foreach ($vendasJSON as $v): ?>

                <?php

                // Converte os dados da venda em um objeto da classe Venda
                $venda = Venda::fromArray($v);

                ?>

                <!-- Cria uma linha para a venda -->
                <tr>

                    <!-- Mostra o ID da venda -->
                    <td>
                        <?= $venda->getId() ?>
                    </td>

                    <!--
                    Mostra o nome do cliente através do ID.
                    Caso o cliente não seja encontrado,
                    mostra "Cliente não encontrado".
                    -->
                    <td>
                        <?= $clientesIndex[$venda->getIdPessoa()] ?? "Cliente não encontrado" ?>
                    </td>

                    <!-- Mostra a data da venda -->
                    <td>
                        <?= $venda->getData() ?>
                    </td>

                    <!-- Mostra os itens da venda -->
                    <td>

                        <ul>

                            <!-- Percorre todos os itens da venda -->
                            <?php foreach ($venda->getItens() as $item): ?>

                                <!-- Mostra o nome e o preço do item -->
                                <li>
                                    <?= $item->getNome() ?>
                                    (R$ <?= number_format($item->getPreco(), 2, ',', '.') ?>)
                                </li>

                            <?php endforeach; ?>

                        </ul>

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
    <a href="index.php">Voltar ao Menu</a>

</body>

</html>