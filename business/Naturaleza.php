<?php
require_once ("persistence/NaturalezaDAO.php");
require_once ("persistence/Connection.php");

class Naturaleza {
	private $idNaturaleza;
	private $nombre;
	private $naturalezaDAO;
	private $connection;

	function getIdNaturaleza() {
		return $this -> idNaturaleza;
	}

	function setIdNaturaleza($pIdNaturaleza) {
		$this -> idNaturaleza = $pIdNaturaleza;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Naturaleza($pIdNaturaleza = "", $pNombre = ""){
		$this -> idNaturaleza = $pIdNaturaleza;
		$this -> nombre = $pNombre;
		$this -> naturalezaDAO = new NaturalezaDAO($this -> idNaturaleza, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idNaturaleza = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> selectAll());
		$naturalezas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($naturalezas, new Naturaleza($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $naturalezas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> selectAllOrder($order, $dir));
		$naturalezas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($naturalezas, new Naturaleza($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $naturalezas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> search($search));
		$naturalezas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($naturalezas, new Naturaleza($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $naturalezas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> naturalezaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
