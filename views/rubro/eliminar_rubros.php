
<?php
    require_once __DIR__ . '/../../controllers/RubroController.php';

    if (isset($_GET['id'])) {
        $codigo_rubro = intval($_GET['id']);

        // Llamar al método del controlador
        $resultado = RubroController::eliminar_ru($codigo_rubro);

        if ($resultado === "OK") {
            header("Location: listar_rubros.php?msg=eliminado");
            exit;
        } else {
            header("Location: listar_rubros.php?error=" . urlencode($resultado));
            exit;
        }
    } else {
        header("Location: listar_rubros.php?error=ID no especificado");
        exit;
    }
?>