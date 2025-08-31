
<?php
class Unidades_Medidas
{
    private $codigo_um;
    private $abreviatura_um;
    private $descripcion_um;

    // Getters
    public function getCodigoUm()
    {
        return $this->codigo_um;
    }
    public function getAbreviaturaUm()
    {
        return $this->abreviatura_um;
    }
    public function getDescripcionUm()
    {
        return $this->descripcion_um;
    }

    // Setters
    public function setCodigoUm($codigo_um)
    {
        $this->codigo_um = $codigo_um;
    }
    public function setAbreviaturaUm($abreviatura_um)
    {
        $this->abreviatura_um = $abreviatura_um;
    }
    public function setDescripcionUm($descripcion_um)
    {
        $this->descripcion_um = $descripcion_um;
    }
}
?>