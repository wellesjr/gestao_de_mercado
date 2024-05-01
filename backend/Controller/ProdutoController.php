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

    $dados = json_decode(file_get_contents("php://input"), true);
            
    if (ProdutoService::verificar()) {
        include_once 'Model/VendasModel.php';
        if (HelperRoutes::getMethod() === "GET") {
            $caminho = HelperRoutes::getAction();
            echo json_encode(ProdutoService::listar($caminho));
            exit;
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
            //sof delete
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
