
<?php
    require_once __DIR__ . '/../../controllers/RubroController.php';
    require_once __DIR__ . '/../../entities/Rubros.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $codigo = $_POST['codigo_ru'];
        $descripcion = $_POST['descripcion_ru'];

        // Crear objeto
        $rubros = new Rubros();
        $rubros->setCodigoRu($codigo);
        $rubros->setDescripcionRu($descripcion);

        // Llamar al controlador
        $resultado = RubroController::editar_ru($rubros);

        if ($resultado === "OK") {
            header("Location: listar_rubros.php?msg=editado");
            exit;
        } else {
            echo "❌ Error al actualizar: " . $resultado;
        }
    }else{
        header("Location: listar_rubros.php");
        exit;
    }
?>