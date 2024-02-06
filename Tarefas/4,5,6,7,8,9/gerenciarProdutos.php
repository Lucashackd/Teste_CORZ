<?php
require_once('conectaBanco.php');
require_once('funcoes.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
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
        <legend>Buscar produtos</legend>
        <form action="formularios.php" method="get" class="formProduto">
            <label for="produto" hidden>Nome do produto:</label>
            <input type="text" name="produto" id="produto" class="inputField" placeholder="Nome do Produto">
            <input type="submit" value="PESQUISAR" class="botao" name="pesquisarProduto">
        </form>
    </section>
    <section>
        <div id="editarProdutos">
            <?php
            if (isset($produto)) {
                if ($produto) {
                    foreach ($produto as $item) {
            ?>
                        <form action='formularios.php' method='get' class="formProduto">
                            <div class="lista">
                                <div class="linha">
                                    <div class="info">
                                        <p>ID: <?php echo $item['id']; ?></p>
                                        <input type='hidden' name='id' value='<?php echo $item['id'] ?>'>
                                    </div>
                                    <div class="info">
                                        <label for="nome" hidden>Nome</label>
                                        <input type='text' name='nome' id='nome' class="inputField" value='<?php echo $item['name']; ?>'>
                                    </div>
                                    <div class="info">
                                        <label for="valor" hidden>Valor unitário</label>
                                        <input type='text' name='valor' id='valor' class="inputField" value='<?php echo $item['unitary_value']; ?>'>
                                    </div>
                                    <div class="info">
                                        <button type='submit' name='editarProduto' value='editProduct' class="botao">ATUALIZAR</button>
                                        <button type='submit' name='deletarProduto' value='deleteProduct' class="botao excluir">EXCLUIR</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                    }
                    ?>
            <?php
                } else {
                    echo '<h2>Nenhum produto encontrado!</h2>';
                }
            }
            ?>
            <hr>
            <div id="adicionarProduto">
                <section>
                    <legend>Adicionar produto</legend>
                    <form action='formularios.php' method='get' class="formProduto">
                        <div class="lista">
                            <div class="linha">
                                <div class="info">
                                    <label for="id" hidden>ID</label>
                                    <p>Informações do produto:</p>
                                </div>
                                <div class="info">
                                    <label for="nome" hidden>Nome</label>
                                    <input type='text' name='nome' id='nome' class="inputField" placeholder="Nome:">
                                </div>
                                <div class="info">
                                    <label for="valor" hidden>Valor unitário</label>
                                    <input type='text' name='valor' id='valor' class="inputField" placeholder="Valor Unitário:">
                                </div>
                                <div class="info">
                                    <button type='submit' name='adicionarProduto' value='addProduct' class="botao">ADICIONAR</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </section>
            </div>
            <div id="msg_product">
                <?php
                if (isset($_SESSION['msg_product'])) {
                    echo $_SESSION['msg_product'];
                    unset($_SESSION['msg_product']);
                }
                ?>
            </div>
    </section>
    </div>
</body>

</html>