<?php
class AreainfluenciaDAO{
	private $idAreaInfluencia;
	private $nombre;

	function AreainfluenciaDAO($pIdAreaInfluencia = "", $pNombre = ""){
		$this -> idAreaInfluencia = $pIdAreaInfluencia;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into areainfluencia(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update areainfluencia set 
				nombre = '" . $this -> nombre . "'	
				where idAreaInfluencia = '" . $this -> idAreaInfluencia . "'";
	}

	function select() {
		return "select idAreaInfluencia, nombre
				from areainfluencia
				where idAreaInfluencia = '" . $this -> idAreaInfluencia . "'";
	}

	function selectAll() {
		return "select idAreaInfluencia, nombre
				from areainfluencia";
	}

	function selectAllOrder($orden, $dir){
		return "select idAreaInfluencia, nombre
				from areainfluencia
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idAreaInfluencia, nombre
				from areainfluencia
				where nombre like '%" . $search . "%'";
	}
}
?>
