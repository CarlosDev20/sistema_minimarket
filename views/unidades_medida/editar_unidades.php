
<?php

    require_once __DIR__ . '/../../controllers/UnidadesMedidasController.php';
    require_once __DIR__ . '/../../entities/Unidades_Medidas.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $codigo = $_POST['codigo_um'];
        $abreviatura = $_POST['abreviatura_um'];
        $descripcion = $_POST['descripcion_um'];

        //Crear objeto

        $unidad = new Unidades_Medidas();
        $unidad->setCodigoUm($codigo);
        $unidad->setAbreviaturaUm($abreviatura);
        $unidad->setDescripcionUm($descripcion);

        // Llamar al controlador
        $resultado = UnidadesMedidasController::editar_um($unidad);

        if ($resultado === "OK") {
            header("Location: listar_unidades.php?msg=editado");
            exit;
        } else {
            echo "❌ Error al actualizar: " . $resultado;
        }
    }else{
        header("Location: listar_unidades.php");
        exit;
    }
?>