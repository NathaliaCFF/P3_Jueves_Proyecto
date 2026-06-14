<?php

require_once "../models/masterAccountModel.php";

class masterAccountController
{
    private $model;

    public function __construct()
    {
        $this->model = new accountModel();
    }

    public function buscarAction(): void
    {
        $id = $_GET['id'] ?? '';

        $dato = $this->model->obtenerPorCuenta($id);

        echo json_encode([
            'success' => !empty($dato),
            'datos'   => $dato
        ]);
    }

    public function listarAction(): void
    {
        $q = $_GET['q'] ?? '';

        $datos = $this->model->buscarCuenta($q);

        echo json_encode($datos);
    }

    public function guardarAction(): void
    {
        $d = json_decode(file_get_contents('php://input'), true);

        $ok = $this->model->guardar($d);

        echo json_encode([
            'success' => $ok,
            'message' => $ok ? 'Guardado correctamente' : 'Error al guardar'
        ]);
    }

    public function inactivarAction(): void
    {
        $d = json_decode(file_get_contents('php://input'), true);

        $ok = $this->model->inactivar($d['cuenta']);

        echo json_encode([
            'success' => $ok,
            'message' => $ok ? 'Cuenta inactivada' : 'Error al inactivar'
        ]);
    }
}

/*
|--------------------------------------------------------------------------
| Router simple
|--------------------------------------------------------------------------
*/

$controller = new masterAccountController();

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'buscar':
        $controller->buscarAction();
        break;

    case 'listar':
        $controller->listarAction();
        break;

    case 'guardar':
        $controller->guardarAction();
        break;

    case 'inactivar':
        $controller->inactivarAction();
        break;

    default:
        echo json_encode([
            'success' => false,
            'message' => 'Acción no válida'
        ]);
}