
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
            return $datos->guardar(2, $oMa); 
        }

        public static function eliminar_ma($codigo_ma)
        {
            $datos = new MarcaModel();
            return $datos->eliminar($codigo_ma);
        }
    }
?>