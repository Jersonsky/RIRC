<?php
class CapituloDAO{
	private $idCapitulo;
	private $nombre;

	function CapituloDAO($pIdCapitulo = "", $pNombre = ""){
		$this -> idCapitulo = $pIdCapitulo;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into capitulo(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update capitulo set 
				nombre = '" . $this -> nombre . "'	
				where idCapitulo = '" . $this -> idCapitulo . "'";
	}

	function select() {
		return "select idCapitulo, nombre
				from capitulo
				where idCapitulo = '" . $this -> idCapitulo . "'";
	}

	function selectAll() {
		return "select idCapitulo, nombre
				from capitulo";
	}

	function selectAllOrder($orden, $dir){
		return "select idCapitulo, nombre
				from capitulo
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idCapitulo, nombre
				from capitulo
				where nombre like '%" . $search . "%'";
	}
}
?>
