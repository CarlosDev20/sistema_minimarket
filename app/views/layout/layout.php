
<?php
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $baseUrl = $protocol . $host . '/Sistema_Minimarket/public/';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema Minimarket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo $baseUrl; ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px; /* Ancho del sidebar */
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        /* --- LAYOUT PRINCIPAL --- */
        #sidebarMenu {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1030;
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }

        .main-content {
            padding-left: var(--sidebar-width);
            transition: padding-left 0.3s ease-in-out;
        }

        /* --- LÓGICA RESPONSIVE --- */
        @media (max-width: 767.98px) {
            #sidebarMenu {
                transform: translateX(-100%); /* Oculta el sidebar por defecto */
            }
            #sidebarMenu.show {
                transform: translateX(0); /* Lo muestra al hacer clic en el botón */
            }
            .main-content {
                padding-left: 0; /* El contenido ocupa todo el ancho */
            }
        }
        
        /* --- ESTILOS DEL SIDEBAR --- */
        .sidebar-brand {
            padding: 1.15rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .sidebar-header {
            padding: .75rem 1.5rem;
            font-size: .8rem;
            font-weight: 500;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: .05rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: .625rem 1.5rem;
            margin: 0 .5rem;
            color: #adb5bd;
            text-decoration: none;
            transition: all .2s ease-in-out;
            border-radius: .375rem;
        }

        .submenu-link {
            padding-left: 3rem;
        }

        .sidebar-link:hover {
            color: #fff;
            background-color: #343a40;
        }

        .sidebar-link.active {
            color: #fff;
            font-weight: 500;
            background: linear-gradient(90deg, rgba(59, 130, 246, 1) 0%, rgba(37, 99, 235, 1) 100%);
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/sidebar.php'; ?>

    <div class="main-content">
        <main class="container-fluid">
            <?php require_once __DIR__ . '/header.php'; ?>

            <div id="content-wrapper" class="pt-4">
                <?php
                    if (isset($data) && is_array($data)) {
                        extract($data);
                    }
                    if (isset($viewFile) && file_exists($viewFile)) {
                        include $viewFile;
                    } else {
                        echo "<div class='alert alert-danger'>Error: La vista solicitada no se encontró.</div>";
                    }
                ?>
            </div>
            
            <?php require_once __DIR__ . '/footer.php'; ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>