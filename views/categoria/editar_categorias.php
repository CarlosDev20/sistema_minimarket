
<?php
    require_once __DIR__ . '/../../controllers/CategoriaController.php';
    require_once __DIR__ . '/../../entities/Categorias.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $codigo = $_POST['codigo_ca'];
        $descripcion = $_POST['descripcion_ca'];

        // Crear objeto
        $categoria = new Categorias();
        $categoria->setCodigoCa($codigo);
        $categoria->setDescripcionCa($descripcion);

        // Llamar al controlador
        $resultado = CategoriaController::editar_ca($categoria);

        if ($resultado === "OK") {
            header("Location: listar_categorias.php?msg=editado");
            exit;
        } else {
            echo "❌ Error al actualizar: " . $resultado;
        }
    }else{
        header("Location: listar_categorias.php");
        exit;
    }
?>