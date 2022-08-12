<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizarHtmlTrait;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    use RenderizarHtmlTrait;
    public function __construct()
    {
    }

    public function processarRequisicao(): void
    {
        // $_SESSION['tipoMensagem']
        echo $this->renderizarHtml('cursos/formulario.php', [
            'titulo' => 'Novo curso'
        ]);
        // require __DIR__ . '/../../view/cursos/formulario.php';
    }
}
