<?php
$routes = [
    '' => 'HomeController@index', 
    'login' => 'UserController@login',
    'aluno' => 'AlunoController@index', 
    'professor' => 'ProfessorController@index', 
    'diretor' => 'DiretorController@index',
    'logout' => 'UserController@logout'
];

return $routes;