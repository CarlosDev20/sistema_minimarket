
<?php
require_once __DIR__ . '/../../config/Conexion.php';
require_once __DIR__ . '/../entities/Productos.php';

class ProductoModel
{
    public function listar($cTexto = "")
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT p.*, m.descripcion_ma, um.descripcion_um, c.descripcion_ca 
                    FROM tb_productos p
                    INNER JOIN tb_marcas m ON p.codigo_ma = m.codigo_ma
                    INNER JOIN tb_unidades_medidas um ON p.codigo_um = um.codigo_um
                    INNER JOIN tb_categorias c ON p.codigo_ca = c.codigo_ca
                    WHERE p.estado = 1 AND p.descripcion_pr LIKE :texto 
                    ORDER BY p.descripcion_pr";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$cTexto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar productos: " . $e->getMessage());
        }
    }

    public function guardar($opcion, Productos $producto)
    {
        $db = Conexion::getInstancia()->getConexion();
        try {
            $db->beginTransaction();
            $fechaActual = date('Y-m-d H:i:s');

            // Creando el producto
            if($opcion == 1){
                $sql = "INSERT INTO tb_productos (descripcion_pr, codigo_ma, codigo_um, codigo_ca, stock_min, stock_max, fecha_crea, fecha_modifica, estado)
                        VALUES (:descripcion, :marca, :unidad, :categoria, :stockMin, :stockMax, :fecha, :fecha, 1)";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":fecha", $fechaActual);
                $stmt->bindValue(":descripcion", $producto->getDescripcionPr());
                $stmt->bindValue(":marca", $producto->getCodigoMa());
                $stmt->bindValue(":unidad", $producto->getCodigoUm());
                $stmt->bindValue(":categoria", $producto->getCodigoCa());
                $stmt->bindValue(":stockMin", $producto->getStockMin());
                $stmt->bindValue(":stockMax", $producto->getStockMax());
                $stmt->execute();

                //obtener id producto insertado
                $codigo_pr = $db->lastInsertId();
                // insertar el stock a los almacenes

                $sqlStock = "INSERT INTO tb_stock_productos(codigo_pr, codigo_al, stock_actual, pu_compra)
                            SELECT :codigo_pr, codigo_al, 0.00, 0.00
                            FROM tb_almacenes";
                $stmtStock = $db->prepare($sqlStock);
                $stmtStock->bindValue(":codigo_pr", $codigo_pr, PDO::PARAM_INT);
                $stmtStock->execute();
            }else{ //actualizar producto
                $sql = "UPDATE tb_productos 
                        SET descripcion_pr = :descripcion, codigo_ma = :marca, codigo_um = :unidad,
                            codigo_ca = :categoria, stock_min = :stockMin, stock_max = :stockMax,
                            fecha_modifica = :fecha
                        WHERE codigo_pr = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":fecha", $fechaActual);
                $stmt->bindValue(":codigo", $producto->getCodigoPr());
                $stmt->bindValue(":descripcion", $producto->getDescripcionPr());
                $stmt->bindValue(":marca", $producto->getCodigoMa());
                $stmt->bindValue(":unidad", $producto->getCodigoUm());
                $stmt->bindValue(":categoria", $producto->getCodigoCa());
                $stmt->bindValue(":stockMin", $producto->getStockMin());
                $stmt->bindValue(":stockMax", $producto->getStockMax());
                $stmt->execute();

                //verificar si hay almacenes nuevos y agregar stock
                $codigo_pr = $producto->getCodigoPr();
                $sqlStock = "INSERT INTO tb_stock_productos(codigo_pr, codigo_al, stock_actual, pu_compra)
                             SELECT :codigo_pr, codigo_al, 0.00, 0.00
                             FROM tb_almacenes
                             WHERE codigo_al NOT IN (
                                 SELECT codigo_al 
                                 FROM tb_stock_productos 
                                 WHERE codigo_pr = :codigo_pr_in
                             )";
                $stmtStock = $db->prepare($sqlStock);
                $stmtStock->bindValue(":codigo_pr", $codigo_pr, PDO::PARAM_INT);
                $stmtStock->bindValue(":codigo_pr_in", $codigo_pr, PDO::PARAM_INT);
                $stmtStock->execute();
            }

            $db->commit();
            return "OK";
        } catch (PDOException $e) {
            $db->rollBack();
            return "Error: " . $e->getMessage();
        }
    }

    public function eliminar($codigo_pr)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "UPDATE tb_productos SET estado = 0 WHERE codigo_pr = :codigo";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo", $codigo_pr, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "OK";
            }
            return "No se pudo eliminar el producto.";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getProductos(): array
    {
        try{
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT p.codigo_pr, p.descripcion_pr, m.descripcion_ma, c.descripcion_ca, u.descripcion_um
                    FROM tb_productos p
                    INNER JOIN tb_marcas m ON p.codigo_ma = m.codigo_ma
                    INNER JOIN tb_unidades_medidas u ON p.codigo_um = u.codigo_um
                    INNER JOIN tb_categorias c ON p.codigo_ca = c.codigo_ca
                    WHERE p.estado = 1
                    ORDER BY codigo_pr";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            throw new Exception("Error al obtener almacenes: " . $e->getMessage());
        }   
    }

    public function verStockPorAlmacenes($codigo_pr)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT b.descripcion_al, a.stock_actual, a.pu_compra
                    FROM tb_stock_productos a
                    INNER JOIN tb_almacenes b ON a.codigo_al = b.codigo_al
                    WHERE a.codigo_pr = :codigo_pr
                    ORDER BY b.codigo_al";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo_pr", $codigo_pr, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el stock por almacén: " . $e->getMessage());
        }
    }
}
?>