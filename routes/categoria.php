
<?php
    switch ($view) {
        case 'categoria/listar_categorias':
            require_once CONTROLLER_PATH . 'CategoriaController.php';
            $texto = $_GET['texto'] ?? '';
            $data['categorias'] = CategoriaController::listado_ca($texto);
            $data['texto'] = $texto;
            break;

        case 'categoria/reporte_categorias':
            require_once REPORT_PATH . 'reporte_categorias.php';
            break;
            
        case 'categoria/guardar':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once CONTROLLER_PATH . 'CategoriaController.php';
                require_once __DIR__ . '/../app/entities/Categorias.php';

                $accion = $_POST['accion'] ?? '';
                $descripcion = trim($_POST['descripcion_ca'] ?? '');

                if ($descripcion === '') {
                    echo "<script>alert('Debe ingresar la descripción de la categoría.'); window.history.back();</script>";
                    exit;
                }

                $categoria = new Categorias();
                $categoria->setDescripcionCa($descripcion);

                if ($accion === 'crear') {
                    CategoriaController::guardar_ca(1, $categoria);
                } else { // editar
                    $codigo = $_POST['codigo_ca'] ?? null;
                    $categoria->setCodigoCa($codigo);
                    CategoriaController::editar_ca($categoria);
                }
                header("Location: ../categoria/listar_categorias");
                exit;
            }
        break;

        case 'categoria/eliminar':
            if (isset($_GET['id'])) {
                require_once CONTROLLER_PATH . 'CategoriaController.php';
                $codigo_categoria = intval($_GET['id']);
                CategoriaController::eliminar_ca($codigo_categoria);
                header("Location: ../categoria/listar_categorias");
                exit;
            }
        break;
    }
?>