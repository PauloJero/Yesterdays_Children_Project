<?php
require_once('Conexao.php');
class Funcionario extends Conexao
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }


    // Método retorna todos os Funcionarios
    public function obterFuncionarios()
    {

        $cmd = $this->con->query("SELECT *
                                FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil 
                                WHERE p.descricao = 'funcionario' ORDER BY u.nome, u.apelido
                                ");

        $dados = $cmd->fetchall(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function filtrarFuncionarios($nome, $apelido)
    {
        $cmd = $this->con->prepare("SELECT * FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil WHERE p.descricao = 'funcionario' AND CONCAT(nome, ' ', apelido) LIKE :nome OR :apelido ORDER BY u.nome, u.apelido");

        $cmd->bindValue(':nome', "%{$nome}%", PDO::PARAM_STR);
        $cmd->bindValue(':apelido', "%{$apelido}%", PDO::PARAM_STR);
        $cmd->execute();
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
    // Retorna um Funcionario. Recebe um parâmetro (id)
    public function obterFuncionarioPorId($id)
    {

        $cmd = $this->con->prepare("SELECT *
        FROM User u INNER JOIN Perfil p ON u.idPerfil = p.idPerfil
        WHERE p.descricao = 'funcionario' AND idUser = ?");
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