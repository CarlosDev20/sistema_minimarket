
<?php
    switch ($view) {
        case 'unidades_medida/listar_unidades':
            require_once CONTROLLER_PATH . 'UnidadesMedidasController.php';
            $texto = $_GET['texto'] ?? '';
            $data['unidades'] = UnidadesMedidasController::listado_um($texto);
            $data['texto'] = $texto;
            break;

        case 'unidades_medida/reporte_unidades':
            require_once REPORT_PATH . 'reporte_unidades.php';
            break;
            
        case 'unidades_medida/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'UnidadesMedidasController.php';
                require_once __DIR__ . '/../app/entities/Unidades_Medidas.php';

                $accion = $_POST['accion'] ?? '';
                $abreviatura = trim($_POST['abreviatura_um'] ?? '');
                $descripcion = trim($_POST['descripcion_um'] ?? '');

                if ($descripcion === '' || $abreviatura === '') {
                    echo "<script>alert('Debe completar todos los campos.'); window.history.back();</script>";
                    exit;
                }

                $unidad = new Unidades_Medidas();
                $unidad->setAbreviaturaUm($abreviatura);
                $unidad->setDescripcionUm($descripcion);

                if ($accion === 'crear') {
                    UnidadesMedidasController::guardar_um(1, $unidad);
                } else { 
                    $codigo = $_POST['codigo_um'] ?? null;
                    $unidad->setCodigoUm($codigo);
                    UnidadesMedidasController::editar_um($unidad);
                }
                
                header("Location: ../unidades_medida/listar_unidades");
                exit;
            }
            break;

        case 'unidades_medida/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'UnidadesMedidasController.php';
                $codigo_um = intval($_GET['id']);
                UnidadesMedidasController::eliminar_um($codigo_um);

                header("Location: ../unidades_medida/listar_unidades");
                exit;
            }
            break;
    }
?>