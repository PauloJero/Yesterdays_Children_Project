<?php

class IdososController extends Controller
{


    #Função chamada por padrão quando não for passado o método
    public function index()
    {
        $this->verIdosos(array());
    }


    #Chama o view ver-idoso, passando um array de resgistos obtidos do Model, que por sua vez exibe todos os idosos registados
    public function verIdosos($parametro = array())
    {

        if (API) { //Chama api se a constante for verdadeira
            $pessoa = new Idoso();
            if (count($parametro) > 0) { //verificamos se há algum parâmetro passado
                //Se for mais do que 1 matamos o processo e apresentamos uma mensagem
                if (count($parametro) > 1) {
                    die("<h1>PARÂMETROS A MAIS!</h1>");
                }
                //fazemos a consulta e obtemos a resposta que é condificada em JSON
                $res = json_encode($pessoa->obterIdosoPorId($parametro[0]));
                //exibimos a resposta json e interrompemos o seguimento com o método exit()
                print_r($res);
                exit();
            } else { //Caso não tiver qualquer parâmetro

                $res = json_encode($pessoa->obterIdosos());

                print_r($res);
                exit();
            }

        } else { //Se a constante API for falsa significa que o usuário não quer acessar api
            $this->js = "\n<script src='../Controllers/JS/Idosos/verIdosos.js'></script>"; //arquivo javascript a ser colocado no fim da página
            $this->titulo = "Ver Idosos";

            $this->carregarTemplate('Idosos/verIdosos'); //carregará o template que por sua vez carregará o view alunos que depois. O segundo parâmetro ainda não será utilizado
        }

    }




    // Método para chamar a view lista de espera
    public function listaEspera($parametro = array())
    {

        if (API) {
            die("<h1>PARÂMETROS A MAIS!</h1>");
            exit();
        } else { //Se a constante API for falsa significa que o usuário não quer acessar api
            $this->js = "\n<script src='../../Controllers/JS/Idosos/listaEspera.js'></script>"; //arquivo javascript a ser colocado no fim da página
            $this->formatacao = '../../Formatacao/Idosos/listaEspera.css';
            $this->titulo = "Lista de espera";
            $idosos = new Idoso();
            $listaEspera = $idosos->listaEspera();
            $this->carregarTemplate('Idosos/listaEspera', $listaEspera); //carregará o template que por sua vez carregará o view alunos que depois. O segundo parâmetro ainda não será utilizado
        }

    }

