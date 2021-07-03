<?php
    class pedido{
        private $idPedido;
        private $idCliente;
        private $fechaPedido;

        public function getIdPedido(){
            return $this->idPedido;
        }
    
        public function setIdPedido($idPedido){
            $this->idPedido = $idPedido;
        }
    
        public function getIdCliente(){
            return $this->idCliente;
        }
    
        public function setIdCliente($idCliente){
            $this->idCliente = $idCliente;
        }
    
        public function getFechaPedido(){
            return $this->fechaPedido;
        }
    
        public function setFechaPedido($fechaPedido){
            $this->fechaPedido = $fechaPedido;
        }
    }
?>