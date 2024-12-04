<?php 

require_once "UserController.php";

class DiretorController {
    public function index() {
        UserController::verificarAcesso(['diretor']);
        echo "Bem-vindo(a), Diretor(a) " . $_SESSION['nome'] ."!";
    }
}