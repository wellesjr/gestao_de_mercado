<?php
namespace App\Model;
class ImpostoModel {
    private $imposto_id;
    private $percentual;
    private $usuario_id;
    private $categoria_id;

    public function __construct($dados) {
        $this->imposto_id   = isset($dados['imposto_id'])   ? $dados['imposto_id']   : null;
        $this->percentual   = isset($dados['percentual'])   ? $dados['percentual']   : null;
        $this->usuario_id   = isset($dados['usuario_id'])   ? $dados['usuario_id']   : null;
        $this->categoria_id = isset($dados['categoria_id']) ? $dados['categoria_id'] : null;
    }


    public function getDadosImposto() {
        return [
            'imposto_id' => $this->imposto_id,
            'categoria'  => $this->categoria_id,
            'usuario_id' => $this->usuario_id,
            'percentual' => $this->percentual,
        ];
    }
}