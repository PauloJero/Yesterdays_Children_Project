<?php
//Classe é chamada se não for digitado nada na url
class HomeController extends Controller{
    public $titulo;

    public function index(){
        $this->titulo = "Home";
        $this->carregarTemplate('home');
    }
}