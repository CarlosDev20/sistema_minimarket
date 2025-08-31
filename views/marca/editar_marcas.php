
<?php
    require_once __DIR__ . '/../../controllers/MarcaController.php';
    require_once __DIR__ . '/../../entities/Marcas.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $codigo = $_POST['codigo_ma'];
        $descripcion = $_POST['descripcion_ma'];

        // Crear objeto
        $marca = new Marcas();
        $marca->setCodigoMa($codigo);
        $marca->setDescripcionMa($descripcion);

        // Llamar al controlador
        $resultado = MarcaController::editar_ma($marca);

        if ($resultado === "OK") {
            header("Location: listar_marcas.php?msg=editado");
            exit;
        } else {
            echo "❌ Error al actualizar: " . $resultado;
        }
    }else{
        header("Location: listar_marcas.php");
        exit;
    }
?>
