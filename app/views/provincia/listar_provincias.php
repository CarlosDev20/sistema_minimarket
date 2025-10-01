
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Provincias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary"><i class="bi bi-geo-alt-fill me-2"></i> Provincias</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormulario">
                <i class="bi bi-plus-circle"></i> Nueva Provincia
            </button>
            <a href="provincia/reporte_provincias" target="_blank" class="btn btn-primary shadow-sm">
                <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
            </a>
        </div>
    </div>          
    <div class="card shadow-lg rounded">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-list-ul"></i> Listado de Provincias</span>
            <form class="d-flex" method="GET" action="provincia/listar_provincias">
                <input class="form-control form-control-sm me-2" type="text" name="texto" placeholder="Buscar..." value="<?php echo htmlspecialchars($texto ?? ''); ?>">
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
                            <th scope="col">Departamento</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($provincias)): ?>
                            <?php foreach ($provincias as $po): ?>
                                <tr>
                                    <td class="ps-3"><?php echo htmlspecialchars($po['codigo_po']); ?></td>
                                    <td><?php echo htmlspecialchars($po['descripcion_po']); ?></td>
                                    <td><?php echo htmlspecialchars($po['descripcion_de']); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-warning me-1"
                                                data-bs-toggle="modal" data-bs-target="#modalFormulario"
                                                data-accion="editar"
                                                data-provincia='<?php echo json_encode($po); ?>'>
                                            <i class="bi bi-pencil me-1"></i>Editar
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                                data-codigo="<?php echo $po['codigo_po']; ?>"
                                                data-descripcion="<?php echo htmlspecialchars($po['descripcion_po']); ?>">
                                            <i class="bi bi-trash me-1"></i>Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-muted py-4">⚠️ No hay registros disponibles.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFormulario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="provincia/guardar">
                <input type="hidden" name="accion" id="formAccion" value="crear">
                <input type="hidden" name="codigo_po" id="formCodigo">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formDescripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="formDescripcion" name="descripcion_po" required>
                    </div>
                    <div class="mb-3">
                        <label for="formDepartamento" class="form-label">Departamento</label>
                        <select class="form-select" id="formDepartamento" name="codigo_de" required>
                            <option value="" disabled selected>Seleccionar...</option>
                            <?php foreach ($departamentos as $de): ?>
                                <option value="<?php echo $de['codigo_de']; ?>"><?php echo $de['descripcion_de']; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                <p class="text-center">¿Seguro deseas eliminar la provincia?</p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/provincias.js"></script>
</body>
</html>