
<?php

    class Conexion
    {
        private $host;
        private $dbname;
        private $user;
        private $password;
        private static $instancia = null;
        private $conexion;

        private function __construct()
        {
            $this->host = "localhost";
            $this->dbname = "sistema_minimarket";
            $this->user = "root";
            $this->password = "admin";

            try{
                $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                die("Error de conexion: " . $e->getMessage());
            }
        }

        //Retornar la instancia unica
        public static function getInstancia()
        {
            if(self::$instancia == null){
                self::$instancia = new Conexion();
            }
            return self::$instancia;
        }

        public function getConexion()
        {
            return $this->conexion;
        }
    }
?>