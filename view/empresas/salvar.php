<?php

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);

include ("../../config/crud.php");
include ("../../controle/empresaControle.php");
include ("../../modelo/empresaModelo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $situacao = ($_POST['situacao'] == 'on' ? 1 : 0);
    $caracter = array(".", "/", "-");
    $cnpj = str_replace($caracter, "", $_POST['cnpj']);

    $empresaModelo = new EmpresaModelo();
    $empresaModelo->setId((int) $_POST['id']);
    $empresaModelo->setRazao(utf8_decode($_POST['razao']));
    $empresaModelo->setEmail(utf8_decode($_POST['email']));
    $empresaModelo->setCnpj(utf8_decode($cnpj));
    $empresaModelo->setSite(utf8_decode($_POST['site']));
    $empresaModelo->setSenha($_POST['senha']);
    $empresaModelo->setTelefone($_POST['telefone']);
    $empresaModelo->setStatus((int) $situacao);

    $empresaControle = new EmpresaControle();
    $retorno = $empresaControle->salvarEmpresa($empresaModelo);
    
    echo $retorno;
else:
    echo $_SERVER['REQUEST_METHOD'];

endif;
?>