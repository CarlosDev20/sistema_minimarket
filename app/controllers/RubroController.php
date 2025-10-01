
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
            return $datos->guardar(2, $oRu); 
        }

        public static function eliminar_ru($codigo_ru)
        {
            $datos = new RubroModel();
            return $datos->eliminar($codigo_ru);
        }
    }
?>