<?php
require_once('conectaBanco.php');
require_once('funcoes.php');
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas Fiscais do Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav id='menu'>
        <ul>
            <li><a href='./index.php'>Clientes</a></li>
            <li><a href='./gerenciarProdutos.php'>Produtos</a></li>
            <li><a href='./gerenciarNotas.php'>Notas</a></li>
        </ul>
    </nav>
    <section>
        <legend>Lista de notas</legend>
        <?php
        foreach ($resposta as $nota) {
        ?>
            <div class="notaCliente">
                <div class="info" hidden>
                    <label for="idNota">ID da Nota: </label>
                    <input type="text" name="idNota" id="idNota" class="inputField" value="<?php echo $nota['id']; ?>">
                </div>
                <div class="cabecalho">
                    <p class="info">ID: <?php echo $nota['id']; ?></p>
                    <div class="linha">
                        <p class="info">Produto</p>
                        <p class="info">Quantidade</p>
                        <p class="info">Valor unitário</p>
                        <p class="info">Valor total</p>
                    </div>
                </div>
                <?php
                $campos = pesquisarDadosNotas($conexao);
                foreach ($campos as $info) {
                    if ($info['id'] == $nota['id']) {
                ?>
                        <div class="notaCliente">
                            <div class="lista">
                                <div class="linha">
                                    <div class="info" hidden>
                                        <label for="idProduto"> ID do Produto: </label>
                                        <input type="text" name="idProduto" id="idProduto" class="inputField" value="<?php echo $info['idProduto']; ?> ">
                                    </div>
                                    <p class="info"><?php echo $info['produto']; ?></p>
                                    <p class="info"><?php echo $info['quantidade']; ?></p>
                                    <p class="info"><?php echo $info['unidade']; ?></p>
                                    <p class="info"><?php echo $info['valorTotal'] ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="linha">
                    <p class="infoNF">Data de emissão: <?php echo $nota['emission_date'] ?></p>
                    <p class="infoNF">Valor final: R$<?php echo $nota['total_value'] ?></p>
                </div>
            </div>
            <hr>
        <?php
        }
        ?>
    </section>
</body>

</html>