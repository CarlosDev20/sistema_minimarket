
<?php
    require_once __DIR__ . '/../models/DistritoModel.php';
    require_once __DIR__ . '/../models/ProvinciaModel.php';
    require_once __DIR__ . '/../entities/Distritos.php';

    class DistritoController
    {
        public static function listado_di($texto = "") {
            $modelo = new DistritoModel();
            return $modelo->listar($texto);
        }

        public static function guardar_di($opcion, Distritos $distrito) {
            $modelo = new DistritoModel();
            return $modelo->guardar($opcion, $distrito);
        }
        
        public static function editar_di(Distritos $distrito) {
            $modelo = new DistritoModel();
            return $modelo->guardar(2, $distrito);
        }

        public static function eliminar_di($codigo_di) {
            $modelo = new DistritoModel();
            return $modelo->eliminar($codigo_di);
        }
        
        public static function listarProvincias() {
            $modelo = new ProvinciaModel();
            return $modelo->listar();
        }
    }
?>