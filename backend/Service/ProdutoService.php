<?php
namespace App\Service;

require_once 'Helper/Constantes.php';
include_once 'Repository/ProdutoRepository.php';

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
            $impostoExistente = (new ProdutoRepository())->getImpostoByNomeAndCategoria($dados['nome'],$dados['categoria_id']);
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

    public static function listar(string $rota): array {
        try {
            switch($rota){
                case "listar_categoria":
                    $categorias = (new ProdutoRepository())->listar(TABELA_CATEGORIA);
                    if (empty($categorias)) {
                        return [
                            'success' => false,
                            'message' => 'Nenhuma categoria cadastrada.'
                        ];
                    }
                    return [
                        'success' => true,
                        'data' => $categorias
                    ];
                case "listar_imposto": 
                    $impostos = (new ProdutoRepository())->listarImposto(TABELA_IMPOSTO);
                    if (empty($impostos)) {
                        return [
                            'success' => false,
                            'message' => 'Nenhum imposto cadastrado.'
                        ];
                    }
                    return [
                        'success' => true,
                        'data' => $impostos
                    ];
                case "listar_produto":
                    $produtos = (new ProdutoRepository())->listarProdutos(TABELA_PRODUTO);
                    if (empty($produtos)) {
                        return [
                            'success' => false,
                            'message' => 'Nenhum produto cadastrado.'
                        ];
                    }
                    return [
                        'success' => true,
                        'data' => $produtos
                    ];
                case "listar_vendas":
                    $vendas = (new ProdutoRepository())->listarVendas(TABELA_VENDA);
                    if (empty($vendas)) {
                        return [
                            'success' => false,
                            'message' => 'Nenhuma venda cadastrada.'
                        ];
                    }
                    return [
                        'success' => true,
                        'data' => $vendas
                    ];
                default:
                    return [
                        'success' => false,
                        'message' => 'Rota não encontrada.'
                    ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
