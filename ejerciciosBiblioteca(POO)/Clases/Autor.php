<?php
    class Autor {

        private $nombreAutor;
        private $pais;

        function __Construct($registro){
            $this->nombreAutor = $registro['NOMAUT'];
            $this->pais = $registro['PAIS'];
        }
        //GETTERS
        function getNombreAutor(){
            return $this->nombreAutor;
        }
        function getPais(){
            return $this->pais;
        }

        //SETTERS
        function setNombreAutor($nuevoValor){
            $this->nombreAutor=$nuevoValor;
        }
        function setPais($nuevoValor){
            $this->pais=$nuevoValor;
        }
    }
?>