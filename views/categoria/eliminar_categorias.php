
<?php
    require_once __DIR__ . '/../../controllers/CategoriaController.php';

    if (isset($_GET['id'])) {
        $codigo_categoria = intval($_GET['id']);

        // Llamar al método del controlador
        $resultado = CategoriaController::eliminar_ca($codigo_categoria);

        if ($resultado === "OK") {
            header("Location: listar_categorias.php?msg=eliminado");
            exit;
        } else {
            header("Location: listar_categorias.php?error=" . urlencode($resultado));
            exit;
        }
    } else {
        header("Location: listar_categorias.php?error=ID no especificado");
        exit;
    }
?>