
<?php

    require_once __DIR__ . '/../lib/fpdf/fpdf.php';
    require_once __DIR__ . '/../app/models/RubroModel.php'; 

    class reporte_rubros extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Rubros');
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

    $pdf = new reporte_rubros();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(40, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(120, 10, 'Nombre Rubro', 1, 1, 'C', true);

    $model = new RubroModel();
    $rubros = $model->getRubros();

    foreach ($rubros as $row) {
        $pdf->Cell(40, 10, $row['codigo_ru'], 1, 0, 'C');
        $descripcion = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['descripcion_ru']);
        $pdf->Cell(120, 10, $descripcion, 1, 1, 'L');
    }

    $pdf->Output('I', 'reporte_rubros.pdf');
?>