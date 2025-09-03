
<?php
    require_once __DIR__ . '/../config/Conexion.php';
    require_once __DIR__ . '/../entities/Almacenes.php';

    class AlmacenModel
    {

        // Listar almacenes (filtrado por texto opcional)
        public function listar($cTexto = "")
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT * 
                        FROM tb_almacenes 
                        WHERE estado = 1 
                        AND (descripcion_al LIKE :texto)
                        ORDER BY codigo_al";
                $stmt = $db->prepare($sql);
                $stmt->execute([':texto' => "%$cTexto%"]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al listar almacenes: " . $e->getMessage());
            }
        }

        // Guardar o actualizar (si viene con id)
        public function guardar($opcion, Almacenes $almacen)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                if ($opcion == 1) { // Insertar
                    $sql = "INSERT INTO tb_almacenes (descripcion_al, estado) 
                            VALUES (:descripcion, :estado)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $almacen->getDescripcionAl());
                    $stmt->bindValue(":estado", 1);
                    $stmt->execute();
                    return "OK";

                } elseif ($opcion == 2) { // Actualizar
                    $sql = "UPDATE tb_almacenes
                            SET descripcion_al = :descripcion 
                            WHERE codigo_al = :codigo";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $almacen->getDescripcionAl());
                    $stmt->bindValue(":codigo", $almacen->getCodigoAl());
                    $stmt->execute();
                    return "OK";
                } else {
                    return "Opción no válida";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }

        // Eliminar
        public function eliminar($codigo_al)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                $sql = "UPDATE tb_almacenes 
                        SET estado = 0 
                        WHERE codigo_al = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $codigo_al, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    return "OK";
                } else {
                    return "No se pudo eliminar el almacen";
                }
            } catch (PDOException $e) {
                return "Error al eliminar almacen: " . $e->getMessage();
            }
        }

        public function getAlmacenes()
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT codigo_al, descripcion_al 
                        FROM tb_almacenes 
                        WHERE estado = 1
                        ORDER BY codigo_al";
                $stmt = $db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al obtener almacenes: " . $e->getMessage());
            }
        }

    }
?>