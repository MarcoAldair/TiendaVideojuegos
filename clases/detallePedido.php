<?php
    class detallePedido{
        private $idDetallePedido;
        private $estadoPedido;
        private $idGame;
        private $fechaDetallePedido;
        private $idPago;
        private $idPedido;

        public function getIdDetallePedido(){
            return $this->idDetallePedido;
        }
    
        public function setIdDetallePedido($idDetallePedido){
            $this->idDetallePedido = $idDetallePedido;
        }
    
        public function getEstadoPedido(){
            return $this->estadoPedido;
        }
    
        public function setEstadoPedido($estadoPedido){
            $this->estadoPedido = $estadoPedido;
        }
    
        public function getIdGame(){
            return $this->idGame;
        }
    
        public function setIdGame($idGame){
            $this->idGame = $idGame;
        }
    
        public function getFechaDetallePedido(){
            return $this->fechaDetallePedido;
        }
    
        public function setFechaDetallePedido($fechaDetallePedido){
            $this->fechaDetallePedido = $fechaDetallePedido;
        }
    
        public function getIdPago(){
            return $this->idPago;
        }
    
        public function setIdPago($idPago){
            $this->idPago = $idPago;
        }
    
        public function getIdPedido(){
            return $this->idPedido;
        }
    
        public function setIdPedido($idPedido){
            $this->idPedido = $idPedido;
        }
    }
?>