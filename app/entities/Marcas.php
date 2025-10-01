<?php

class Marcas
{
    private $codigo_ma;
    private $descripcion_ma;

    // Getters
    public function getCodigoMa()
    {
        return $this->codigo_ma;
    }
    public function getDescripcionMa()
    {
        return $this->descripcion_ma;
    }

    // Setters
    public function setCodigoMa($codigo_ma)
    {
        $this->codigo_ma = $codigo_ma;
    }
    public function setDescripcionMa($descripcion_ma)
    {
        $this->descripcion_ma = $descripcion_ma;
    }

}
?>