
<?php
// app/views/layout/sidebar.php
$current_view = $_GET['view'] ?? 'dashboard/inicio';

function is_active($menu_item_url, $current_view) {
    return str_starts_with($current_view, $menu_item_url) ? 'active' : '';
}
?>
<div class="offcanvas-md offcanvas-start bg-dark text-white flex-shrink-0" tabindex="-1" id="sidebarMenu">
    
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <a href="dashboard/inicio" class="text-white text-decoration-none">
            <i class="bi bi-shop-window fs-2"></i>
            <span class="fs-4 ms-2">MiniGest</span>
        </a>
    </div>
    
    <div class="offcanvas-body p-0 d-flex flex-column">
        
        <ul class="list-unstyled ps-0">
            <li class="sidebar-item">
                <a href="dashboard/inicio" class="sidebar-link <?php echo is_active('dashboard/inicio', $current_view); ?>">
                    <i class="bi bi-house-door-fill me-2"></i> Inicio
                </a>
            </li>

            <li class="sidebar-header">
                <i class="bi bi-gear-fill me-2"></i>Procesos    
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link submenu-link">Entrada de Productos</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link submenu-link">Salida de Productos</a>
            </li>

            <li class="sidebar-header">
                <i class="bi bi-bar-chart-line-fill me-2"></i>Reportes
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link submenu-link">Reporte #1</a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link submenu-link">Reporte #2</a>
            </li>

            <li class="sidebar-header">
                <i class="bi bi-collection-fill me-2"></i>Datos Maestros
            </li>
            <li class="sidebar-item">
                <a href="proveedor/listar_proveedores" class="sidebar-link submenu-link <?php echo is_active('proveedor', $current_view); ?>">Proveedores</a>
            </li>
            <li class="sidebar-item">
                <a href="producto/listar_productos" class="sidebar-link submenu-link <?php echo is_active('producto', $current_view); ?>">Productos</a>
            </li>
            <li class="sidebar-item">
                <a href="marca/listar_marcas" class="sidebar-link submenu-link <?php echo is_active('marca', $current_view); ?>">Marcas</a>
            </li>
            <li class="sidebar-item">
                <a href="unidades_medida/listar_unidades" class="sidebar-link submenu-link <?php echo is_active('unidades_medida', $current_view); ?>">Unidades</a>
            </li>
            <li class="sidebar-item">
                <a href="categoria/listar_categorias" class="sidebar-link submenu-link <?php echo is_active('categoria', $current_view); ?>">Categorías</a>
            </li>
            <li class="sidebar-item">
                <a href="almacen/listar_almacenes" class="sidebar-link submenu-link <?php echo is_active('almacen', $current_view); ?>">Almacenes</a>
            </li>
            <li class="sidebar-item">
                <a href="rubro/listar_rubros" class="sidebar-link submenu-link <?php echo is_active('rubro', $current_view); ?>">Rubros</a>
            </li>
             <li class="sidebar-item">
                <a href="departamento/listar_departamentos" class="sidebar-link submenu-link <?php echo is_active('departamento', $current_view); ?>">Departamentos</a>
            </li>
            <li class="sidebar-item">
                <a href="provincia/listar_provincias" class="sidebar-link submenu-link <?php echo is_active('provincia', $current_view); ?>">Provincias</a>
            </li>
            <li class="sidebar-item">
                <a href="distrito/listar_distritos" class="sidebar-link submenu-link <?php echo is_active('distrito', $current_view); ?>">Distritos</a>
            </li>

            <li class="sidebar-header">
                <i class="bi bi-pc-display me-2"></i>Sistemas
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link submenu-link">Usuario de Sistemas</a>
            </li>

        </ul>

        <div class="mt-auto">
            <hr class="mx-3">
            <ul class="list-unstyled ps-0">
                 <li class="sidebar-item">
                     <a href="#" class="sidebar-link">
                        <i class="bi bi-box-arrow-left me-2"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>  