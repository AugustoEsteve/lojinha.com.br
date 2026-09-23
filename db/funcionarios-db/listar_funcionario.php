<?php
require_once "config.php";

if (!file_exists($funcionariosFile)) {
    file_put_contents($funcionariosFile, '[]');
}

$funcionariosJSON = json_decode(file_get_contents($funcionariosFile), true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de funcionários</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #1d1d1d;
            color: white;
            min-height: 100vh;
            padding: 2rem 1rem;
            background-image: radial-gradient(circle 1.2px, rgba(173, 216, 230, 0.25) 100%, transparent 100%);
            background-size: 1rem 1rem;
        }

        .container {
            width: min(75rem, 100%);
            margin: 0 auto;
            padding: 2rem;
            background: rgba(43, 43, 43, 0.72);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.2rem;
            backdrop-filter: blur(4px);
        }

        h1 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.04);
        }

        th, td {
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.75rem;
            text-align: left;
        }

        th {
            background: rgba(111, 111, 255, 0.4);
        }

        a, button {
            color: white;
            background: rgb(111, 111, 255);
            border: none;
            border-radius: 0.5rem;
            padding: 0.6rem 0.9rem;
            text-decoration: none;
            cursor: pointer;
        }

        .actions {
            margin-top: 1rem;
        }

        @media (max-width: 700px) {
            .container {
                padding: 1rem;
                overflow-x: auto;
            }

            table {
                min-width: 650px;
            }
        }
    </style>
</head>
<body>
<main class="container">
    <h1>Funcionários Cadastrados</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Salário (R$)</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($funcionariosJSON as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f['idPessoa'] ?? $f['idFuncionario'] ?? $f['id'] ?? '') ?></td>
                <td><?= htmlspecialchars($f['nome'] ?? '') ?></td>
                <td><?= htmlspecialchars($f['cpf'] ?? '') ?></td>
                <td><?= htmlspecialchars($f['cargo'] ?? '') ?></td>
                <td><?= number_format((float) ($f['salario'] ?? 0), 2, ',', '.') ?></td>
                <td>
                    <form action="excluir_funcionario.php" method="post" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir este funcionário?');">
                        <input type="hidden" name="idPessoa" value="<?= htmlspecialchars($f['idPessoa'] ?? $f['idFuncionario'] ?? $f['id'] ?? '') ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="actions">
        <a href="../../funcionario_form.html">Cadastrar Novo Funcionário</a>
    </div>
</main>
</body>
</html>
