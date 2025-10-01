
<?php

    class Distritos
    {
        private $codigo_di;
        private $descripcion_di;
        private $codigo_po;

        public function getCodigoDi() { return $this->codigo_di; }
        public function getDescripcionDi() { return $this->descripcion_di; }
        public function getCodigoPo() { return $this->codigo_po; }

        public function setCodigoDi($codigo_di) { $this->codigo_di = $codigo_di; }
        public function setDescripcionDi($descripcion_di) { $this->descripcion_di = $descripcion_di; }
        public function setCodigoPo($codigo_po) { $this->codigo_po = $codigo_po; }
    }
?>