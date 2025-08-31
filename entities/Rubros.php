
<?php
    class Rubros
    {
        private $codigo_ru;
        private $descripcion_ru;

        // Getters
        public function getCodigoRu()
        {
            return $this->codigo_ru;
        }
        public function getDescripcionRu()
        {
            return $this->descripcion_ru;
        }

        // Setters
        public function setCodigoRu($codigo_ru)
        {
            $this->codigo_ru = $codigo_ru;
        }
        public function setDescripcionRu($descripcion_ru)
        {
            $this->descripcion_ru = $descripcion_ru;
        }
    }
?>