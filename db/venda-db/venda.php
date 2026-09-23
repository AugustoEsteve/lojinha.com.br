<?php

require_once dirname(__DIR__) . '/prod-db/produto.php';

class Venda
{
    private $id;
    private $idPessoa; //id do cliente (do JSON de clientes)
    private $itens = []; //lista de objetos produto
    private $total;
    private $data;

    public function __construct($id, $idPessoa)
    {
        $this->id = $id;
        $this->idPessoa = $idPessoa;
        $this->itens = [];
        $this->total = 0;
        $this->data = date("Y-m-d H:i:s");
    }

    //Adicona o item na venda
    public function adicionarItem(Produto $produto): void
    {
        $this->itens[] = $produto;
        $this->calcularTotal();
    }

    //Recalcula o total da venda
    private function calcularTotal(): void
    {
        $this->total = 0;
        foreach ($this->itens as $produto) {
            $this->total += $produto->getPreco();
        }
    }

//Getters
public function getId()
{
    return $this->id;
}

public function getIdPessoa()
{
    return $this->idPessoa;
}

public function getItens(): array
{
    return $this->itens;
}

public function getTotal(): float
{
    return $this->total;
}

public function getData(): string
{
    return $this->data;
} 

//Converte para array (para salvar em JSON)
public function toArray(): array
{
    return[
        "id" => $this->id,
        "idPessoa" => $this->idPessoa,
        "itens" => array_map(function($p) { return $p->toArray(); }, $this->itens),
        "total" => $this->total,
        "data" => $this->data
    ];
}

//Reconstrói objeto Venda a partir de um array (do JSON)
public static function fromArray(array $data): self
{
    $venda = new Venda($data['id'], $data['idPessoa']);
    $venda->data = $data['data'] ?? date('Y-m-d H:i:s');

    foreach ($data['itens'] ?? [] as $produto) {
        $venda->adicionarItem(Produto::fromArray($produto));
    }

    return $venda;
    }
}