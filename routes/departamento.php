
<?php

switch ($view) {
    case 'departamento/listar_departamentos':
        require_once CONTROLLER_PATH . 'DepartamentoController.php';
        $texto = $_GET['texto'] ?? '';
        $data['departamentos'] = DepartamentoController::listado_de($texto);
        $data['texto'] = $texto;
        break;

    case 'departamento/reporte_departamentos':
        require_once REPORT_PATH . 'reporte_departamentos.php';
        break;
        
    case 'departamento/guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once CONTROLLER_PATH . 'DepartamentoController.php';
            require_once __DIR__ . '/../app/entities/Departamentos.php';

            $accion = $_POST['accion'] ?? '';
            $descripcion = trim($_POST['descripcion_de'] ?? '');

            if ($descripcion === '') {
                echo "<script>alert('Debe ingresar la descripción del departamento.'); window.history.back();</script>";
                exit;
            }

            $departamento = new Departamentos();
            $departamento->setDescripcionDe($descripcion);

            if ($accion === 'crear') {
                DepartamentoController::guardar_de(1, $departamento);
            } else { // editar
                $codigo = $_POST['codigo_de'] ?? null;
                $departamento->setCodigoDe($codigo);
                DepartamentoController::editar_de($departamento);
            }
            header("Location: ../departamento/listar_departamentos");
            exit;
        }
        break;

    case 'departamento/eliminar':
        if (isset($_GET['id'])) {
            require_once CONTROLLER_PATH . 'DepartamentoController.php';
            $codigo_de = intval($_GET['id']);
            DepartamentoController::eliminar_de($codigo_de);
            header("Location: ../departamento/listar_departamentos");
            exit;
        }
        break;
}
?>