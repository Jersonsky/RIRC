<?php
class PaisDAO{
	private $idPais;
	private $nombre;

	function PaisDAO($pIdPais = "", $pNombre = ""){
		$this -> idPais = $pIdPais;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into pais(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update pais set 
				nombre = '" . $this -> nombre . "'	
				where idPais = '" . $this -> idPais . "'";
	}

	function select() {
		return "select idPais, nombre
				from pais
				where idPais = '" . $this -> idPais . "'";
	}

	function selectAll() {
		return "select idPais, nombre
				from pais";
	}

	function selectAllOrder($orden, $dir){
		return "select idPais, nombre
				from pais
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from pais
				where idPais = '" . $this -> idPais . "'";
	}
}
?>
