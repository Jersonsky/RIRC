<?php
class TemaNormatividadDAO{
	private $idTemaNormatividad;
	private $desripcion;
	private $normatividad;
	private $tema;

	function TemaNormatividadDAO($pIdTemaNormatividad = "", $pDesripcion = "", $pNormatividad = "", $pTema = ""){
		$this -> idTemaNormatividad = $pIdTemaNormatividad;
		$this -> desripcion = $pDesripcion;
		$this -> normatividad = $pNormatividad;
		$this -> tema = $pTema;
	}

	function insert(){
		return "insert into temanormatividad(desripcion, normatividad_idNormatividad, tema_idTema)
				values('" . $this -> desripcion . "', '" . $this -> normatividad . "', '" . $this -> tema . "')";
	}

	function update(){
		return "update temanormatividad set 
				desripcion = '" . $this -> desripcion . "',
				normatividad_idNormatividad = '" . $this -> normatividad . "',
				tema_idTema = '" . $this -> tema . "'	
				where idTemaNormatividad = '" . $this -> idTemaNormatividad . "'";
	}

	function select() {
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad
				where idTemaNormatividad = '" . $this -> idTemaNormatividad . "'";
	}

	function selectAll() {
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad";
	}

	function selectAllByNormatividad() {
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad
				where normatividad_idNormatividad = '" . $this -> normatividad . "'";
	}

	function selectAllByTema() {
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad
				where tema_idTema = '" . $this -> tema . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad
				order by " . $orden . " " . $dir;
	}

	function selectAllByNormatividadOrder($orden, $dir) {
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad
				where normatividad_idNormatividad = '" . $this -> normatividad . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByTemaOrder($orden, $dir) {
		return "select idTemaNormatividad, desripcion, normatividad_idNormatividad, tema_idTema
				from temanormatividad
				where tema_idTema = '" . $this -> tema . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from temanormatividad
				where idTemaNormatividad = '" . $this -> idTemaNormatividad . "'";
	}
}
?>
