<?php

require __DIR__ . '/../vendor/autoload.php';

// use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
// use Alura\Cursos\Controller\ListarCursos;
// use Alura\Cursos\Controller\Persistencia;
// use Alura\Cursos\Controller\Edicao;

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/rotas.php';

if (!array_key_exists($caminho, $rotas)) {
    // echo "Erro 404";
    http_response_code(404);
    exit();
}

session_start();

/* var_dump(stripos($caminho, 'login'));
exit(); */

// $rotaLogin = stripos($caminho, 'login');
$rotaLogin = str_contains($caminho, 'login');
// if(!isset($_SESSION['logado']) && $rotaLogin === false) {
if(!isset($_SESSION['logado']) && !$rotaLogin) {
    header('location: /login');
    exit();
}

$classeControle = $rotas[$caminho];
/** @var InterfaceControladorRequisicao $controller */
$controller = new $classeControle;
$controller->processarRequisicao();

/* switch ($_SERVER['PATH_INFO']) {
    case '/listar-cursos':
        // require 'listar-cursos.php';
        $controller = new ListarCursos();
        $controller->processarRequisicao();
        break;
    case '/novo-curso':
        // require 'formulario-novo-curso.php';
        $controller = new FormularioInsercao();
        $controller->processarRequisicao();
        break;
    case '/salvar-curso':
        $controller = new Persistencia();
        $controller->processarRequisicao();
        break;
    default:
    echo "Erro 404";
    break;
} */

/* if ($_SERVER['PATH_INFO'] === "/listar-cursos") {
    require 'listar-cursos.php';
} elseif ($_SERVER['PATH_INFO'] === "/novo-curso") {
    require 'formulario-novo-curso.php';
} else {
    echo "Erro 404";
} */
