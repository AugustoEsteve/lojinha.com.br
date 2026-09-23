<?php

// Define o nome do arquivo JSON que contém os dados dos clientes
$arquivo = "clientes.json";

// Verifica se o arquivo de clientes existe
if (file_exists($arquivo)) {

    // Lê o conteúdo do arquivo JSON e converte os dados para um array PHP
    $clientes = json_decode(file_get_contents($arquivo), true);

    // Exibe o título da lista de clientes
    echo "<h2> Lista de Clientes </h2>";

    // Inicia uma lista não ordenada em HTML
    echo "<ul>";

    // Percorre cada cliente armazenado no array
    foreach ($clientes as $c) {

        // Exibe os dados de cada cliente: ID, nome, CPF e saldo
        echo "<li> {$c['idPessoa']} - {$c['nome']} - CPF: {$c['cpf']} - Saldo: {$c['saldo']} </li>";
    }

    // Finaliza a lista HTML
    echo "</ul>";

} else {

    // Exibe uma mensagem caso o arquivo de clientes não seja encontrado
    echo "Nenhum cliente cadastrado.";
}