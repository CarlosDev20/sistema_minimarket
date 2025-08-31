
<?php
require_once __DIR__ . '/../lib/fpdf/fpdf.php'; // Ajusta la ruta según dónde esté FPDF
require_once __DIR__ . '/../models/UnidadMedidaModel.php'; // Tu modelo para obtener datos

class reporte_unidades extends FPDF
{
    // Cabecera del reporte
    function Header()
    {
        // Logo (opcional, asegúrate de tener la imagen en assets)
        //$this->Image(__DIR__ . '/../assets/logo.png', 10, 8, 20);

        // Fuente para el título
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, utf8_decode('Reporte de Unidades de Medida'), 0, 1, 'C');
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
    }
}

// Instancia de PDF
$pdf = new reporte_unidades();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Encabezados de la tabla
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(80, 10, 'Nombre', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Abreviatura', 1, 1, 'C', true);

// Obtener datos desde el modelo
$model = new UnidadMedidaModel();
$unidades = $model->getUnidades(); // Este método debe retornar un array con los datos

// Llenar la tabla
foreach ($unidades as $row) {
    $pdf->Cell(20, 10, $row['codigo_um'], 1, 0, 'C');
    $pdf->Cell(80, 10, utf8_decode($row['descripcion_um']), 1, 0, 'L');
    $pdf->Cell(40, 10, $row['abreviatura_um'], 1, 1, 'C');
}

// Salida del PDF
$pdf->Output('I', 'reporte_unidades.pdf');
