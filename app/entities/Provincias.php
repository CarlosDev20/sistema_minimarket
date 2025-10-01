
<?php

class Provincias
{
    private $codigo_po;
    private $descripcion_po;
    private $codigo_de;

    public function getCodigoPo() { return $this->codigo_po; }
    public function getDescripcionPo() { return $this->descripcion_po; }
    public function getCodigoDe() { return $this->codigo_de; }

    public function setCodigoPo($codigo_po) { $this->codigo_po = $codigo_po; }
    public function setDescripcionPo($descripcion_po) { $this->descripcion_po = $descripcion_po; }
    public function setCodigoDe($codigo_de) { $this->codigo_de = $codigo_de; }
}
?>