
<?php
    require_once __DIR__ . '/../../controllers/AlmacenController.php';
    require_once __DIR__ . '/../../entities/Almacenes.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $codigo = $_POST['codigo_al'];
        $descripcion = $_POST['descripcion_al'];

        // Crear objeto
        $almacen = new Almacenes();
        $almacen->setCodigoAl($codigo);
        $almacen->setDescripcionAl($descripcion);

        // Llamar al controlador
        $resultado = AlmacenController::editar_al($almacen);

        if ($resultado === "OK") {
            header("Location: listar_almacenes.php?msg=editado");
            exit;
        } else {
            echo "❌ Error al actualizar: " . $resultado;
        }
    }else{
        header("Location: listar_almacenes.php");
        exit;
    }
?>
