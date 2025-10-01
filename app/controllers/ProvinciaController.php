
<?php

require_once __DIR__ . '/../models/ProvinciaModel.php';
require_once __DIR__ . '/../models/DepartamentoModel.php';
require_once __DIR__ . '/../entities/Provincias.php';

class ProvinciaController
{
    public static function listado_po($texto = "") {
        $modelo = new ProvinciaModel();
        return $modelo->listar($texto);
    }

    public static function guardar_po($opcion, Provincias $provincia) {
        $modelo = new ProvinciaModel();
        return $modelo->guardar($opcion, $provincia);
    }
    
    public static function editar_po(Provincias $provincia) {
        $modelo = new ProvinciaModel();
        return $modelo->guardar(2, $provincia); // 2 = actualizar
    }

    public static function eliminar_po($codigo_po) {
        $modelo = new ProvinciaModel();
        return $modelo->eliminar($codigo_po);
    }
    
    public static function listarDepartamentos() {
        $modelo = new DepartamentoModel();
        return $modelo->listar();
    }
}
?>