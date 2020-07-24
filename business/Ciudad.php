<?php
require_once ("persistence/CiudadDAO.php");
require_once ("persistence/Connection.php");

class Ciudad {
	private $idCiudad;
	private $nombre;
	private $pais;
	private $ciudadDAO;
	private $connection;

	function getIdCiudad() {
		return $this -> idCiudad;
	}

	function setIdCiudad($pIdCiudad) {
		$this -> idCiudad = $pIdCiudad;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getPais() {
		return $this -> pais;
	}

	function setPais($pPais) {
		$this -> pais = $pPais;
	}

	function Ciudad($pIdCiudad = "", $pNombre = "", $pPais = ""){
		$this -> idCiudad = $pIdCiudad;
		$this -> nombre = $pNombre;
		$this -> pais = $pPais;
		$this -> ciudadDAO = new CiudadDAO($this -> idCiudad, $this -> nombre, $this -> pais);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCiudad = $result[0];
		$this -> nombre = $result[1];
		$pais = new Pais($result[2]);
		$pais -> select();
		$this -> pais = $pais;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> selectAll());
		$ciudads = array();
		while ($result = $this -> connection -> fetchRow()){
			$pais = new Pais($result[2]);
			$pais -> select();
			array_push($ciudads, new Ciudad($result[0], $result[1], $pais));
		}
		$this -> connection -> close();
		return $ciudads;
	}

	function selectAllByPais(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> selectAllByPais());
		$ciudads = array();
		while ($result = $this -> connection -> fetchRow()){
			$pais = new Pais($result[2]);
			$pais -> select();
			array_push($ciudads, new Ciudad($result[0], $result[1], $pais));
		}
		$this -> connection -> close();
		return $ciudads;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> selectAllOrder($order, $dir));
		$ciudads = array();
		while ($result = $this -> connection -> fetchRow()){
			$pais = new Pais($result[2]);
			$pais -> select();
			array_push($ciudads, new Ciudad($result[0], $result[1], $pais));
		}
		$this -> connection -> close();
		return $ciudads;
	}

	function selectAllByPaisOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> selectAllByPaisOrder($order, $dir));
		$ciudads = array();
		while ($result = $this -> connection -> fetchRow()){
			$pais = new Pais($result[2]);
			$pais -> select();
			array_push($ciudads, new Ciudad($result[0], $result[1], $pais));
		}
		$this -> connection -> close();
		return $ciudads;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> search($search));
		$ciudads = array();
		while ($result = $this -> connection -> fetchRow()){
			$pais = new Pais($result[2]);
			$pais -> select();
			array_push($ciudads, new Ciudad($result[0], $result[1], $pais));
		}
		$this -> connection -> close();
		return $ciudads;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> ciudadDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
