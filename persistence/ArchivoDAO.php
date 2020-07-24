<?php
class ArchivoDAO{
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

	function ArchivoDAO($pIdArchivo = "", $pNombre = "", $pDescripcion = "", $pUrl = "", $pFechapublicacion = "", $pFechatemporalidad = "", $pFuente = "", $pSubcapitulo = "", $pTema = "", $pSeccion = "", $pEstado= "",$pAdministrador=""){
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
	}

	function insert(){
		return "insert into archivo(nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado,administrador)
				values('" . $this -> nombre . "', '" . $this -> descripcion . "', '" . $this -> url . "', '" . $this -> fechapublicacion . "', '" . $this -> fechatemporalidad . "', '" . $this -> fuente . "', '" . $this -> subcapitulo . "', '" . $this -> tema . "', '" . $this -> seccion . "','". $this -> estado."','". $this -> administrador ."')";
	}

	function update(){
		return "update archivo set 
				nombre = '" . $this -> nombre . "',
				descripcion = '" . $this -> descripcion . "',
				url = '" . $this -> url . "',
				fechapublicacion = '" . $this -> fechapublicacion . "',
				fechatemporalidad = '" . $this -> fechatemporalidad . "',
				fuente = '" . $this -> fuente . "',
				subcapitulo_idSubcapitulo = '" . $this -> subcapitulo . "',
				tema_idTema = '" . $this -> tema . "',
				seccion_idSeccion = '" . $this -> seccion . "',
                estado = '" . $this -> estado . "'		
				where idArchivo = '" . $this -> idArchivo . "'";
	}

	function select() {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where idArchivo = '" . $this -> idArchivo . "'";
	}

	function selectAll() {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo";
	}

	function selectAllBySubcapitulo() {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where subcapitulo_idSubcapitulo = '" . $this -> subcapitulo . "'";
	}

	function selectAllByTema() {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where tema_idTema = '" . $this -> tema . "'";
	}

	function selectAllBySeccion() {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where seccion_idSeccion = '" . $this -> seccion . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				order by " . $orden . " " . $dir;
	}

	function selectAllBySubcapituloOrder($orden, $dir) {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where subcapitulo_idSubcapitulo = '" . $this -> subcapitulo . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByTemaOrder($orden, $dir) {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where tema_idTema = '" . $this -> tema . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllBySeccionOrder($orden, $dir) {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado
				from archivo
				where seccion_idSeccion = '" . $this -> seccion . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idArchivo, nombre, descripcion, url, fechapublicacion, fechatemporalidad, fuente, subcapitulo_idSubcapitulo, tema_idTema, seccion_idSeccion, estado, administrador
				from archivo
				where nombre like '%" . $search . "%' or descripcion like '%" . $search . "%' or url like '%" . $search . "%' or fechapublicacion like '%" . $search . "%' or fechatemporalidad like '%" . $search . "%' or fuente like '%" . $search . "%'";
	}
	
	function traerPorArchivoSeccionSub($SubCapitulo,$Seccion)
	{
	    return "select ar.*
                from archivo ar
                inner join seccion s on ar.seccion_idSeccion = s.idSeccion
                WHERE ar.subcapitulo_idSubcapitulo='".$SubCapitulo."' and s.idSeccion='".$Seccion."' and
                ar.estado = 0";
	}
	
	function traerPorSubCapitulo($SubCapitulo)
	{
	    return "select ar.* 
                from archivo ar
                WHERE ar.subcapitulo_idSubcapitulo='".$SubCapitulo."' and ar.seccion_idSeccion is null
                and ar.estado = 0";
	}
	
	function traerPorIDArchivoSeccionSub($SubCapitulo,$Seccion)
	{
	    return "select ar.*
                from archivo ar
                inner join seccion s on ar.seccion_idSeccion = s.idSeccion
                WHERE ar.subcapitulo_idSubcapitulo='".$SubCapitulo."' and s.idSeccion='".$Seccion."' and
                ar.estado = 0";
	}
	
	function traeridArchivo($SubCapitulo)
	{
	    return "SELECT ar.idArchivo
                from archivo ar
                where subcapitulo_idSubcapitulo=".$SubCapitulo." and seccion_idSeccion is null
                and ar.estado = 0";
	}
}
?>
