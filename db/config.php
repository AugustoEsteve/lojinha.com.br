<?php

function carregarJson(string $arquivo): array
{
    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, '[]');
    }

    $dados = json_decode(file_get_contents($arquivo), true);
    return is_array($dados) ? $dados : [];
}

function salvarJson(string $arquivo, array $dados): void
{
    file_put_contents(
        $arquivo,
        json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        LOCK_EX
    );
}

function escapar($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
