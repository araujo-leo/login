<?php 
require_once "UserController.php";

class AlunoController {
    public function index() {
        UserController::verificarAcesso(['aluno', 'diretor']);

        echo "Bem-vindo(a)," . $_SESSION['perfil']."(a) " . $_SESSION['nome'] ."!";
    }
}