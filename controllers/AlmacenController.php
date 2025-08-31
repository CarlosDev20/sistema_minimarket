
<?php
    require_once __DIR__ . '/../models/AlmacenModel.php';
    require_once __DIR__ . '/../entities/Almacenes.php';

    class AlmacenController
    {
        private $model;

        public function __construct()
        {
            $this->model = new AlmacenModel();
        }

        // Listado de almacenes
        public function listar($texto = "")
        {
            return $this->model->listar($texto);
        }

        // Guardar (insertar o actualizar)
        public function guardar($opcion, Almacenes $almacen)
        {
            return $this->model->guardar($opcion, $almacen);
        }

        // Eliminar
        public function eliminar($codigo_al)
        {
            return $this->model->eliminar($codigo_al);
        }
    }
?>