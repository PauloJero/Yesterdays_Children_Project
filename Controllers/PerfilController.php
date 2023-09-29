<?php 
// classe para carregar a view de apis
class PerfilController extends Controller{
    public $titulo;

    public function index(){
        $dados = new User();
        $dados = $dados->obterUser($_SESSION['idUser']);
        $this->js =  "\n\t\t<script src='../Controllers/JS/Perfil/perfil.js'></script>\n\n\n"; //arquivo javascript a ser colocado no fim da página
        $this->formatacao = '../Formatacao/perfil.css';
        $this->titulo = "Perfil";
        $this->carregarTemplate("perfil", $dados);
    }
}

?>