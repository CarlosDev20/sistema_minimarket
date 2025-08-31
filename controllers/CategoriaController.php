
<?php
    require_once __DIR__ . '/../models/CategoriaModel.php';
    require_once __DIR__ . '/../entities/Categorias.php';

    class CategoriaController
    {

        public static function listado_ca($texto = "")
        {
            $datos = new CategoriaModel();
            return $datos->listar($texto);
        }

        public static function guardar_ca($opcion, Categorias $categoria)
        {
            $datos = new CategoriaModel();
            return $datos->guardar($opcion, $categoria);
        }

        public static function editar_ca(Categorias $oCa)
        {
            $datos = new CategoriaModel();
            return $datos->guardar(2, $oCa); // 2 = actualizar
        }

        public static function eliminar_ca($codigo_ca)
        {
            $datos = new CategoriaModel();
            return $datos->eliminar($codigo_ca);
        }
        
    }

    //procesando la creacion de una categoria
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? '';

        if ($accion === 'crear') {
            $descripcion = trim($_POST['descripcion_ca'] ?? '');

            if ($descripcion === '') {
                echo "<scrip>alert('Falta ingresar datos requeridos (*)'); window.history.back();)</scrip>";
                exit;
            }

            $ca = new Categorias();
            $ca->setDescripcionCa($descripcion);

            $respuesta = CategoriaController::guardar_ca(1, $ca);

            if ($respuesta) {
                header("Location: ../views/categoria/listar_categorias.php");
                exit;
            } else {
                header("Location: ../views/categoria/listar_categorias.php?error=" . urlencode($respuesta));
                exit;
            }
        }
    }
?>