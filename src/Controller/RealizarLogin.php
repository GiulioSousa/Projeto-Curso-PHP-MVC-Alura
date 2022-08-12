<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin extends ControllerCaminhos implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function processarRequisicao(): void
    {
        $email = filter_input(
            type: INPUT_POST,
            var_name: 'email',
            filter: FILTER_VALIDATE_EMAIL
        );

        if (is_null($email) || $email === false) {
            $this->definirMensagem('danger', "O e-mail digitado não é um e-mail válido");
            // $_SESSION['tipoMensagem'] = 'danger';
            // $_SESSION['mensagem'] = "O e-mail digitado não é um e-mail válido";
            header('location: /login');
            return;
        }
        
        /* $senha = filter_input(
            type: INPUT_POST,
            var_name: 'senha',
            filter: FILTER_SANITIZE_STRING
        ); */
        
        $senha = strip_tags($_POST['senha']);
        // $senha = $_POST['senha'];
        
        $email = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);
        
        if (is_null($email) || !$email->senhaEstaCorreta($senha)) {
            $this->definirMensagem('danger', "E-mail ou senha inválidos");
            // $_SESSION['tipoMensagem'] = 'danger';
            // $_SESSION['mensagem'] = "E-mail ou senha inválidos";
            header('location: /login');
            return;
        }

        // $_SESSION['tipoMensagem'] = null;
        $_SESSION['logado'] = true;

        // $pass = password_hash('123456', PASSWORD_BCRYPT);

        header('location: /listar-cursos');
    }
}
