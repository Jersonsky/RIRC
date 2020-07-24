<?php
require_once ("persistence/SectorDAO.php");
require_once ("persistence/Connection.php");

class Sector {
	private $idSector;
	private $nombre;
	private $sectorDAO;
	private $connection;

	function getIdSector() {
		return $this -> idSector;
	}

	function setIdSector($pIdSector) {
		$this -> idSector = $pIdSector;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Sector($pIdSector = "", $pNombre = ""){
		$this -> idSector = $pIdSector;
		$this -> nombre = $pNombre;
		$this -> sectorDAO = new SectorDAO($this -> idSector, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> sectorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> sectorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> sectorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idSector = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> sectorDAO -> selectAll());
		$sectors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($sectors, new Sector($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $sectors;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> sectorDAO -> selectAllOrder($order, $dir));
		$sectors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($sectors, new Sector($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $sectors;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> sectorDAO -> search($search));
		$sectors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($sectors, new Sector($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $sectors;
	}
}
?>
