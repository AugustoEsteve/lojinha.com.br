<?php
require_once "funcionario.php";

require_once "config.php";
if (!file_exists($funcionariosFile)) file_put_contents($funcionariosFile, "[]");

$funcionariosJSON =json_decode(file_get_contents($funcionariosFile), true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head></head>
  <meta charset="UTF-8">
  <title>Lista de funcionários</title>
  </html>
  <body>
  <h1>Funcionários Cadastrado   s</h1>

  <table border="1" cellpadding="5">
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
            <td><?=$f['idPessoa'] ?></td>
            <td><?=$f['nome'] ?></td>
            <td><?=$f['cpf']?></td>
            <td><?=$f['cargo']?></td>
            <td><?=number_format($f['salario'],2,',',',') ?></td>
            <td>
                <form action="excluir_funcionario.php" method="post" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir este funcionário?');">
                    <input type="hidden" name="idPessoa" value="<?=$f['idPessoa'] ?>">
                    <button type="submit"> x Excluir</button>
                </form>
           </td>
        </tr>
    <?php endforeach; ?>
    </table>

    <br>
    <a href="../../funcionario_form.html"> + Cadastrar Novo Funcionário</a>
    </body>
    </html>
            