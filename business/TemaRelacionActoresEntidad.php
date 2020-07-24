<?php
require_once ("persistence/TemaRelacionActoresEntidadDAO.php");
require_once ("persistence/Connection.php");

class TemaRelacionActoresEntidad {
	private $idTemaRelacionActoresEntidad;
	private $desripcion;
	private $tema;
	private $relacionActoresEntidad;
	private $temaRelacionActoresEntidadDAO;
	private $connection;

	function getIdTemaRelacionActoresEntidad() {
		return $this -> idTemaRelacionActoresEntidad;
	}

	function setIdTemaRelacionActoresEntidad($pIdTemaRelacionActoresEntidad) {
		$this -> idTemaRelacionActoresEntidad = $pIdTemaRelacionActoresEntidad;
	}

	function getDesripcion() {
		return $this -> desripcion;
	}

	function setDesripcion($pDesripcion) {
		$this -> desripcion = $pDesripcion;
	}

	function getTema() {
		return $this -> tema;
	}

	function setTema($pTema) {
		$this -> tema = $pTema;
	}

	function getRelacionActoresEntidad() {
		return $this -> relacionActoresEntidad;
	}

	function setRelacionActoresEntidad($pRelacionActoresEntidad) {
		$this -> relacionActoresEntidad = $pRelacionActoresEntidad;
	}

	function TemaRelacionActoresEntidad($pIdTemaRelacionActoresEntidad = "", $pDesripcion = "", $pTema = "", $pRelacionActoresEntidad = ""){
		$this -> idTemaRelacionActoresEntidad = $pIdTemaRelacionActoresEntidad;
		$this -> desripcion = $pDesripcion;
		$this -> tema = $pTema;
		$this -> relacionActoresEntidad = $pRelacionActoresEntidad;
		$this -> temaRelacionActoresEntidadDAO = new TemaRelacionActoresEntidadDAO($this -> idTemaRelacionActoresEntidad, $this -> desripcion, $this -> tema, $this -> relacionActoresEntidad);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idTemaRelacionActoresEntidad = $result[0];
		$this -> desripcion = $result[1];
		$tema = new Tema($result[2]);
		$tema -> select();
		$this -> tema = $tema;
		$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
		$relacionActoresEntidad -> select();
		$this -> relacionActoresEntidad = $relacionActoresEntidad;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> selectAll());
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function selectAllByTema(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> selectAllByTema());
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function selectAllByRelacionActoresEntidad(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> selectAllByRelacionActoresEntidad());
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> selectAllOrder($order, $dir));
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function selectAllByTemaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> selectAllByTemaOrder($order, $dir));
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function selectAllByRelacionActoresEntidadOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> selectAllByRelacionActoresEntidadOrder($order, $dir));
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> search($search));
		$temaRelacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$relacionActoresEntidad = new RelacionActoresEntidad($result[3]);
			$relacionActoresEntidad -> select();
			array_push($temaRelacionActoresEntidads, new TemaRelacionActoresEntidad($result[0], $result[1], $tema, $relacionActoresEntidad));
		}
		$this -> connection -> close();
		return $temaRelacionActoresEntidads;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaRelacionActoresEntidadDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
