<?php
class  DocumentoJuridicoDAO{
	private $idDocumentoJuridico;
	private $nombre;

	function  DocumentoJuridicoDAO($pIdDocumentoJuridico = "", $pNombre = ""){
		$this -> idDocumentoJuridico = $pIdDocumentoJuridico;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into documentojuridico(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update documentojuridico set 
				nombre = '" . $this -> nombre . "'	
				where idDocumentoJuridico = '" . $this -> idDocumentoJuridico . "'";
	}

	function select() {
		return "select idDocumentoJuridico, nombre
				from documentojuridico
				where idDocumentoJuridico = '" . $this -> idDocumentoJuridico . "'";
	}

	function selectAll() {
		return "select idDocumentoJuridico, nombre
				from documentojuridico";
	}

	function selectAllOrder($orden, $dir){
		return "select idDocumentoJuridico, nombre
				from documentojuridico
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idDocumentoJuridico, nombre
				from documentojuridico
				where nombre like '%" . $search . "%'";
	}
}
?>
