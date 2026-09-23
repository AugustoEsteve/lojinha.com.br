<!DOCTYPE html>
<!-- Isaac esteve aqui -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: white;
            background: rgb(29, 29, 29);
        }

        .background {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-color: rgb(29, 29, 29);
            background-image: radial-gradient(circle 1.2px, rgba(173, 216, 230, 0.25) 100%, transparent 100%);
            background-size: 1rem 1rem;
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

        main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 1rem 2rem;
        }

        .container {
            width: min(32rem, 100%);
            background: rgba(43, 43, 43, 0.4);
            border-radius: 1.5rem;
            padding: 2rem;
            backdrop-filter: blur(3px);
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        label {
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 0.8rem 0.75rem;
            border-radius: 0.7rem;
            border: 1px solid rgba(255,255,255,0.2);
            background: white;
            color: black;
            outline: none;
        }

        input:focus {
            border: 2px solid rgb(111, 111, 255);
        }

        button,
        .link {
            margin-top: 0.5rem;
            display: inline-block;
            text-align: center;
            color: white;
            text-decoration: none;
            background: rgb(111, 111, 255);
            border-radius: 0.8rem;
            padding: 0.9rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover,
        .link:hover {
            transform: scale(1.02);
            filter: brightness(1.05);
        }

        .links {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <header>
        <h1>Lojinha.com.br</h1>
        <nav>
            <a href="index.php">Página Inicial</a>
            <a href="db/prod-db/listar_produto.php">Produtos</a>
        </nav>
    </header>

    <main>
        <section class="container">
            <h1>Cadastro de Produto</h1>

            <form action="db/prod-db/salvar_produto.php" method="post">
                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="preco">Preço (R$):</label>
                <input type="number" id="preco" step="0.01" min="0" name="preco" required>

                <button type="submit">Salvar Produto</button>
            </form>

            <div class="links">
                <a class="link" href="db/prod-db/listar_produto.php">Ver produtos</a>
                <a class="link" href="venda_form.php">Voltar para vendas</a>
            </div>
        </section>
    </main>
</body>
</html>
