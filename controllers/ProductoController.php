
<?php
    require_once __DIR__ . '/../models/ProductoModel.php';
    require_once __DIR__ . '/../entities/Productos.php';

    class ProductoController
    {

        public static function listar($texto = "")
        {
            $datos = new ProductoModel();
            return $datos->listar($texto);
        }

        public static function guardar($opcion, Productos $producto)
        {
            $datos = new ProductoModel();
            return $datos->guardar($opcion, $producto);
        }

        public static function eliminar($codigo_pr)
        {
            $datos = new ProductoModel();
            return $datos->eliminar($codigo_pr);
        }

        public static function listarMarcas($texto = "")
        {
            $datos = new ProductoModel();
            return $datos->listarMarcas($texto);
        }

        public static function listarUnidadesMedida($texto = "")
        {
            $datos = new ProductoModel();
            return $datos->listarUnidades($texto);
        }

        public static function listarCategorias($texto = "")
        {
            $datos = new ProductoModel();
            return $datos->listarCategorias($texto);
        }

        public static function verStockActualPorAlmacen($codigo_pr)
        {
            $datos = new ProductoModel();
            return $datos->verStockPorAlmacenes($codigo_pr);
        }
    }
?>