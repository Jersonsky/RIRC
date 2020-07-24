<?php
require_once ("persistence/AplicabilidadDAO.php");
require_once ("persistence/Connection.php");

class Aplicabilidad {
	private $idAplicabilidad;
	private $nombre;
	private $aplicabilidadDAO;
	private $connection;

	function getIdAplicabilidad() {
		return $this -> idAplicabilidad;
	}

	function setIdAplicabilidad($pIdAplicabilidad) {
		$this -> idAplicabilidad = $pIdAplicabilidad;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Aplicabilidad($pIdAplicabilidad = "", $pNombre = ""){
		$this -> idAplicabilidad = $pIdAplicabilidad;
		$this -> nombre = $pNombre;
		$this -> aplicabilidadDAO = new AplicabilidadDAO($this -> idAplicabilidad, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> aplicabilidadDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> aplicabilidadDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> aplicabilidadDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idAplicabilidad = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> aplicabilidadDAO -> selectAll());
		$aplicabilidads = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($aplicabilidads, new Aplicabilidad($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $aplicabilidads;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> aplicabilidadDAO -> selectAllOrder($order, $dir));
		$aplicabilidads = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($aplicabilidads, new Aplicabilidad($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $aplicabilidads;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> aplicabilidadDAO -> search($search));
		$aplicabilidads = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($aplicabilidads, new Aplicabilidad($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $aplicabilidads;
	}
}
?>
