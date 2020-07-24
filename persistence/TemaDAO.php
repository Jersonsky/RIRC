<?php
class TemaDAO{
	private $idTema;
	private $descripcion;

	function TemaDAO($pIdTema = "", $pDescripcion = ""){
		$this -> idTema = $pIdTema;
		$this -> descripcion = $pDescripcion;
	}

	function insert(){
		return "insert into tema(descripcion)
				values('" . $this -> descripcion . "')";
	}

	function update(){
		return "update tema set 
				descripcion = '" . $this -> descripcion . "'	
				where idTema = '" . $this -> idTema . "'";
	}

	function select() {
		return "select idTema, descripcion
				from tema
				where idTema = '" . $this -> idTema . "'";
	}

	function selectAll() {
		return "select idTema, descripcion
				from tema";
	}

	function selectAllOrder($orden, $dir){
		return "select idTema, descripcion
				from tema
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idTema, descripcion
				from tema
				where descripcion like '%" . $search . "%'";
	}
}
?>
