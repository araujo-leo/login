<?php

require_once '../config/conexao.php';
require_once '../app/Models/UserModel.php';

class UserController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {

        if (!isset($_SESSION['login'])) {
            include_once '../app/views/auth/login.php';
            if (isset($_GET['formulario_login_enviado']) && $_GET['formulario_login_enviado'] === 'true') {
                $dadosLogin = [
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                ];

                try {
                    $this->processarLogin($dadosLogin);
                } catch (Exception $e) {
                    echo 'Erro ao processar o cadastro: ' . $e->getMessage();
                }
            }
        } else {
            $this->redirecionarUsuario();
        }
    }

    private function processarLogin($dadosLogin)
    {
        $resultadoLogin = $this->userModel->loginUsuario($dadosLogin);

        if ($resultadoLogin['status']) {
            $this->redirecionarUsuario();
        } else {
            echo '<script>alert("' . $resultadoLogin['message'] . '");</script>';
        }
    }

    public static function verificarAcesso(array $perfisPermitidos)
    {

        if (!isset($_SESSION['login'])) {
            header('Location: /login/public');
            exit();
        }

        if (!in_array($_SESSION['perfil'], $perfisPermitidos)) {
            header('Location: /login/public');
            exit();
        }
    }

    private function redirecionarUsuario()
    {
        if (isset($_SESSION['perfil'])) {
            switch ($_SESSION['perfil']) {
                case 'professor':
                    header("Location: /login/public/professor");
                    exit;
                case 'diretor':
                    header("Location: /login/public/diretor");
                    exit;
                case 'aluno':
                    header("Location: /login/public/aluno");
                    exit;
                default:
                    session_destroy();
                    header("Location: /login");
                    exit;
            }
        }
    }

    public function logout() {
        session_destroy(); 
        header('Location: /login/public/'); 
        exit();
    }

}
