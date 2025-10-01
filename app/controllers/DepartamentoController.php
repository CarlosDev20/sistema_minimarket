
<?php

require_once __DIR__ . '/../models/DepartamentoModel.php';
require_once __DIR__ . '/../entities/Departamentos.php';

class DepartamentoController
{
    public static function listado_de($texto = "")
    {
        $modelo = new DepartamentoModel();
        return $modelo->listar($texto);
    }

    public static function guardar_de($opcion, Departamentos $departamento)
    {
        $modelo = new DepartamentoModel();
        return $modelo->guardar($opcion, $departamento);
    }

    public static function editar_de(Departamentos $departamento)
    {
        $modelo = new DepartamentoModel();
        return $modelo->guardar(2, $departamento); 
    }

    public static function eliminar_de($codigo_de)
    {
        $modelo = new DepartamentoModel();
        return $modelo->eliminar($codigo_de);
    }
}
?>