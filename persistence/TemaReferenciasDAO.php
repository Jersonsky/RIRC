<?php
class TemaReferenciasDAO{
	private $idTemaReferencias;
	private $descripcion;
	private $tema;
	private $referencias;

	function TemaReferenciasDAO($pIdTemaReferencias = "", $pDescripcion = "", $pTema = "", $pReferencias = ""){
		$this -> idTemaReferencias = $pIdTemaReferencias;
		$this -> descripcion = $pDescripcion;
		$this -> tema = $pTema;
		$this -> referencias = $pReferencias;
	}

	function insert(){
		return "insert into temareferencias(descripcion, tema_idTema, referencias_idReferencias)
				values('" . $this -> descripcion . "', '" . $this -> tema . "', '" . $this -> referencias . "')";
	}

	function update(){
		return "update temareferencias set 
				descripcion = '" . $this -> descripcion . "',
				tema_idTema = '" . $this -> tema . "',
				referencias_idReferencias = '" . $this -> referencias . "'	
				where idTemaReferencias = '" . $this -> idTemaReferencias . "'";
	}

	function select() {
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias
				where idTemaReferencias = '" . $this -> idTemaReferencias . "'";
	}

	function selectAll() {
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias";
	}

	function selectAllByTema() {
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias
				where tema_idTema = '" . $this -> tema . "'";
	}

	function selectAllByReferencias() {
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias
				where referencias_idReferencias = '" . $this -> referencias . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias
				order by " . $orden . " " . $dir;
	}

	function selectAllByTemaOrder($orden, $dir) {
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias
				where tema_idTema = '" . $this -> tema . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByReferenciasOrder($orden, $dir) {
		return "select idTemaReferencias, descripcion, tema_idTema, referencias_idReferencias
				from temareferencias
				where referencias_idReferencias = '" . $this -> referencias . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from temareferencias
				where idTemaReferencias = '" . $this -> idTemaReferencias . "'";
	}
}
?>
