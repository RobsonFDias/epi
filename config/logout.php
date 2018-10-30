<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<?php
session_start();
error_reporting(0);

include('../config/crud.php');
include_once('../controle/usuarioControle.php');

$usuarioControle = new UsuarioControle();
if ($usuarioControle->sair()) {
    echo "<script>location.href='../../index.php'; </script>";
}
?>

