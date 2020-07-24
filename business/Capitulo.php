<?php
require_once ("persistence/CapituloDAO.php");
require_once ("persistence/Connection.php");

class Capitulo {
	private $idCapitulo;
	private $nombre;
	private $capituloDAO;
	private $connection;

	function getIdCapitulo() {
		return $this -> idCapitulo;
	}

	function setIdCapitulo($pIdCapitulo) {
		$this -> idCapitulo = $pIdCapitulo;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function Capitulo($pIdCapitulo = "", $pNombre = ""){
		$this -> idCapitulo = $pIdCapitulo;
		$this -> nombre = $pNombre;
		$this -> capituloDAO = new CapituloDAO($this -> idCapitulo, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> capituloDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> capituloDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> capituloDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCapitulo = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> capituloDAO -> selectAll());
		$capitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($capitulos, new Capitulo($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $capitulos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> capituloDAO -> selectAllOrder($order, $dir));
		$capitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($capitulos, new Capitulo($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $capitulos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> capituloDAO -> search($search));
		$capitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($capitulos, new Capitulo($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $capitulos;
	}
}
?>
