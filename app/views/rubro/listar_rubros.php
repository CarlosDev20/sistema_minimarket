
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Rubros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">📑 Rubros</h2>
            <div>
                <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="bi bi-plus-circle"></i> Nuevo Rubro
                </button>
                <a href="rubro/reporte_rubros" target="_blank" class="btn btn-primary shadow-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
                </a>
            </div>
        </div>

        <div class="card shadow-lg rounded">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-list-ul"></i> Listado de Rubros</span>
                <form class="d-flex" method="GET" action="rubro/listar_rubros">
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
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rubros)): ?>
                                <?php foreach ($rubros as $ru): ?>
                                    <tr>
                                        <td class="ps-3"><?php echo htmlspecialchars($ru['codigo_ru']); ?></td>
                                        <td><?php echo htmlspecialchars($ru['descripcion_ru']); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar" data-codigo="<?php echo $ru['codigo_ru']; ?>"
                                                data-descripcion="<?php echo htmlspecialchars($ru['descripcion_ru']); ?>">
                                                <i class="bi bi-pencil me-1"></i>Editar
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalEliminar" data-codigo="<?php echo $ru['codigo_ru']; ?>"
                                                data-descripcion="<?php echo htmlspecialchars($ru['descripcion_ru']); ?>">
                                                <i class="bi bi-trash me-1"></i>Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
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

    <div class="modal fade" id="modalCrear" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="rubro/guardar">
                    <input type="hidden" name="accion" value="crear">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Crear Nuevo Rubro</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descripcion_ru_crear" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion_ru_crear" name="descripcion_ru" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="rubro/guardar">
                    <input type="hidden" name="accion" value="editar">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title"><i class="bi bi-pencil"></i> Editar Rubro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="codigo_ru" id="editCodigo">
                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion_ru" id="editDescripcion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
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
                    <p class="text-center">¿Seguro deseas eliminar el rubro?</p>
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
    <script src="assets/js/rubros.js"></script>
</body>
</html>