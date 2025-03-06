<?php

Class Accesorio{
    private $codigoAcc;
    private $nombreAcc;
    private $descripcionAcc;
    private $precioAcc;
    private $foto;

    public function __construct($registro){
        $this->nombreAcc=$registro['nombreAcc'];
        $this->descripcionAcc=$registro['descripcionAcc'];
        $this->precioAcc=$registro['precioAcc'];
        $this->categoriaAcc=$registro['categoriaAcc'];
        $this->foto=$registro['Foto'];
    }



    public function getCodigoAcc()
    {
        return $this->codigoAcc;
    }

  
    public function setCodigoAcc($codigoAcc)
    {
        $this->codigoAcc = $codigoAcc;

        return $this;
    }

   
    public function getNombreAcc()
    {
        return $this->nombreAcc;
    }

  
    public function setNombreAcc($nombreAcc)
    {
        $this->nombreAcc = $nombreAcc;

        return $this;
    }





  
    public function getDescripcionAcc()
    {
        return $this->descripcionAcc;
    }

  
    public function setDescripcionAcc($descripcionAcc)
    {
        $this->descripcionAcc = $descripcionAcc;

        return $this;
    }

    
    public function getPrecioAcc()
    {
        return $this->precioAcc;
    }

    
    public function setPrecioAcc($precioAcc)
    {
        $this->precioAcc = $precioAcc;

        return $this;
    }

    
    public function getFoto()
    {
        return $this->foto;
    }

    
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }
}




?>