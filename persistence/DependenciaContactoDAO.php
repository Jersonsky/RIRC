<?php
class DependenciaContactoDAO{
	private $idDependenciaContacto;
	private $nombre;

	function DependenciaContactoDAO($pIdDependenciaContacto = "", $pNombre = ""){
		$this -> idDependenciaContacto = $pIdDependenciaContacto;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into dependenciacontacto(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update dependenciacontacto set 
				nombre = '" . $this -> nombre . "'	
				where idDependenciaContacto = '" . $this -> idDependenciaContacto . "'";
	}

	function select() {
		return "select idDependenciaContacto, nombre
				from dependenciacontacto
				where idDependenciaContacto = '" . $this -> idDependenciaContacto . "'";
	}

	function selectAll() {
		return "select idDependenciaContacto, nombre
				from dependenciacontacto";
	}

	function selectAllOrder($orden, $dir){
		return "select idDependenciaContacto, nombre
				from dependenciacontacto
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idDependenciaContacto, nombre
				from dependenciacontacto
				where nombre like '%" . $search . "%'";
	}
}
?>
