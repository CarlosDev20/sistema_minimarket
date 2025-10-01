
<?php

    require_once __DIR__ . '/../lib/fpdf/fpdf.php';
    require_once __DIR__ . '/../app/models/MarcaModel.php'; 

    class reporte_marcas extends FPDF
    {
        // Cabecera del reporte
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Marcas');
            $this->Cell(0, 10, $titulo, 0, 1, 'C');
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
    $pdf = new reporte_marcas();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Encabezados de la tabla
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(40, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(120, 10, 'Nombre Marca', 1, 1, 'C', true);

    // Obtener datos desde el modelo
    $model = new MarcaModel();
    $marcas = $model->getMarcas();

    // Llenar la tabla
    foreach ($marcas as $row) {
        $pdf->Cell(40, 10, $row['codigo_ma'], 1, 0, 'C');
        $descripcion = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['descripcion_ma']);
        $pdf->Cell(120, 10, $descripcion, 1, 1, 'L');
    }

    // Salida del PDF
    $pdf->Output('I', 'reporte_marcas.pdf');

?>