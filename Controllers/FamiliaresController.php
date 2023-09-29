<?php

class FamiliaresController extends Controller
{

    #Função chamada por padrão quando não for passado o método
    public function index()
    {
        $this->verFamiliares(array());
    }


    #Chama o view ver-idoso, passando um array de resgistos obtidos do Model, que por sua vez exibe todos os familiares registados
    public function verFamiliares($parametro = array())
    {
        if(API){//Chama api se a constante for verdadeira
            $pessoa = new Familiar();

             if( count($parametro) > 0){ //verificamos se há algum parâmetro passado
                //Se for mais do que 1 matamos o processo e apresentamos uma mensagem
                if(count($parametro) > 1){
                    die("<h1>PARÂMETROS A MAIS!</h1>");
                }
                //fazemos a consulta e obtemos a resposta que é condificada em JSON
                 $res = json_encode($pessoa->obterFamiliarPorId($parametro[0]));
                //exibimos a resposta json e interrompemos o seguimento com o método exit()
                 print_r($res);
                 exit();
             }else{ //Caso não tiver qualquer parâmetro
 
                 $res = json_encode($pessoa->obterFamiliares());
     
                 print_r($res);
                 exit();
             }
 
         }else{//Se a constante API for falsa significa que o usuário não quer acessar api
 
 
             $this->js =  "\n<script src='../Controllers/JS/Familiares/verFamiliares.js'></script>"; //arquivo javascript a ser colocado no fim da página
             $this->formatacao = '../Formatacao/estilo.css';
             $this->titulo = "Ver Familiares";
             
             $this->carregarTemplate('Familiares/verFamiliares'); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
         }
       
    }
    public function detalhes($parametro){
        if(API){ //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js =  "\n<script src='../../../Controllers/JS/Familiares/detalhes.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Detalhes de um familiar";
        $this->formatacao = '../../../Formatacao/Familiares/detalhes.css';
        $fam = new Familiar();
        $dados = $fam->obterFamiliarPorId($parametro[0]);
        $this->carregarTemplate('Familiares/detalhes', $dados); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }

}

?>