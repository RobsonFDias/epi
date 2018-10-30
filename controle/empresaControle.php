<?php

class EmpresaControle extends Crud {

    private $empresaModelo;

    public function salvar(EmpresaModelo $empresaModelo) {
        $this->empresaModelo = $empresaModelo;
        try {
            if ($this->empresaModelo->getId() == "novo"):
                $id = parent::inserir("empresa", "id,razao,email,cnpj,site,senha,telefone,status", $this->usuarioModelo->getId() . "|" .
                                $this->empresaModelo->getRazao() . "|" .
                                $this->empresaModelo->getEmail() . "|" .
                                $this->empresaModelo->getCnpj() . "|" .
                                $this->empresaModelo->getSite() . "|" .
                                $this->empresaModelo->getSenha() . "|" .
                                $this->empresaModelo->getTelefone() . "|" .
                                $this->empresaModelo->getStatus());
            else:
                parent::atualizar("empresa", "razao,email,cnpj,site,senha,telefone,status", $this->empresaModelo->getRazao() . "|" .
                        $this->empresaModelo->getEmail() . "|" .
                        $this->empresaModelo->getCnpj() . "|" .
                        $this->empresaModelo->getSite() . "|" .
                        $this->empresaModelo->getSenha() . "|" .
                        $this->empresaModelo->getTelefone() . "|" .
                        $this->empresaModelo->getStatus() . "|" .
                        $this->usuarioModelo->__getId(), "id = ?");
                $id = $this->usuarioModelo->__getId();
            endif;
            return($id);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function atualizarLogado($id, $status) {
        try {
            parent::atualizar("usuario", "logado,", $status . "|" . $id, "id = ?");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarUsuarioId($id) {
        try {
            $sql = parent::selecionar("usuario", "nome,email,senha,img,sexo", "id = '$id'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarUserId($id) {
        try {
            $sql = parent::select("usuario", "nome,email,senha,img,sexo", "id = '" . $id . "'");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarEmail($email) {
        try {
            $sql = parent::select("usuario", "email", "email = '" . $email . "'");
            foreach ($sql as $sql) :
                $e = $sql[0];
            endforeach;
            return($e);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarUsuario($id) {
        try {
            parent::deletar("usuario", "id = '$id'");
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarUsuarioJson($id) {
        try {
            $sql = parent::json("usuario u", "u.id,u.nome,u.email,u.senha,u.telefone,u.data_nascimento,u.img,u.sexo,p.id_perfil,p.sobre,p.estado_civil,p.sexualidade,p.altura,p.peso,p.cigarro,p.alcool,a.apelido", "INNER JOIN perfil p ON p.usuario = u.id INNER JOIN apelido a ON a.usuario = u.id WHERE u.id = '" . $id . "'", "sim");
            //$sql = parent::json("usuario","id,nome,email,senha,telefone,img,sexo","id = '".$id."'",NULL);
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarUsuario($id) {
        try {
            $sql = parent::json("usuario", "id,nome,email,senha,telefone,data_nascimento,img,sexo", "id = '" . $id . "'", NULL);
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarTodosUsuario() {
        try {
            $sql = parent::select("usuario", "id,nome,img", "img <> '' order by id desc");
            return($sql);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function buscarQuantidadeUsuario() {
        try {
            $sql = parent::select("usuario", "COUNT(id)", "1 = 1");
            foreach ($sql as $q) :
                $quantUsuario = $q[0];
            endforeach;
            return($quantUsuario);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

}

?>