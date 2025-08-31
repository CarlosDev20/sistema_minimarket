<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../entities/Productos.php';

class ProductoModel
{

    // Listado general de productos
    public function listar($cTexto = "")
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT * FROM productos WHERE descripcion_pr LIKE :texto ORDER BY descripcion_pr";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$cTexto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar productos: " . $e->getMessage());
        }
    }

    // Guardar producto (insertar o actualizar)
    public function guardar($opcion, Productos $producto)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();

            if ($opcion == 1) { // Insertar
                $sql = "INSERT INTO productos (descripcion_pr, codigo_ma, codigo_um, codigo_ca, stock_min, stock_max)
                        VALUES (:descripcion, :marca, :unidad, :categoria, :stockMin, :stockMax)";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $producto->getDescripcionPr());
                $stmt->bindValue(":marca", $producto->getCodigoMa());
                $stmt->bindValue(":unidad", $producto->getCodigoUm());
                $stmt->bindValue(":categoria", $producto->getCodigoCa());
                $stmt->bindValue(":stockMin", $producto->getStockMin());
                $stmt->bindValue(":stockMax", $producto->getStockMax());
                $stmt->execute();
                return "OK";
            } else if ($opcion == 2) { // Actualizar
                $sql = "UPDATE productos 
                        SET descripcion_pr = :descripcion, 
                            codigo_ma = :marca,
                            codigo_um = :unidad,
                            codigo_ca = :categoria,
                            stock_min = :stockMin,
                            stock_max = :stockMax
                        WHERE codigo_pr = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $producto->getDescripcionPr());
                $stmt->bindValue(":marca", $producto->getCodigoMa());
                $stmt->bindValue(":unidad", $producto->getCodigoUm());
                $stmt->bindValue(":categoria", $producto->getCodigoCa());
                $stmt->bindValue(":stockMin", $producto->getStockMin());
                $stmt->bindValue(":stockMax", $producto->getStockMax());
                $stmt->bindValue(":codigo", $producto->getCodigoPr());
                $stmt->execute();
                return "OK";
            } else {
                return "Opción no válida";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar producto
    public function eliminar($codigo_pr)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "DELETE FROM productos WHERE codigo_pr = :codigo";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo", $codigo_pr, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() == 1 ? "OK" : "No se pudo eliminar los datos";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Listar marcas para productos
    public function listarMarcas($cTexto = "")
    {
        $db = Conexion::getInstancia()->getConexion();
        $sql = "SELECT * FROM marcas WHERE descripcion_ma LIKE :texto ORDER BY descripcion_ma";
        $stmt = $db->prepare($sql);
        $stmt->execute([':texto' => "%$cTexto%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar unidades de medida
    public function listarUnidades($cTexto = "")
    {
        $db = Conexion::getInstancia()->getConexion();
        $sql = "SELECT * FROM unidades_medida WHERE descripcion_um LIKE :texto ORDER BY descripcion_um";
        $stmt = $db->prepare($sql);
        $stmt->execute([':texto' => "%$cTexto%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar categorías
    public function listarCategorias($cTexto = "")
    {
        $db = Conexion::getInstancia()->getConexion();
        $sql = "SELECT * FROM categorias WHERE descripcion_ca LIKE :texto ORDER BY descripcion_ca";
        $stmt = $db->prepare($sql);
        $stmt->execute([':texto' => "%$cTexto%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ver stock actual de un producto por almacenes
    public function verStockPorAlmacenes($codigo_pr)
    {
        $db = Conexion::getInstancia()->getConexion();
        $sql = "SELECT a.descripcion_al, s.stock_actual 
                FROM stock_almacenes s 
                INNER JOIN almacenes a ON s.codigo_al = a.codigo_al
                WHERE s.codigo_pr = :codigo";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":codigo", $codigo_pr, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>