<?php
    function pesquisarUsuario($conexao) {
        try {
            $query = $conexao->prepare("SELECT * FROM clients");
            $resultado = $query->execute();
            $resultado = $query->fetchAll();
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function editarUsuario($conexao, $array) {
        try {
            $query = $conexao->prepare("UPDATE clients SET name = (?), email = (?) WHERE id = (?)");
            $resultado = $query->execute($array);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function cadastraUsuario($conexao, $array){
        try {
            $query = $conexao->prepare("INSERT INTO clients (name, email) VALUES (?, ?)");
            $resultado = $query->execute($array);
            return $resultado;
        } catch(PDOEXCEPTION $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function pesquisarProduto($conexao, $array){
        try {
            $query = $conexao->prepare("SELECT * FROM products WHERE name LIKE (?)");
            $resultado = $query->execute($array);
            if($resultado){
                $matriz = $query->fetchAll();
                return $matriz;
            } else{
                return $resultado;
            }

         }catch(PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }
    }

    function editarProduto($conexao, $array){
        try {
            $query = $conexao->prepare("UPDATE products SET name = (?), unitary_value = (?) WHERE id = (?)");
            $resultado = $query->execute($array);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deletarProduto($conexao, $array) {
        try {
            $query = $conexao->prepare("DELETE FROM products WHERE id = (?)");
            $resultado = $query->execute($array);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function cadastrarProduto($conexao, $array) {
        try {
             $query = $conexao->prepare("INSERT INTO products (name, unitary_value) VALUES (?, ?)");
             $resultado = $query->execute($array);
             return $resultado;
         } catch(PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }
    }

    function pesquisarNotas($conexao) {
        try {
            $query = $conexao->prepare("SELECT * FROM invoices");
            $resultado = $query->execute();
            $resultado = $query->fetchAll();
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function pesquisarDadosNotas($conexao) {
        try {
            $query = $conexao->prepare("SELECT invoices.id as 'id', products.name as 'produto', products.id as 'idProduto', items.amount as 'quantidade', products.unitary_value as 'unidade',
                                        items.total_item_value as 'valorTotal', invoices.emission_date as 'data', invoices.total_value as 'valorNota'
                                        FROM invoices LEFT JOIN items ON (invoices.id = items.invoice_id) JOIN products ON (items.product_id = products.id)");
            $resultado = $query->execute();
            $resultado = $query->fetchAll();
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function listarProdutos($conexao) {
        try {
            $query = $conexao->prepare("SELECT * FROM products");
            $resultado = $query->execute();
            if($resultado){
                $matriz = $query->fetchAll();
                return $matriz;
            } else{
                return $resultado;
            }

         }catch(PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }
    }

    function excluirProdutoNota($conexao, $array) {
        try {
                $query = $conexao->prepare("DELETE FROM items WHERE invoice_id = (?) AND product_id = (?)");
                $resultado = $query->execute($array);
                return $resultado;
            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
    }

    function atualizaValorNota($conexao) {
        try {
            $query = $conexao->prepare("UPDATE invoices SET invoices.total_value =
                                    (SELECT SUM(items.total_item_value)
                                    FROM items WHERE items.invoice_id = invoices.id)");
        $resultado = $query->execute();
        return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();    
        }
    }

    function adicionarNota($conexao, $cliente) {
        try {
            $query = $conexao->prepare("INSERT INTO invoices (client_id, emission_date) VALUES (?, curdate())");
            $resultado = $query->execute($cliente);
            $ultimo_id = $conexao->lastInsertId();
            return $ultimo_id;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();    
        }
    }

    function adicionarProdutosNota($conexao, $array) {
        try {
            $query = $conexao->prepare("INSERT INTO items (product_id, amount, invoice_id) VALUES (?, ?, ?)");
            $resultado = $query->execute($array);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();    
        }
    }

    function atualizaValorTotal($conexao) {
        try {
            $query = $conexao->prepare("UPDATE items SET total_item_value =
                                        amount * (SELECT unitary_value
                                        FROM products
                                        WHERE items.product_id = products.id)");
            $resultado = $query->execute();
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();    
        }
    }

    function excluirNota($conexao, $array) {
        try {
            $query = $conexao->prepare("DELETE FROM invoices WHERE id = ?");
            $resultado = $query->execute($array);
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();    
        }
    }

    function pesquisarNotasCliente($conexao, $cliente) {
        try {
            $query = $conexao->prepare("SELECT * FROM invoices WHERE client_id = (?)");
            $resultado = $query->execute($cliente);
            $resultado = $query->fetchAll();
            return $resultado;
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
?>