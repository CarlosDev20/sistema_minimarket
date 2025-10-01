
<?php
    require_once __DIR__ . '/../models/ProductoModel.php';
    require_once __DIR__ . '/../models/MarcaModel.php';
    require_once __DIR__ . '/../models/UnidadMedidaModel.php';
    require_once __DIR__ . '/../models/CategoriaModel.php';
    require_once __DIR__ . '/../entities/Productos.php';

class ProductoController
{
    public static function listar($texto = "")
    {
        $modelo = new ProductoModel();
        return $modelo->listar($texto);
    }

    public static function guardar($opcion, Productos $producto)
    {
        $modelo = new ProductoModel();
        return $modelo->guardar($opcion, $producto);
    }

    public static function eliminar($codigo_pr)
    {
        $modelo = new ProductoModel();
        return $modelo->eliminar($codigo_pr);
    }

    public static function listarMarcas()
    {
        $modelo = new MarcaModel();
        return $modelo->getMarcas(); 
    }

    public static function listarUnidadesMedida()
    {
        $modelo = new UnidadMedidaModel();
        return $modelo->getUnidades(); 
    }

    public static function listarCategorias()
    {
        $modelo = new CategoriaModel();
        return $modelo->getCategorias(); 
    }

    public static function verStockActualPorAlmacen($codigo_pr)
    {
        $modelo = new ProductoModel();
        return $modelo->verStockPorAlmacenes($codigo_pr);
    }
}
?>