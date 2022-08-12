<?php

use Alura\Cursos\Controller\{
    FormularioEdicao,
    Exclusao, 
    FormularioInsercao,
    FormularioLogin,
    ListarCursos,
    Logout,
    Persistencia,
    RealizarLogin
};

return [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class,
    '/excluir-curso' => Exclusao::class,
    '/editar-curso' => FormularioEdicao::class,
    '/login' => FormularioLogin::class,
    '/realizar-login' => RealizarLogin::class,
    '/logout' => Logout::class
];

/* $rotas = [
    '/listar-cursos' => ListarCursos::class,
    '/novo-curso' => FormularioInsercao::class,
    '/salvar-curso' => Persistencia::class
];

return $rotas; */