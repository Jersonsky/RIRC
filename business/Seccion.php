<?php
require_once ("persistence/SeccionDAO.php");
require_once ("persistence/Connection.php");

class Seccion {
	private $idSeccion;
	private $nombre;
	private $seccionDAO;
	private $connection;

	function getIdSeccion() {
		return $this -> idSeccion;
	}

	function setIdSeccion($pIdSeccion) {
		$this -> idSeccion = $pIdSeccion;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Seccion($pIdSeccion = "", $pNombre = ""){
		$this -> idSeccion = $pIdSeccion;
		$this -> nombre = $pNombre;
		$this -> seccionDAO = new SeccionDAO($this -> idSeccion, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> seccionDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> seccionDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> seccionDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idSeccion = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> seccionDAO -> selectAll());
		$seccions = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($seccions, new Seccion($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $seccions;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> seccionDAO -> selectAllOrder($order, $dir));
		$seccions = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($seccions, new Seccion($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $seccions;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> seccionDAO -> search($search));
		$seccions = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($seccions, new Seccion($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $seccions;
	}
	
	function traerSeccionPorSub($subCapitulo){
	    $this -> connection -> open();
	    $this -> connection ->run($this-> seccionDAO -> traerSeccionPorSub($subCapitulo));
	    $seccions = array();
	    while ($result = $this -> connection -> fetchRow()){
	        array_push($seccions, new Seccion($result[0], $result[1]));
	    }
	    $this -> connection -> close();
	    return $seccions;
	}
}
?>
