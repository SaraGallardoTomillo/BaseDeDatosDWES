<?Php

class Viviendas {

	private $id;
	private $tipo;
	private $zona;
	private $direccion;
	private $ndormitorios;
	private $precio;
	private $tamano;
	private $extras;
	private $foto;
	private $observaciones;


	
	
	

	function __Construct ($registro){
		
		$this->id=  $registro['id'];
		$this->tipo = $registro['tipo'];
		$this->zona = $registro['zona'];
		$this->direccion = $registro['direccion'];
		$this->ndormitorios = $registro['ndormitorios'];
		$this->precio = $registro['precio'];
		$this->tamano = $registro['tamano'];
		$this->extras = $registro['extras'];
		$this->foto = $registro['foto'];
		$this->observaciones = $registro['observaciones'];
		
		
	}

	//Getters	
	function getId(){
		return $this->id;
	}
	function getTipo(){
		return $this->tipo;
	}
	function getZona(){
		return $this->zona;
	}
	function getDireccion(){
		return $this->direccion;
	}
	function getNdormitorios(){
		return $this->ndormitorios;
	}
	function getPrecio(){
		return $this->precio;
	}
	function getTamano(){
		return $this->tamano;
	}
	function getExtras(){
		return $this->extras;
	}
	function getFoto(){
		return $this->foto;
	}
	function getObservaciones(){
		return $this->observaciones;
	}
	
	

	//Setters
	function setId($codigo){
		$this->id=$codigo;
	}

	function setTipo($tipo){
		$this->tipo=$tipo;
	}
	function setZona($zona){
		$this->zona=$zona;
	}
	function setDireccion($direccion){
		$this->direccion=$direccion;
	}
	function setNdormitorios($ndormitorios){
		$this->ndormitorios=$ndormitorios;
	}
	function setPrecio($precio){
		$this->precio=$precio;
	}
	function setTamano($tamano){
		$this->tamano=$tamano;
	}
	function setExtras($extras){
		$this->extras=$extras;
	}
	function setFoto($foto){
		$this->foto=$foto;
	}
	function setObservaciones($observaciones){
		$this->observaciones=$observaciones;
	}
	

}
	
	

?>