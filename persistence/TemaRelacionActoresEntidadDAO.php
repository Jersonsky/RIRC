<?php
class TemaRelacionActoresEntidadDAO{
	private $idTemaRelacionActoresEntidad;
	private $desripcion;
	private $tema;
	private $relacionActoresEntidad;

	function TemaRelacionActoresEntidadDAO($pIdTemaRelacionActoresEntidad = "", $pDesripcion = "", $pTema = "", $pRelacionActoresEntidad = ""){
		$this -> idTemaRelacionActoresEntidad = $pIdTemaRelacionActoresEntidad;
		$this -> desripcion = $pDesripcion;
		$this -> tema = $pTema;
		$this -> relacionActoresEntidad = $pRelacionActoresEntidad;
	}

	function insert(){
		return "insert into temarelacionactoresentidad(desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad)
				values('" . $this -> desripcion . "', '" . $this -> tema . "', '" . $this -> relacionActoresEntidad . "')";
	}

	function update(){
		return "update temarelacionactoresentidad set 
				desripcion = '" . $this -> desripcion . "',
				tema_idTema = '" . $this -> tema . "',
				relacionActoresEntidad_idRelacionActoresEntidad = '" . $this -> relacionActoresEntidad . "'	
				where idTemaRelacionActoresEntidad = '" . $this -> idTemaRelacionActoresEntidad . "'";
	}

	function select() {
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad
				where idTemaRelacionActoresEntidad = '" . $this -> idTemaRelacionActoresEntidad . "'";
	}

	function selectAll() {
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad";
	}

	function selectAllByTema() {
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad
				where tema_idTema = '" . $this -> tema . "'";
	}

	function selectAllByRelacionActoresEntidad() {
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad
				where relacionActoresEntidad_idRelacionActoresEntidad = '" . $this -> relacionActoresEntidad . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad
				order by " . $orden . " " . $dir;
	}

	function selectAllByTemaOrder($orden, $dir) {
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad
				where tema_idTema = '" . $this -> tema . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByRelacionActoresEntidadOrder($orden, $dir) {
		return "select idTemaRelacionActoresEntidad, desripcion, tema_idTema, relacionActoresEntidad_idRelacionActoresEntidad
				from temarelacionactoresentidad
				where relacionActoresEntidad_idRelacionActoresEntidad = '" . $this -> relacionActoresEntidad . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from temarelacionactoresentidad
				where idTemaRelacionActoresEntidad = '" . $this -> idTemaRelacionActoresEntidad . "'";
	}
}
?>
