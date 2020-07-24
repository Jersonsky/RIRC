<?php
require_once ("persistence/NormatividadDAO.php");
require_once ("persistence/Connection.php");

class Normatividad {
	private $idNormatividad;
	private $numero;
	private $anio;
	private $objetivo;
	private $documentoJuridico;
	private $entidades;
	private $sector;
	private $aplicabilidad;
	private $normatividadDAO;
	private $connection;

	function getIdNormatividad() {
		return $this -> idNormatividad;
	}

	function setIdNormatividad($pIdNormatividad) {
		$this -> idNormatividad = $pIdNormatividad;
	}

	function getNumero() {
		return $this -> numero;
	}

	function setNumero($pNumero) {
		$this -> numero = $pNumero;
	}

	function getAnio() {
		return $this -> anio;
	}

	function setAnio($pAnio) {
		$this -> anio = $pAnio;
	}

	function getObjetivo() {
		return $this -> objetivo;
	}

	function setObjetivo($pObjetivo) {
		$this -> objetivo = $pObjetivo;
	}

	function getDocumentoJuridico() {
		return $this -> documentoJuridico;
	}

	function setDocumentoJuridico($pDocumentoJuridico) {
		$this -> documentoJuridico = $pDocumentoJuridico;
	}

	function getEntidades() {
		return $this -> entidades;
	}

	function setEntidades($pEntidades) {
		$this -> entidades = $pEntidades;
	}

	function getSector() {
		return $this -> sector;
	}

	function setSector($pSector) {
		$this -> sector = $pSector;
	}

	function getAplicabilidad() {
		return $this -> aplicabilidad;
	}

	function setAplicabilidad($pAplicabilidad) {
		$this -> aplicabilidad = $pAplicabilidad;
	}

	function Normatividad($pIdNormatividad = "", $pNumero = "", $pAnio = "", $pObjetivo = "", $pDocumentoJuridico = "", $pEntidades = "", $pSector = "", $pAplicabilidad = ""){
		$this -> idNormatividad = $pIdNormatividad;
		$this -> numero = $pNumero;
		$this -> anio = $pAnio;
		$this -> objetivo = $pObjetivo;
		$this -> documentoJuridico = $pDocumentoJuridico;
		$this -> entidades = $pEntidades;
		$this -> sector = $pSector;
		$this -> aplicabilidad = $pAplicabilidad;
		$this -> normatividadDAO = new NormatividadDAO($this -> idNormatividad, $this -> numero, $this -> anio, $this -> objetivo, $this -> documentoJuridico, $this -> entidades, $this -> sector, $this -> aplicabilidad);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idNormatividad = $result[0];
		$this -> numero = $result[1];
		$this -> anio = $result[2];
		$this -> objetivo = $result[3];
		$documentoJuridico = new DocumentoJuridico($result[4]);
		$documentoJuridico -> select();
		$this -> documentoJuridico = $documentoJuridico;
		$entidades = new Entidades($result[5]);
		$entidades -> select();
		$this -> entidades = $entidades;
		$sector = new Sector($result[6]);
		$sector -> select();
		$this -> sector = $sector;
		$aplicabilidad = new Aplicabilidad($result[7]);
		$aplicabilidad -> select();
		$this -> aplicabilidad = $aplicabilidad;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAll());
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllByDocumentoJuridico(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllByDocumentoJuridico());
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllByEntidades(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllByEntidades());
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllBySector(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllBySector());
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllByAplicabilidad(){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllByAplicabilidad());
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllOrder($order, $dir));
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllByDocumentoJuridicoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllByDocumentoJuridicoOrder($order, $dir));
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllByEntidadesOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllByEntidadesOrder($order, $dir));
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllBySectorOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllBySectorOrder($order, $dir));
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function selectAllByAplicabilidadOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> selectAllByAplicabilidadOrder($order, $dir));
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> normatividadDAO -> search($search));
		$normatividads = array();
		while ($result = $this -> connection -> fetchRow()){
			$documentoJuridico = new DocumentoJuridico($result[4]);
			$documentoJuridico -> select();
			$entidades = new Entidades($result[5]);
			$entidades -> select();
			$sector = new Sector($result[6]);
			$sector -> select();
			$aplicabilidad = new Aplicabilidad($result[7]);
			$aplicabilidad -> select();
			array_push($normatividads, new Normatividad($result[0], $result[1], $result[2], $result[3], $documentoJuridico, $entidades, $sector, $aplicabilidad));
		}
		$this -> connection -> close();
		return $normatividads;
	}
	
	function traerId(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> normatividadDAO -> traerId());
	    $result = $this -> connection -> fetchRow();
	    $this -> connection -> close();
	    $this -> idNormatividad = $result[0];
	}
}
?>
