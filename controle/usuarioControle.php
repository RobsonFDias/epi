<?php

class UsuarioControle extends Crud {

    private $usuarioModelo;

    public function validaUsuario(UsuarioModelo $usuarioModelo) {
        $this->usuarioModelo = $usuarioModelo;
        try {
            $usuario = parent::select("usuario", "id,nome,email,senha,telefone,img,sexo", "email ='" . $this->usuarioModelo->__getEmail() . "'");
            if ($usuario != ''):
                foreach ($usuario as $us):
                    if ($us[2] == $this->usuarioModelo->__getEmail() && $us[3] == $this->usuarioModelo->__getSenha()):
                        return $us[0];
                    else:
                        return 0;
                    endif;
                endforeach;
            else :
                return 0;
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function protegePagina() {
        try {
            if (!isset($_SESSION["ID_USUARIO"])) {
                return(false);
            } else {
                return(true);
            }
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function sair() {
        try {
            if (isset($_SESSION['ID_USUARIO'])) {
                session_unset();
                session_destroy();
                return(true);
            } else {
                return(false);
            }
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function deletarImg($id) {
        $imagem = NULL;
        try {
            if ($id != ''):
                $img = UsuarioControle::buscarUsuarioId($id);
                if ($img == ''):
                    echo '';
                else:
                    foreach ($img as $img):
                        $imagem = $img[3];
                    endforeach;
                endif;
                if (!$imagem == NULL) :
                    if (file_exists('../imagens/usuario/' . $imagem)):
                        unlink('../imagens/usuario/' . $imagem);
                    else :
                        unlink('../imagens/usuario/' . $imagem);
                    endif;
                endif;
            endif;
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function inserirUsuario(UsuarioModelo $usuarioModelo) {
        $this->usuarioModelo = $usuarioModelo;
        try {
            if ($this->usuarioModelo->__getId() == "novo"):
                $id = parent::inserir("usuario", "id,nome,email,senha,telefone,data_nascimento,img,sexo,logado", $this->usuarioModelo->__getId() . "|" .
                                $this->usuarioModelo->__getNome() . "|" .
                                $this->usuarioModelo->__getEmail() . "|" .
                                $this->usuarioModelo->__getSenha() . "|" .
                                $this->usuarioModelo->__getTelefone() . "|" .
                                $this->usuarioModelo->__getDataNasc() . "|" .
                                $this->usuarioModelo->__getImg() . "|" .
                                $this->usuarioModelo->__getSexo() . "|" .
                                $this->usuarioModelo->__getLogado());
            else:
                $img = $this->usuarioModelo->__getImg();
                if (!empty($img)) :
                    UsuarioControle::deletarImg($this->usuarioModelo->__getId());
                endif;
                parent::atualizar("usuario", "nome,email,senha,telefone,data_nascimento," . ($img == "" ? "" : "img,") . "sexo,logado,", $this->usuarioModelo->__getNome() . "|" .
                        $this->usuarioModelo->__getEmail() . "|" .
                        $this->usuarioModelo->__getSenha() . "|" .
                        $this->usuarioModelo->__getTelefone() . "|" .
                        $this->usuarioModelo->__getDataNasc() . "|" .
                        ($img == "" ? "" : $this->usuarioModelo->__getImg() . "|") .
                        $this->usuarioModelo->__getSexo() . "|" .
                        $this->usuarioModelo->__getLogado() . "|" .
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