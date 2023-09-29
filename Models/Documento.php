<?php

// Precisa de alteração devido as alterações feitas pelo Cami
class Documento extends Conexao
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }

    // Método para obter todos os documentos
    public function obterDocumentos()
    {
        $cmd = $this->con->query("SELECT d.idDocumento, d.caminho, d.tipo, d.origem, d.idIdoso, d.idFuncResponsavel, u.nome AS nomeU,
                                u.apelido AS apelidoU
                                 FROM documento d 
                                INNER JOIN User u
                                ON u.idUser = d.idIdoso
                                ");
        $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }
 // Método para obter todos os tipos de documentos
 public function obterTiposDocumentos()
 {
     $cmd = $this->con->query("SELECT tipo FROM documento");
     $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
     return $dados;
 }

 public function verificarDocumento($id, $nome)
    {
        $cmd = $this->con->query("SELECT * FROM documento WHERE idIdoso =".$id."AND tipo =".$nome);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            
            return true;
        } else {
            return false;
        }
    }

    // Método para obter um documento por ID
    public function obterDocumentoPorId($id)
    {
        $cmd = $this->con->prepare("SELECT d.idDocumento, d.caminho, d.tipo, d.origem, d.idIdoso, d.idFuncResponsavel, u.nome AS nomeu,
                                    u.apelido AS apelidoU
                                    FROM documento d 
                                    INNER JOIN User u
                                    ON u.idUser = d.idIdoso
                                     WHERE d.idDocumento = ?
                                 ");
        $cmd->bindValue(1, $id);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            return $dados;
        } else {
            return false;
        }
    }

    // Método para inserir um novo documento
    public function inserirDocumento($dados)
    {
        $cmd = $this->con->prepare("INSERT INTO Documento (caminho, tipo, origem, idIdoso, idFuncResponsavel) 
                                    VALUES (?, ?,?,?,?)
                                    ");

        $cmd->bindValue(1, $dados["caminho"]);
        $cmd->bindValue(2, $dados["tipo"]);
        $cmd->bindValue(3, $dados["origem"]);
        $cmd->bindValue(4, $dados["idIdoso"]);
        $cmd->bindValue(5, $dados["idFuncResponsavel"]);

        if ($cmd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para atualizar um documento existente
    public function atualizarDocumento($dados)
    {
        $cmd = $this->con->prepare("UPDATE documento SET tipo = ?, origem = ? WHERE idDocumento = ?");
        $cmd->bindValue(1, $dados['tipo']);
        $cmd->bindValue(2, $dados['origem']);
        $cmd->bindValue(3, $dados['id']);

        if ($cmd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Método para excluir um documento
    public function excluirDocumento($id)
    {
        $cmd = $this->con->prepare("DELETE FROM documento WHERE idDocumento = ?");
        $cmd->bindValue(1, $id);

        if ($cmd->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>
