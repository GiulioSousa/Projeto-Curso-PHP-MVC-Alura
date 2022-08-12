<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessageTrait;

class Exclusao implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processarRequisicao(): void
    {
        $id = filter_input(
            type: INPUT_GET,
            var_name: 'id',
            filter: FILTER_VALIDATE_INT
        );

        if(is_null($id) || $id === false) {
            $this->definirMensagem('danger', "Curso inexistente");
            // $_SESSION['tipoMensagem'] = 'danger';
            // $_SESSION['mensagem'] = "Curso inexistente";
            header('location: /listar-cursos');
            return;
        }
        
        
        $curso = $this->entityManager->getReference(Curso::class, $id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->definirMensagem('success', 'Curso excluído com sucesso');
        // $_SESSION['tipoMensagem'] = 'success';
        // $_SESSION['mensagem'] = 'Curso excluído com sucesso';

        header('location: /listar-cursos');
    }
}
