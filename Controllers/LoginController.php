<?php
// classe para carregar a view de apis
class LoginController extends Controller
{
    public $titulo;

    public function index($param)
    {
        $this->js = "\n\t\t<script src='../Controllers/JS/User/login.js'></script>\n\n\n"; //arquivo javascript a ser colocado no fim da página
        $this->formatacao = '../Formatacao/login.css';
        $this->titulo = "Login";
        if (isset($param['form']) && $param['form']) {
            // Verificar se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verificar as credenciais de login
                $email = htmlspecialchars(addslashes($_POST["email"]));
                $senha = htmlspecialchars(addslashes($_POST["senha"]));

                if (filter_var($email, FILTER_VALIDATE_EMAIL) && $senha != "") {

                    $reg = new User();
                    $reg = $reg->login($email);


                    if ($reg != false) {
                        if (password_verify($senha, $reg['senha'])) {

                            $_SESSION['user'] = $reg['descricao'];
                            $_SESSION['idUser'] = $reg['idUser'];
                            $_SESSION['funcionario'] = $reg['nome'] . " ".$reg['apelido'];
                            // Redirecionar para a página após o login bem-sucedido
                            header("Location: /Gaan/index.php");
                            exit();
                        } else {
                            //Necessita de correção, redirecionamento incorreto à página de login
                            header("Location: ../../login");
                            exit();
                        }

                    } else {
                        //Necessita de correção, redirecionamento incorreto à página de login
                        header("Location: ../../login");
                        exit();
                    }

                } else {
                    //Necessita de correção, redirecionamento incorreto à página de login
                    header("Location: ../../login");
                    exit();
                }
            }

        } else {

            $this->carregarTemplate("login");
        }
    }
}

?>