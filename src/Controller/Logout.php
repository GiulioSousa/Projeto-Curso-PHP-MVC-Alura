<?php

namespace Alura\Cursos\Controller;

class Logout extends ControllerCaminhos implements InterfaceControladorRequisicao
{
    public function processarRequisicao(): void
    {
        session_destroy();
        header('location: /login');
    }
}