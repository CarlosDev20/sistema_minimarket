
<?php
    class E_Proveedores
    {
        private $codigo_pv;
        private $codigo_tdpc;
        private $nrodocumento_pv;
        private $razon_social_pv;
        private $nombres;
        private $apellidos;
        private $codigo_sx;
        private $codigo_ru;
        private $email_pv;
        private $telefono_pv;
        private $movil_pv;
        private $direccion_pv;
        private $codigo_di;
        private $observacion_pv;

        public function getCodigoPv() { return $this->codigo_pv; }
        public function getCodigoTdpc() { return $this->codigo_tdpc; }
        public function getNrodocumentoPv() { return $this->nrodocumento_pv; }
        public function getRazonSocialPv() { return $this->razon_social_pv; }
        public function getNombres() { return $this->nombres; }
        public function getApellidos() { return $this->apellidos; }
        public function getCodigoSx() { return $this->codigo_sx; }
        public function getCodigoRu() { return $this->codigo_ru; }
        public function getEmailPv() { return $this->email_pv; }
        public function getTelefonoPv() { return $this->telefono_pv; }
        public function getMovilPv() { return $this->movil_pv; }
        public function getDireccionPv() { return $this->direccion_pv; }
        public function getCodigoDi() { return $this->codigo_di; }
        public function getObservacionPv() { return $this->observacion_pv; }

        public function setCodigoPv($codigo_pv) { $this->codigo_pv = $codigo_pv; }
        public function setCodigoTdpc($codigo_tdpc) { $this->codigo_tdpc = $codigo_tdpc; }
        public function setNrodocumentoPv($nrodocumento_pv) { $this->nrodocumento_pv = $nrodocumento_pv; }
        public function setRazonSocialPv($razon_social_pv) { $this->razon_social_pv = $razon_social_pv; }
        public function setNombres($nombres) { $this->nombres = $nombres; }
        public function setApellidos($apellidos) { $this->apellidos = $apellidos; }
        public function setCodigoSx($codigo_sx) { $this->codigo_sx = $codigo_sx; }
        public function setCodigoRu($codigo_ru) { $this->codigo_ru = $codigo_ru; }
        public function setEmailPv($email_pv) { $this->email_pv = $email_pv; }
        public function setTelefonoPv($telefono_pv) { $this->telefono_pv = $telefono_pv; }
        public function setMovilPv($movil_pv) { $this->movil_pv = $movil_pv; }
        public function setDireccionPv($direccion_pv) { $this->direccion_pv = $direccion_pv; }
        public function setCodigoDi($codigo_di) { $this->codigo_di = $codigo_di; }
        public function setObservacionPv($observacion_pv) { $this->observacion_pv = $observacion_pv; }
    }
?>
