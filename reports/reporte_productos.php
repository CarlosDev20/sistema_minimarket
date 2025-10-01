
<?php
    require_once __DIR__ . '/../lib/fpdf/fpdf.php';
    require_once __DIR__ . '/../app/models/ProductoModel.php';

    class reporte_productos extends FPDF
    {
        // Cabecera del reporte
        function Header()
        {
            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Productos');
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
    $pdf = new reporte_productos();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4'); // 'L' para orientación horizontal
    $pdf->SetFont('Arial', '', 10);

    // Encabezados de la tabla
    $pdf->SetFillColor(224, 235, 255);
    $pdf->Cell(15, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(90, 10, 'Descripcion', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Marca', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'Categoria', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Medida', 1, 1, 'C', true);

    // Obtener datos desde el modelo
    $model = new ProductoModel();
    $productos = $model->getProductos();

    // Llenar la tabla
    foreach ($productos as $producto) {
        $pdf->Cell(15, 10, $producto['codigo_pr'] ?? '', 1, 0, 'C');
        $pdf->Cell(90, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $producto['descripcion_pr']), 1, 0, 'C');
        $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $producto['descripcion_ma']), 1, 0, 'C');
        $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $producto['descripcion_ca']), 1, 0, 'C');
        $pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $producto['descripcion_um']), 1, 1, 'C');
    }

    // Salida del PDF
    $pdf->Output('I', 'reporte_productos.pdf');
?>