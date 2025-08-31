
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
            $sql = "SELECT * FROM almacenes WHERE descripcion_al LIKE :texto ORDER BY descripcion_al";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$cTexto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // devuelve array asociativo
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
                $sql = "INSERT INTO almacenes (descripcion_al) VALUES (:descripcion)";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $almacen->getDescripcionAl());
                $stmt->execute();
                return "OK";
            } else if ($opcion == 2) { // Actualizar
                $sql = "UPDATE almacenes SET descripcion_al = :descripcion WHERE codigo_al = :codigo";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(":descripcion", $almacen->getDescripcionAl());
                $stmt->bindValue(":codigo", $almacen->getCodigoAl(), PDO::PARAM_INT);
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
            $sql = "DELETE FROM almacenes WHERE codigo_al = :codigo";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":codigo", $codigo_al, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() == 1 ? "OK" : "No se pudo eliminar los datos";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>