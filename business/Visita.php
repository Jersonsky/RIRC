<?php
require_once ("persistence/VisitaDAO.php");
require_once ("persistence/Connection.php");

class Visita {
	private $idVisita;
	private $fecha;
	private $archivo;
	private $visitante;
	private $visitaDAO;
	private $connection;

	function getVisitaDAO() {
	    return $this -> visitaDAO;
	}
	
	function getIdVisita() {
		return $this -> idVisita;
	}

	function setIdVisita($pIdVisita) {
		$this -> idVisita = $pIdVisita;
	}

	function getFecha() {
		return $this -> fecha;
	}

	function setFecha($pFecha) {
		$this -> fecha = $pFecha;
	}

	function getArchivo() {
		return $this -> archivo;
	}

	function setArchivo($pArchivo) {
		$this -> archivo = $pArchivo;
	}

	function getVisitante() {
		return $this -> visitante;
	}

	function setVisitante($pVisitante) {
		$this -> visitante = $pVisitante;
	}

	function Visita($pIdVisita = "", $pFecha = "", $pArchivo = "", $pVisitante = ""){
		$this -> idVisita = $pIdVisita;
		$this -> fecha = $pFecha;
		$this -> archivo = $pArchivo;
		$this -> visitante = $pVisitante;
		$this -> visitaDAO = new VisitaDAO($this -> idVisita, $this -> fecha, $this -> archivo, $this -> visitante);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idVisita = $result[0];
		$this -> fecha = $result[1];
		$archivo = new Archivo($result[2]);
		$archivo -> select();
		$this -> archivo = $archivo;
		$visitante = new Visitante($result[3]);
		$visitante -> select();
		$this -> visitante = $visitante;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> selectAll());
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function selectAllByArchivo(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> selectAllByArchivo());
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function selectAllByVisitante(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> selectAllByVisitante());
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> selectAllOrder($order, $dir));
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function selectAllByArchivoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> selectAllByArchivoOrder($order, $dir));
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function selectAllByVisitanteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> selectAllByVisitanteOrder($order, $dir));
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> search($search));
		$visitas = array();
		while ($result = $this -> connection -> fetchRow()){
			$archivo = new Archivo($result[2]);
			$archivo -> select();
			$visitante = new Visitante($result[3]);
			$visitante -> select();
			array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
		}
		$this -> connection -> close();
		return $visitas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> visitaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	
	function totalVisitas(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> totalVisitas());
	    $visitas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        array_push($visitas, new Visita($result[0], $result[1]));
	    }
	    $this -> connection -> close();
	    return $visitas;
	}
	
	function traerVisita($archivos){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> traerVisita($archivos));
	    $visitas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        $archivo = new Archivo($result[2]);
	        $archivo -> select();
	        $visitante = new Visitante($result[3]);
	        $visitante -> select();
	        array_push($visitas, new Visita($result[0], $result[1], $archivo, $visitante));
	    }
	    $this -> connection -> close();
	    return $visitas;
	}
	
	function traerVisitaPorCapitulo(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> traerVisitaPorCapitulo());
	    $visitas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        
	        array_push($visitas, new Visita($result[0],$result[1], $result[2]));
	    }
	    $this -> connection -> close();
	    return $visitas;
	}
	
	function graficaPorSubcapitulo($subcapitulo){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> graficaPorSubcapitulo($subcapitulo));
	    $visitas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        
	        array_push($visitas, new Visita($result[0],$result[1], $result[2]));
	    }
	    $this -> connection -> close();
	    return $visitas;
	}
	
	function graficaPorDocumento($subcapitulo){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> graficaPorDocumento($subcapitulo));
	    $visitas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        $archivo = new Archivo($result[1]);
	        $archivo -> select();
	        array_push($visitas, new Visita($result[0],$archivo, $result[2]));
	    }
	    $this -> connection -> close();
	    return $visitas;
	}
	
	function graficaPorDocumentoTotal($archivo){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> graficaPorDocumentoTotal($archivo));
	    $result = $this -> connection -> fetchRow();
	    $this -> connection -> close();
	    $this -> idVisita = $result[0];
	    $this -> fecha = $result[1];
	    $this -> archivo = $result[2];
	    
	    
	}
	
	function controlDocumentos(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> visitaDAO -> controlDocumentos());
	    $visitas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        array_push($visitas, new Visita($result[0],$result[1], $result[2]));
	    }
	    $this -> connection -> close();
	    return $visitas;
	}
}
?>
