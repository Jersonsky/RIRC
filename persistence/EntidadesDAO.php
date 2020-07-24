<?php
class EntidadesDAO{
	private $idEntidades;
	private $nombre;

	function EntidadesDAO($pIdEntidades = "", $pNombre = ""){
		$this -> idEntidades = $pIdEntidades;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into entidades(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update entidades set 
				nombre = '" . $this -> nombre . "'	
				where idEntidades = '" . $this -> idEntidades . "'";
	}

	function select() {
		return "select idEntidades, nombre
				from entidades
				where idEntidades = '" . $this -> idEntidades . "'";
	}

	function selectAll() {
		return "select idEntidades, nombre
				from entidades";
	}

	function selectAllOrder($orden, $dir){
		return "select idEntidades, nombre
				from entidades
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idEntidades, nombre
				from entidades
				where nombre like '%" . $search . "%'";
	}
}
?>
