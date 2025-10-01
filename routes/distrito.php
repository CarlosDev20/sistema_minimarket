
<?php

    switch ($view) {
        case 'distrito/listar_distritos':
            require_once CONTROLLER_PATH . 'DistritoController.php';
            $texto = $_GET['texto'] ?? '';
            $data['provincias'] = DistritoController::listarProvincias();
            $data['distritos'] = DistritoController::listado_di($texto);
            $data['texto'] = $texto;
            break;

        case 'distrito/reporte_distritos':
            require_once REPORT_PATH . 'reporte_distritos.php';
            break;
            
        case 'distrito/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'DistritoController.php';
                $accion = $_POST['accion'] ?? '';
                $distrito = new Distritos();
                $distrito->setDescripcionDi(trim($_POST['descripcion_di'] ?? ''));
                $distrito->setCodigoPo(trim($_POST['codigo_po'] ?? ''));

                if ($accion === 'crear') {
                    DistritoController::guardar_di(1, $distrito);
                } else {
                    $distrito->setCodigoDi($_POST['codigo_di'] ?? null);
                    DistritoController::editar_di($distrito);
                }
                header("Location: ../distrito/listar_distritos");
                exit;
            }
            break;

        case 'distrito/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'DistritoController.php';
                DistritoController::eliminar_di(intval($_GET['id']));
                header("Location: ../distrito/listar_distritos");
                exit;
            }
            break;
    }
?>