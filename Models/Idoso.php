<?php
require_once('Conexao.php');
class Idoso extends Conexao
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }


    // Método retorna todos os idosos
    public function obterIdosos()
    {

        $cmd = $this->con->query("SELECT *
                                FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil
                                WHERE p.descricao = 'utente'
                                ");

        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function filtrarIdosos($nome, $apelido)
    {
        $cmd = $this->con->prepare("SELECT * FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil WHERE p.descricao = 'utente' AND CONCAT(nome, ' ', apelido) LIKE :nome OR :apelido ORDER BY u.nome, u.apelido");

        $cmd->bindValue(':nome', "%{$nome}%", PDO::PARAM_STR);
        $cmd->bindValue(':apelido', "%{$apelido}%", PDO::PARAM_STR);
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    // Retorna um idoso. Recebe um parâmetro (id)
    public function obterIdosoPorId($id)
    {

        $cmd = $this->con->prepare("SELECT *
        FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil LEFT JOIN Inscricao i ON u.idUser = i.idUserUtente
        WHERE p.descricao = 'utente' AND idUser = ?");
        $cmd->bindParam(1, $id);

        try {
            $cmd->execute();

            if ($cmd->rowCount() > 0) {

                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                return $dados;
            } else {
                return array("info" => "Sem resultado");
            }


        } catch (Exception $e) {
            return array("info" => "Houve um erro!", "erro" => $e->getMessage());

        }

    }
    // Método retorna todos os utentes em lista de espera
    public function listaEspera()
    {

        $cmd = $this->con->query("SELECT * FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil INNER JOIN Inscricao i ON u.idUser = i.idUserUtente
        WHERE p.descricao = 'utente' AND i.respostaServico = 'Manutenção em lista de espera'");

        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;

    }

    public function obterFamiliarIdoso($id)
    {

        $cmd = $this->con->prepare("SELECT f.nome, f.apelido, i.parentesco FROM Familiar f
                                    INNER JOIN Idoso i
                                    ON f.id_familiar = i.id_familiar
                                    WHERE i.id_idoso = ?");
        $cmd->bindParam(1, $id);

        try {
            $cmd->execute();

            if ($cmd->rowCount() > 0) {

                $dados = $cmd->fetch(PDO::FETCH_ASSOC);
                return $dados;
            } else {
                return array("info" => "Sem resultado");
            }


        } catch (Exception $e) {
            return array("info" => "Houve um erro!", "erro" => $e->getMessage());

        }

    }


    // FUNÇÃO PARA INSCREVER UM UTENTE NUM DETERMINADO SERVIÇO
    public function inserirInscricao($inputs)
    {

        $verif = $this->verifRespUtente($inputs);

        if (!$verif) {

            $stmp = $this->con->prepare("INSERT INTO ResponsavelUtente(idUserUtente, idUserResponsavel, parentesco)VALUES(?,?,?)");
            $stmp->bindValue(1, $inputs['idUserUtente']);
            $stmp->bindValue(2, $inputs['idUserResponsavel']);
            $stmp->bindValue(3, $inputs['parentesco']);
            $stmp->execute();
        }
        try {
            $sql = "INSERT INTO Inscricao( ";
            $val = "VALUES(";
            $inputsKeys = array_keys($inputs);
            $inputsCount = count($inputs);

            // ESTE TRECHO DE CÓDIGO SERVE BASICAMENTE PARA INTRODUZIR DADOS NA QUERY AUTOMÁTICAMENTE
            foreach ($inputs as $key => $value) {
                if ($key == "parentesco") {
                    continue;
                }
                // Verificar se é o último elemento
                $currentIndex = array_search($key, $inputsKeys);
                if ($currentIndex < $inputsCount - 1) {
                    $sql .= $key . ", ";
                    $val .= ":" . $key . ", ";
                } else {
                    $sql .= $key . ")";
                    $val .= ":" . $key . ")";
                    $sql .= $val;
                }
            }
            $cmd = $this->con->prepare($sql);
            foreach ($inputs as $key => $value) {
                if ($key == "parentesco") {
                    continue;
                }
                $cmd->bindValue(":" . $key, $value);
            }
            $verif = $this->verifInscricao($inputs['idUserUtente']);

            if ($verif) {
                return array("mensagem" => "Inscrição já realizada", "sc" => "eu", "res" => false, "dados" => $inputs);
            }

            if ($cmd->execute()) {
                return array("mensagem" => "Inscrição feita com sucesso", "res" => true, "dados" => $inputs);
            } else {
                return array("mensagem" => "Não foi possível fazer a inscrição", "sc" => "eex", "res" => false, "dados" => $inputs);
            }


        } catch (Exception $e) {
            return array("mensagem" => "Houve um erro", "sc" => "exc", "res" => false, "dados" => $inputs);

        }

    }

    // FUNÇÃO PARA ATUALIZAR UM UTENTE NUM DETERMINADO SERVIÇO
    public function atualizarInscricao($inputs)
    {

        $cmd = $this->con->prepare("UPDATE Inscricao SET
                        observacao = ?, relatorio = ?, grauAutonomia = ?, comQuemVive = ?, temApoioAlguem = ?, motivoSolicitacao = ?, serSocio = ?, pontuacaoCriterio = ?, tecnicoVisitou = ?, dataVisitaDomicilio = ?
                        WHERE idInscricao = ?
        ");
        $cmd->bindValue(1, $inputs['observacao']);
        $cmd->bindValue(2, $inputs['relatorio']);
        $cmd->bindValue(3, $inputs['grauAutonomia']);
        $cmd->bindValue(4, $inputs['comQuemVive']);
        $cmd->bindValue(5, $inputs['temApoioAlguem']);
        $cmd->bindValue(6, $inputs['motivoSolicitacao']);
        $cmd->bindValue(7, $inputs['serSocio']);
        $cmd->bindValue(8, $inputs['pontuacaoCriterio']);
        $cmd->bindValue(9, $inputs['tecnicoVisitou']);
        $cmd->bindValue(10, $inputs['dataVisitaDomicilio']);
        $cmd->bindParam(11, $inputs['idInscricao']);

        try {
            if ($cmd->execute()) {
                return array("mensagem" => "Inscrição atualizada com sucesso", "res" => true, "dados" => $inputs);
            } else {
                return array("mensagem" => "Não foi possível atualizar a inscrição", "sc" => "exec", "res" => false, "dados" => $inputs);
            }


        } catch (Exception $e) {
            return array("mensagem" => "Houve um erro", "sc" => "excep", "res" => false, "dados" => $inputs);

        }

    }
    // FUNÇÃO PARA ATUALIZAR UM UTENTE NUM DETERMINADO SERVIÇO
    public function respostaInscricao($inputs)
    {
    
        $dataAtual = date('Y-m-d');
        $cmd = $this->con->prepare("UPDATE Inscricao SET
                        respostaServico = ?, tecnicoRespondeu = ?, dataResposta = ?
                        WHERE idInscricao = ?
                        ");
        $cmd->bindValue(1, $inputs['respostaServico']);
        $cmd->bindValue(2, $inputs['tecnicoRespondeu']);
        $cmd->bindValue(3, $dataAtual);
        $cmd->bindParam(4, $inputs['idInscricao']);

        try {
            if ($cmd->execute()) {
                return array("mensagem" => "Inscrição atualizada com sucesso", "res" => true, "dados" => $inputs);
            } else {
                return array("mensagem" => "Não foi possível atualizar a inscrição", "sc" => "exec", "res" => false, "dados" => $inputs);
            }


        } catch (Exception $e) {
            return array("mensagem" => "Houve um erro", "sc" => "excep", "res" => false, "dados" => $inputs);

        }

    }
    public function verifRespUtente($inputs)
    {
        $cmd = $this->con->prepare("SELECT * FROM ResponsavelUtente WHERE idUserUtente = ? AND idUserResponsavel = ?");
        $cmd->bindParam(1, $inputs['idUserUtente']);
        $cmd->bindParam(2, $inputs['idUserResponsavel']);

        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Função para retornar uma inscrição
    public function obterInscricao($input)
    {
        $cmd = $this->con->prepare("SELECT * FROM Inscricao i INNER JOIN User u ON u.idUser = i.idUserUtente 
                                    INNER JOIN ResponsavelUtente ru ON u.idUser = ru.idUserUtente
                                    WHERE ru.idUserUtente = ?");
        $cmd->bindParam(1, $input);
        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return $cmd->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    // Função para retornar um User da tabela ResponsavelUtente
    public function obterResponUtente($input)
    {
        $cmd = $this->con->prepare("SELECT * FROM ResponsavelUtente
                                    WHERE idUserUtente = ?");
        $cmd->bindParam(1, $input);
        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return $cmd->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Função para verificar uma determinada inscrição
    public function verifInscricao($input)
    {
        $cmd = $this->con->prepare("SELECT * FROM Inscricao WHERE idUserUtente = ?");
        $cmd->bindParam(1, $input);
        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Método faz atualização de um idoso
    public function atualizarIdoso($dados)
    {

        
        $cmd = $this->con->prepare("UPDATE User SET nome = ?, apelido = ?, sexo = ?, dataNascimento = ?
        WHERE idUser = ?");

        $cmd->bindValue(1, $dados->nome);
        $cmd->bindValue(2, $dados->apelido);
        $cmd->bindValue(3, $dados->sexo);
        $cmd->bindValue(4, $dados->dn);
        $cmd->bindParam(5, $dados->id);

        if ($cmd->execute()) {
            return "sucesso";
        } else {
            return "insucesso";
        }
    }


    // Método deleta um idoso. Recebe um parâmetro (id)
    public function eliminarIdoso($id)
    {

        $cmd = $this->con->prepare("DELETE FROM User
                                    WHERE idUser = ?");
        $cmd->bindParam(1, $id);
        try {
            if ($cmd->execute()) {

                return "sucesso";
            } else {
                return "insucesso";
            }
        } catch (Exception $e) {
            return "Idoso nao pode ser eliminado";
        }
    }


    // PROCESSO

    // Função para retornar um processo de utente
    public function obterProcessoUtente($input)
    {
        $cmd = $this->con->prepare("SELECT * FROM ProcessoUtente pu INNER JOIN User u ON u.idUser = pu.idUserUtente 
                                    WHERE pu.idUserUtente = ?");
        $cmd->bindParam(1, $input);
        if ($cmd->execute() && $cmd->rowCount() > 0) {
            return $cmd->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    public function inserirProcessoUtente($inputs)
    {
        $cmd = $this->con->prepare("INSERT INTO ProcessoUtente(idUserUtente, socioNumero, contratoNumero, dataSaida, motivoSaida, habilitLiteraria, historiaVida, gostosPessoais)VALUES(?,?,?,?,?,?,?,?)                                    
                                    ");

        $cmd->bindParam(1, $inputs["idUserUtente"]);
        $cmd->bindParam(2, $inputs["socioNumero"]);
        $cmd->bindParam(3, $inputs["contratoNumero"]);
        $cmd->bindParam(4, $inputs["dataSaida"]);
        $cmd->bindParam(5, $inputs["motivoSaida"]);
        $cmd->bindParam(6, $inputs["habilitLiteraria"]);
        $cmd->bindParam(7, $inputs["historiaVida"]);
        $cmd->bindParam(8, $inputs["gostosPessoais"]);

        if ($cmd->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

?>