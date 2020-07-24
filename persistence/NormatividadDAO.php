<?php
class NormatividadDAO{
	private $idNormatividad;
	private $numero;
	private $anio;
	private $objetivo;
	private $documentoJuridico;
	private $entidades;
	private $sector;
	private $aplicabilidad;

	function NormatividadDAO($pIdNormatividad = "", $pNumero = "", $pAnio = "", $pObjetivo = "", $pDocumentoJuridico = "", $pEntidades = "", $pSector = "", $pAplicabilidad = ""){
		$this -> idNormatividad = $pIdNormatividad;
		$this -> numero = $pNumero;
		$this -> anio = $pAnio;
		$this -> objetivo = $pObjetivo;
		$this -> documentoJuridico = $pDocumentoJuridico;
		$this -> entidades = $pEntidades;
		$this -> sector = $pSector;
		$this -> aplicabilidad = $pAplicabilidad;
	}

	function insert(){
		return "insert into normatividad(numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad)
				values('" . $this -> numero . "', '" . $this -> anio . "', '" . $this -> objetivo . "', '" . $this -> documentoJuridico . "', '" . $this -> entidades . "', '" . $this -> sector . "', '" . $this -> aplicabilidad . "')";
	}

	function update(){
		return "update normatividad set 
				numero = '" . $this -> numero . "',
				anio = '" . $this -> anio . "',
				objetivo = '" . $this -> objetivo . "',
				documentoJuridico_idDocumentoJuridico = '" . $this -> documentoJuridico . "',
				entidades_idEntidades = '" . $this -> entidades . "',
				sector_idSector = '" . $this -> sector . "',
				aplicabilidad_idAplicabilidad = '" . $this -> aplicabilidad . "'	
				where idNormatividad = '" . $this -> idNormatividad . "'";
	}

	function select() {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where idNormatividad = '" . $this -> idNormatividad . "'";
	}

	function selectAll() {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad";
	}

	function selectAllByDocumentoJuridico() {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where documentoJuridico_idDocumentoJuridico = '" . $this -> documentoJuridico . "'";
	}

	function selectAllByEntidades() {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where entidades_idEntidades = '" . $this -> entidades . "'";
	}

	function selectAllBySector() {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where sector_idSector = '" . $this -> sector . "'";
	}

	function selectAllByAplicabilidad() {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where aplicabilidad_idAplicabilidad = '" . $this -> aplicabilidad . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				order by " . $orden . " " . $dir;
	}

	function selectAllByDocumentoJuridicoOrder($orden, $dir) {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where documentoJuridico_idDocumentoJuridico = '" . $this -> documentoJuridico . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByEntidadesOrder($orden, $dir) {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where entidades_idEntidades = '" . $this -> entidades . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllBySectorOrder($orden, $dir) {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where sector_idSector = '" . $this -> sector . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByAplicabilidadOrder($orden, $dir) {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where aplicabilidad_idAplicabilidad = '" . $this -> aplicabilidad . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idNormatividad, numero, anio, objetivo, documentoJuridico_idDocumentoJuridico, entidades_idEntidades, sector_idSector, aplicabilidad_idAplicabilidad
				from normatividad
				where numero like '%" . $search . "%' or anio like '%" . $search . "%' or objetivo like '%" . $search . "%'";
	}
	
	function traerId(){
	    return "SELECT idNormatividad
                from normatividad
                order by idNormatividad DESC
                limit 1";
	}
}

?>
