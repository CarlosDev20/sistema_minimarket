
<?php
    switch ($view) {
        case 'rubro/listar_rubros':
            require_once CONTROLLER_PATH . 'RubroController.php';
            $texto = $_GET['texto'] ?? '';
            $data['rubros'] = RubroController::listado_ru($texto);
            $data['texto'] = $texto;
            break;

        case 'rubro/reporte_rubros':
            require_once REPORT_PATH . 'reporte_rubros.php';
            break;
            
        case 'rubro/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'RubroController.php';
                require_once __DIR__ . '/../app/entities/Rubros.php';

                $accion = $_POST['accion'] ?? '';
                $descripcion = trim($_POST['descripcion_ru'] ?? '');

                if ($descripcion === '') {
                    echo "<script>alert('Debe ingresar la descripción del rubro.'); window.history.back();</script>";
                    exit;
                }

                $rubro = new Rubros();
                $rubro->setDescripcionRu($descripcion);

                if ($accion === 'crear') {
                    RubroController::guardar_ru(1, $rubro);
                } else { // editar
                    $codigo = $_POST['codigo_ru'] ?? null;
                    $rubro->setCodigoRu($codigo);
                    RubroController::editar_ru($rubro);
                }
                header("Location: ../rubro/listar_rubros");
                exit;
            }
            break;

        case 'rubro/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'RubroController.php';
                $codigo_rubro = intval($_GET['id']);
                RubroController::eliminar_ru($codigo_rubro);
                header("Location: ../rubro/listar_rubros");
                exit;
            }
        break;
    }
?>