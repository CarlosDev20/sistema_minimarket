
<?php
    class Departamentos
    {
        private $codigo_de;
        private $descripcion_de;

        public function getCodigoDe()
        {
            return $this->codigo_de;
        }
        public function getDescripcionDe()
        {
            return $this->descripcion_de;
        }

        public function setCodigoDe($codigo_de)
        {
            $this->codigo_de = $codigo_de;
        }
        public function setDescripcionDe($descripcion_de)
        {
            $this->descripcion_de = $descripcion_de;
        }
    }
?>
