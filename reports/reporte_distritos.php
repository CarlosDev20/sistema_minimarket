
<?php
    require_once __DIR__ . '/../lib/fpdf/fpdf.php';
    require_once __DIR__ . '/../app/models/DistritoModel.php';

    class reporte_distritos extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Distritos');
            $this->Cell(0, 10, $titulo, 0, 1, 'C');
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
            $this->Ln(5);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
        }
    }

    // Instancia de PDF
    $pdf = new reporte_distritos();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4'); // 'L' para orientación horizontal
    $pdf->SetFont('Arial', '', 9);

    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(90, 10, 'Distrito', 1, 0, 'C', true);
    $pdf->Cell(85, 10, 'Provincia', 1, 0, 'C', true);
    $pdf->Cell(80, 10, 'Departamento', 1, 1, 'C', true);

    // Obtener datos
    $model = new DistritoModel();
    $distritos = $model->listar();

    // Llenar la tabla
    foreach ($distritos as $distrito) {
        $pdf->Cell(20, 10, $distrito['codigo_di'], 1, 0, 'C');
        $pdf->Cell(90, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $distrito['descripcion_di']), 1, 0, 'L');
        $pdf->Cell(85, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $distrito['descripcion_po']), 1, 0, 'L');
        $pdf->Cell(80, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $distrito['descripcion_de']), 1, 1, 'L');
    }

    $pdf->Output('I', 'reporte_distritos.pdf');
?>