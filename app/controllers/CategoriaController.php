
<?php
    require_once __DIR__ . '/../models/CategoriaModel.php';
    require_once __DIR__ . '/../entities/Categorias.php';

    class CategoriaController
    {

        public static function listado_ca($texto = "")
        {
            $datos = new CategoriaModel();
            return $datos->listar($texto);
        }

        public static function guardar_ca($opcion, Categorias $categoria)
        {
            $datos = new CategoriaModel();
            return $datos->guardar($opcion, $categoria);
        }

        public static function editar_ca(Categorias $oCa)
        {
            $datos = new CategoriaModel();
            return $datos->guardar(2, $oCa); 
        }

        public static function eliminar_ca($codigo_ca)
        {
            $datos = new CategoriaModel();
            return $datos->eliminar($codigo_ca);
        }
        
    }
?>