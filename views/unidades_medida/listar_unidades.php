<?php
require_once __DIR__ . '/../../controllers/UnidadesMedidasController.php';

$texto = $_GET['texto'] ?? '';
$unidades = UnidadesMedidasController::listado_um($texto);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Unidades de Medida</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <!-- Encabezado con título y botón -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">📏 Unidades de Medida</h2>
            <div class="d-flex">
                <a href="crear_unidades.php" class="btn btn-success shadow-sm me-2">
                    <i class="bi bi-plus-circle"></i> Nueva Unidad
                </a>
                <a href="../../reports/reporte_unidades.php" target="_blank" class="btn btn-primary shadow-sm">
                    <i class="bi bi-file-earmark-pdf"></i> Generar Reporte
                </a>
            </div>
        </div>


        <!-- Tarjeta de tabla -->
        <div class="card shadow-lg rounded">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-list-ul"></i> Listado de unidades</span>
                <form class="d-flex" method="GET">
                    <input class="form-control form-control-sm me-2" type="text" name="texto" placeholder="Buscar..."
                        value="<?php echo htmlspecialchars($texto); ?>">
                    <button class="btn btn-sm btn-outline-light" type="submit">Buscar</button>
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Abreviatura</th>
                                <th scope="col">Descripción</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($unidades)): ?>
                                <?php foreach ($unidades as $um): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($um['codigo_um']); ?></td>
                                        <td><?php echo htmlspecialchars($um['abreviatura_um']); ?></td>
                                        <td><?php echo htmlspecialchars($um['descripcion_um']); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar" data-codigo="<?php echo $um['codigo_um']; ?>"
                                                data-abreviatura="<?php echo htmlspecialchars($um['abreviatura_um']); ?>"
                                                data-descripcion="<?php echo htmlspecialchars($um['descripcion_um']); ?>">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalEliminar" data-codigo="<?php echo $um['codigo_um']; ?>"
                                                data-descripcion="<?php echo htmlspecialchars($um['descripcion_um']); ?>">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
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

    <!-- Modal de edición -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="editar_unidades.php">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="modalEditarLabel">
                            <i class="bi bi-pencil"></i> Editar Unidad de Medida
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="codigo_um" id="editCodigo">

                        <div class="mb-3">
                            <label for="editAbreviatura" class="form-label">Abreviatura</label>
                            <input type="text" class="form-control" name="abreviatura_um" id="editAbreviatura" required>
                        </div>

                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion_um" id="editDescripcion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check2-circle"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalEliminarLabel">
                        <i class="bi bi-exclamation-triangle"></i> Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="bi bi-trash3 text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mb-3">¿Estás seguro de que deseas eliminar la siguiente unidad de medida?</p>
                    <div class="alert alert-warning">
                        <strong>Código:</strong> <span id="codigoEliminar"></span><br>
                        <strong>Descripción:</strong> <span id="descripcionEliminar"></span>
                    </div>
                    <p class="text-muted small text-center mb-0">
                        <i class="bi bi-info-circle"></i> Esta acción no se puede deshacer.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </button>
                    <a href="eliminar_unidades.php" id="btnConfirmarEliminar" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Definitivamente
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript externo -->
    <script src="../../assets/unidades_medida.js"></script>
</body>

</html>