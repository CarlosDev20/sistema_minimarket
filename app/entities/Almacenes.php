<?php
    class Almacenes
    {
        private $codigo_al;
        private $descripcion_al;

        public function getCodigoAl()
        {
            return $this->codigo_al;
        }
        public function getDescripcionAl()
        {
            return $this->descripcion_al;
        }

        public function setCodigoAl($codigo_al)
        {
            $this->codigo_al = $codigo_al;
        }
        public function setDescripcionAl($descripcion_al)
        {
            $this->descripcion_al = $descripcion_al;
        }
    }
?>