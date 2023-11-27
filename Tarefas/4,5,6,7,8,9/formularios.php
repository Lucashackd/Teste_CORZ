<?php
    require_once('conectaBanco.php');
    require_once('funcoes.php');
    session_start();

    #EDITAR USUÁRIO
    if (isset($_GET['editarUsuario'])) {
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $id = $_GET['id'];

        $array = array($nome, $email, $id);
        $resultado = editarUsuario($conexao, $array);
        if ($resultado) {
            $_SESSION['msg_edit'] = "Edição realizada";
        } else {
            $_SESSION['msg_edit'] = "Erro ao editar";
        }
        header('location:./index.php');
    }

    #CADASTRO USUARIO
    if (isset($_GET['adicionarUsuario'])) {
        $nome = $_GET['nome'];
        $email = $_GET['email'];

        $array = array($nome, $email);
        $resultado = cadastraUsuario($conexao, $array);
        if ($resultado) {
            $_SESSION['msg_include'] = "Cliente adicionado";
        } else {
            $_SESSION["msg_include"] = "Erro ao adicionar";
        }
        header('location:./index.php');
    }

    #PESQUISAR PRODUTO
    if(isset($_GET['pesquisarProduto'])) {
        $produto = $_GET['produto'];
        $array = array('%'.$produto.'%');
        $produto = pesquisarProduto($conexao, $array);
        require_once('./gerenciarProdutos.php');   
    }

    #EDITAR PRODUTO
    if(isset($_GET['editarProduto'])) {
        $nome = $_GET['nome'];
        $valor = $_GET['valor'];
        $id = $_GET['id'];
        
        $array = array($nome, $valor, $id);
        $resultado = editarProduto($conexao, $array);
        if($resultado) {
            $_SESSION['msg_product'] = "Edição realizada";
            require_once('./gerenciarProdutos.php');
        } else {
            $_SESSION['msg_product'] = "Erro ao editar";
            require_once('./gerenciarProdutos.php');
        }
    }

    #EXCLUIR PRODUTO
    if(isset($_GET['deletarProduto'])) {
        $id = $_GET['id'];
        $array = array($id);
        $resultado = deletarProduto($conexao, $array);
        if($resultado) {
            $_SESSION['msg_product'] = "Exclusão realizada";
            require_once('./gerenciarProdutos.php');
        } else {
            $_SESSION['msg_admin2'] = "Erro ao excluir";
            require_once('./gerenciarProdutos.php');
        }
    }

    #CADASTRO PRODUTO
    if(isset($_GET['adicionarProduto'])) {
        $nome = $_GET['nome'];
        $valor = $_GET['valor'];

        $array = array($nome, $valor);
        $resultado = cadastrarProduto($conexao, $array);
        if($resultado){
            $_SESSION["msg_product"] = "Adicionado com sucesso";
            require_once('./gerenciarProdutos.php');
        } else{
            $_SESSION["msg_product"] = "Erro ao adicionar";
            require_once('./gerenciarProdutos.php');
        }
    }

    #ADICIONAR PRODUTO NA NOTA FISCAL
    if(isset($_GET['addNotaProd'])) {
        $produto = $_GET['produto'];
        $quantidade = $_GET['quantidade'];
        $id = $_GET['id'];

        $array = array($produto, $quantidade, $id);
        $resultado = adicionarProdutosNota($conexao, $array);
        if($resultado) {
            $valorTotal = atualizaValorTotal($conexao);
            if ($valorTotal) {
                $valorNota = atualizaValorNota($conexao);
            }
            $_SESSION['msg_updateNF'] = "Inclusão realizada";
            header('location:./gerenciarNotas.php');
        } else {
            $_SESSION['msg_udpdateNF'] = "Erro ao incluir";
            header('location:./gerenciarNotas.php');
        }
    }

    #EXCLUIR PRODUTO DA NOTA FISCAL
    if(isset($_GET['excluirProdutoNota'])) {
        $idNota = $_GET['idNota'];
        $idProduto = $_GET['idProduto'];
        
        $array = array($idNota, $idProduto);
        $resultado = excluirProdutoNota($conexao, $array);
        if ($resultado) {
            $update = atualizaValorNota($conexao);
            if ($update) {
                $_SESSION['msg_productDelete'] = "Exclusão realizada, valor da nota atualizado";
                header('location:./gerenciarNotas.php');
            } else {
                $_SESSION['msg_productDelete'] = "Erro ao atualizar valor da nota";
                header('location:./gerenciarNotas.php');
            }   
        } else {
            $_SESSION['msg_productDelete'] = "Não foi possível excluir";
            header('location:./gerenciarNotas.php');
        }
    }

    #CADASTRAR NOTA FISCAL
    if(isset($_GET['adicionarNota'])) {
        $idCliente = $_GET['clienteNova'];
        $idProduto = $_GET['produtoNova'];
        $quantidade = $_GET['quantidadeNova'];

        $cliente = array($idCliente);
        $nota = adicionarNota($conexao, $cliente);
        if ($nota) {
            $array = array($idProduto, $quantidade, $nota);
            $items = adicionarProdutosNota($conexao, $array);
            if ($items) {
                $valorTotal = atualizaValorTotal($conexao);
                if ($valorTotal) {
                    $valorNota = atualizaValorNota($conexao);
                    $_SESSION['msg_addNota'] = "Nota criada, produtos inseridos e valor total atualizado";
                    header('location:./gerenciarNotas.php');
                } else {
                    $_SESSION['msg_addNota'] = "Erro ao atualizar valor total dos produtos";
                    header('location:./gerenciarNotas.php');
                }
            } else {
                $_SESSION['msg_addNota'] = "Erro ao inserir produtos";
                header('location:./gerenciarNotas.php');
            }
        } else {
            $_SESSION['msg_addNota'] = "Erro ao criar nota";
            header('location:./gerenciarNotas.php');
        }
    }

    #EXCLUIR NOTA FISCAL
    if(isset($_GET['excluirNota'])) {
        $id = $_GET['idNota'];
        $array = array($id);
        $resultado = excluirNota($conexao, $array);
        if ($resultado) {
            $_SESSION['msg_productDelete'] = "Nota deletada";
            header('location:./gerenciarNotas.php');
        } else {
            $_SESSION['msg_productDelete'] = "Erro ao deletar nota";
            header('location:./gerenciarNotas.php');
        }
    }

    #CADASTRAR NOTA FISCAL CLIENTE
    if(isset($_GET['adicionarNotaCliente'])) {
        $idCliente = $_GET['clienteNova'];
        $idProduto = $_GET['produtoNova'];
        $quantidade = $_GET['quantidadeNova'];

        $cliente = array($idCliente);
        $nota = adicionarNota($conexao, $cliente);
        if ($nota) {
            $array = array($idProduto, $quantidade, $nota);
            $items = adicionarProdutosNota($conexao, $array);
            if ($items) {
                $valorTotal = atualizaValorTotal($conexao);
                if ($valorTotal) {
                    $valorNota = atualizaValorNota($conexao);
                    $_SESSION['msg_addNota'] = "Nota criada, produtos inseridos e valor total atualizado";
                    header('location:./index.php');
                } else {
                    $_SESSION['msg_addNota'] = "Erro ao atualizar valor total dos produtos";
                    header('location:./index.php');
                }
            } else {
                $_SESSION['msg_addNota'] = "Erro ao inserir produtos";
                header('location:./index.php');
            }
        } else {
            $_SESSION['msg_addNota'] = "Erro ao criar nota";
            header('location:./index.php');
        }
    }

    #VISUALIZAR NOTAS FISCAIS CLIENTE
    if(isset($_GET['verNotas'])) {
        $idCliente = $_GET['idCliente'];

        $cliente = array($idCliente);

        $resposta = pesquisarNotasCliente($conexao, $cliente);
        if ($resposta) {
            require_once('./notasClientes.php');
        } else {
            $_SESSION['msg_addNota'] = "Nenhuma nota encontrada";
            header('location:./index.php');
        }
    }
    
?>