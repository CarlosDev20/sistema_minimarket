
<?php
    require_once __DIR__ . '/../../config/Conexion.php';
    require_once __DIR__ . '/../../app/entities/Categorias.php';

    class CategoriaModel
    {
        public function listar($cTexto = "")
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT * 
                        FROM tb_categorias 
                        WHERE estado = 1 
                        AND (descripcion_ca LIKE :texto)
                        ORDER BY codigo_ca";
                $stmt = $db->prepare($sql);
                $stmt->execute([':texto' => "%$cTexto%"]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al listar categorías: " . $e->getMessage());
            }
        }

        // Guardar categoría (Insertar o Actualizar)
        public function guardar($opcion, Categorias $ca)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                if ($opcion == 1) { // Insertar
                    $sql = "INSERT INTO tb_categorias (descripcion_ca, estado) 
                            VALUES (:descripcion, :estado)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $ca->getDescripcionCa());
                    $stmt->bindValue(":estado", 1);
                    $stmt->execute();
                    return "OK";

                } elseif ($opcion == 2) { // Actualizar
                    $sql = "UPDATE tb_categorias 
                            SET descripcion_ca = :descripcion
                            WHERE codigo_ca = :codigo";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $ca->getDescripcionCa());
                    $stmt->bindValue(":codigo", $ca->getCodigoCa());
                    $stmt->execute();
                    return "OK";
                } else {
                    return "Opción no válida";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }

        // Eliminar (lógico)
        public function eliminar($codigo_ca)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                $sql = "UPDATE tb_categorias 
                        SET estado = 0 
                        WHERE codigo_ca = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $codigo_ca, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    return "OK";
                } else {
                    return "No se pudo eliminar la categoría";
                }
            } catch (PDOException $e) {
                return "Error al eliminar categoría: " . $e->getMessage();
            }
        }

        public function getCategorias()
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT codigo_ca, descripcion_ca, estado 
                        FROM tb_categorias 
                        WHERE estado = 1
                        ORDER BY codigo_ca";
                $stmt = $db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al obtener categorías: " . $e->getMessage());
            }
        }
    }
?>
