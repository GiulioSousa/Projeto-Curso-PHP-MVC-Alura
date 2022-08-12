<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizarHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControladorRequisicao
{
    use RenderizarHtmlTrait;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }
    public function processarRequisicao(): void
    {
        echo $this->renderizarHtml('cursos/listar-cursos.php', [
            'cursos' => $this->repositorioDeCursos->findAll(),
            'titulo' => 'Lista de cursos'
        ]);
    }
}
