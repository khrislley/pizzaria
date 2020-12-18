<?php

# Conexão com o banco de dados MySQL **********************************************************************************************
$server = "localhost";
$user = "root";
$senha = "masterkey";
$db = "pizzaria";

$conexao = mysqli_connect($server, $user, $senha, $db);

if($conexao->connect_errno){
    echo "NÃO FOI POSSIVEL CONECTAR AO BANCO DE DADOS";
    exit;
}

$query = "SELECT * FROM PEDIDO";
$resultadoPedido = mysqli_query($conexao, $query);

$query = "SELECT * FROM FUNCIONARIO";
$resultadoFuncionario = mysqli_query($conexao, $query);

$query = "SELECT * FROM SABOR";
$resultadoSabor = mysqli_query($conexao, $query);

$query = "SELECT * FROM BORDA";
$resultadoBorda = mysqli_query($conexao, $query);

$query = "SELECT * FROM ADICIONAL";
$resultadoAdicional = mysqli_query($conexao, $query);

$query = "SELECT * FROM ENTREGADOR";
$resultadoEntregador = mysqli_query($conexao, $query);

$query = "SELECT * FROM CLIENTE";
$resultadoCliente = mysqli_query($conexao, $query);

$query = "SELECT * FROM TAMANHO";
$resultadoTamanho = mysqli_query($conexao, $query);

$query = "SELECT * FROM ENDERECO";
$resultadoEndereco = mysqli_query($conexao, $query);

$query = "SELECT * FROM SITUACAO";
$resultadoSituacao = mysqli_query($conexao, $query);
