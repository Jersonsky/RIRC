<?php
require_once ("persistence/AreaInfluenciaDAO.php");
require_once ("persistence/Connection.php");

class AreaInfluencia {
	private $idAreaInfluencia;
	private $nombre;
	private $areaInfluenciaDAO;
	private $connection;

	function getIdAreaInfluencia() {
		return $this -> idAreaInfluencia;
	}

	function setIdAreaInfluencia($pIdAreaInfluencia) {
		$this -> idAreaInfluencia = $pIdAreaInfluencia;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function AreaInfluencia($pIdAreaInfluencia = "", $pNombre = ""){
		$this -> idAreaInfluencia = $pIdAreaInfluencia;
		$this -> nombre = $pNombre;
		$this -> areaInfluenciaDAO = new AreaInfluenciaDAO($this -> idAreaInfluencia, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaInfluenciaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaInfluenciaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaInfluenciaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idAreaInfluencia = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaInfluenciaDAO -> selectAll());
		$areaInfluencias = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($areaInfluencias, new AreaInfluencia($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $areaInfluencias;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaInfluenciaDAO -> selectAllOrder($order, $dir));
		$areaInfluencias = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($areaInfluencias, new AreaInfluencia($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $areaInfluencias;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> areaInfluenciaDAO -> search($search));
		$areaInfluencias = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($areaInfluencias, new AreaInfluencia($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $areaInfluencias;
	}
}
?>
