```php
<?php

// Classe responsável por representar um produto
class Produto
{
    // Atributos privados da classe
    private $id;
    private $nome;
    private $preco;

    // Construtor: inicializa os atributos ao criar um novo objeto
    public function __construct($id, $nome, $preco)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
    }

    // Getter: retorna o ID do produto
    public function getId()
    {
        return $this->id;
    }

    // Getter: retorna o nome do produto
    public function getNome()
    {
        return $this->nome;
    }

    // Getter: retorna o preço do produto
    public function getPreco()
    {
        return $this->preco;
    }

    // Setters: permitem alterar os valores dos atributos

    // Altera o ID do produto
    public function setId($id)
    {
        $this->id = $id;
    }

    // Altera o nome do produto
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    // Altera o preço do produto
    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    // Converte o objeto para um array
    // Útil para posteriormente salvar os dados em JSON
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco
        ];
    }

    // Cria um objeto Produto a partir de um array
    // Útil para recuperar dados vindos de um arquivo JSON
    public static function fromArray($data)
    {
        return new Produto(
            $data['id'],
            $data['nome'],
            $data['preco']
        );
    }
}

?>