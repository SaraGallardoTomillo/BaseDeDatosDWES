<?php

class Usuarios {
    protected $usuario;
    protected $contrasena;
    
    public function __construct($registro) {
        $this->usuario = $registro['usuario'];
        $this->contrasena = $registro['contrasena'];

    }
    
    public function getUsuario() {
        return $this->usuario; 
        
    }
    
    public function getContrasena() {
        return $this->nombre_corto; 
        
    }
    
            
    }
     