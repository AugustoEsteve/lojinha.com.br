<?php
require_once "pessoa.php";

//dados pessoais e privados do cliente
class Cliente extends Pessoa {
    private float $credito;
    private float $saldo;

    public function __construct($idPessoa, $nome, $cpf, $credito, $saldo) {
        parent:__construct($idPessoa, $nome, $cpf);
        $this->credito = $saldo;
    }
//pegando as informações
    public function toArray() {
        return[
        "idPessoa" => $this->getIdPessoa(),
        "nome" => $this ->getNome(),
        "cpf"=> $this ->getCpf(),
        "credito" => $this->credito,
        "saldo" => $this->saldo
        ];
    } 
}
?>