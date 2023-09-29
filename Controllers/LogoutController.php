<?php
// classe para carregar a view de apis
class LogoutController extends Controller
{
    public function index()
    {
        echo "Index Logout";
        // Destroi a sessão atual
        session_destroy();

        // Redireciona para a página de login
        header('Location: ' . ROOT . '/login');
        exit();

    }
}

?>