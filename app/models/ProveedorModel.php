
<?php
require_once __DIR__ . '/../../config/Conexion.php';
require_once __DIR__ . '/../entities/Proveedores.php';

class ProveedorModel
{
    public function listar($texto = "")
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT 
                        pv.codigo_pv,
                        pv.nrodocumento_pv,
                        pv.razon_social_pv,
                        pv.nombres,
                        pv.apellidos,
                        pv.email_pv,
                        tdpc.descripcion_tdpc,
                        ru.descripcion_ru,
                        di.descripcion_di
                    FROM 
                        tb_proveedores pv
                    INNER JOIN 
                        tb_tipos_documentos_pv_cl tdpc ON pv.codigo_tdpc = tdpc.codigo_tdpc
                    INNER JOIN 
                        tb_rubros ru ON pv.codigo_ru = ru.codigo_ru
                    INNER JOIN 
                        tb_distritos di ON pv.codigo_di = di.codigo_di
                    WHERE 
                        pv.estado = 1 AND pv.razon_social_pv LIKE :texto
                    ORDER BY 
                        pv.razon_social_pv";
            $stmt = $db->prepare($sql);
            $stmt->execute([':texto' => "%$texto%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar proveedores: " . $e->getMessage());
        }
    }


    public function listarTiposDocumento()
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT codigo_tdpc, descripcion_tdpc FROM tb_tipos_documentos_pv_cl WHERE estado = 1";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar tipos de documento: " . $e->getMessage());
        }
    }

    public function listarSexos()
    {
        try {
            $db = Conexion::getInstancia()->getConexion();
            $sql = "SELECT codigo_sx, descripcion_sx FROM tb_sexos WHERE estado = 1";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al listar sexos: " . $e->getMessage());
        }
    }
}
?>