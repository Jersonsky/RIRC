<?php
class SectorDAO{
	private $idSector;
	private $nombre;

	function SectorDAO($pIdSector = "", $pNombre = ""){
		$this -> idSector = $pIdSector;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into sector(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update sector set 
				nombre = '" . $this -> nombre . "'	
				where idSector = '" . $this -> idSector . "'";
	}

	function select() {
		return "select idSector, nombre
				from sector
				where idSector = '" . $this -> idSector . "'";
	}

	function selectAll() {
		return "select idSector, nombre
				from sector";
	}

	function selectAllOrder($orden, $dir){
		return "select idSector, nombre
				from sector
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idSector, nombre
				from sector
				where nombre like '%" . $search . "%'";
	}
}
?>
