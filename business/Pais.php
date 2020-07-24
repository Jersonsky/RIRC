<?php
require_once ("persistence/PaisDAO.php");
require_once ("persistence/Connection.php");

class Pais {
	private $idPais;
	private $nombre;
	private $paisDAO;
	private $connection;

	function getIdPais() {
		return $this -> idPais;
	}

	function setIdPais($pIdPais) {
		$this -> idPais = $pIdPais;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Pais($pIdPais = "", $pNombre = ""){
		$this -> idPais = $pIdPais;
		$this -> nombre = $pNombre;
		$this -> paisDAO = new PaisDAO($this -> idPais, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idPais = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> selectAll());
		$paiss = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($paiss, new Pais($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $paiss;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> selectAllOrder($order, $dir));
		$paiss = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($paiss, new Pais($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $paiss;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> search($search));
		$paiss = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($paiss, new Pais($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $paiss;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> paisDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
