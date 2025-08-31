<?php
    require_once __DIR__ . '/../models/UnidadMedidaModel.php';
    require_once __DIR__ . '/../entities/Unidades_Medidas.php';

    class UnidadesMedidasController
    {
        public static function listado_um($cTexto)
        {
            $datos = new UnidadMedidaModel();
            return $datos->listar($cTexto);
        }

        public static function guardar_um($nOpcion, Unidades_Medidas $oUm)
        {
            $datos = new UnidadMedidaModel();
            return $datos->guardar($nOpcion, $oUm);
        }

        public static function editar_um(Unidades_Medidas $oUm)
        {
            $datos = new UnidadMedidaModel();
            return $datos->guardar(2, $oUm); // 2 = actualizar
        }

        public static function eliminar_um($Codigo_um)
        {
            $datos = new UnidadMedidaModel();
            return $datos->eliminar($Codigo_um);
        }

    }

    //procesando la creacion de una unidad de medida
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? '';

        if ($accion === 'crear') {
            $abreviatura = trim($_POST['abreviatura_um'] ?? '');
            $descripcion = trim($_POST['descripcion_um'] ?? '');

            if ($abreviatura === '' || $descripcion === '') {
                echo "<scrip>alert('Falta ingresar datos requeridos (*)'); window.history.back();)</scrip>";
                exit;
            }

            $um = new Unidades_Medidas();
            $um->setAbreviaturaUm($abreviatura);
            $um->setDescripcionUm($descripcion);

            $respuesta = UnidadesMedidasController::guardar_um(1, $um);

            if ($respuesta) {
                header("Location: ../views/unidades_medida/listar_unidades.php");
                exit;
            } else {
                header("Location: ../views/unidades_medida/crear_unidades.php?error=" . urlencode($respuesta));
                exit;
            }
        }
    }
?>