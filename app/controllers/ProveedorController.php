
<?php
require_once __DIR__ . '/../models/ProveedorModel.php';
require_once __DIR__ . '/../models/RubroModel.php';
require_once __DIR__ . '/../models/DistritoModel.php';
require_once __DIR__ . '/../entities/Proveedores.php';

class ProveedorController
{
    public static function listar($texto = "")
    {
        $modelo = new ProveedorModel();
        return $modelo->listar($texto);
    }

    public static function listarDocumentos()
    {
        $modelo = new ProveedorModel();
        return $modelo->listarTiposDocumento();
    }

    public static function listarSexos()
    {
        $modelo = new ProveedorModel();
        return $modelo->listarSexos();
    }
}
?>