<?php
require_once('Conexao.php');
class User extends Conexao
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }




    // Método para verificar se existe uma pessoa com email ou telefone passado
    public function inserirUser($input)
    {
        try {
            if (!$this->verificarUser($input)) {
                $hashedPassword = password_hash($input["senha"], PASSWORD_DEFAULT);
                $cmd = $this->con->prepare("INSERT INTO User(idPerfil, nome, apelido, estadoCivil, dataNascimento, identificacao, validadeIdentificacao, naturalidade, nif, sns, ss, rua, numero, andar, lado, cp, localidade, telefone, telemovel, email, senha,estado) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $cmd->bindValue(1, $input["perfil"]);
                $cmd->bindValue(2, $input["nome"]);
                $cmd->bindValue(3, $input["apelido"]);
                $cmd->bindValue(4, $input["estadoCivil"]);
                $cmd->bindValue(5, $input["dataNascimento"]);
                $cmd->bindValue(6, $input["identificacao"]);
                $cmd->bindValue(7, $input["validadeIdentificacao"]);
                $cmd->bindValue(8, $input["naturalidade"]);
                $cmd->bindValue(9, $input["nif"]);
                $cmd->bindValue(10, $input["sns"]);
                $cmd->bindValue(11, $input["ss"]);
                $cmd->bindValue(12, $input["rua"]);
                $cmd->bindValue(13, $input["numero"]);
                $cmd->bindValue(14, $input["andar"]);
                $cmd->bindValue(15, $input["lado"]);
                $cmd->bindValue(16, $input["cp"]);
                $cmd->bindValue(17, $input["localidade"]);
                $cmd->bindValue(18, $input["telefone"]);
                $cmd->bindValue(19, $input["telemovel"]);
                $cmd->bindValue(20, $input["email"]);
                $cmd->bindValue(21, $hashedPassword);
                $cmd->bindValue(22, "ativo");

                if ($cmd->execute()) {
                    return "sucesso";
                } else {
                    return "insucesso";
                }
            } else {
                return 'existe';
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function atualizarUser($input)
    {
        // SE A SEÇÃO A ATUALIZAR FOR DA SENHA
        if ($input['secao'] == "senha") {

            $verif = $this->obterUser($input['idUser']);
            if (password_verify($verif['senha'], $input['senhaAtual'])) {

                $cmd = $this->con->prepare("UPDATE User SET senha = ? WHERE idUser = ?");
                $cmd->bindValue(1, $input['senhaNova']);
                $cmd->bindValue(2, $input['idUser']);

                if ($cmd->execute()) {
                    return "sucesso";
                } else {
                    return "insucesso";
                }
            } else {
                return 'incorreta';
            }

            // SE A SEÇÃO FOR DO EMAIL
        } else if ($input['secao'] == "email") {

            $verif = $this->obterUser($input['idUser']);

            if ($verif['email'] == $input['emailAtual']) {

                $cmd = $this->con->prepare("UPDATE User SET email = ? WHERE idUser = ?");
                $cmd->bindValue(1, $input['emailAtual']);
                $cmd->bindValue(2, $input['idUser']);

                if ($cmd->execute()) {
                    return "sucesso";
                } else {
                    return "insucesso";
                }
            } else {
                return 'incorreta';
            }

            // CASO FOR DOS DADOS PESSOAIS, ENDEREÇO E CONTATOS
        } else {
           
            $sql = "UPDATE User SET ";
            $inputKeys = array_keys($input);
            $inputCount = count($input);

            foreach ($input as $key => $value) {
                if ($key == "idUser" || $key == "secao") {
                    continue;
                }
                // Verificar se é o último elemento
                $currentIndex = array_search($key, $inputKeys);
                if ($currentIndex < $inputCount - 1) {
                    $sql .= $key . " = :" . $key . ", ";
                } else {
                    $sql .= $key . " = :" . $key . " ";
                }
            }

            $sql .= " WHERE idUser=:idUser";
            $cmd = $this->con->prepare($sql);

            foreach ($input as $key => $value) {
                if ($key == "idUser" || $key == "secao") {
                    continue;
                }
                $cmd->bindValue(":" . $key, $value);
            }
            $cmd->bindParam(":idUser", $input['idUser']);
            try {

                if ($cmd->execute()) {
                    return "sucesso";
                } else {
                    return "insucesso";
                }


            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
    // Método para verificar se existe uma pessoa com email ou telefone... passado
    public function verificarUser($input)
    {
        $cmd = $this->con->prepare("SELECT * FROM User
                                    WHERE identificacao = ? 
                                    OR nif = ? 
                                    OR sns = ? 
                                    OR ss = ? 
                                    OR email = ?");


        $cmd->bindParam(1, $input["identificacao"]);
        $cmd->bindParam(2, $input["nif"]);
        $cmd->bindParam(3, $input["sns"]);
        $cmd->bindParam(4, $input["ss"]);
        $cmd->bindParam(5, $input["email"]);


        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function obterUser($id)
    {
        $cmd = $this->con->prepare("SELECT * FROM User INNER JOIN Perfil ON Perfil.idPerfil = User.idPerfil WHERE User.idUser = ? ");

        $cmd->bindParam(1, $id);

        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            return $dados;
        } else {
            return false;
        }
    }

    // Método elimina um usuário
    public function eliminarUser($id)
    {
        $cmd = $this->con->prepare("DELETE FROM User WHERE User.idUser = ? ");

        $cmd->bindParam(1, $id);

        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function login($input)
    {
        $cmd = $this->con->prepare("SELECT * FROM User INNER JOIN Perfil ON Perfil.idPerfil = User.idPerfil WHERE email = ? ");
        $cmd->bindParam(1, $input);

        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            return $dados;
        } else {
            return false;
        }
    }

}

?>