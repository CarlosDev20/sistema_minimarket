<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-basket-fill me-2"></i> Productos</h2>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormulario">
                    <i class="bi bi-plus-circle"></i> Nuevo Producto
                </button>
                <a href="producto/reporte_productos" target="_blank" class="btn btn-primary shadow-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
                </a>
            </div>
        </div>

        <div class="card shadow-lg rounded">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-list-ul"></i> Listado de Productos</span>
                <form class="d-flex" method="GET" action="producto/listar_productos">
                    <input class="form-control form-control-sm me-2" type="text" name="texto" placeholder="Buscar..."
                        value="<?php echo htmlspecialchars($texto ?? ''); ?>">
                    <button class="btn btn-sm btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="ps-3">Código</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Unidad de Medida</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productos)): ?>
                                <?php foreach ($productos as $producto): ?>
                                    <tr>
                                        <td class="ps-3"><?php echo htmlspecialchars($producto['codigo_pr']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['descripcion_pr']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['descripcion_ma']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['descripcion_ca']); ?></td>
                                        <td><?php echo htmlspecialchars($producto['descripcion_um']); ?></td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button"
                                                    class="btn btn-sm btn-warning d-flex align-items-center gap-1 me-2 rounded"
                                                    data-bs-toggle="modal" data-bs-target="#modalFormulario"
                                                    data-accion="editar" data-producto='<?php echo json_encode($producto); ?>'>
                                                    <i class="bi bi-pencil"></i> Editar
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center gap-1 me-2 rounded"
                                                    data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                                    data-codigo="<?php echo $producto['codigo_pr']; ?>"
                                                    data-descripcion="<?php echo htmlspecialchars($producto['descripcion_pr']); ?>">
                                                    <i class="bi bi-trash"></i> Eliminar
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-info d-flex align-items-center gap-1 rounded"
                                                    data-bs-toggle="modal" data-bs-target="#modalVerStock"
                                                    data-codigo="<?php echo $producto['codigo_pr']; ?>"
                                                    data-descripcion="<?php echo htmlspecialchars($producto['descripcion_pr']); ?>">
                                                    <i class="bi bi-eye-fill"></i> Ver Stock
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        ⚠️ No hay registros disponibles.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFormulario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="POST" action="producto/guardar">
                    <input type="hidden" name="accion" id="formAccion" value="crear">
                    <input type="hidden" name="codigo_pr" id="formCodigo">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTitulo"></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="formDescripcion" class="form-label">Descripción del Producto</label>
                                <input type="text" class="form-control" id="formDescripcion" name="descripcion_pr"
                                    required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="formMarca" class="form-label">Marca</label>
                                <select class="form-select" id="formMarca" name="codigo_ma" required>
                                    <option value="" disabled selected>Seleccionar...</option>
                                    <?php foreach ($marcas as $marca): ?>
                                        <option value="<?php echo $marca['codigo_ma']; ?>">
                                            <?php echo $marca['descripcion_ma']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="formUnidad" class="form-label">Unidad de Medida</label>
                                <select class="form-select" id="formUnidad" name="codigo_um" required>
                                    <option value="" disabled selected>Seleccionar...</option>
                                    <?php foreach ($unidades as $unidad): ?>
                                        <option value="<?php echo $unidad['codigo_um']; ?>">
                                            <?php echo $unidad['descripcion_um']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="formCategoria" class="form-label">Categoría</label>
                                <select class="form-select" id="formCategoria" name="codigo_ca" required>
                                    <option value="" disabled selected>Seleccionar...</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria['codigo_ca']; ?>">
                                            <?php echo $categoria['descripcion_ca']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formStockMin" class="form-label">Stock Mínimo</label>
                                <input type="number" class="form-control" id="formStockMin" name="stock_min" value="0"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="formStockMax" class="form-label">Stock Máximo</label>
                                <input type="number" class="form-control" id="formStockMax" name="stock_max" value="0"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn" id="btnGuardar"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">¿Seguro deseas eliminar el producto?</p>
                    <div class="alert alert-warning">
                        <strong>Código:</strong> <span id="codigoEliminar"></span><br>
                        <strong>Descripción:</strong> <span id="descripcionEliminar"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="btnConfirmarEliminar" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Definitivamente
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVerStock" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Estado de Stock por Almacén</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3" id="stockProductoTitulo"></h6>
                    <div id="stockSpinner" class="text-center d-none">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Almacén</th>
                                <th class="text-end">Stock Actual</th>
                                <th class="text-end">P.U. Compra</th>
                            </tr>
                        </thead>
                        <tbody id="stockTablaCuerpo">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/productos.js"></script>
</body>

</html>