<!DOCTYPE html>
<!-- Isaac esteve aqui -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Vendas - Menu Principal</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=add" />
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

        .background {
            position: fixed;
            inset: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-color: rgb(29, 29, 29);
            background-image: radial-gradient(circle 1.2px, rgba(173, 216, 230, 0.25) 100%, transparent 100%);
            background-size: 1rem 1rem;
        }

        .background::after {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image: radial-gradient(circle at center, transparent 60%, rgb(29, 29, 29) 100%);
            pointer-events: none;
        }

        header {
            width: 100%;
            position: fixed;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 2rem;
            backdrop-filter: blur(2px);
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(131, 152, 185, 0.254);
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
            padding: 0.6rem 1rem;
            border-radius: 0.7rem;
            transition: 0.3s ease;
        }

        header nav a:hover {
            transform: scale(1.03);
        }

        header nav .active {
            background: rgb(111, 111, 255);
        }

        .inicio {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 90px;
        }

        .container {
            width: min(60rem, 90vw);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            border-radius: 1.2rem;
            background: rgba(20, 20, 20, 0.48);
            backdrop-filter: blur(3px);
        }

        .title {
            margin-bottom: 0.5rem;
        }

        .info {
            margin-bottom: 1.5rem;
            color: rgb(214, 214, 214);
        }

        .container ul {
            width: 100%;
            list-style: none;
            display: grid;
            grid-template-columns: repeat(2, minmax(220px, 1fr));
            gap: 1rem;
        }

        .card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            gap: 0.8rem;
            background: rgba(35, 35, 35, 0.9);
            padding: 1.2rem;
            border-radius: 1rem;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .card span {
            font-size: 2.4rem;
        }

        .card strong {
            font-size: 1rem;
        }

        .card li {
            width: 100%;
            list-style: none;
        }

        .card a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            color: white;
            text-decoration: none;
            background: rgb(111, 111, 255);
            padding: 0.7rem 1rem;
            border-radius: 0.8rem;
            transition: 0.25s ease;
        }

        .card a.primary {
            background: rgb(0, 209, 80);
        }

        .card a:hover {
            transform: translateY(-1px);
            filter: brightness(1.08);
        }

        @media (max-width: 600px) {
            .container ul {
                grid-template-columns: 1fr;
            }

            header {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <header>
        <h1>Lojinha.com.br</h1>
        <nav>
            <a href="index.php" class="active">Página Inicial</a>
            <a href="db/prod-db/listar_produto.php">Produtos</a>
        </nav>
    </header>

    <main class="inicio">
        <section class="container">
            <h1 class="title">Sistema de Vendas</h1>
            <p class="info">Escolha uma das opções abaixo:</p>

            <ul>
                <li class="card">
                    <span>📦</span>
                    <strong>Gerenciamento de produtos</strong>
                    <a href="produto_form.php" class="primary"><span class="material-symbols-rounded">add</span> Cadastrar produto</a>
                    <a href="db/prod-db/listar_produto.php">Listar produtos</a>
                </li>

                <li class="card">
                    <span>💸</span>
                    <strong>Gerenciamento de vendas</strong>
                    <a href="venda_form.php" class="primary"><span class="material-symbols-rounded">add</span> Nova venda</a>
                    <a href="db/venda-db/listar_venda.php">Ver vendas</a>
                </li>

                <li class="card">
                    <span>👤</span>
                    <strong>Gerenciamento de clientes</strong>
                    <a href="cliente_form.html" class="primary"><span class="material-symbols-rounded">add</span> Cadastrar cliente</a>
                    <a href="db/client-db/listar_cliente.php">Ver clientes</a>
                </li>

                <li class="card">
                    <span>💻</span>
                    <strong>Gerenciamento de funcionários</strong>
                    <a href="funcionario_form.html" class="primary"><span class="material-symbols-rounded">add</span> Cadastrar funcionário</a>
                    <a href="db/funcionarios-db/listar_funcionario.php">Listar funcionários</a>
                </li>
            </ul>
        </section>
    </main>
</body>
</html>
