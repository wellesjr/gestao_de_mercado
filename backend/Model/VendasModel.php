<?php
namespace App\Model;
class VendasModel {
    private $id;
    private $usuario_id;
    private $produto_id;
    private $quantidade;
    private $valor_unitario;
    private $valor_imposto;

    public function __construct($dados) {
        $this->id = isset($dados['id']) ? $dados['id'] : null;
        $this->usuario_id = isset($dados['usuario_id'])  ? $dados['usuario_id'] : null;
        $this->produto_id = isset($dados['produto_id'])  ? $dados['produto_id'] : null;
        $this->quantidade = isset($dados['quantidade']) ? $dados['quantidade'] : null;
        $this->valor_imposto  = isset($dados['valor_imposto'])  ? $dados['valor_imposto'] : null;
        $this->valor_unitario = isset($dados['valor_unitario']) ? $dados['valor_unitario'] : null;
    }

    
    public function getDadosVenda() {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'valor_imposto' => $this->valor_imposto,
            'valor_unitario' => $this->valor_unitario
        ];
    }
}