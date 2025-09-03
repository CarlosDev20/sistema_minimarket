<?php
// index.php
require_once __DIR__ . '/controllers/UnidadesMedidasController.php';
require_once __DIR__ . '/entities/Unidades_Medidas.php';

// Acción por defecto
$action = $_GET['action'] ?? 'listar';

switch ($action) {
    case 'listar':
        // Muestra listado
        include __DIR__ . '/views/unidades_medida/listar_unidades.php';
        break;

    case 'crear':
        // Muestra formulario para crear
        include __DIR__ . '/views/unidades_medida/crear_unidades.php';
        break;

    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $um = new Unidades_Medidas();
            $um->setAbreviaturaUm($_POST['abreviatura_um']);
            $um->setDescripcionUm($_POST['descripcion_um']);
            UnidadesMedidasController::guardar_um(1, $um);
        }
        header("Location: index.php?action=listar");
        break;

    case 'editar':
        $id = $_GET['id'] ?? null;
        if ($id) {
            include __DIR__ . '/views/unidades_medida/editar_unidades.php';
        }
        break;

    case 'actualizar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $um = new Unidades_Medidas();
            $um->setCodigoUm($_POST['codigo_um']);
            $um->setAbreviaturaUm($_POST['abreviatura_um']);
            $um->setDescripcionUm($_POST['descripcion_um']);
            UnidadesMedidasController::editar_um($um);
        }
        header("Location: index.php?action=listar");
        break;

    case 'eliminar':
        $id = $_GET['id'] ?? null;
        if ($id) {
            UnidadesMedidasController::eliminar_um($id);
        }
        header("Location: index.php?action=listar");
        break;

    default:
        echo "⚠️ Acción no válida.";
        break;
}
