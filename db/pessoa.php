<?php

// Pessoa.php

// Cria a classe Pessoa
class Pessoa
{
    // Atributos protegidos da classe
    // protected permite que a própria classe e classes filhas acessem esses atributos
    protected int $idPessoa;
    protected string $nome;
    protected string $cpf;

    // Construtor da classe
    // É executado automaticamente quando um novo objeto Pessoa é criado
    public function __construct($idPessoa, $nome, $cpf)
    {
        // Armazena o ID recebido no atributo idPessoa
        $this->idPessoa = $idPessoa;

        // Armazena o nome recebido no atributo nome
        $this->nome = $nome;

        // Armazena o CPF recebido no atributo cpf
        $this->cpf = $cpf;
    }

    // Método para obter o ID da pessoa
    // Retorna o valor do atributo idPessoa
    public function getIdPessoa(): int
    {
        return $this->idPessoa;
    }

    // Método para obter o nome da pessoa
    // Retorna o valor do atributo nome
    public function getNome(): string
    {
        return $this->nome;
    }

    // Método para obter o CPF da pessoa
    // Retorna o valor do atributo cpf
    public function getCpf(): string
    {
        return $this->cpf;
    }
}
