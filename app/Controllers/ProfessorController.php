<?php 

require_once "UserController.php";

class ProfessorController {
    public function index() {
        UserController::verificarAcesso(['professor',  'diretor']);
        echo "Bem-vindo(a), ". $_SESSION['perfil'] ."(a) " . $_SESSION['nome'] ."!";
    }
}