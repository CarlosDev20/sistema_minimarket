
<?php
switch ($view) {
    case 'proveedor/listar_proveedores':
        require_once CONTROLLER_PATH . 'ProveedorController.php';
        $texto = $_GET['texto'] ?? '';
        //$data['rubros'] = ProveedorController::listar();
        //$data['distritos'] = ProveedorController::listarDistritos();
        $data['tipos_doc'] = ProveedorController::listarDocumentos();
        $data['sexos'] = ProveedorController::listarSexos();
        $data['proveedores'] = ProveedorController::listar($texto);
        $data['texto'] = $texto;
        break;
}
?>