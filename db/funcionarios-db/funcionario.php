<?php
require_once dirname(__DIR__) . '/pessoa.php';

// Dados pessoais e privados do funcionário
class Funcionario extends Pessoa {
    private string $cargo;
    private float $salario;

    public function __construct($idPessoa, $nome, $cpf, $cargo, $salario) {
        parent::__construct($idPessoa, $nome, $cpf);
        $this->cargo = $cargo;
        $this->salario = $salario;
    }

    // Getters específicos
    public function getCargo(): string {
        return $this->cargo;
    }

    public function getSalario(): float {
        return $this->salario;
    }

    // Setters específicos
    public function setCargo(string $cargo): void {
        $this->cargo = $cargo;
    }

    public function setSalario(float $salario): void {
        $this->salario = $salario;
    }

    // Pegando as informações
    public function toArray(): array {
        return [
            "idPessoa" => $this->getIdPessoa(),
            "nome"     => $this->getNome(),
            "cpf"      => $this->getCpf(),
            "cargo"    => $this->cargo,
            "salario"  => $this->salario
        ];
    }

    // Reconstruindo o objeto a partir de um array
    public static function fromArray(array $data): self {
        return new self(
            $data['idPessoa'] ?? $data['idFuncionario'],
            $data['nome'],
            $data['cpf'],
            $data['cargo'],
            (float)$data['salario']
        );
    }
}
?>