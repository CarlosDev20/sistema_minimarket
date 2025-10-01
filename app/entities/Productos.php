<?php

class Productos
{

    private $codigo_pr;
    private $descripcion_pr;
    private $codigo_ma;
    private $codigo_um;
    private $codigo_ca;
    private $stock_min;
    private $stock_max;

    // Getters
    public function getCodigoPr()
    {
        return $this->codigo_pr;
    }
    public function getDescripcionPr()
    {
        return $this->descripcion_pr;
    }
    public function getCodigoMa()
    {
        return $this->codigo_ma;
    }
    public function getCodigoUm()
    {
        return $this->codigo_um;
    }
    public function getCodigoCa()
    {
        return $this->codigo_ca;
    }
    public function getStockMin()
    {
        return $this->stock_min;
    }
    public function getStockMax()
    {
        return $this->stock_max;
    }

    // Setters
    public function setCodigoPr($codigo_pr)
    {
        $this->codigo_pr = $codigo_pr;
    }
    public function setDescripcionPr($descripcion_pr)
    {
        $this->descripcion_pr = $descripcion_pr;
    }
    public function setCodigoMa($codigo_ma)
    {
        $this->codigo_ma = $codigo_ma;
    }
    public function setCodigoUm($codigo_um)
    {
        $this->codigo_um = $codigo_um;
    }
    public function setCodigoCa($codigo_ca)
    {
        $this->codigo_ca = $codigo_ca;
    }
    public function setStockMin($stock_min)
    {
        $this->stock_min = $stock_min;
    }
    public function setStockMax($stock_max)
    {
        $this->stock_max = $stock_max;
    }

}

?>