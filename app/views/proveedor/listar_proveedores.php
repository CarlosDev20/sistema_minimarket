<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-truck me-2"></i> Proveedores</h2>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormulario">
                    <i class="bi bi-plus-circle"></i> Nuevo Proveedor
                </button>
            </div>
        </div>

        <div class="card shadow-lg rounded">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-list-ul"></i> Listado de Proveedores</span>
                <form class="d-flex" method="GET" action="proveedor/listar_proveedores">
                    <input class="form-control form-control-sm me-2" type="text" name="texto"
                        placeholder="Buscar por Razón Social..." value="<?php echo htmlspecialchars($texto ?? ''); ?>">
                    <button class="btn btn-sm btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="ps-3">Código</th>
                                <th scope="col">Tipo DOC</th>
                                <th scope="col">Nro DOC</th>
                                <th scope="col">Razón Social</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Rubro</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proveedores)): ?>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <tr>
                                        <td class="ps-3"><?php echo htmlspecialchars($proveedor['codigo_pv']); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor['descripcion_tdpc']); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor['nrodocumento_pv']); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor['razon_social_pv']); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor['nombres']); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor['apellidos']); ?></td>
                                        <td><?php echo htmlspecialchars($proveedor['descripcion_ru']); ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal"
                                                data-bs-target="#modalFormulario" data-accion="editar"
                                                data-proveedor='<?php echo json_encode($proveedor); ?>'>
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalEliminar"
                                                data-codigo="<?php echo $proveedor['codigo_pv']; ?>"
                                                data-descripcion="<?php echo htmlspecialchars($proveedor['razon_social_pv']); ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
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
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <form method="POST" action="proveedor/guardar">
                    <input type="hidden" name="accion" id="formAccion" value="crear">
                    <input type="hidden" name="codigo_pv" id="formCodigo">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTitulo"></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 border-end">
                                <h6 class="text-muted mb-3">Información Principal</h6>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Tipo doc. (*)</label>
                                        <select name="codigo_tdpc" id="formTipoDoc" class="form-select" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            <?php foreach ($documentos as $doc): ?>
                                                <option value="<?php echo $doc['codigo_tdpc']; ?>">
                                                    <?php echo htmlspecialchars($doc['descripcion_tdpc']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label">Nro doc. (*)</label>
                                        <input type="text" name="nrodocumento_pv" id="formNroDoc" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Razón social (*)</label>
                                    <input type="text" name="razon_social_pv" id="formRazonSocial" class="form-control"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-3"><label>Nombres:</label><input type="text" name="nombres"
                                            id="formNombres" class="form-control"></div>
                                    <div class="col-sm-6 mb-3"><label>Apellidos:</label><input type="text"
                                            name="apellidos" id="formApellidos" class="form-control"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label>Sexo:</label>
                                        <select name="codigo_sx" id="formSexo" class="form-select" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            <?php foreach ($sexos as $sx): ?>
                                                <option value="<?php echo $sx['codigo_sx']; ?>">
                                                    <?php echo htmlspecialchars($sx['descripcion_sx']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label>Rubro (*)</label>
                                        <select name="codigo_ru" id="formRubro" class="form-select" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            <?php foreach ($rubros as $ru): ?>
                                                <option value="<?php echo $ru['codigo_ru']; ?>">
                                                    <?php echo $ru['descripcion_ru']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-3">Información de Contacto y Ubicación</h6>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email_pv" id="formEmail" class="form-control">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6"><label># Teléfono</label><input type="text" name="telefono_pv"
                                            id="formTelefono" class="form-control"></div>
                                    <div class="col-6"><label># Móvil</label><input type="text" name="movil_pv"
                                            id="formMovil" class="form-control"></div>
                                </div>
                                <div class="mb-3">
                                    <label>Distrito / Provincia / Dpto (*)</label>
                                    <select name="codigo_di" id="formDistrito" class="form-select" required>
                                        <option value="" disabled selected>Seleccionar...</option>
                                        <?php foreach ($distritos as $di): ?>
                                            <option value="<?php echo $di['codigo_di']; ?>">
                                                <?php echo $di['descripcion_di']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="direccion_pv" id="formDireccion" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-label">Observación</label>
                                <textarea name="observacion_pv" id="formObservacion" class="form-control"
                                    rows="2"></textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/proveedores.js"></script>
</body>

</html>