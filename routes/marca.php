
<?php

    switch ($view) {
        case 'marca/listar_marcas':
            require_once CONTROLLER_PATH . 'MarcaController.php';
            $texto = $_GET['texto'] ?? '';
            $data['marcas'] = MarcaController::listado_ma($texto);
            $data['texto'] = $texto;
            break;

        case 'marca/reporte_marcas':
            require_once REPORT_PATH . 'reporte_marcas.php';
            break;
            
        case 'marca/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'MarcaController.php';
                require_once __DIR__ . '/../app/entities/Marcas.php';

                $accion = $_POST['accion'] ?? '';
                $descripcion = trim($_POST['descripcion_ma'] ?? '');

                if ($descripcion === '') {
                    echo "<script>alert('Debe ingresar la descripción de la marca.'); window.history.back();</script>";
                    exit;
                }

                $marca = new Marcas();
                $marca->setDescripcionMa($descripcion);

                if ($accion === 'crear') {
                    MarcaController::guardar_ma(1, $marca);
                } else { // editar
                    $codigo = $_POST['codigo_ma'] ?? null;
                    $marca->setCodigoMa($codigo);
                    MarcaController::editar_ma($marca);
                }
                header("Location: ../marca/listar_marcas");
                exit;
            }
            break;

        case 'marca/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'MarcaController.php';
                $codigo_marca = intval($_GET['id']);
                MarcaController::eliminar_ma($codigo_marca);
                header("Location: ../marca/listar_marcas");
                exit;
            }
            break;
    }
?>