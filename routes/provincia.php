
<?php

switch ($view) {
    case 'provincia/listar_provincias':
        require_once CONTROLLER_PATH . 'ProvinciaController.php';
        $texto = $_GET['texto'] ?? '';
        $data['departamentos'] = ProvinciaController::listarDepartamentos();
        $data['provincias'] = ProvinciaController::listado_po($texto);
        $data['texto'] = $texto;
        break;
    
    case 'provincia/reporte_provincias':
        require_once REPORT_PATH . 'reporte_provincias.php';
        break;
        
    case 'provincia/guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once CONTROLLER_PATH . 'ProvinciaController.php';
            $accion = $_POST['accion'] ?? '';
            $provincia = new Provincias();
            $provincia->setDescripcionPo(trim($_POST['descripcion_po'] ?? ''));
            $provincia->setCodigoDe(trim($_POST['codigo_de'] ?? ''));

            if ($accion === 'crear') {
                ProvinciaController::guardar_po(1, $provincia);
            } else { 
                $provincia->setCodigoPo($_POST['codigo_po'] ?? null);
                ProvinciaController::editar_po($provincia);
            }
            header("Location: ../provincia/listar_provincias");
            exit;
        }
        break;

    case 'provincia/eliminar':
        if (isset($_GET['id'])) {
            require_once CONTROLLER_PATH . 'ProvinciaController.php';
            ProvinciaController::eliminar_po(intval($_GET['id']));
            header("Location: ../provincia/listar_provincias");
            exit;
        }
        break;
}
?>