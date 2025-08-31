
<?php
    require_once __DIR__ . '/../models/MarcaModel.php';
    require_once __DIR__ . '/../entities/Marcas.php';

    class MarcaController
    {

        public static function listado_ma($texto = "")
        {
            $datos = new MarcaModel();
            return $datos->listar($texto);
        }

        public static function guardar_ma($opcion, Marcas $marca)
        {
            $datos = new MarcaModel();
            return $datos->guardar($opcion, $marca);
        }

        public static function editar_ma(Marcas $oMa)
        {
            $datos = new MarcaModel();
            return $datos->guardar(2, $oMa); // 2 = actualizar
        }

        public static function eliminar_ma($codigo_ma)
        {
            $datos = new MarcaModel();
            return $datos->eliminar($codigo_ma);
        }
    }

    // Procesando la creacion de una marca
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? '';

        if ($accion === 'crear') {
            $descripcion = trim($_POST['descripcion_ma'] ?? '');

            if ($descripcion === '') {
                echo "<script>alert('Debe ingresar la descripción de la marca.'); window.history.back();</script>";
                exit;
            }

            $marca = new Marcas();
            $marca->setDescripcionMa($descripcion);

            $respuesta = MarcaController::guardar_ma(1, $marca); // 1 = crear

            if ($respuesta) {
                header("Location: ../views/marca/listar_marcas.php");
                exit;
            } else {
                header("Location: ../views/marca/crear_marcas.php?error=" . urlencode($respuesta));
                exit;
            }
        }
    }
?>