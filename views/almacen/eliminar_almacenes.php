
<?php
    require_once __DIR__ . '/../../controllers/AlmacenController.php';

    if (isset($_GET['id'])) {
        $codigo_almacen = intval($_GET['id']);

        // Llamar al método del controlador
        $resultado = AlmacenController::eliminar_al($codigo_almacen);

        if ($resultado === "OK") {
            header("Location: listar_almacenes.php?msg=eliminado");
            exit;
        } else {
            header("Location: listar_almacenes.php?error=" . urlencode($resultado));
            exit;
        }
    } else {
        header("Location: listar_almacenes.php?error=ID no especificado");
        exit;
    }
?>