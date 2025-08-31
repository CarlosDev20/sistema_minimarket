
<?php
    require_once __DIR__ . '/../models/RubroModel.php';
    require_once __DIR__ . '/../entities/Rubros.php';

    class RubroController
    {

        public static function listado_ru($texto = "")
        {
            $datos = new RubroModel();
            return $datos->listar($texto);
        }

        public static function guardar_ru($opcion, Rubros $rubro)
        {
            $datos = new RubroModel();
            return $datos->guardar($opcion, $rubro);
        }

        public static function editar_ru(Rubros $oRu)
        {
            $datos = new RubroModel();
            return $datos->guardar(2, $oRu); // 2 = actualizar
        }

        public static function eliminar_ru($codigo_ru)
        {
            $datos = new RubroModel();
            return $datos->eliminar($codigo_ru);
        }
    }

    // Procesando la creacion de una marca
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? '';

        if ($accion === 'crear') {
            $descripcion = trim($_POST['descripcion_ru'] ?? '');

            if ($descripcion === '') {
                echo "<script>alert('Debe ingresar la descripción del rubro.'); window.history.back();</script>";
                exit;
            }

            $rubro = new Rubros();
            $rubro->setDescripcionRu($descripcion);

            $respuesta = RubroController::guardar_ru(1, $rubro); // 1 = crear

            if ($respuesta) {
                header("Location: ../views/rubro/listar_rubros.php");
                exit;
            } else {
                header("Location: ../views/rubro/listar_rubros.php?error=" . urlencode($respuesta));
                exit;
            }
        }
    }
?>