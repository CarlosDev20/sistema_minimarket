
<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../entities/Departamentos.php';

class DepartamentoModel
{

    // Listar departamentos
    public function listar($cTexto = "")
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT * FROM departamentos WHERE descripcion_de LIKE :texto ORDER BY descripcion_de";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$cTexto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar departamentos: " . $e->getMessage());
        }
    }

    // Guardar o actualizar departamento
    public function guardar($opcion, Departamentos $departamento)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();

            if ($opcion == 1) { // Insertar
                $sql = "INSERT INTO departamentos (descripcion_de) VALUES (:descripcion)";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $departamento->getDescripcionDe());
                $stmt->execute();
                return "OK";
            } else if ($opcion == 2) { // Actualizar
                $sql = "UPDATE departamentos SET descripcion_de = :descripcion WHERE codigo_de = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $departamento->getDescripcionDe());
                $stmt->bindValue(":codigo", $departamento->getCodigoDe(), PDO::PARAM_INT);
                $stmt->execute();
                return "OK";
            } else {
                return "Opción no válida";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Eliminar departamento
    public function eliminar($codigo_de)
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "DELETE FROM departamentos WHERE codigo_de = :codigo";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo", $codigo_de, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() == 1 ? "OK" : "No se pudo eliminar los datos";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>