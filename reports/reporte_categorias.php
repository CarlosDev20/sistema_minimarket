
<?php
    require_once __DIR__ . '/../lib/fpdf/fpdf.php'; // Ajusta la ruta según dónde esté FPDF
    require_once __DIR__ . '/../app/models/CategoriaModel.php'; // Modelo de categorías

    class reporte_categorias extends FPDF
    {
        // Cabecera del reporte
        function Header()
        {
            // Logo si quieres
            //$this->Image(__DIR__ . '/../assets/logo.png', 10, 8, 20);

            $this->SetFont('Arial', 'B', 14);
            $titulo = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Reporte de Categorías');
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

    // Instancia del PDF
    $pdf = new reporte_categorias();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Encabezados de tabla
    $pdf->SetFillColor(200, 220, 255);
    $pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
    $pdf->Cell(120, 10, 'Nombre Categoria', 1, 1, 'C', true);

    // Obtener datos
    $model = new CategoriaModel();
    $categorias = $model->getCategorias(); // Método que retorna array de categorías activas

    // Llenar la tabla
    foreach ($categorias as $row) {
        $pdf->Cell(20, 10, $row['codigo_ca'], 1, 0, 'C');
        $descripcion = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['descripcion_ca']);
        $pdf->Cell(120, 10, $descripcion, 1, 1, 'L');
    }

    // Generar salida
    $pdf->Output('I', 'reporte_categorias.pdf');
?>
