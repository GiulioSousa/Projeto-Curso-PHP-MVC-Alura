<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizarHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao implements InterfaceControladorRequisicao
{
    use RenderizarHtmlTrait;
    
    private $repositorioCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function processarRequisicao(): void
    {
        $id = filter_input(
            type: INPUT_GET,
            var_name: 'id',
            filter: FILTER_VALIDATE_INT
        );

        if(is_null($id) || $id === false) {
            header('location: /listar-cursos');
            return;
        }

        $curso = $this->repositorioCursos->find($id);
        echo $this->renderizarHtml('cursos/formulario.php', [
            'curso' => $curso,
            'titulo' => "Editar Curso: {$curso->getDescricao()}"
        ]);
        // $titulo = "Editar Curso: {$curso->getDescricao()}";
        // require __DIR__ . '/../../view/cursos/formulario.php';
    }
}