    public function detalhes($parametro)
    {
      
        if (API) { //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js = "\n<script src='../../../Controllers/JS/Idosos/detalhes.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Detalhes de um idoso";
        $this->formatacao = '../../../Formatacao/Idosos/detalhes.css';
        $id = intval($parametro[0]);
        $idoso = new Idoso();
        $dados = $idoso->obterIdosoPorId($id);
        $dados2 = array("inscrito" => $idoso->verifInscricao($id));

        $this->carregarTemplate('Idosos/detalhes', $dados, $dados2); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }


    // Função para apresentar a view de exibir informações de inscrição de um determinado usuário
    public function verInscricao($parametro)
    {
        if (API) { //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js = "\n<script src='../../../Controllers/JS/Idosos/verInscricao.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Detalhes de inscrição de um idoso";
        $this->formatacao = '../../../Formatacao/Idosos/verInscricao.css';
        $id = intval($parametro[0]);

        $idoso = new Idoso();
        $user = new User();
        $respon = $idoso->obterResponUtente($id);
        if ($respon) {
            $responsavel = $user->obterUser($respon['idUserResponsavel']);
            $idoso = $idoso->obterInscricao($id);
            $this->carregarTemplate('Idosos/verInscricao', $idoso, $responsavel); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
        } else {
            header("Location: ../detalhes/" . $id);
            exit();
        }
    }


    // MÉTODO PARA PÁGINA DE INSCRIÇÃO
    public function inscrever($parametro)
    {
        if (API) { //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js = "\n<script src='../../../Controllers/JS/Idosos/inscricao.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Inscrição ao Serviço";
        $this->formatacao = '../../../Formatacao/Idosos/inscricao.css';

        $idoso = new Idoso();
        $dados = $idoso->obterIdosoPorId($parametro[0]);


        $familiares = new Familiar();
        $familiares = $familiares->obterFamiliares();
        $this->carregarTemplate('Idosos/inscrever', $dados, $familiares); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.
    }

    // FUNÇÃO PARA FAZER INSCRIÇÃO DOS UTENTES NUM DOS SERVIÇÕES E SEU RESPETIVO RESPONSÁVEL CASO AINDA NÃO EXISTA
    public function inserirInscricao($parametro)
    {
        echo "<title>Inscrição</title>"; //Definimos um título para a página, visto que aqui não carregamos o template
        if (isset($_POST)) { //Verificamos se existe a variável $_POST para poder dar prosseguimento à inscrição

            $inscricao = new Idoso();
            $inscricao = $inscricao->inserirInscricao($_POST); //Chamamos a função que inscreve utente que, por sua vez, retorna alguns dados que vão ajudar a saber se o User foi efetuado com sucesso ou não. E também retornamos os dados que foram enviados na eventualidade de não ser possível fazer a inscrição para voltar a preencher os respetivos campos no formulário e exibir a informação sobre o que aconteceu. Vale ressaltar ainda que redirecionamos o utilizador para uma respetiva página conforme o resultado

            if ($inscricao['res']) {
                $_SESSION['res'] = $inscricao['res'];
                $_SESSION['mensagem'] = $inscricao['mensagem'];
                header("Location: ../verInscricao/" . $inscricao['dados']['idUserUtente']);
                exit();
            } else {

                $_SESSION['dados'] = $inscricao['dados'];
                $_SESSION['mensagem'] = $inscricao['mensagem'];
                $_SESSION['res'] = $inscricao['res'];
                header("Location: ../inscrever/" . $inscricao['dados']['idUserUtente']);
                exit();
            }


        }
    }
    // FUNÇÃO PARA ATUALIZAR INSCRIÇÃO DOS UTENTES NUM DOS SERVIÇÕES E SEU RESPETIVO RESPONSÁVEL CASO AINDA NÃO EXISTA
    public function atualizarInscricao($parametro)
    {
        echo "<title>Inscrição</title>"; //Definimos um título para a página, visto que aqui não carregamos o template
        if (isset($_POST)) { //Verificamos se existe a variável $_POST para poder dar prosseguimento à inscrição
            $inscricao = new Idoso();
            $inscricao = $inscricao->atualizarInscricao($_POST); //Chamamos a função que inscreve utente que, por sua vez, retorna alguns dados que vão ajudar a saber se o User foi efetuado com sucesso ou não. E também retornamos os dados que foram enviados na eventualidade de não ser possível fazer a inscrição para voltar a preencher os respetivos campos no formulário e exibir a informação sobre o que aconteceu. Vale ressaltar ainda que redirecionamos o utilizador para uma respetiva página conforme o resultado

            if ($inscricao['res']) {
                $_SESSION['res'] = $inscricao['res'];
                $_SESSION['mensagem'] = $inscricao['mensagem'];
                header("Location: ../verInscricao/" . $inscricao['dados']['idUserUtente']);
                exit();
            } else {
                $_SESSION['dados'] = $inscricao['dados'];
                $_SESSION['mensagem'] = $inscricao['mensagem'];
                $_SESSION['res'] = $inscricao['res'];
                header("Location: ../verInscricao/" . $inscricao['dados']['idUserUtente']);
                exit();
            }


        }
    }
    // FUNÇÃO PARA ATUALIZAR INSCRIÇÃO DOS UTENTES NUM DOS SERVIÇÕES E SEU RESPETIVO RESPONSÁVEL CASO AINDA NÃO EXISTA
    public function respostaInscricao($parametro)
    {
        echo "<title>Inscrição</title>"; //Definimos um título para a página, visto que aqui não carregamos o template
        if (isset($_POST)) { //Verificamos se existe a variável $_POST para poder dar prosseguimento à inscrição
            $inscricao = new Idoso();
            $inscricao = $inscricao->respostaInscricao($_POST); //Chamamos a função que inscreve utente que, por sua vez, retorna alguns dados que vão ajudar a saber se o User foi efetuado com sucesso ou não. E também retornamos os dados que foram enviados na eventualidade de não ser possível fazer a inscrição para voltar a preencher os respetivos campos no formulário e exibir a informação sobre o que aconteceu. Vale ressaltar ainda que redirecionamos o utilizador para uma respetiva página conforme o resultado

            if ($inscricao['res']) {
                $_SESSION['res'] = $inscricao['res'];
                $_SESSION['mensagem'] = $inscricao['mensagem'];
                header("Location: ../verInscricao/" . $inscricao['dados']['idUserUtente']);
                exit();
            } else {
                $_SESSION['dados'] = $inscricao['dados'];
                $_SESSION['mensagem'] = $inscricao['mensagem'];
                $_SESSION['res'] = $inscricao['res'];
                header("Location: ../verInscricao/" . $inscricao['dados']['idUserUtente']);
                exit();
            }


        }
    }

    // MÉTODO PARA PÁGINA DE REGISTAR PROCESSO DE UM UTENTE JÁ ADMITIDO
    // Função para apresentar a view de exibir informações de inscrição de um determinado usuário
    public function registarProcesso($parametro)
    {
        if (API) { //Para não permitir que usuário entre nesta view através de api
            $this->titulo = "Página não encontrada";
            die("<h1>API NÃO ENCONTRADA</h1>");
        }
        $this->js = "\n<script src='../../../Controllers/JS/Idosos/registarProcesso.js'></script>"; //arquivo javascript a ser colocado no fim da página
        $this->titulo = "Detalhes de inscrição de um idoso";
        $this->formatacao = '../../../Formatacao/Idosos/registarProcesso.css';

        // CASO EXISTIR  A VARIÁVEL FORM
        if (isset($_POST) && isset($parametro["form"])) {
            $idoso = new Idoso();
            // SE FOR VERDADE SIGNIFICA QUE JÁ HÁ UM REGISTO DE PRECESSO
            if (!$idoso->obterProcessoUtente($_POST["idUserUtente"])) {

                if ($idoso->inserirProcessoUtente($_POST)) {
                    $processo = $idoso->obterProcessoUtente($_POST["idUserUtente"]);
                    $_SESSION["idProcesso"] = $processo["idProcesso"];
                    $_SESSION["sucesso"] = "Processo registo com sucesso";                
                    header("Location: ../../registarProcesso/" . $_POST["idUserUtente"]);
                    exit();

                } else { //Caso não for possível inserir proceso utente

                }

            } else { //CASO EXISTIR JÁ UM PROCESSO

                $processo = $idoso->obterProcessoUtente($_POST["idUserUtente"]);
                $_SESSION["existeProcesso"] = "Já existe um processo";    
                $_SESSION["idProcesso"] = $processo["idProcesso"];            
                header("Location: ../../registarProcesso/" . $_POST["idUserUtente"]);
                exit();
            }

        } else {
            $id = intval($parametro[0]);
            $idoso = new Idoso();
            $dadosIdoso = $idoso->obterInscricao($id);
            $processo = $idoso->obterProcessoUtente($dadosIdoso['idUserUtente']);
            if(!$processo) $_SESSION["idProcesso"] = 0;
            if($processo) $_SESSION["idProcesso"] = $processo["idProcessoUtente"];
            $this->carregarTemplate('Idosos/registarProcesso', $dadosIdoso, $processo); #Carrega o template que por sua vez exibe o view requerido, passando dados ou não.

        }
    }
}

?>