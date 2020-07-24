<?php
require_once ("persistence/VisitanteDAO.php");
require_once ("persistence/Connection.php");

class Visitante {
	private $idVisitante;
	private $nombre;
	private $visitanteDAO;
	private $connection;

	function getIdVisitante() {
		return $this -> idVisitante;
	}

	function setIdVisitante($pIdVisitante) {
		$this -> idVisitante = $pIdVisitante;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Visitante($pIdVisitante = "", $pNombre = ""){
		$this -> idVisitante = $pIdVisitante;
		$this -> nombre = $pNombre;
		$this -> visitanteDAO = new VisitanteDAO($this -> idVisitante, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idVisitante = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> selectAll());
		$visitantes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($visitantes, new Visitante($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $visitantes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> selectAllOrder($order, $dir));
		$visitantes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($visitantes, new Visitante($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $visitantes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> search($search));
		$visitantes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($visitantes, new Visitante($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $visitantes;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitanteDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	
	function traerIP($ip){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitanteDAO -> traerIP($ip));
	    $visitantes = array();
	    while ($result = $this -> connection -> fetchRow()){
	        array_push($visitantes, new Visitante($result[0], $result[1]));
	    }
	    $this -> connection -> close();
	    return $visitantes;
	}
	
	function selectPorNombre(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitanteDAO -> selectPorNombre());
	    $result = $this -> connection -> fetchRow();
	    $this -> connection -> close();
	    $this -> idVisitante = $result[0];
	    $this -> nombre = $result[1];
	}
}
?>
