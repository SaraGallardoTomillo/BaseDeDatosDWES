<?php

class Productos {
    protected $codigo;
    protected $nombre_corto;
    protected $PVP;
    
    public function __construct($registro) {
        $this->codigo = $registro['cod'];
        $this->nombre_corto = $registro['nombre_corto'];
        $this->PVP = $registro['PVP'];
    }
    
    public function getCodigo() {
        return $this->codigo; 
        
    }
    
    public function getNombreCorto() {
        return $this->nombre_corto; 
        
    }
    
    public function getPVP() {
        return $this->PVP; 
        
    }
     
}