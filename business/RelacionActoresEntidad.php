<?php
require_once ("persistence/RelacionActoresEntidadDAO.php");
require_once ("persistence/Connection.php");

class RelacionActoresEntidad {
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
	private $relacionActoresEntidadDAO;
	private $connection;

	function getIdRelacionActoresEntidad() {
		return $this -> idRelacionActoresEntidad;
	}

	function setIdRelacionActoresEntidad($pIdRelacionActoresEntidad) {
		$this -> idRelacionActoresEntidad = $pIdRelacionActoresEntidad;
	}

	function getSiglas() {
		return $this -> siglas;
	}

	function setSiglas($pSiglas) {
		$this -> siglas = $pSiglas;
	}

	function getTelefono() {
		return $this -> telefono;
	}

	function setTelefono($pTelefono) {
		$this -> telefono = $pTelefono;
	}

	function getPagina_Web() {
		return $this -> pagina_Web;
	}

	function setPagina_Web($pPagina_Web) {
		$this -> pagina_Web = $pPagina_Web;
	}

	function getCorreo() {
		return $this -> correo;
	}

	function setCorreo($pCorreo) {
		$this -> correo = $pCorreo;
	}

	function getDescripcion() {
		return $this -> descripcion;
	}

	function setDescripcion($pDescripcion) {
		$this -> descripcion = $pDescripcion;
	}

	function getEntidades() {
		return $this -> entidades;
	}

	function setEntidades($pEntidades) {
		$this -> entidades = $pEntidades;
	}

	function getDependenciaContacto() {
		return $this -> dependenciaContacto;
	}

	function setDependenciaContacto($pDependenciaContacto) {
		$this -> dependenciaContacto = $pDependenciaContacto;
	}

	function getNaturaleza() {
		return $this -> naturaleza;
	}

	function setNaturaleza($pNaturaleza) {
		$this -> naturaleza = $pNaturaleza;
	}

	function getAreaInfluencia() {
		return $this -> areaInfluencia;
	}

	function setAreaInfluencia($pAreaInfluencia) {
		$this -> areaInfluencia = $pAreaInfluencia;
	}

	function getSector() {
		return $this -> sector;
	}

	function setSector($pSector) {
		$this -> sector = $pSector;
	}

	function RelacionActoresEntidad($pIdRelacionActoresEntidad = "", $pSiglas = "", $pTelefono = "", $pPagina_Web = "", $pCorreo = "", $pDescripcion = "", $pEntidades = "", $pDependenciaContacto = "", $pNaturaleza = "", $pAreaInfluencia = "", $pSector = ""){
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
		$this -> relacionActoresEntidadDAO = new RelacionActoresEntidadDAO($this -> idRelacionActoresEntidad, $this -> siglas, $this -> telefono, $this -> pagina_Web, $this -> correo, $this -> descripcion, $this -> entidades, $this -> dependenciaContacto, $this -> naturaleza, $this -> areaInfluencia, $this -> sector);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idRelacionActoresEntidad = $result[0];
		$this -> siglas = $result[1];
		$this -> telefono = $result[2];
		$this -> pagina_Web = $result[3];
		$this -> correo = $result[4];
		$this -> descripcion = $result[5];
		$entidades = new Entidades($result[6]);
		$entidades -> select();
		$this -> entidades = $entidades;
		$dependenciaContacto = new DependenciaContacto($result[7]);
		$dependenciaContacto -> select();
		$this -> dependenciaContacto = $dependenciaContacto;
		$naturaleza = new Naturaleza($result[8]);
		$naturaleza -> select();
		$this -> naturaleza = $naturaleza;
		$areaInfluencia = new AreaInfluencia($result[9]);
		$areaInfluencia -> select();
		$this -> areaInfluencia = $areaInfluencia;
		$sector = new Sector($result[10]);
		$sector -> select();
		$this -> sector = $sector;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAll());
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByEntidades(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByEntidades());
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByDependenciaContacto(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByDependenciaContacto());
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByNaturaleza(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByNaturaleza());
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByAreaInfluencia(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByAreaInfluencia());
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllBySector(){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllBySector());
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllOrder($order, $dir));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByEntidadesOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByEntidadesOrder($order, $dir));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByDependenciaContactoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByDependenciaContactoOrder($order, $dir));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByNaturalezaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByNaturalezaOrder($order, $dir));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllByAreaInfluenciaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllByAreaInfluenciaOrder($order, $dir));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function selectAllBySectorOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> selectAllBySectorOrder($order, $dir));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> relacionActoresEntidadDAO -> search($search));
		$relacionActoresEntidads = array();
		while ($result = $this -> connection -> fetchRow()){
			$entidades = new Entidades($result[6]);
			$entidades -> select();
			$dependenciaContacto = new DependenciaContacto($result[7]);
			$dependenciaContacto -> select();
			$naturaleza = new Naturaleza($result[8]);
			$naturaleza -> select();
			$areaInfluencia = new AreaInfluencia($result[9]);
			$areaInfluencia -> select();
			$sector = new Sector($result[10]);
			$sector -> select();
			array_push($relacionActoresEntidads, new RelacionActoresEntidad($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector));
		}
		$this -> connection -> close();
		return $relacionActoresEntidads;
	}
	
	function traerId(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> relacionActoresEntidadDAO -> traerId());
	    $result = $this -> connection -> fetchRow();
	    $this -> connection -> close();
	    $this -> idRelacionActoresEntidad = $result[0];
	}
}
?>
