<?php
include_once("funcoes.php");
?>
<html>

<head>
    <title>PIZZARIA</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <?php
    session_start();
    if (!isset($_SESSION['login'])) {
        echo "ERRO! O usuário não está logado!";
        exit();
    }
    ?>


    <header>
        <h1>PIZZARIA</h1>
    </header>

    <div class="subHeader">
        <a href="verificarStatus.php">Verificar status</a>
        <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <a href="relatorioVendasDiarias.php">Relatório diário</a>
        <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <?php if (isset($_SESSION['login'])) { ?>
            <a href="logout.php">
                <?php echo $_SESSION['login']; ?>
                (sair)
            </a>
    </div>
<?php } ?>


<div class='menu'>
    <div class="menuOpcao">
        <h3>Pedidos</h3>
        <div class="cont">
            <a href="inserirPedido.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarPedido.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarPedidoEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarPedido.php">Excluir</a>
        </div>
    </div>


    <div class="menuOpcao">
        <h3>Clientes</h3>
        <div class="cont">
            <a href="inserirCliente.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarCliente.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarClienteEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarCliente.php">Excluir</a>
        </div>
    </div>

    <div class="menuOpcao">
        <h3>Endereço</h3>
        <div class="cont">
            <a href="inserirEndereco.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarEndereco.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarEnderecoEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarEndereco.php">Excluir</a>
        </div>
    </div>


    <div class="menuOpcao">
        <h3>Sabores</h3>
        <div class="cont">
            <a href="inserirSabor.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarSabor.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarSaborEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarSabor.php">Excluir</a>
        </div>
    </div>

    <div class="menuOpcao">
        <h3>Entregadores</h3>
        <div class="cont">
            <a href="inserirEntregador.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarEntregador.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarEntregadorEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarEntregador.php">Excluir</a>
        </div>
    </div>

    <div class="menuOpcao">
        <h3>Adicionais</h3>
        <div class="cont">
            <a href="inserirAdicional.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarAdicional.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarAdicionalEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarAdicional.php">Excluir</a>
        </div>
    </div>

    <div class="menuOpcao">
        <h3>Borda</h3>
        <div class="cont">
            <a href="inserirBorda.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarBorda.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarBordaEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarBorda.php">Excluir</a>
        </div>
    </div>

    <div class="menuOpcao">
        <h3>Funcionários</h3>

        <div class="cont">
            <a href="inserirFuncionario.php">Cadastrar</a>
        </div>
        <div class="cont">
            <a href="procurarFuncionario.php">Pesquisar</a>
        </div>
        <div class="cont">
            <a href="selecionarFuncionarioEditar.php">Editar</a>
        </div>
        <div class="cont">
            <a href="deletarFuncionario.php">Excluir</a>
        </div>
    </div>
</div><br>

<footer>Copyright ©2020 Khrislley Oliveira - Todos os direitos reservados.</footer>

</body>

</html>