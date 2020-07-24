<?php
require_once ("persistence/DocumentoJuridicoDAO.php");
require_once ("persistence/Connection.php");

class DocumentoJuridico {
	private $idDocumentoJuridico;
	private $nombre;
	private $documentoJuridicoDAO;
	private $connection;

	function getIdDocumentoJuridico() {
		return $this -> idDocumentoJuridico;
	}

	function setIdDocumentoJuridico($pIdDocumentoJuridico) {
		$this -> idDocumentoJuridico = $pIdDocumentoJuridico;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function DocumentoJuridico($pIdDocumentoJuridico = "", $pNombre = ""){
		$this -> idDocumentoJuridico = $pIdDocumentoJuridico;
		$this -> nombre = $pNombre;
		$this -> documentoJuridicoDAO = new DocumentoJuridicoDAO($this -> idDocumentoJuridico, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> documentoJuridicoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> documentoJuridicoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> documentoJuridicoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idDocumentoJuridico = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> documentoJuridicoDAO -> selectAll());
		$documentoJuridicos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($documentoJuridicos, new DocumentoJuridico($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $documentoJuridicos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> documentoJuridicoDAO -> selectAllOrder($order, $dir));
		$documentoJuridicos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($documentoJuridicos, new DocumentoJuridico($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $documentoJuridicos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> documentoJuridicoDAO -> search($search));
		$documentoJuridicos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($documentoJuridicos, new DocumentoJuridico($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $documentoJuridicos;
	}
}
?>
