
<?php

require_once __DIR__ . '/../lib/fpdf/fpdf.php';
require_once __DIR__ . '/../app/models/DepartamentoModel.php';

class reporte_departamentos extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Departamentos');
        $this->Cell(0, 10, $titulo, 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
    }
}

$pdf = new reporte_departamentos();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(40, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(120, 10, 'Nombre Departamento', 1, 1, 'C', true);

$model = new DepartamentoModel();
$departamentos = $model->listar(); 

foreach ($departamentos as $row) {
    $pdf->Cell(40, 10, $row['codigo_de'], 1, 0, 'C');
    $descripcion = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['descripcion_de']);
    $pdf->Cell(120, 10, $descripcion, 1, 1, 'L');
}

$pdf->Output('I', 'reporte_departamentos.pdf');
?>