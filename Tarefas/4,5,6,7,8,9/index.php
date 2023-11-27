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
    <title>Gerenciamento de clientes</title>
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
        <legend>Edição de clientes</legend>
        <section>
            <div id="msg_edit">
                <?php
                if (isset($_SESSION['msg_edit'])) {
                    echo $_SESSION['msg_edit'];
                    unset($_SESSION['msg_edit']);
                }
                ?>
            </div>
            <div id="msg_addNota">
                <?php
                if (isset($_SESSION['msg_addNota'])) {
                    echo $_SESSION['msg_addNota'];
                    unset($_SESSION['msg_addNota']);
                }
                ?>
            </div>
            <div id="msg_include">
                <?php
                if (isset($_SESSION['msg_include'])) {
                    echo $_SESSION['msg_include'];
                    unset($_SESSION['msg_include']);
                }
                ?>
            </div>
        </section>
        <?php
        $usuario = pesquisarUsuario($conexao);
        if ($usuario) {
            foreach ($usuario as $client) {
                ?>
                <form action="formularios.php" method="get">
                    <div class="lista">
                        <div class="linha">
                            <div class="info" hidden>
                                <label for="id" hidden>ID:</label>
                                <input type="text" id="idCliente" name="idCliente" class="inputField" value='<?php echo $client['id']; ?>' required>
                            </div>
                            <div class="info">
                                <label for="nome">Cliente: </label>
                                <input type="text" id="nome" name="nome" class="inputField" value='<?php echo $client['name']; ?>' required>
                            </div>
                            <div class="info">
                                <label for="email" hidden>Email: </label>
                                <input type="email" id="email" name="email" class="inputField" value='<?php echo $client['email']; ?>' required>
                            </div>
                            <div class="info">
                                <input type="submit" value="ATUALIZAR" id="editar" class="botao" name="editarUsuario">
                                <input type="hidden" name="id" value='<?php echo $client['id']; ?>' hidden>
                                <input type="submit" value="VISUALIZAR NOTAS" id="verNotas" class="botao" name="verNotas">
                            </div>
                        </div>
                    </div>
                </form>

                <form action="formularios.php" method="get">
                    <div class="criarNota">
                        <div class="info">
                            <label for="produtoNova">Produto: </label>
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
                            <input type="number" name="quantidadeNova" id="quantidadeNova" class="inputField" placeholder="Quantidade: " required>
                        </div>
                        <div class="info" hidden>
                            <label for="clienteNova" hidden>ID Cliente: </label>
                            <input type="number" name="clienteNova" id="clienteNova" class="inputField" value="<?php echo $client['id']; ?>" required>
                        </div>
                        <div class="info">
                            <input type="submit" value="CRIAR NOTA" id="adicionarNotaCliente" class="botao" name="adicionarNotaCliente">
                        </div>
                    </div>
                </form>
                <hr>
            <?php
            }
            ?>
    </section>
    <hr>
    <section>
        <legend>Inclusão de clientes</legend>
        <form action="formularios.php" method="get">
            <div id="lista">
                <div class="linha">
                    <div class="info">
                        <label for="nome" hidden>Nome:</label>
                        <input type="text" id="nome" name="nome" class="inputField" placeholder="Nome:" required>
                    </div>
                    <div class="info">
                        <label for="email" hidden>Email:</label>
                        <input type="email" id="email" name="email" class="inputField" placeholder="Email:" required>
                    </div>
                    <div class="info">
                        <input type="submit" value="ADICIONAR" id="adicionar" name="adicionarUsuario" class="botao">
                    </div>
                </div>
            </div>
        </form>
    </section>
    <?php
        } else {
            echo '<h2>Nenhum usuário encontrado!</h2>';
        }
    ?>
</body>
</html>