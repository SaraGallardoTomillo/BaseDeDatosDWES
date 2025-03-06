<?php
    class Productos{
        private $cod;
        private $nombre;
        private $nombre_corto;
        private $descripcion;
        private $PVP;
        private $familia;
        
        

        function __Construct ($registro){
            
            $this->cod=  $registro['cod'];
            $this->nombre = $registro['nombre'];
            $this->nombre_corto = $registro['nombre_corto'];
            $this->descripcion = $registro['descripcion'];
            $this->PVP = $registro['PVP'];
            $this->familia = $registro['familia'];
            
        }

        //Getters	
        function getcod(){
            return $this->cod;
        }
        function getnombre(){
            return $this->nombre;
        }
        function getnombre_corto(){
            return $this->nombre_corto;
        }
        function getdescripcion(){
            return $this->descripcion;
        }
        function getPVP(){
            return $this->PVP;
        }
        function getfamilia(){
            return $this->familia;
        }
        

        //Setters
        function setcod($codigo){
            $this->cod=$codigo;
        }

        function setnombre($nombre){
            $this->nombre=$eccion;
        }
        
        function setnombre_corto($nombre_corto){
            $this->nombre_corto=$nombre_corto;
        }
        function setdescripcion($descripcion){
            $this->descripcion=$descripcion;
        }
        function setPVP($pvp){
            $this->PVP=$pvp;
        }
        function setfamilia($familia){
            $this->familia=$familia;
        }
    }
?>