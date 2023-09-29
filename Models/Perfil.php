<?php
require_once('Conexao.php');
class Perfil extends Conexao
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }




    
    public function getPerfil()
    {
        $cmd = $this->con->query("SELECT * FROM Perfil");

        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

}

?>