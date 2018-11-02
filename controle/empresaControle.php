<?php

class EmpresaControle extends Crud {

    private $empresaModelo;

    public function salvarEmpresa(EmpresaModelo $empresaModelo) {
        $this->empresaModelo = $empresaModelo;

        try {
            if ($this->empresaModelo->getId() == ""):
                $id = parent::inserir("empresa", "id,razao,email,cnpj,site,senha,telefone,status", $this->empresaModelo->getId() . "|" .
                                $this->empresaModelo->getRazao() . "|" .
                                $this->empresaModelo->getEmail() . "|" .
                                $this->empresaModelo->getCnpj() . "|" .
                                $this->empresaModelo->getSite() . "|" .
                                $this->empresaModelo->getSenha() . "|" .
                                $this->empresaModelo->getTelefone() . "|" .
                                $this->empresaModelo->getStatus());
            else:
                parent::atualizar("empresa", "razao,email,cnpj,site,senha,telefone,status,", $this->empresaModelo->getRazao() . "|" .
                        $this->empresaModelo->getEmail() . "|" .
                        $this->empresaModelo->getCnpj() . "|" .
                        $this->empresaModelo->getSite() . "|" .
                        $this->empresaModelo->getSenha() . "|" .
                        $this->empresaModelo->getTelefone() . "|" .
                        $this->empresaModelo->getStatus() . "|" .
                        $this->empresaModelo->getId(), "id = ?");
                $id = $this->empresaModelo->getId();
            endif;
            return($id);
        } catch (PDOException $e) {
            echo($e->getMessage());
        }
    }

    public function buscarTodasEmpresa() {
        try {
            $sql = parent::selecionar("empresa", "id,razao,email,cnpj,site,senha,telefone,status", "1 = 1");
            return($sql);
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function buscarEmpresaId($id) {
        try {
            $sql = parent::selecionar("empresa", "razao,email,cnpj,site,senha,telefone,status", "id = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>