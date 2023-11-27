<?php
require_once('conectaBanco.php');
require_once('funcoes.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de notas fiscais</title>
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
        <div id="msg_updateNF">
            <?php
            if (isset($_SESSION['msg_updateNF'])) {
                echo $_SESSION['msg_updateNF'];
                unset($_SESSION['msg_updateNF']);
            }
            ?>
        </div>
        <div id="msg_productDelete">
            <?php
            if (isset($_SESSION['msg_productDelete'])) {
                echo $_SESSION['msg_productDelete'];
                unset($_SESSION['msg_productDelete']);
            }
            ?>
        </div>
        <?php
        $resultado = pesquisarNotas($conexao);
        if ($resultado) {
            foreach ($resultado as $nota) {
                ?>
                <div class="nota">
                    <form action="formularios.php" method="get" class="formNF">
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
                                <input type="submit" value="EXCLUIR NOTA" name="excluirNota" id="excluirNota" class="botao excluir2">
                            </div>
                        </div>
                        <?php
                        $campos = pesquisarDadosNotas($conexao);
                        foreach ($campos as $info) {
                            if ($info['id'] == $nota['id']) {
                                ?>
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
                                        <input type="submit" value="EXCLUIR PRODUTO" name="excluirProdutoNota" id="excluirProdutoNota" class="botao excluir">
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </form>
                    <div class="linha">
                        <p class="infoNF">Data de emissão: <?php echo $nota['emission_date'] ?></p>
                        <p class="infoNF">Valor final: R$<?php echo $nota['total_value'] ?></p>
                    </div>
                    <form action="formularios.php" method="get" class="formNF">
                        <div class="lista">
                            <div class="linha">
                                <label for="id" hidden>ID: </label>
                                <input type='text' name='id' value='<?php echo $nota['id'] ?>' hidden>
                                <div class="info">
                                    <label for="produto" hidden>Produto: </label>
                                    <select name="produto" id="produto" class="inputField">
                                        <?php
                                        $produto = listarProdutos($conexao);
                                        foreach ($produto as $opcao) {
                                            ?>
                                            <option value="<?php echo $opcao['id'] ?>">
                                                <?php echo $opcao['name'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="info">
                                    <label for="quantidade" hidden>Quantidade: </label>
                                    <input type="number" name="quantidade" id="quantidade" class="inputField" pattern="[0-9]+" title="Digite um número inteiro" required>
                                </div>
                                <button type='submit' name='addNotaProd' value='addNotaProd' class="botao">ADICIONAR PRODUTO</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
            <?php
            }
        }
        ?>
    </section>
    <section>
        <legend>Adição de notas</legend>
        <div class="lista">
            <div class="cabecalho">
                <div class="linha">
                    <p class="info">Cliente</p>
                    <p class="info">Produto</p>
                    <p class="info">Quantidade</p>
                </div>
            </div>
            <form action="formularios.php" method="get" class="formNF">
                <div class="linha">
                    <div class="info">
                        <label for="clienteNova" hidden>Cliente: </label>
                        <select name="clienteNova" id="clienteNova" class="inputField">
                            <?php
                            $usuario = pesquisarUsuario($conexao);
                            foreach ($usuario as $cliente) {
                                ?>
                                <option value="<?php echo $cliente['id'] ?>">
                                    <?php echo $cliente['name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="info">
                        <label for="produtoNova" hidden>Produto: </label>
                        <select name="produtoNova" id="produtoNova" class="inputField">
                            <?php
                            $produto = listarProdutos($conexao);
                            foreach ($produto as $opcao) {
                                ?>
                                <option value="<?php echo $opcao['id'] ?>">
                                    <?php echo $opcao['name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="info">
                        <label for="quantidadeNova" hidden>Quantidade: </label>
                        <input type="number" name="quantidadeNova" id="quantidadeNova" class="inputField" required>
                    </div>
                    <div class="info">
                        <p hidden>Easter Egg</p>
                    </div>
                    <input type="submit" name="adicionarNota" id="adicionarNota" class="botao" value="ADICIONAR NOTA">
                </div>
            </form>
        </div>
        <div id="msg_addNota">
            <?php
            if (isset($_SESSION['msg_addNota'])) {
                echo $_SESSION['msg_addNota'];
                unset($_SESSION['msg_addNota']);
            }
            ?>
        </div>
    </section>
</body>

</html>