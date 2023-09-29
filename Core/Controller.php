<?php

class Controller { //classe a ser herdada por todas as outras
    public $dados = array();
    public $dados2 = array();
    public $titulo; //title a ser atribuido dinamicamente conforme a pagina acessada
    public $js; //receberá ficheiro javascript a ser carregado
    public $formatacao; //Receberá a formatação a ser incluída na página

    public function carregarTemplate($nomeView, $dadosModel = array(), $dadosModel2 = array()) { //metodo responsavel por carregar template
        $this->dados = $dadosModel;
        $this->dados2 = $dadosModel2;
        include 'Views/template.php';
        
        
        
    }

    //metodo responsavel por carregar o view no template
    public function carregarViewNoTemplate($nomeView, $dadosModel = array(), $dadosModel2 = array()){
        $this->dados = $dadosModel;
        $this->dados2 = $dadosModel2;
        include 'Views/'.$nomeView . '.php';
        echo $this->js; //despeja-se o ficheiro javascript da respetiva página no fim.
    }
}