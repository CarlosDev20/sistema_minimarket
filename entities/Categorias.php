<?php
    class Categorias
    {
        private $codigo_ca;
        private $descripcion_ca;

        // Getters
        public function getCodigoCa()
        {
            return $this->codigo_ca;
        }
        public function getDescripcionCa()
        {
            return $this->descripcion_ca;
        }

        // Setters
        public function setCodigoCa($codigo_ca)
        {
            $this->codigo_ca = $codigo_ca;
        }
        public function setDescripcionCa($descripcion_ca)
        {
            $this->descripcion_ca = $descripcion_ca;
        }
    }
?>