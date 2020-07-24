<?php
require_once ("persistence/ArchivoDAO.php");
require_once ("persistence/Connection.php");

class Archivo {
	private $idArchivo;
	private $nombre;
	private $descripcion;
	private $url;
	private $fechapublicacion;
	private $fechatemporalidad;
	private $fuente;
	private $subcapitulo;
	private $tema;
	private $seccion;
	private $estado;
	private $administrador;
	private $archivoDAO;
	private $connection;

	function getArchivoDAO() {
	    return $this -> archivoDAO;
	}
	
	function getIdArchivo() {
		return $this -> idArchivo;
	}

	function setIdArchivo($pIdArchivo) {
		$this -> idArchivo = $pIdArchivo;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getUrl() {
		return $this -> url;
	}
	
	function getEstado() {
	    return $this -> estado;
	}

	function setUrl($pUrl) {
		$this -> url = $pUrl;
	}

	function getFechapublicacion() {
		return $this -> fechapublicacion;
	}

	function setFechapublicacion($pFechapublicacion) {
		$this -> fechapublicacion = $pFechapublicacion;
	}

	function getFechatemporalidad() {
		return $this -> fechatemporalidad;
	}

	function setFechatemporalidad($pFechatemporalidad) {
		$this -> fechatemporalidad = $pFechatemporalidad;
	}

	function getFuente() {
		return $this -> fuente;
	}

	function setFuente($pFuente) {
		$this -> fuente = $pFuente;
	}

	function getSubcapitulo() {
		return $this -> subcapitulo;
	}

	function setSubcapitulo($pSubcapitulo) {
		$this -> subcapitulo = $pSubcapitulo;
	}

	function getTema() {
		return $this -> tema;
	}

	function setTema($pTema) {
		$this -> tema = $pTema;
	}

	function getSeccion() {
		return $this -> seccion;
	}

	function setSeccion($pSeccion) {
		$this -> seccion = $pSeccion;
	}

	function getAdministrador() {
		return $this -> administrador;
	}

	function Archivo($pIdArchivo = "", $pNombre = "", $pDescripcion = "", $pUrl = "", $pFechapublicacion = "", $pFechatemporalidad = "", $pFuente = "", $pSubcapitulo = "", $pTema = "", $pSeccion = "", $pEstado = "", $pAdministrador=""){
		$this -> idArchivo = $pIdArchivo;
		$this -> nombre = $pNombre;
		$this -> descripcion = $pDescripcion;
		$this -> url = $pUrl;
		$this -> fechapublicacion = $pFechapublicacion;
		$this -> fechatemporalidad = $pFechatemporalidad;
		$this -> fuente = $pFuente;
		$this -> subcapitulo = $pSubcapitulo;
		$this -> tema = $pTema;
		$this -> seccion = $pSeccion;
		$this -> estado = $pEstado;
		$this -> administrador = $pAdministrador;
		$this -> archivoDAO = new ArchivoDAO($this -> idArchivo, $this -> nombre, $this -> descripcion, $this -> url, $this -> fechapublicacion, $this -> fechatemporalidad, $this -> fuente, $this -> subcapitulo, $this -> tema, $this -> seccion, $this -> estado, $this -> administrador);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idArchivo = $result[0];
		$this -> nombre = $result[1];
		$this -> descripcion = $result[2];
		$this -> url = $result[3];
		$this -> fechapublicacion = $result[4];
		$this -> fechatemporalidad = $result[5];
		$this -> fuente = $result[6];
		$subcapitulo = new Subcapitulo($result[7]);
		$subcapitulo -> select();
		$this -> subcapitulo = $subcapitulo;
		$tema = new Tema($result[8]);
		$tema -> select();
		$this -> tema = $tema;
		$seccion = new Seccion($result[9]);
		$seccion -> select();
		$this -> seccion = $seccion;
		$this -> estado = $result[10];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAll());
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllBySubcapitulo(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllBySubcapitulo());
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllByTema(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllByTema());
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllBySeccion(){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllBySeccion());
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllOrder($order, $dir));
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllBySubcapituloOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllBySubcapituloOrder($order, $dir));
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllByTemaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllByTemaOrder($order, $dir));
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function selectAllBySeccionOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> selectAllBySeccionOrder($order, $dir));
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
		}
		$this -> connection -> close();
		return $archivos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> archivoDAO -> search($search));
		$archivos = array();
		while ($result = $this -> connection -> fetchRow()){
			$subcapitulo = new Subcapitulo($result[7]);
			$subcapitulo -> select();
			$tema = new Tema($result[8]);
			$tema -> select();
			$seccion = new Seccion($result[9]);
			$seccion -> select();
			$admin = new Administrator($result[11]);
			$admin -> select();
			array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10],$admin));
		}
		$this -> connection -> close();
		return $archivos;
	}
	
	function traerPorArchivoSeccionSub($SubCapitulo, $Seccion){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> archivoDAO -> traerPorArchivoSeccionSub($SubCapitulo, $Seccion));
	    $archivos = array();
	    while ($result = $this -> connection -> fetchRow()){
	        $subcapitulo = new Subcapitulo($result[7]);
	        $subcapitulo -> select();
	        $tema = new Tema($result[8]);
	        $tema -> select();
	        $seccion = new Seccion($result[9]);
	        $seccion -> select();
	        array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
	    }
	    $this -> connection -> close();
	    return $archivos;
	}
	
	function traerPorSubCapitulo($SubCapitulo){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> archivoDAO -> traerPorSubCapitulo($SubCapitulo));
	    $archivos = array();
	    while ($result = $this -> connection -> fetchRow()){
	        $subcapitulo = new Subcapitulo($result[7]);
	        $subcapitulo -> select();
	        $tema = new Tema($result[8]);
	        $tema -> select();
	        $seccion = new Seccion($result[9]);
	        $seccion -> select();
	        array_push($archivos, new Archivo($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $subcapitulo, $tema, $seccion, $result[10]));
	    }
	    $this -> connection -> close();
	    return $archivos;
	}
	
	function traeridArchivo($SubCapitulo){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> archivoDAO -> traeridArchivo($SubCapitulo));
	    $archivos = array();
	    while ($result = $this -> connection -> fetchRow()){
	        
	        array_push($archivos, new Archivo($result[0]));
	    }
	    $this -> connection -> close();
	    return $archivos;
	}
	
	function traerPorIDArchivoSeccionSub($SubCapitulo, $Seccion){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> archivoDAO -> traerPorIDArchivoSeccionSub($SubCapitulo, $Seccion));
	    $archivos = array();
	    while ($result = $this -> connection -> fetchRow()){
	        
	        array_push($archivos, new Archivo($result[0]));
	    }
	    $this -> connection -> close();
	    return $archivos;
	}
}
?>
