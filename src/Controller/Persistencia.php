<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }
    
    public function processarRequisicao(): void
    {
        /* $descricao = filter_input(
            type: INPUT_POST, 
            var_name: 'descricao',
            filter: FILTER_SANITIZE_STRING); */

        $descricao = strip_tags(string: $_POST['descricao']);

        $curso = new Curso();
        $curso->setDescricao($descricao);

        $id = filter_input(
            type: INPUT_GET,
            var_name: 'id',
            filter: FILTER_VALIDATE_INT
        );

        if(!is_null($id) && $id !== false) {
            $curso = $this->entityManager->find(Curso::class, $id);
            $curso->setDescricao($descricao);
            $this->definirMensagem('success', "Curso de {$curso->getDescricao()} atualizado com sucesso!");
            // $_SESSION['mensagem'] = "Curso de {$curso->getDescricao()} atualizado com sucesso!";
        } else {
            $curso = new Curso();
            $curso->setDescricao($descricao);
            $this->entityManager->persist($curso);
            $this->definirMensagem('success', "Curso de {$curso->getDescricao()} adicionado com sucesso!");
            // $_SESSION['mensagem'] = "Curso de {$curso->getDescricao()} adicionado com sucesso!";
        }

        // $_SESSION['tipoMensagem'] = 'success';
        
        $this->entityManager->flush();
        header(header: 'location: /listar-cursos', replace: true, response_code: 302);
    }
}