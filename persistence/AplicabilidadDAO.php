<?php
class AplicabilidadDAO{
	private $idAplicabilidad;
	private $nombre;

	function AplicabilidadDAO($pIdAplicabilidad = "", $pNombre = ""){
		$this -> idAplicabilidad = $pIdAplicabilidad;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into aplicabilidad(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update aplicabilidad set 
				nombre = '" . $this -> nombre . "'	
				where idAplicabilidad = '" . $this -> idAplicabilidad . "'";
	}

	function select() {
		return "select idAplicabilidad, nombre
				from aplicabilidad
				where idAplicabilidad = '" . $this -> idAplicabilidad . "'";
	}

	function selectAll() {
		return "select idAplicabilidad, nombre
				from aplicabilidad";
	}

	function selectAllOrder($orden, $dir){
		return "select idAplicabilidad, nombre
				from aplicabilidad
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idAplicabilidad, nombre
				from aplicabilidad
				where nombre like '%" . $search . "%'";
	}
}
?>
