
<?php

require_once __DIR__ . '/../../config/Conexion.php';
require_once __DIR__ . '/../../app/entities/Departamentos.php';

class DepartamentoModel
{
    public function listar($cTexto = "")
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT * FROM 
                    tb_departamentos WHERE 
                    estado = 1
                    AND (descripcion_de LIKE :texto)
                    ORDER BY codigo_de";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$cTexto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar departamentos: " . $e->getMessage());
        }
    }

    public function guardar($opcion, Departamentos $departamento)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();

            if ($opcion == 1) { // Insertar
                $sql = "INSERT INTO tb_departamentos (descripcion_de, estado) VALUES (:descripcion, 1)";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $departamento->getDescripcionDe());
            } else { // Actualizar
                $sql = "UPDATE tb_departamentos SET descripcion_de = :descripcion WHERE codigo_de = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $departamento->getDescripcionDe());
                $stmt->bindValue(":codigo", $departamento->getCodigoDe(), PDO::PARAM_INT);
            }
            $stmt->execute();
            return "OK";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function eliminar($codigo_de)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "UPDATE tb_departamentos 
                    SET estado = 0 
                    WHERE codigo_de = :codigo";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo", $codigo_de, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return "OK";
            } else {
                return "No se pudo eliminar el departamento.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>