<?php
require_once('Conexao.php');
class Familiar extends Conexao
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }


    // Método retorna todos os familiares
    public function obterFamiliares()
    {

        $cmd = $this->con->query("SELECT *
                                FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil
                                WHERE p.descricao = 'familiar' ORDER BY u.nome, u.apelido
                                ");

        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function filtrarFamiliares($nome, $apelido)
    {
        $cmd = $this->con->prepare("SELECT * FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil WHERE p.descricao = 'familiar' AND CONCAT(nome, ' ', apelido) LIKE :nome OR :apelido ORDER BY u.nome, u.apelido");

        $cmd->bindValue(':nome', "%{$nome}%", PDO::PARAM_STR);
        $cmd->bindValue(':apelido', "%{$apelido}%", PDO::PARAM_STR);
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    // Retorna um idoso. Recebe um parâmetro (id)
    public function obterFamiliarPorId($id)
    {

        $cmd = $this->con->prepare("SELECT *
        FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil
        WHERE p.descricao = 'familiar' AND idUser = ?");
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

}

?>