
<?php
    require_once __DIR__ . '/../models/AlmacenModel.php';
    require_once __DIR__ . '/../entities/Almacenes.php';

    class AlmacenController
    {

        // Listado de almacenes
        public static function listado_al($texto = "")
        {
            $datos = new AlmacenModel();
            return $datos->listar($texto);
        }

        // Guardar (insertar o actualizar)
        public static function guardar_al($opcion, Almacenes $almacen)
        {
            $datos = new AlmacenModel();
            return $datos->guardar($opcion, $almacen);
        }

        public static function editar_al(Almacenes $oAl)
        {
            $datos = new AlmacenModel();
            return $datos->guardar(2, $oAl); // 2 = actualizar
        }

        // Eliminar
        public static function eliminar_al($codigo_al)
        {
            $datos = new AlmacenModel();
            return $datos->eliminar($codigo_al);
        }
    }

    // Procesando la creacion de una marca
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? '';

        if ($accion === 'crear') {
            $descripcion = trim($_POST['descripcion_al'] ?? '');

            if ($descripcion === '') {
                echo "<script>alert('Debe ingresar la descripción del almacen.'); window.history.back();</script>";
                exit;
            }

            $almacen = new Almacenes();
            $almacen->setDescripcionAl($descripcion);

            $respuesta = AlmacenController::guardar_al(1, $almacen); // 1 = crear

            if ($respuesta) {
                header("Location: ../views/almacen/listar_almacenes.php");
                exit;
            } else {
                header("Location: ../views/rubro/listar_almacenes.php?error=" . urlencode($respuesta));
                exit;
            }
        }
    }

?>