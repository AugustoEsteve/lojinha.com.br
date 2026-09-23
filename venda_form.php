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

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: white;
        }


        /* =========================
           FUNDO
        ========================= */

        .background {
            position: fixed;
            inset: 0;

            z-index: -1;

            width: 100%;
            height: 100%;

            background-color: rgb(29, 29, 29);

            background-image:
                radial-gradient(
                    circle 1.2px,
                    rgba(173, 216, 230, 0.25) 100%,
                    transparent 100%
                );

            background-size: 1rem 1rem;
        }

        .background::after {
            content: "";

            position: fixed;
            inset: 0;

            z-index: -1;

            background-image:
                radial-gradient(
                    circle at center,
                    transparent 60%,
                    rgb(29, 29, 29) 100%
                );

            pointer-events: none;
        }


        /* =========================
           HEADER
        ========================= */

        header {
            width: 100%;

            z-index: 1;

            position: fixed;

            display: flex;

            justify-content: space-between;
            align-items: center;

            padding: 0.8rem 2rem;

            backdrop-filter: blur(2px);

            flex-wrap: wrap;

            border-bottom:
                1px solid rgba(131, 152, 185, 0.254);
        }

        header nav {
            display: flex;

            justify-content: center;
            align-items: center;

            gap: 1rem;
        }

        header nav a {
            color: white;

            text-decoration: none;

            background: rgb(131, 153, 185);

            padding: 0.5rem 1rem;

            border-radius: 0.7rem;

            transition: 0.6s ease all;
        }

        header nav a:hover {
            transform: scale(1.05);
        }

        header nav .active {
            background: rgb(111, 111, 255);

            transform: scale(1.05);
        }


        /* =========================
           ÁREA PRINCIPAL
        ========================= */

        main {
            width: 100%;

            min-height: 100vh;

            display: flex;

            justify-content: center;
            align-items: center;

            flex-direction: column;
        }


        /* =========================
           CONTAINER
        ========================= */

        .container {
            background-color: rgba(43, 43, 43, 0.318);

            display: flex;

            justify-content: center;
            align-items: flex-start;

            flex-direction: column;

            padding: 30px;

            width: 100%;
            max-width: 450px;

            border-radius: 30px;

            backdrop-filter: blur(4px);
        }

        .container h1 {
            width: 100%;

            text-align: center;

            margin-bottom: 20px;
        }


        /* =========================
           FORMULÁRIO
        ========================= */

        .container form {
            width: 100%;

            font-size: 20px;

            text-align: left;
        }

        .container label {
            display: block;

            margin-bottom: 5px;
        }


        /* =========================
           INPUTS E SELECTS
        ========================= */

        .container select,
        .container input {
            width: 100%;

            padding: 8px;

            border-radius: 10px;

            border: 1px solid black;

            background-color: white;

            color: black;

            outline: none;
        }

        .container select:focus,
        .container input:focus {
            border: 2px solid rgb(111, 111, 255);
        }


        /* =========================
           BOTÃO
        ========================= */

        .container button {
            width: 100%;

            background-color: rgb(111, 111, 255);

            color: white;

            padding: 10px;

            border: 1px solid rgb(111, 111, 255);

            border-radius: 10px;

            font-family:
                'Segoe UI',
                Tahoma,
                Geneva,
                Verdana,
                sans-serif;

            font-size: 16px;

            cursor: pointer;

            transition: 0.3s ease;
        }

        .container button:hover {
            transform: scale(1.03);
        }

        .container button:active {
            transform: scale(0.98);
        }


        /* =========================
           LINK
        ========================= */

        .container a {
            width: 100%;

            display: block;

            text-align: center;

            margin-top: 20px;

            color: white;

            text-decoration: none;

            background: rgb(131, 153, 185);

            padding: 8px;

            border-radius: 10px;

            transition: 0.3s ease;
        }

        .container a:hover {
            transform: scale(1.03);

            background: rgb(111, 111, 255);
        }

    </style>

</head>


<body>

    <!-- Fundo -->
    <div class="background"></div>


    <!-- Header -->
    <header>

        <h1>Lojinha.com.br</h1>

        <nav>

            <a href="index.php">
                Página Inicial
            </a>

            <a href="db/prod-db/listar_produto.php">
                Produtos
            </a>

        </nav>

    </header>


    <!-- Conteúdo principal -->
    <main>

        <section class="container">

            <h1>Nova Venda</h1>


            <form
                action="db/venda-db/salvar_vendas.php"
                method="post"
            >

                <!-- Cliente -->

                <label for="cliente">
                    Cliente:
                </label>

                <select
                    id="cliente"
                    name="idPessoa"
                    required
                >

                    <option value="">
                        -- Selecione um cliente --
                    </option>

                    <?php foreach ($clientes as $c): ?>

                        <option
                            value="<?= escapar($c['idPessoa']) ?>"
                        >
                            <?= escapar($c['nome']) ?>
                        </option>

                    <?php endforeach; ?>

                </select>


                <br><br>


                <!-- Produto -->

                <label for="produto">
                    Produto:
                </label>

                <select
                    id="produto"
                    name="idProduto"
                    required
                >

                    <option value="">
                        -- Selecione um produto --
                    </option>

                    <?php foreach ($produtos as $p): ?>

                        <option
                            value="<?= escapar($p['id']) ?>"
                        >

                            <?= escapar($p['nome']) ?>

                            -
                            
                            R$
                            <?= number_format(
                                $p['preco'],
                                2,
                                ',',
                                '.'
                            ) ?>

                        </option>

                    <?php endforeach; ?>

                </select>


                <br><br>


                <!-- Quantidade -->

                <label for="quantidade">
                    Quantidade:
                </label>

                <input
                    type="number"
                    id="quantidade"
                    name="quantidade"
                    value="1"
                    min="1"
                    required
                >


                <br><br>


                <!-- Botão -->

                <button type="submit">
                    Adicionar Item
                </button>

            </form>


            <!-- Lista de vendas -->

            <a href="db/venda-db/listar_venda.php">
                Ver Vendas
            </a>

        </section>

    </main>

</body>

</html> 
