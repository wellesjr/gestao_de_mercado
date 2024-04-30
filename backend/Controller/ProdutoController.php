<?php

use App\Model\VendasModel;
use App\Model\ImpostoModel;
use App\Model\ProdutoModel;
use App\Model\CategoriaModel;

use App\Helper\HelperRoutes;

use App\Service\ProdutoService;
use App\Service\UsuarioService;

if (HelperRoutes::getApi() === 'produtos') {
    include_once 'Service/ProdutoService.php';
    include_once 'Model/vendasModel.php';
    include_once 'Model/ImpostoModel.php';
    include_once 'Model/ProdutoModel.php';
    include_once 'Model/CategoriaModel.php';

    $dados = json_decode(file_get_contents("php://input"), true);
            
    if (ProdutoService::verificar()) {
        if (HelperRoutes::getMethod() === "GET") {
            if (HelperRoutes::getAction() === 'listar_vendas'){
                echo json_encode(ProdutoService::listarVendas());
            }
            if (HelperRoutes::getAction() === 'listar_produtos'){
                echo json_encode(ProdutoService::listarProdutos());
            }
            if (HelperRoutes::getAction() === 'listar_categoria'){
                echo json_encode(ProdutoService::listarCategorias());
            }
            if (HelperRoutes::getAction() === 'listar_imposto_por_categoria'){
                echo json_encode(ProdutoService::listarImpostosCategoria());
            }
        }

        if (HelperRoutes::getMethod() === "POST" && !isset($_POST['_method'])) {
            if (HelperRoutes::getAction() === 'cadastrar_categoria'){
                $categoria = (new CategoriaModel($dados))->getDadosCategoria();
                echo json_encode(ProdutoService::addCategoria($categoria));
            }
            if (HelperRoutes::getAction() === 'cadastrar_imposto'){
                $imposto = (new ImpostoModel($dados))->getDadosImposto();
                echo json_encode(ProdutoService::addImposto($imposto));
            }
            if (HelperRoutes::getAction() === 'cadastrar_produto'){
                $produto = (new ProdutoModel($dados))->getDados();
                echo json_encode(ProdutoService::addProduto($produto));
            }
            if (HelperRoutes::getAction() === 'cadastrar_vendas'){
                $vendas = (new VendasModel($dados))->getDadosVenda();
                echo json_encode(ProdutoService::addVenda($vendas));
            }
        }
        if ((HelperRoutes::getMethod() === "POST" && isset($_POST['_method'])) && $_POST['_method'] === "DELETE") {
            if (HelperRoutes::getAction() === 'deletar_categoria'){
                $categoria = (new CategoriaModel($dados))->getDadosCategoria();
                echo json_encode(ProdutoService::excluiCategoria($categoria));
            }
            if (HelperRoutes::getAction() === 'deletar_imposto'){
                $imposto = (new ImpostoModel($dados))->getDadosImposto();
                echo json_encode(ProdutoService::excluiImposto($imposto));
            }
            if (HelperRoutes::getAction() === 'deletar_produto'){
                $produto = (new ProdutoModel($dados))->getDados();
                echo json_encode(ProdutoService::excluiProduto($produto));
            }
            if (HelperRoutes::getAction() === 'deletar_vendas'){
                $vendas = (new VendasModel($dados))->getDadosVenda();
                echo json_encode(UsuarioService::excluiVendas($vendas));
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Rota não encontrada']);
    }
}
