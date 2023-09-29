<?php


include "autoload.php";

$metodo = $_SERVER["REQUEST_METHOD"];


if ($metodo == "GET") {
    $idosos = new Idoso();

    if(isset($_GET["nome"]) && isset($_GET["apelido"])){

        $res = $idosos->filtrarIdosos($_GET["nome"],$_GET["apelido"]);
    }else{

        $res = $idosos->obterIdosos();
    }
   
    echo json_encode($res);


} else if ($metodo == "POST") {


    $input = json_decode(file_get_contents("php://input"));




} else if ($metodo == "PUT") {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents("php://input"));

    $idoso = new Idoso();
    if ($input->listaEspera == "listaEspera") {
        $dados = array("respostaServico" => $input->respostaServico, "idInscricao" => $input->idInscricao, "tecnicoRespondeu" => $input->tecnicoRespondeu);
        $res = $idoso->respostaInscricao($dados);

        if($res['res']){
            $listaEspera = $idoso->listaEspera();
            $res = array("res"=>"sucesso", "dados"=>$listaEspera);
            echo json_encode($res);
        }else{
            echo json_encode("insucesso");
        }
        
    }




} elseif ($metodo == "DELETE") {

    $input = json_decode(file_get_contents("php://input"));



}


?>