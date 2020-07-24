<?php
require_once ("persistence/TemaNormatividadDAO.php");
require_once ("persistence/Connection.php");

class TemaNormatividad {
	private $idTemaNormatividad;
	private $desripcion;
	private $normatividad;
	private $tema;
	private $temaNormatividadDAO;
	private $connection;

	function getIdTemaNormatividad() {
		return $this -> idTemaNormatividad;
	}

	function setIdTemaNormatividad($pIdTemaNormatividad) {
		$this -> idTemaNormatividad = $pIdTemaNormatividad;
	}

	function getDesripcion() {
		return $this -> desripcion;
	}

	function setDesripcion($pDesripcion) {
		$this -> desripcion = $pDesripcion;
	}

	function getNormatividad() {
		return $this -> normatividad;
	}

	function setNormatividad($pNormatividad) {
		$this -> normatividad = $pNormatividad;
	}

	function getTema() {
		return $this -> tema;
	}

	function setTema($pTema) {
		$this -> tema = $pTema;
	}

	function TemaNormatividad($pIdTemaNormatividad = "", $pDesripcion = "", $pNormatividad = "", $pTema = ""){
		$this -> idTemaNormatividad = $pIdTemaNormatividad;
		$this -> desripcion = $pDesripcion;
		$this -> normatividad = $pNormatividad;
		$this -> tema = $pTema;
		$this -> temaNormatividadDAO = new TemaNormatividadDAO($this -> idTemaNormatividad, $this -> desripcion, $this -> normatividad, $this -> tema);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idTemaNormatividad = $result[0];
		$this -> desripcion = $result[1];
		$normatividad = new Normatividad($result[2]);
		$normatividad -> select();
		$this -> normatividad = $normatividad;
		$tema = new Tema($result[3]);
		$tema -> select();
		$this -> tema = $tema;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> selectAll());
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function selectAllByNormatividad(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> selectAllByNormatividad());
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function selectAllByTema(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> selectAllByTema());
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> selectAllOrder($order, $dir));
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function selectAllByNormatividadOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> selectAllByNormatividadOrder($order, $dir));
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function selectAllByTemaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> selectAllByTemaOrder($order, $dir));
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> search($search));
		$temaNormatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$normatividad = new Normatividad($result[2]);
			$normatividad -> select();
			$tema = new Tema($result[3]);
			$tema -> select();
			array_push($temaNormatividads, new TemaNormatividad($result[0], $result[1], $normatividad, $tema));
		}
		$this -> connection -> close();
		return $temaNormatividads;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaNormatividadDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
