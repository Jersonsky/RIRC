<?php
class NaturalezaDAO{
	private $idNaturaleza;
	private $nombre;

	function NaturalezaDAO($pIdNaturaleza = "", $pNombre = ""){
		$this -> idNaturaleza = $pIdNaturaleza;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into naturaleza(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update naturaleza set 
				nombre = '" . $this -> nombre . "'	
				where idNaturaleza = '" . $this -> idNaturaleza . "'";
	}

	function select() {
		return "select idNaturaleza, nombre
				from naturaleza
				where idNaturaleza = '" . $this -> idNaturaleza . "'";
	}

	function selectAll() {
		return "select idNaturaleza, nombre
				from naturaleza";
	}

	function selectAllOrder($orden, $dir){
		return "select idNaturaleza, nombre
				from naturaleza
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from naturaleza
				where idNaturaleza = '" . $this -> idNaturaleza . "'";
	}
}
?>
