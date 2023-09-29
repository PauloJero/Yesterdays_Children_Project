<?php
include "autoload.php";


// Verifica se a requisição foi feita por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents("php://input"));
    $dados = array();

    foreach ($input as $key => $value) {
        if ($key != 'confSenha' && $key != 'confEmail') {

            $v = htmlspecialchars(stripslashes(trim($value)));
            $dados[$key] = $v;
        }
    }
    $reg = new User();
    $reg = $reg->inserirUser($dados);
    echo json_encode($reg);


} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents("php://input"));
    $dados = array();

    foreach ($input as $key => $value) {
        if ($key != 'confSenha' && $key != 'confEmail') {

            $v = htmlspecialchars(stripslashes(trim($value)));
            $dados[$key] = $v;
        }
    }
    $reg = new User();
    $reg = $reg->atualizarUser($dados);

    echo json_encode($reg);
}
?>