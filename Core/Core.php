<?php
class Core
{
    public $controller;
    public $metodo;
    public $parametros = array();
    public function __construct()
    {
        $this->path();
        $this->run();
    }

    public function path()
    { //funcao responsavel para obter o controller, metodo e parametro (se existir)

        if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

            define("API", false);
            // Obter a página atual
            $url = str_replace("index.php", "Views", $_SERVER['PHP_SELF']);
            $url = explode("/", $url);
            if (end($url) == "at") {
                $url = array_slice($url, -5, 5);
                if ($url[2] == 'form') {

                    $controller = ucfirst($url[0]) . "Controller";
                    $c = new $controller;
                    call_user_func_array(array($c, $url[1]), array(array("form" => true, "idUserUtente" => $url[3]))); //funcao executa metodo de uma classe e passa parametros caso existir
                }
            } else {

                $end = array_slice($url, -2, 1);
                if ($end[0] == "form") {
                    $url = array_slice($url, -4, 4);
                    if ($url[2] == 'form') {
                        $controller = ucfirst($url[0]) . "Controller";
                        $c = new $controller;
                        call_user_func_array(array($c, $url[1]), array(array("form" => true))); //funcao executa metodo de uma classe e passa parametros caso existir
                    }
                } else {
                    $url = array_slice($url, -3, 3);
                    if ($url[2] == 'form') {
                        $controller = ucfirst($url[0]) . "Controller";
                        $c = new $controller;
                        call_user_func_array(array($c, $url[1]), array(array("form" => true))); //funcao executa metodo de uma classe e passa parametros caso existir
                    }
                }
            }


        } else {
            if (isset($_SERVER['REQUEST_URI'])) {
                $url = $_SERVER['REQUEST_URI'];

            }

            //possui informação após domínio
            if (!empty($url)) {
                $url = explode('/', trim($url, '/'));
                if (count($url) > 2) {
                    // Retiramos as duas primieras posições porque não nos interessam
                    if ($url[0] == 'Gaan') {
                        array_shift($url);

                    }
                    if ($url[0] == 'index.php') {
                        array_shift($url);

                    }

                    if (count($url) > 0) { //Se for maior que zero significa que há alguma coisa na url


                        if (lcfirst($url[0]) == "api") { //Para saber se o usuário quer acessar api
                            define("API", true);
                            array_shift($url);

                        } else {
                            define("API", false);
                        }
                        $this->controller = ucfirst($url[0]) . 'Controller'; //obtemos o nome da respetiva classe que se pretende executar
                        array_shift($url); //retiramo-lo da variavel

                        if (count($url) > 0) { //casop for verdade obtemos o método pretendido
                            $this->metodo = str_replace("-", "_", lcfirst($url[0])); //substitui-se o - por _ que vem na url

                            array_shift($url); //retira-se o método da url
                        } else {
                            $this->metodo = 'index'; //caso não existir método
                        }

                        if (count($url) > 0) { //se for maior que 0 significa que há parâmetros
                            $this->parametros = $url;
                        }
                    } else {
                        //caso não houver controller e metodo atribui-se valores padroes
                        $this->controller = 'HomeController';
                        $this->metodo = 'index';

                    }

                } else {
                    //caso não houver controller e metodo atribui-se valores padroes
                    $this->controller = 'HomeController';
                    $this->metodo = 'index';

                }

            } else {
                //caso não houver controller e metodo atribui-se valores padroes
                $this->controller = 'HomeController';
                $this->metodo = 'index';

            }
        }
    }
    public function run()
    { //funcao responsavel por correr o programa

        $caminho = 'Controllers/' . $this->controller . '.php';

        if (!file_exists($caminho)) { //caso nao existir classe interrompe-se o progresso
            die("<h1>Página não encontrada</h1>");

        } elseif (!method_exists($this->controller, $this->metodo)) {
            die("<h1>Página não encontrada</h1>");
        }
        $c = new $this->controller; //cria-se objeto da classe
        call_user_func_array(array($c, $this->metodo), array($this->parametros)); //funcao executa metodo de uma classe e passa parametros caso existir


    }
}