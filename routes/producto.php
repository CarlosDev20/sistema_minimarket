
<?php
    switch ($view) {
        case 'producto/listar_productos':
            require_once CONTROLLER_PATH . 'ProductoController.php';
            $texto = $_GET['texto'] ?? '';
            $data['marcas'] = ProductoController::listarMarcas();
            $data['unidades'] = ProductoController::listarUnidadesMedida();
            $data['categorias'] = ProductoController::listarCategorias();
            $data['productos'] = ProductoController::listar($texto);
            $data['texto'] = $texto;
            break;
        
        case 'producto/reporte_productos':
            require_once REPORT_PATH . 'reporte_productos.php';
            break;

        case 'producto/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'ProductoController.php';
                
                $producto = new Productos();
                $producto->setDescripcionPr($_POST['descripcion_pr']);
                $producto->setCodigoMa($_POST['codigo_ma']);
                $producto->setCodigoUm($_POST['codigo_um']);
                $producto->setCodigoCa($_POST['codigo_ca']);
                $producto->setStockMin($_POST['stock_min']);
                $producto->setStockMax($_POST['stock_max']);

                if ($_POST['accion'] === 'crear') {
                    ProductoController::guardar(1, $producto);
                } else {
                    $producto->setCodigoPr($_POST['codigo_pr']);
                    ProductoController::guardar(2, $producto);
                }
                header("Location: ../producto/listar_productos");
                exit;
            }
            break;

        case 'producto/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'ProductoController.php';
                ProductoController::eliminar(intval($_GET['id']));
                header("Location: ../producto/listar_productos");
                exit;
            }
            break;

        case 'producto/ver_stock':
            if (isset($_GET['codigo_pr'])) {
            require_once CONTROLLER_PATH . 'ProductoController.php';
            $codigo_pr = intval($_GET['codigo_pr']);
            $stock_data = ProductoController::verStockActualPorAlmacen($codigo_pr);
            header('Content-Type: application/json');//
            echo json_encode($stock_data);
            exit; 
            }
            break;
    }
?>