<?php
require_once ("persistence/DependenciaContactoDAO.php");
require_once ("persistence/Connection.php");

class DependenciaContacto {
	private $idDependenciaContacto;
	private $nombre;
	private $dependenciaContactoDAO;
	private $connection;

	function getIdDependenciaContacto() {
		return $this -> idDependenciaContacto;
	}

	function setIdDependenciaContacto($pIdDependenciaContacto) {
		$this -> idDependenciaContacto = $pIdDependenciaContacto;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function DependenciaContacto($pIdDependenciaContacto = "", $pNombre = ""){
		$this -> idDependenciaContacto = $pIdDependenciaContacto;
		$this -> nombre = $pNombre;
		$this -> dependenciaContactoDAO = new DependenciaContactoDAO($this -> idDependenciaContacto, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dependenciaContactoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dependenciaContactoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dependenciaContactoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idDependenciaContacto = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> dependenciaContactoDAO -> selectAll());
		$dependenciaContactos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($dependenciaContactos, new DependenciaContacto($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $dependenciaContactos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> dependenciaContactoDAO -> selectAllOrder($order, $dir));
		$dependenciaContactos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($dependenciaContactos, new DependenciaContacto($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $dependenciaContactos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> dependenciaContactoDAO -> search($search));
		$dependenciaContactos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($dependenciaContactos, new DependenciaContacto($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $dependenciaContactos;
	}
}
?>
