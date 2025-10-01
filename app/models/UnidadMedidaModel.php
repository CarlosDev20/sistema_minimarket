<?php
    require_once __DIR__ . '/../../config/Conexion.php';
    require_once __DIR__ . '/../../app/entities/Unidades_Medidas.php';

    class UnidadMedidaModel
    {

        // Listado de unidades de medida
        public function listar($cTexto = "")
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT * 
                    FROM tb_unidades_medidas 
                    WHERE estado = 1 
                    AND (descripcion_um LIKE :texto OR abreviatura_um LIKE :texto)
                    ORDER BY codigo_um";
                $stmt = $db->prepare($sql);
                $stmt->execute([':texto' => "%$cTexto%"]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al listar unidades de medida: " . $e->getMessage());
            }
        }

        // Guardar (Insertar o Actualizar)
        public function guardar($opcion, Unidades_Medidas $um)
        {
            try {
                $db = Conexion::getInstancia()->getConexion();

                if ($opcion == 1) { // Insertar
                    $sql = "INSERT INTO tb_unidades_medidas (abreviatura_um, descripcion_um, estado) 
                        VALUES (:abreviatura, :descripcion, :estado)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":abreviatura", $um->getAbreviaturaUm());
                    $stmt->bindValue(":descripcion", $um->getDescripcionUm());
                    $stmt->bindValue(":estado", 1);
                    $stmt->execute();
                    return "OK";

                } elseif ($opcion == 2) { // Actualizar
                    $sql = "UPDATE tb_unidades_medidas 
                        SET abreviatura_um = :abreviatura, descripcion_um = :descripcion 
                        WHERE codigo_um = :codigo";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue(":abreviatura", $um->getAbreviaturaUm());
                    $stmt->bindValue(":descripcion", $um->getDescripcionUm());
                    $stmt->bindValue(":codigo", $um->getCodigoUm());
                    $stmt->execute();
                    return "OK";

                } else {
                    return "Opción no válida";
                }
            } catch (PDOException $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public function eliminar($codigo_um)
        {
            try{
                $db = Conexion::getInstancia()->getConexion();

                $sql = "UPDATE tb_unidades_medidas 
                    SET estado = 0 
                    WHERE codigo_um = :codigo";

                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $codigo_um, PDO::PARAM_INT);

                if($stmt->execute()){
                    return "OK";
                }else{
                    return "No se pudo eliminar el registro";
                }

            }catch (PDOException $e) {
                return "Error al eliminar unidad de medida: " . $e->getMessage();
            }
        }

        public function getUnidades()
        {
            try {
                $db = Conexion::getInstancia()->getConexion();
                $sql = "SELECT codigo_um, abreviatura_um, descripcion_um 
                        FROM tb_unidades_medidas 
                        WHERE estado = 1
                        ORDER BY codigo_um";
                $stmt = $db->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Error al obtener unidades: " . $e->getMessage());
            }
        }
    }
?>