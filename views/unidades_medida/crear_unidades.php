
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Unidad de Medida</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <!-- Tarjeta del formulario -->
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">📏 Registrar Nueva Unidad de Medida</h4>
                    </div>
                    <div class="card-body">
                        <form action="../../controllers/UnidadesMedidasController.php" method="POST">
                            
                            <!-- Abreviatura -->
                            <div class="mb-3">
                                <label for="abreviatura_um" class="form-label">Abreviatura</label>
                                <input type="text" class="form-control" id="abreviatura_um" name="abreviatura_um" placeholder="Ej: Kg, Lt, cm" required>
                            </div>

                            <!-- Descripción -->
                            <div class="mb-3">
                                <label for="descripcion_um" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion_um" name="descripcion_um" placeholder="Ej: Kilogramos, Litros, Centímetros" required>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between">
                                <a href="listar_unidades.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" name="accion" value="crear" class="btn btn-success">💾 Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
