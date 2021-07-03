<?php
    class pago{
        private $idPago;
        private $fecha;
        private $total;
        private $estadoPago;

        public function getIdPago(){
            return $this->idPago;
        }
    
        public function setIdPago($idPago){
            $this->idPago = $idPago;
        }
    
        public function getFecha(){
            return $this->fecha;
        }
    
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
    
        public function getTotal(){
            return $this->total;
        }
    
        public function setTotal($total){
            $this->total = $total;
        }
    
        public function getEstadoPago(){
            return $this->estadoPago;
        }
    
        public function setEstadoPago($estadoPago){
            $this->estadoPago = $estadoPago;
        }
    }
?>