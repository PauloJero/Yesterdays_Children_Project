<?php 
// classe para carregar a view de apis
class RegistoController extends Controller{
    public $titulo;

    public function index(){
        $perfil = new Perfil();
        $perfil = $perfil->getPerfil();
        $this->js =  "\n\t\t<script src='../Controllers/JS/User/registo.js'></script>\n\n\n"; //arquivo javascript a ser colocado no fim da página
        $this->formatacao = '../Formatacao/User.css';
        $this->titulo = "Registo";
        $this->carregarTemplate("registo", $perfil);
    }
}

?>