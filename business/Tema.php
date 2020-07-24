<?php
require_once ("persistence/TemaDAO.php");
require_once ("persistence/Connection.php");

class Tema {
	private $idTema;
	private $descripcion;
	private $temaDAO;
	private $connection;

	function getIdTema() {
		return $this -> idTema;
	}

	function setIdTema($pIdTema) {
		$this -> idTema = $pIdTema;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function Tema($pIdTema = "", $pDescripcion = ""){
		$this -> idTema = $pIdTema;
		$this -> descripcion = $pDescripcion;
		$this -> temaDAO = new TemaDAO($this -> idTema, $this -> descripcion);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idTema = $result[0];
		$this -> descripcion = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaDAO -> selectAll());
		$temas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($temas, new Tema($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $temas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaDAO -> selectAllOrder($order, $dir));
		$temas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($temas, new Tema($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $temas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> temaDAO -> search($search));
		$temas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($temas, new Tema($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $temas;
	}
}
?>
