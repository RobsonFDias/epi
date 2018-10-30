<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/empresaControle.php");
include ("../../modelo/empresaModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $situacao = isset($_POST['situacao']) ? 1 : 0;

    $empresaModelo = new FestaModelo();
    $empresaModelo->setId($_POST['id']);
    $empresaModelo->setRazao(utf8_decode($_POST['razao']));
    $empresaModelo->setEmail(utf8_decode($_POST['email']));
    $empresaModelo->setCnpj($_POST['cnpj']);
    $empresaModelo->setSite(utf8_decode($_POST['site']));
    $empresaModelo->setSenha($_POST['senha']);
    $empresaModelo->setTelefone($_POST['telefone']);
    $empresaModelo->setStatus($situacao);

    $empresaControle = new EmpresaControle();
    $retorno = $empresaControle->salvar($empresaModelo);

    echo $retorno;
endif;
?>