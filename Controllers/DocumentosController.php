<?php

class DocumentosController extends Controller
{

    #Função chamada por padrão quando não for passado o método
    public function index()
    {
        $this->verDocumentos();
    }


    #Chama o view ver-idoso, passando um array de resgistos obtidos do Model, que por sua vez exibe todos os documentos registados
    public function verDocumentos()
    {
        if (API) { //Chama api se a constante for verdadeira

            die("<h1>PÁGINA NÃO PODE SER ACESSADA ATRAVÉS DE API!</h1>");


        } else { //Se a constante API for falsa significa que o usuário não quer acessar api


            $this->js = "\n<script src='../Controllers/JS/Documentos/obterDocumentos.js'></script>"; //arquivo javascript a ser colocado no fim da página
            $this->formatacao = '../Formatacao/estilo.css';
            $this->titulo = "Ver Documentos";
            $this->carregarTemplate('Documentos/verDocumentos'); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
        }
    }

    #Chama o view registar_documento para adicionar um novo documentos
    public function registarDocumento()
    {
        $this->js = "\n<script src='../../Controllers/JS/Documentos/registarDocumento.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->formatacao = '../../Formatacao/estilo.css';
        $this->titulo = "Registar Documento";

        $idoso = new Idoso();
        $func = new Funcionario();
        $idosos = $idoso->obterIdosos();
        $func = $func->obterFuncionarios();
        $dados = array("func" => $func, "idosos" => $idosos);

        $this->carregarTemplate('Documentos/registarDocumento', $dados); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }

    public function detalhes($parametro){
        if(API){ //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js =  "\n<script src='../../../Controllers/JS/Documentos/detalhes.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Detalhes de um documento";
        $this->formatacao = '../../../Formatacao/estilo.css';
        $doc = new Documento();
        $dados = $doc->obterDocumentoPorId($parametro[0]);
        $this->carregarTemplate('Documentos/detalhes', $dados); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }


}

?>