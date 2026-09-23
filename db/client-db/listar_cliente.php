<?php

// Define o nome do arquivo JSON que contém os dados dos clientes
require_once "config.php";

// Verifica se o arquivo de clientes existe
if (file_exists($arquivo)) {

    // Lê o conteúdo do arquivo JSON e converte os dados para um array PHP
    $clientes = json_decode(file_get_contents($arquivo), true);

    // Exibe o título da lista de clientes
    echo '<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Lista de Clientes</title><style>*{box-sizing:border-box;font-family:"Segoe UI",Tahoma,sans-serif}body{margin:0;min-height:100vh;padding:2rem 1rem;color:white;background:#1d1d1d;background-image:radial-gradient(circle 1.2px,rgba(173,216,230,.25) 100%,transparent 100%);background-size:1rem 1rem}.container{width:min(70rem,100%);margin:0 auto;padding:2rem;background:rgba(43,43,43,.72);border:1px solid rgba(255,255,255,.08);border-radius:1.2rem;backdrop-filter:blur(4px)}h1{margin:0 0 1.5rem;text-align:center}.cliente{padding:.9rem 1rem;margin:.75rem 0;border:1px solid rgba(255,255,255,.15);border-radius:.7rem;background:rgba(255,255,255,.04)}a{display:inline-block;margin-top:1rem;color:white;background:rgb(111,111,255);border-radius:.5rem;padding:.6rem .9rem;text-decoration:none}</style></head><body><main class="container"><h1>Lista de Clientes</h1>';

    // Inicia uma lista não ordenada em HTML
    echo "<ul>";

    // Percorre cada cliente armazenado no array
    foreach ($clientes as $c) {

        // Exibe os dados de cada cliente: ID, nome, CPF e saldo
        echo "<li class='cliente'> {$c['idPessoa']} - {$c['nome']} - CPF: {$c['cpf']} - Saldo: {$c['saldo']} </li>";
    }

    // Finaliza a lista HTML
    echo "</ul>";

} else {

    // Exibe uma mensagem caso o arquivo de clientes não seja encontrado
    echo "Nenhum cliente cadastrado.";
}

echo "</ul><a href='../../cliente_form.html'>Cadastrar Novo Cliente</a> <a href='../../index.php'>Voltar ao Menu</a></main></body></html>";