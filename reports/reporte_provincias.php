
<?php
    require_once __DIR__ . '/../lib/fpdf/fpdf.php';
    require_once __DIR__ . '/../app/models/ProvinciaModel.php';

    class reporte_provincias extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Provincias');
            $this->Cell(0, 10, $titulo, 0, 1, 'C');
            $this->Ln(10);
        }

        // Pie de página    
        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . ' / {nb}', 0, 0, 'C');
        }
    }

    // Instancia de PDF
    $pdf = new reporte_provincias();
    $pdf->AliasNbPages();
    $pdf->AddPage(); 
    $pdf->SetFont('Arial', '', 10);

    // Encabezados de la tabla
    $pdf->SetFillColor(224, 235, 255);
    $pdf->Cell(15, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(90, 10, 'Descripcion', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Departamento', 1, 1, 'C', true);

    // Obtener datos desde el modelo
    $model = new ProvinciaModel();
    $provincias = $model->getProvincias();

    // Llenar la tabla
    foreach ($provincias as $provincia) {
        $pdf->Cell(15, 10, $provincia['codigo_po'] ?? '', 1, 0, 'C');
        $pdf->Cell(90, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $provincia['descripcion_po']), 1, 0, 'C');
        $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $provincia['descripcion_de']), 1, 1, 'C');
    }

    // Salida del PDF
    $pdf->Output('I', 'reporte_provincias.pdf');
?>