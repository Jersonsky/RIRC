<?php
require_once ("persistence/SubcapituloDAO.php");
require_once ("persistence/Connection.php");

class Subcapitulo {
	private $idSubcapitulo;
	private $nombre;
	private $capitulo;
	private $subcapituloDAO;
	private $connection;

	function getIdSubcapitulo() {
		return $this -> idSubcapitulo;
	}

	function setIdSubcapitulo($pIdSubcapitulo) {
		$this -> idSubcapitulo = $pIdSubcapitulo;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getCapitulo() {
		return $this -> capitulo;
	}

	function setCapitulo($pCapitulo) {
		$this -> capitulo = $pCapitulo;
	}

	function Subcapitulo($pIdSubcapitulo = "", $pNombre = "", $pCapitulo = ""){
		$this -> idSubcapitulo = $pIdSubcapitulo;
		$this -> nombre = $pNombre;
		$this -> capitulo = $pCapitulo;
		$this -> subcapituloDAO = new SubcapituloDAO($this -> idSubcapitulo, $this -> nombre, $this -> capitulo);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idSubcapitulo = $result[0];
		$this -> nombre = $result[1];
		$capitulo = new Capitulo($result[2]);
		$capitulo -> select();
		$this -> capitulo = $capitulo;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> selectAll());
		$subcapitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			$capitulo = new Capitulo($result[2]);
			$capitulo -> select();
			array_push($subcapitulos, new Subcapitulo($result[0], $result[1], $capitulo));
		}
		$this -> connection -> close();
		return $subcapitulos;
	}

	function selectAllByCapitulo(){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> selectAllByCapitulo());
		$subcapitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			$capitulo = new Capitulo($result[2]);
			$capitulo -> select();
			array_push($subcapitulos, new Subcapitulo($result[0], $result[1], $capitulo));
		}
		$this -> connection -> close();
		return $subcapitulos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> selectAllOrder($order, $dir));
		$subcapitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			$capitulo = new Capitulo($result[2]);
			$capitulo -> select();
			array_push($subcapitulos, new Subcapitulo($result[0], $result[1], $capitulo));
		}
		$this -> connection -> close();
		return $subcapitulos;
	}

	function selectAllByCapituloOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> selectAllByCapituloOrder($order, $dir));
		$subcapitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			$capitulo = new Capitulo($result[2]);
			$capitulo -> select();
			array_push($subcapitulos, new Subcapitulo($result[0], $result[1], $capitulo));
		}
		$this -> connection -> close();
		return $subcapitulos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> subcapituloDAO -> search($search));
		$subcapitulos = array();
		while ($result = $this -> connection -> fetchRow()){
			$capitulo = new Capitulo($result[2]);
			$capitulo -> select();
			array_push($subcapitulos, new Subcapitulo($result[0], $result[1], $capitulo));
		}
		$this -> connection -> close();
		return $subcapitulos;
	}
}
?>
