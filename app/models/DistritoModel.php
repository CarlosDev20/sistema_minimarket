
<?php
    require_once __DIR__ . '/../../config/Conexion.php';
    require_once __DIR__ . '/../entities/Distritos.php';

    class DistritoModel
    {
        public function listar($texto = "")
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT di.*, po.descripcion_po, de.descripcion_de 
                        FROM tb_distritos di
                        INNER JOIN tb_provincias po ON di.codigo_po = po.codigo_po
                        INNER JOIN tb_departamentos de ON po.codigo_de = de.codigo_de
                        WHERE di.estado = 1 AND di.descripcion_di LIKE :texto
                        ORDER BY di.descripcion_di";
                $stmt = $db->prepare($sql);
                $stmt->execute([':texto' => "%$texto%"]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al listar distritos: " . $e->getMessage());
            }
        }

        public function guardar($opcion, Distritos $distrito)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                if ($opcion == 1) { 
                    $sql = "INSERT INTO tb_distritos (descripcion_di, codigo_po, estado) 
                            VALUES (:descripcion, :codigo_po, 1)";
                    $stmt = $db->prepare($sql);
                } else { 
                    $sql = "UPDATE tb_distritos SET descripcion_di = :descripcion, codigo_po = :codigo_po
                            WHERE codigo_di = :codigo";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":codigo", $distrito->getCodigoDi(), PDO::PARAM_INT);
                }
                $stmt->bindValue(":descripcion", $distrito->getDescripcionDi());
                $stmt->bindValue(":codigo_po", $distrito->getCodigoPo(), PDO::PARAM_INT);
                $stmt->execute();
                return "OK";
            } catch (PDOException $e) {
                return "Error al guardar distrito: " . $e->getMessage();
            }
        }

        public function eliminar($codigo_di)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "UPDATE tb_distritos SET estado = 0 WHERE codigo_di = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $codigo_di, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    return "OK";
                }
                return "No se pudo eliminar el distrito.";
            } catch (PDOException $e) {
                return "Error al eliminar distrito: " . $e->getMessage();
            }
        }
    }
?>