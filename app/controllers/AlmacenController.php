
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
            return $datos->guardar(2, $oAl); 
        }

        public static function eliminar_al($codigo_al)
        {
            $datos = new AlmacenModel();
            return $datos->eliminar($codigo_al);
        }
    }
?>