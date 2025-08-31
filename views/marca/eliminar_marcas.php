
<?php
    require_once __DIR__ . '/../../controllers/MarcaController.php';

    if (isset($_GET['id'])) {
        $codigo_marca = intval($_GET['id']);

        // Llamar al método del controlador
        $resultado = MarcaController::eliminar_ma($codigo_marca);

        if ($resultado === "OK") {
            header("Location: listar_marcas.php?msg=eliminado");
            exit;
        } else {
            header("Location: listar_marcas.php?error=" . urlencode($resultado));
            exit;
        }
    } else {
        header("Location: listar_marcas.php?error=ID no especificado");
        exit;
    }
?>
