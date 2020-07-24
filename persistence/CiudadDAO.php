<?php
class CiudadDAO{
	private $idCiudad;
	private $nombre;
	private $pais;

	function CiudadDAO($pIdCiudad = "", $pNombre = "", $pPais = ""){
		$this -> idCiudad = $pIdCiudad;
		$this -> nombre = $pNombre;
		$this -> pais = $pPais;
	}

	function insert(){
		return "insert into ciudad(nombre, pais_idPais)
				values('" . $this -> nombre . "', '" . $this -> pais . "')";
	}

	function update(){
		return "update ciudad set 
				nombre = '" . $this -> nombre . "',
				pais_idPais = '" . $this -> pais . "'	
				where idCiudad = '" . $this -> idCiudad . "'";
	}

	function select() {
		return "select idCiudad, nombre, pais_idPais
				from ciudad
				where idCiudad = '" . $this -> idCiudad . "'";
	}

	function selectAll() {
		return "select idCiudad, nombre, pais_idPais
				from ciudad";
	}

	function selectAllByPais() {
		return "select idCiudad, nombre, pais_idPais
				from ciudad
				where pais_idPais = '" . $this -> pais . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idCiudad, nombre, pais_idPais
				from ciudad
				order by " . $orden . " " . $dir;
	}

	function selectAllByPaisOrder($orden, $dir) {
		return "select idCiudad, nombre, pais_idPais
				from ciudad
				where pais_idPais = '" . $this -> pais . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from ciudad
				where idCiudad = '" . $this -> idCiudad . "'";
	}
}
?>
