<?php
class RelacionActoresEntidadDAO{
	private $idRelacionActoresEntidad;
	private $siglas;
	private $telefono;
	private $pagina_Web;
	private $correo;
	private $descripcion;
	private $entidades;
	private $dependenciaContacto;
	private $naturaleza;
	private $areaInfluencia;
	private $sector;

	function  RelacionActoresEntidadDAO($pIdRelacionActoresEntidad = "", $pSiglas = "", $pTelefono = "", $pPagina_Web = "", $pCorreo = "", $pDescripcion = "", $pEntidades = "", $pDependenciaContacto = "", $pNaturaleza = "", $pAreaInfluencia = "", $pSector = ""){
		$this -> idRelacionActoresEntidad = $pIdRelacionActoresEntidad;
		$this -> siglas = $pSiglas;
		$this -> telefono = $pTelefono;
		$this -> pagina_Web = $pPagina_Web;
		$this -> correo = $pCorreo;
		$this -> descripcion = $pDescripcion;
		$this -> entidades = $pEntidades;
		$this -> dependenciaContacto = $pDependenciaContacto;
		$this -> naturaleza = $pNaturaleza;
		$this -> areaInfluencia = $pAreaInfluencia;
		$this -> sector = $pSector;
	}

	function insert(){
		return "insert into relacionactoresentidad(siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector)
				values('" . $this -> siglas . "', '" . $this -> telefono . "', '" . $this -> pagina_Web . "', '" . $this -> correo . "', '" . $this -> descripcion . "', '" . $this -> entidades . "', '" . $this -> dependenciaContacto . "', '" . $this -> naturaleza . "', '" . $this -> areaInfluencia . "', '" . $this -> sector . "')";
	}

	function update(){
		return "update relacionactoresentidad set 
				siglas = '" . $this -> siglas . "',
				telefono = '" . $this -> telefono . "',
				pagina_Web = '" . $this -> pagina_Web . "',
				correo = '" . $this -> correo . "',
				descripcion = '" . $this -> descripcion . "',
				entidades_idEntidades = '" . $this -> entidades . "',
				dependenciaContacto_idDependenciaContacto = '" . $this -> dependenciaContacto . "',
				naturaleza_idNaturaleza = '" . $this -> naturaleza . "',
				areaInfluencia_idAreaInfluencia = '" . $this -> areaInfluencia . "',
				sector_idSector = '" . $this -> sector . "'	
				where idRelacionActoresEntidad = '" . $this -> idRelacionActoresEntidad . "'";
	}

	function select() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where idRelacionActoresEntidad = '" . $this -> idRelacionActoresEntidad . "'";
	}

	function selectAll() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad";
	}

	function selectAllByEntidades() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where entidades_idEntidades = '" . $this -> entidades . "'";
	}

	function selectAllByDependenciaContacto() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where dependenciaContacto_idDependenciaContacto = '" . $this -> dependenciaContacto . "'";
	}

	function selectAllByNaturaleza() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where naturaleza_idNaturaleza = '" . $this -> naturaleza . "'";
	}

	function selectAllByAreaInfluencia() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where areaInfluencia_idAreaInfluencia = '" . $this -> areaInfluencia . "'";
	}

	function selectAllBySector() {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where sector_idSector = '" . $this -> sector . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				order by " . $orden . " " . $dir;
	}

	function selectAllByEntidadesOrder($orden, $dir) {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where entidades_idEntidades = '" . $this -> entidades . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByDependenciaContactoOrder($orden, $dir) {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where dependenciaContacto_idDependenciaContacto = '" . $this -> dependenciaContacto . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByNaturalezaOrder($orden, $dir) {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where naturaleza_idNaturaleza = '" . $this -> naturaleza . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByAreaInfluenciaOrder($orden, $dir) {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where areaInfluencia_idAreaInfluencia = '" . $this -> areaInfluencia . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllBySectorOrder($orden, $dir) {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where sector_idSector = '" . $this -> sector . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idRelacionActoresEntidad, siglas, telefono, pagina_Web, correo, descripcion, entidades_idEntidades, dependenciaContacto_idDependenciaContacto, naturaleza_idNaturaleza, areaInfluencia_idAreaInfluencia, sector_idSector
				from relacionactoresentidad
				where siglas like '%" . $search . "%' or telefono like '%" . $search . "%' or pagina_Web like '%" . $search . "%' or correo like '%" . $search . "%' or descripcion like '%" . $search . "%'";
	}
	
	function traerId(){
	    return "SELECT idRelacionActoresEntidad
                from relacionactoresentidad
                order by idRelacionActoresEntidad DESC
                limit 1";
	}
}
?>
