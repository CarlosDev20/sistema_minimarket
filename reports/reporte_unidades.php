
<?php

    require_once __DIR__ . '/../lib/fpdf/fpdf.php';
    require_once __DIR__ . '/../app/models/UnidadMedidaModel.php'; 

    class reporte_unidades extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Unidades de Medida');
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

    $pdf = new reporte_unidades();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(30, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Abreviatura', 1, 0, 'C', true);
    $pdf->Cell(100, 10, 'Nombre', 1, 1, 'C', true);

    $model = new UnidadMedidaModel();
    $unidades = $model->getUnidades();

    foreach ($unidades as $row) {
        $pdf->Cell(30, 10, $row['codigo_um'], 1, 0, 'C');
        $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['abreviatura_um']), 1, 0, 'C');
        $pdf->Cell(100, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['descripcion_um']), 1, 1, 'L');
    }

    $pdf->Output('I', 'reporte_unidades.pdf');
    
?>