<?php

class FuncionariosController extends Controller
{

    #Função chamada por padrão quando não for passado o método
    public function index()
    {
        $this->verFuncionarios(array());
    }


    #Chama o view ver_cuidadores, passando um array de resgistos obtidos do Model, que por sua vez exibe todos os cuidadores registados
    public function verFuncionarios($parametro)
    {
        if (API) { //Chama api se a constante for verdadeira
            $pessoa = new Funcionario();
            if( count($parametro) > 0){ //verificamos se há algum parâmetro passado
                //Se for mais do que 1 matamos o processo e apresentamos uma mensagem
                if(count($parametro) > 1){
                    die("<h1>PARÂMETROS A MAIS!</h1>");
                }
                //fazemos a consulta e obtemos a resposta que é condificada em JSON
                $res = json_encode($pessoa->obterFuncionarioPorId($parametro[0]));
                //exibimos a resposta json e interrompemos o seguimento com o método exit()
                print_r($res);
                exit();

            } else { //Caso não tiver qualquer parâmetro

                $res = json_encode($pessoa->obterFuncionarios());

                print_r($res);
                exit();
            }

        } else { //Se a constante API for falsa significa que o usuário não quer acessar api

            $this->js =  "\n<script src='../Controllers/JS/Funcionarios/verFuncionarios.js'></script>"; //arquivo javascript a ser colocado no fim da página
            $this->formatacao = '../Formatacao/estilo.css';
            $this->titulo = "Ver Funcionários";
            $this->carregarTemplate('Funcionarios/verFuncionarios'); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
        }
    }

    #Chama o view registar_funcionario para adicionar um novo cuidador
    public function registar_funcionario()
    {
        if(API){ //Para não permitir que usuário entre nesta view através de api
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js =  "\n<script src='../../Controllers/JS/Funcionarios/registar_funcionario.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Registar um funcionário";
        $this->formatacao = '../../Formatacao/estilo.css';
        $this->carregarTemplate('Funcionarios/registar_funcionario'); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }

    public function detalhes($parametro){
        if(API){ //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js =  "\n<script src='../../../Controllers/JS/Funcionarios/detalhes.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Detalhes de um funcionário";
        $this->formatacao = '../../../Formatacao/Funcionarios/detalhes.css';
        $funcio = new Funcionario();
        $dados = $funcio->obterFuncionarioPorId($parametro[0]);
        $this->carregarTemplate('Funcionarios/detalhes', $dados); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }

}

?>