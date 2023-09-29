<?php 
// classe para carregar a view de apis
class ApisController extends Controller{
    public $titulo;

    public function index(){
        $this->titulo = "APIs";
        $this->carregarTemplate("apis");
    }
}

?>