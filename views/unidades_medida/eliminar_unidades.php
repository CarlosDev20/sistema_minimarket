
<?php
require_once __DIR__ . '/../../controllers/UnidadesMedidasController.php';

if (isset($_GET['id'])) {
    $codigo_um = intval($_GET['id']);

    // Llamar al modelo desde el controlador
    $resultado = UnidadesMedidasController::eliminar_um($codigo_um);

    if ($resultado === "OK") {
        header("Location: listar_unidades.php?msg=eliminado");
        exit;
    } else {
        header("Location: listar_unidades.php?error=" . urlencode($resultado));
        exit;
    }
} else {
    header("Location: listar_unidades.php?error=ID no especificado");
    exit;
}

