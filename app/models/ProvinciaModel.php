
<?php

require_once __DIR__ . '/../../config/Conexion.php';
require_once __DIR__ . '/../entities/Provincias.php';

class ProvinciaModel
{
    public function listar($texto = "")
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT p.*, d.descripcion_de 
                    FROM tb_provincias p
                    INNER JOIN tb_departamentos d ON p.codigo_de = d.codigo_de
                    WHERE p.estado = 1 AND p.descripcion_po LIKE :texto
                    ORDER BY p.descripcion_po";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$texto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar provincias: " . $e->getMessage());
        }
    }

    public function guardar($opcion, Provincias $provincia)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            if ($opcion == 1) { // Insertar
                $sql = "INSERT INTO tb_provincias (descripcion_po, codigo_de, estado) 
                        VALUES (:descripcion, :codigo_de, 1)";
                $stmt = $db->prepare($sql);
            } else { // Actualizar
                $sql = "UPDATE tb_provincias SET descripcion_po = :descripcion, codigo_de = :codigo_de
                        WHERE codigo_po = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":codigo", $provincia->getCodigoPo(), PDO::PARAM_INT);
            }
            $stmt->bindValue(":descripcion", $provincia->getDescripcionPo());
            $stmt->bindValue(":codigo_de", $provincia->getCodigoDe(), PDO::PARAM_INT);
            $stmt->execute();
            return "OK";
        } catch (PDOException $e) {
            return "Error al guardar provincia: " . $e->getMessage();
        }
    }

    public function eliminar($codigo_po)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "UPDATE tb_provincias SET estado = 0 WHERE codigo_po = :codigo";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo", $codigo_po, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "OK";
            }
            return "No se pudo eliminar la provincia.";
        } catch (PDOException $e) {
            return "Error al eliminar provincia: " . $e->getMessage();
        }
    }

    public function getProvincias()
    {
        try{
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT  o.codigo_po, o.descripcion_po, d.descripcion_de
                    FROM tb_provincias o
                    INNER JOIN tb_departamentos d ON o.codigo_de = d.codigo_de
                    WHERE o.estado = 1
                    ORDER BY codigo_po";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            throw new Exception("Error al obtener almacenes: " . $e->getMessage());
        }
    }
}
?>