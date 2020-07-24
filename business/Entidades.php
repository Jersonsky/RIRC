<?php
require_once ("persistence/EntidadesDAO.php");
require_once ("persistence/Connection.php");

class Entidades {
	private $idEntidades;
	private $nombre;
	private $entidadesDAO;
	private $connection;

	function getIdEntidades() {
		return $this -> idEntidades;
	}

	function setIdEntidades($pIdEntidades) {
		$this -> idEntidades = $pIdEntidades;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Entidades($pIdEntidades = "", $pNombre = ""){
		$this -> idEntidades = $pIdEntidades;
		$this -> nombre = $pNombre;
		$this -> entidadesDAO = new EntidadesDAO($this -> idEntidades, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> entidadesDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> entidadesDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> entidadesDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idEntidades = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> entidadesDAO -> selectAll());
		$entidadess = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($entidadess, new Entidades($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $entidadess;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> entidadesDAO -> selectAllOrder($order, $dir));
		$entidadess = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($entidadess, new Entidades($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $entidadess;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> entidadesDAO -> search($search));
		$entidadess = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($entidadess, new Entidades($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $entidadess;
	}
}
?>
