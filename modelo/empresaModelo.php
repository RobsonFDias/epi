<?php

class EmpresaModelo {

    private $id;
    private $razao;
    private $email;
    private $cnpj;
    private $site;
    private $senha;
    private $telefone;
    private $status;

    function getId() {
        return $this->id;
    }

    function getRazao() {
        return $this->razao;
    }

    function getEmail() {
        return $this->email;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getSite() {
        return $this->site;
    }

    function getSenha() {
        return $this->senha;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRazao($razao) {
        $this->razao = $razao;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setSite($site) {
        $this->site = $site;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}

?>
