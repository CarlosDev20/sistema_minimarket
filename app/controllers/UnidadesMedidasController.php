<?php
    require_once __DIR__ . '/../models/UnidadMedidaModel.php';
    require_once __DIR__ . '/../entities/Unidades_Medidas.php';

    class UnidadesMedidasController
    {
        public static function listado_um($cTexto)
        {
            $datos = new UnidadMedidaModel();
            return $datos->listar($cTexto);
        }

        public static function guardar_um($nOpcion, Unidades_Medidas $oUm)
        {
            $datos = new UnidadMedidaModel();
            return $datos->guardar($nOpcion, $oUm);
        }

        public static function editar_um(Unidades_Medidas $oUm)
        {
            $datos = new UnidadMedidaModel();
            return $datos->guardar(2, $oUm); // 2 = actualizar
        }

        public static function eliminar_um($Codigo_um)
        {
            $datos = new UnidadMedidaModel();
            return $datos->eliminar($Codigo_um);
        }

    }

?>