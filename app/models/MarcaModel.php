<?php
    require_once __DIR__ . '/../../config/Conexion.php';
    require_once __DIR__ . '/../../app/entities/Marcas.php';

    class MarcaModel
    {
        // Listar marcas activas
        public function listar($cTexto = "")
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT * 
                        FROM tb_marcas 
                        WHERE estado = 1 
                        AND (descripcion_ma LIKE :texto)
                        ORDER BY codigo_ma";
                $stmt = $db->prepare($sql);
                $stmt->execute([':texto' => "%$cTexto%"]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al listar marcas: " . $e->getMessage());
            }
        }

        // Guardar marca (Insertar o Actualizar)
        public function guardar($opcion, Marcas $ma)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                if ($opcion == 1) { // Insertar
                    $sql = "INSERT INTO tb_marcas (descripcion_ma, estado) 
                            VALUES (:descripcion, :estado)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $ma->getDescripcionMa());
                    $stmt->bindValue(":estado", 1);
                    $stmt->execute();
                    return "OK";

                } elseif ($opcion == 2) { // Actualizar
                    $sql = "UPDATE tb_marcas 
                            SET descripcion_ma = :descripcion 
                            WHERE codigo_ma = :codigo";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $ma->getDescripcionMa());
                    $stmt->bindValue(":codigo", $ma->getCodigoMa());
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
        public function eliminar($codigo_ma)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                $sql = "UPDATE tb_marcas 
                        SET estado = 0 
                        WHERE codigo_ma = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $codigo_ma, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    return "OK";
                } else {
                    return "No se pudo eliminar la marca";
                }
            } catch (PDOException $e) {
                return "Error al eliminar marca: " . $e->getMessage();
            }
        }

        public function getMarcas()
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT codigo_ma, descripcion_ma 
                        FROM tb_marcas 
                        WHERE estado = 1
                        ORDER BY codigo_ma";
                $stmt = $db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al obtener marcas: " . $e->getMessage());
            }
        }
    }
?>