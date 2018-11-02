<?php

class Crud extends PDO {

    var $tabela;
    var $campos;
    var $valores;
    var $condicao;
    var $conexao;

    public function __construct() {
        try {
            //$this->conexao = new PDO("mysql:host=uaivo.mysql.uhserver.com;port=3306;dbname=uaivo", "uaivoapp", "uai@2017");
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES => false,
            );
            $this->conexao = new PDO("mysql:host=localhost;port=3306;dbname=epi", "root", "", $opt);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if ($ex->getCode() == 2002) {
                echo "Este host não é conhecido";
            } elseif ($ex->getCode() == 1049) {
                echo "Este banco de dados não existe";
            } elseif ($ex->getCode() == 1045) {
                echo "Acesso negado! Usuário e/ou senha inválido(s)";
            } else {
                echo "Code: " . $ex->getCode() . " Message: " . $ex->getMessage();
            }
        }
    }

    public function selecionar($tabela, $campos, $condicao) {
        $this->campos = $campos;
        $this->tabela = $tabela;
        $this->condicao = $condicao;
        try {
            $json = array();
            $sql = $this->conexao->query("select $this->campos from $this->tabela where $this->condicao")->fetchAll();
            foreach ($sql as $key => $value) {
                foreach ($value as $k => $v) {
                    $json[$key][$k] = utf8_encode($v);
                }
            }
            Crud::desconectar();
            return(json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }

    public function novoID($u) {
        try {
            $sql = $this->conexao->query("select max(" . $u . ") from $this->tabela")->fetchAll();
            foreach ($sql as $key => $value) {
                foreach ($value as $k => $v) {
                    $id = utf8_encode($v);
                }
            }
            Crud::desconectar();
            return($id);
        } catch (Exception $e) {
            print($e->getMessage());
        }
    }

    public function inserir($tabela, $campos, $valores) {
        $this->tabela = $tabela;
        $this->campos = $campos;
        $this->valores = $valores;
        $c = explode("|", $this->valores);
        $t = ",?";
        $valor = "";
        for ($i = 1; $i <= count($c) - 1; $i++): $valor .= $t;
        endfor;

        $b = explode(",", $campos);
        for ($i = 1; $i <= count($b); $i++): $camposF .= $b[$i] . ",";
        endfor;
        $camposF = substr($camposF, 0, count($camposF) - 3);
        try {
            $this->conexao->beginTransaction();
            $stmt = $this->conexao->prepare("INSERT INTO " . $this->tabela . " (" . $camposF . ") VALUES (" . substr($valor, 1, 10000) . ")");

            $cont = 1;
            for ($i = 1; $i <= count($c) - 1; $i++):
                $stmt->bindValue($cont, $c[$i]);
                $cont++;
            endfor;

            $stmt->execute();
            $this->conexao->commit();
            $id = Crud::novoID($b[0]);
            return $id;
        } catch (PDOException $ex) {
            $this->conexao->rollback();
            //print_r("Erro ao tentar Inserir: " . $ex->getMessage());
            print_r("erro");
        }
    }

    public function atualizar($tabela, $campos, $valores, $condicao) {
        $this->tabela = $tabela;
        $this->campos = str_replace(",", "=?,", $campos);
        $contagem = strlen($this->campos);
        $this->valores = $valores;
        $this->condicao = $condicao;
        $c = explode("|", $this->valores);
        try {
            $this->conexao->beginTransaction();
            $stmt = $this->conexao->prepare('UPDATE ' . $this->tabela . ' SET ' . substr($this->campos, 0, $contagem - 1) . ' WHERE ' . $this->condicao);
            $cont = 1;
            for ($i = 0; $i <= count($c) - 1; $i++):
                $stmt->bindValue($cont, $c[$i]);
                $cont++;
            endfor;
            $stmt->execute();
            $this->conexao->commit();
            Crud::desconectar();
        } catch (PDOException $ex) {
            $this->conexao->rollback();
            echo 'Erro ao tentar Alterar: ' . $ex->getMessage();
        }
    }

    public function deletar($tabela, $condicao) {
        $this->tabela = $tabela;
        $this->condicao = $condicao;
        try {
            $this->conexao->beginTransaction();
            $this->conexao->exec("DELETE FROM " . $this->tabela . " WHERE " . $this->condicao);
            $this->conexao->commit();
            Crud::desconectar();
        } catch (PDOException $ex) {
            echo "Erro ao tentar deletar: " . $ex->getMessage();
        }
    }

    public function desconectar() {
        try {
            $this->conexao = NULL;
        } catch (PDOException $ex) {
            echo "Erro ao tentar desconectar: " . $ex->getMessage();
        }
    }

}

?>