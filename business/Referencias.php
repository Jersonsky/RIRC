<?php
require_once ("persistence/ReferenciasDAO.php");
require_once ("persistence/Connection.php");

class Referencias {
	private $idReferencias;
	private $titulo;
	private $editorial;
	private $Autores;
	private $link;
	private $entidades;
	private $ciudad;
	private $referenciasDAO;
	private $connection;

	function getIdReferencias() {
		return $this -> idReferencias;
	}

function getReferenciasDAO() {
		return $this -> referenciasDAO;
	}


	function setIdReferencias($pIdReferencias) {
		$this -> idReferencias = $pIdReferencias;
	}

	function getTitulo() {
		return $this -> titulo;
	}

	function setTitulo($pTitulo) {
		$this -> titulo = $pTitulo;
	}

	function getEditorial() {
		return $this -> editorial;
	}

	function setEditorial($pEditorial) {
		$this -> editorial = $pEditorial;
	}

	function getAutores() {
		return $this -> Autores;
	}

	function setAutores($pAutores) {
		$this -> Autores = $pAutores;
	}

	function getLink() {
		return $this -> link;
	}

	function setLink($pLink) {
		$this -> link = $pLink;
	}

	function getEntidades() {
		return $this -> entidades;
	}

	function setEntidades($pEntidades) {
		$this -> entidades = $pEntidades;
	}

	function getCiudad() {
		return $this -> ciudad;
	}

	function setCiudad($pCiudad) {
		$this -> ciudad = $pCiudad;
	}

	function Referencias($pIdReferencias = "", $pTitulo = "", $pEditorial = "", $pAutores = "", $pLink = "", $pEntidades = "", $pCiudad = ""){
		$this -> idReferencias = $pIdReferencias;
		$this -> titulo = $pTitulo;
		$this -> editorial = $pEditorial;
		$this -> Autores = $pAutores;
		$this -> link = $pLink;
		$this -> entidades = $pEntidades;
		$this -> ciudad = $pCiudad;
		$this -> referenciasDAO = new ReferenciasDAO($this -> idReferencias, $this -> titulo, $this -> editorial, $this -> Autores, $this -> link, $this -> entidades, $this -> ciudad);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idReferencias = $result[0];
		$this -> titulo = $result[1];
		$this -> editorial = $result[2];
		$this -> Autores = $result[3];
		$this -> link = $result[4];
		$entidades = new Entidades($result[5]);
		$entidades -> select();
		$this -> entidades = $entidades;
		$ciudad = new Ciudad($result[6]);
		$ciudad -> select();
		$this -> ciudad = $ciudad;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> selectAll());
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}

	function selectAllByEntidades(){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> selectAllByEntidades());
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}

	function selectAllByCiudad(){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> selectAllByCiudad());
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> selectAllOrder($order, $dir));
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}

	function selectAllByEntidadesOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> selectAllByEntidadesOrder($order, $dir));
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}

	function selectAllByCiudadOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> selectAllByCiudadOrder($order, $dir));
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> referenciasDAO -> search($search));
		$referenciass = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$ciudad = new Ciudad($result[6]);
			$ciudad -> select();
			array_push($referenciass, new Referencias($result[0], $result[1], $result[2], $result[3], $result[4], $entidades, $ciudad));
		}
		$this -> connection -> close();
		return $referenciass;
	}
	
	function traerId(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> referenciasDAO -> traerId());
	    $result = $this -> connection -> fetchRow();
	    $this -> connection -> close();
	    $this -> idReferencias = $result[0];
	    
	}
}
?>
