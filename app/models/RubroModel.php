
<?php
    require_once __DIR__ . '/../../config/Conexion.php';
    require_once __DIR__ . '/../../app/entities/Rubros.php';

    class RubroModel
    {

        // Listado de Rubros
        public function listar($cTexto = "")
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT * 
                        FROM tb_rubros 
                        WHERE estado = 1
                        AND (descripcion_ru LIKE :texto) 
                        ORDER BY codigo_ru";
                $stmt = $db->prepare($sql);
                $stmt->execute([':texto' => "%$cTexto%"]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al listar rubros: " . $e->getMessage());
            }
        }

        // Guardar Rubro (insertar o actualizar)
        public function guardar($opcion, Rubros $rubro)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                if ($opcion == 1) { // Insertar
                    $sql = "INSERT INTO tb_rubros (descripcion_ru, estado) 
                            VALUES (:descripcion, :estado)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $rubro->getDescripcionRu());
                    $stmt->bindValue(":estado", 1);
                    $stmt->execute();
                    return "OK";
                } elseif ($opcion == 2) { // Actualizar
                    $sql = "UPDATE tb_rubros 
                            SET descripcion_ru = :descripcion 
                            WHERE codigo_ru = :codigo";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":descripcion", $rubro->getDescripcionRu());
                    $stmt->bindValue(":codigo", $rubro->getCodigoRu());
                    $stmt->execute();
                    return "OK";
                } else {
                    return "Opción no válida";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }

        // Eliminar Rubro
        public function eliminar($codigo_ru)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "UPDATE tb_rubros
                        SET estado = 0
                        WHERE codigo_ru = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $codigo_ru, PDO::PARAM_INT);
                
                if($stmt->execute()){
                    return "OK";
                }else{
                    return "No se pudo eliminar el rubro";
                }
            } catch (PDOException $e) {
                return "Error al eliminar el rubro: " . $e->getMessage();
            }
        }

        public function getRubros()
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT codigo_ru, descripcion_ru 
                        FROM tb_rubros 
                        WHERE estado = 1
                        ORDER BY codigo_ru";
                $stmt = $db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al obtener rubros: " . $e->getMessage());
            }
        }

    }
?>