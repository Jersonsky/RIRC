<?php
require_once ("persistence/TemaReferenciasDAO.php");
require_once ("persistence/Connection.php");

class TemaReferencias {
	private $idTemaReferencias;
	private $descripcion;
	private $tema;
	private $referencias;
	private $temaReferenciasDAO;
	private $connection;

	function getIdTemaReferencias() {
		return $this -> idTemaReferencias;
	}

	function setIdTemaReferencias($pIdTemaReferencias) {
		$this -> idTemaReferencias = $pIdTemaReferencias;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getTema() {
		return $this -> tema;
	}

	function setTema($pTema) {
		$this -> tema = $pTema;
	}

	function getReferencias() {
		return $this -> referencias;
	}

	function setReferencias($pReferencias) {
		$this -> referencias = $pReferencias;
	}

	function TemaReferencias($pIdTemaReferencias = "", $pDescripcion = "", $pTema = "", $pReferencias = ""){
		$this -> idTemaReferencias = $pIdTemaReferencias;
		$this -> descripcion = $pDescripcion;
		$this -> tema = $pTema;
		$this -> referencias = $pReferencias;
		$this -> temaReferenciasDAO = new TemaReferenciasDAO($this -> idTemaReferencias, $this -> descripcion, $this -> tema, $this -> referencias);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idTemaReferencias = $result[0];
		$this -> descripcion = $result[1];
		$tema = new Tema($result[2]);
		$tema -> select();
		$this -> tema = $tema;
		$referencias = new Referencias($result[3]);
		$referencias -> select();
		$this -> referencias = $referencias;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> selectAll());
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function selectAllByTema(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> selectAllByTema());
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function selectAllByReferencias(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> selectAllByReferencias());
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> selectAllOrder($order, $dir));
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function selectAllByTemaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> selectAllByTemaOrder($order, $dir));
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function selectAllByReferenciasOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> selectAllByReferenciasOrder($order, $dir));
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> search($search));
		$temaReferenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$tema = new Tema($result[2]);
			$tema -> select();
			$referencias = new Referencias($result[3]);
			$referencias -> select();
			array_push($temaReferenciass, new TemaReferencias($result[0], $result[1], $tema, $referencias));
		}
		$this -> connection -> close();
		return $temaReferenciass;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaReferenciasDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
