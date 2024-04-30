<?php
namespace App\Service;

include_once 'Repository/UsuarioRepository.php';

use Exception;
use App\Helper\HelperRoutes;
use App\Repository\ProdutoRepository;

class ProdutoService {
    public static function verificar(): bool{
        $funcao = HelperRoutes::getAction();
        $verifica = !empty($funcao) ? true : false;
        return $verifica;
    }

    public static function addCategoria($dados): array {
        try {
            $categoriaExistente = (new ProdutoRepository())->getCategoriaByNome($dados['nome']);
            if (!empty($categoriaExistente)) {
                return [
                    'success' => false,
                    'message' => 'Categoria já cadastrado.'
                ];
            }
            $categoria = (new ProdutoRepository())->save($dados, TABELA_CATEGORIA );
            if (empty($categoria)) {
                return [
                    'success' => false,
                    'message' => 'Erro ao cadastrar categoria.'
                ];
            }
            return [
                'success' => true,
                'message' => "Categoria cadastrada com sucesso!"
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function addImposto($dados): array {
        try {
            $impostoExistente = (new ProdutoRepository())->getImpostoByNome($dados['nome'],$dados['categoria_id']);
            if (!empty($impostoExistente)) {
                return [
                    'success' => false,
                    'message' => 'Imposto já cadastrado para está categoria.'
                ];
            }
            $imposto = (new ProdutoRepository())->save($dados, TABELA_IMPOSTO);
            if (empty($imposto)) {
                return [
                    'success' => false,
                    'message' => 'Erro ao cadastrar imposto.'
                ];
            }
            return [
                'success' => true,
                'message' => "Imposto cadastrado com sucesso!"
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function addProduto($dados): array {
        try {
            $produto = (new ProdutoRepository())->save($dados, TABELA_PRODUTO);
            if (empty($produto)) {
                return [
                    'success' => false,
                    'message' => 'Erro ao cadastrar o produto.'
                ];
            }
            return [
                'success' => true,
                'message' => "Produto cadastrada com sucesso!"
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public static function addVenda($dados): array {
        try {
            $venda = (new ProdutoRepository())->save($dados, TABELA_VENDA);
            if (empty($venda)) {
                return [
                    'success' => false,
                    'message' => 'Erro ao cadastrar venda.'
                ];
            }
            return [
                'success' => true,
                'message' => "Venda cadastrada com sucesso!"
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

}
