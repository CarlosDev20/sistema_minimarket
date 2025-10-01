
<?php
    switch ($view) {
        case 'almacen/listar_almacenes':
            require_once CONTROLLER_PATH . 'AlmacenController.php';
            $texto = $_GET['texto'] ?? '';
            $data['almacenes'] = AlmacenController::listado_al($texto);
            $data['texto'] = $texto;
            break;

        case 'almacen/reporte_almacenes':
            require_once REPORT_PATH . 'reporte_almacenes.php';
            break;
            
        case 'almacen/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'AlmacenController.php';
                require_once CONTROLLER_PATH . '/../entities/Almacenes.php';

                $accion = $_POST['accion'] ?? '';
                $descripcion = trim($_POST['descripcion_al'] ?? '');

                if ($descripcion === '') {
                    echo "<script>alert('Debe ingresar la descripción del almacén.'); window.history.back();</script>";
                    exit;
                }

                $almacen = new Almacenes();
                $almacen->setDescripcionAl($descripcion);

                if ($accion === 'crear') {
                    AlmacenController::guardar_al(1, $almacen);
                } else {
                    $codigo = $_POST['codigo_al'] ?? null;
                    $almacen->setCodigoAl($codigo);
                    AlmacenController::editar_al($almacen);
                }
                header("Location: ../almacen/listar_almacenes");
                exit;
            }
            break;

        case 'almacen/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'AlmacenController.php';
                $codigo_almacen = intval($_GET['id']);
                AlmacenController::eliminar_al($codigo_almacen);
                header("Location: ../almacen/listar_almacenes");
                exit;
            }
        break;
    }
?>