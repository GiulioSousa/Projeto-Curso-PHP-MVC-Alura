<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizarHtmlTrait;

class FormularioLogin implements InterfaceControladorRequisicao
{
    use RenderizarHtmlTrait;
    
    public function processarRequisicao(): void
    {
        echo $this->renderizarHtml('login/formulario.php', [
            'titulo' => 'Login'
        ]);
    }
}