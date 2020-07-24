<?php
class ReferenciasDAO{
	private $idReferencias;
	private $titulo;
	private $editorial;
	private $Autores;
	private $link;
	private $entidades;
	private $ciudad;

	function ReferenciasDAO($pIdReferencias = "", $pTitulo = "", $pEditorial = "", $pAutores = "", $pLink = "", $pEntidades = "", $pCiudad = ""){
		$this -> idReferencias = $pIdReferencias;
		$this -> titulo = $pTitulo;
		$this -> editorial = $pEditorial;
		$this -> Autores = $pAutores;
		$this -> link = $pLink;
		$this -> entidades = $pEntidades;
		$this -> ciudad = $pCiudad;
	}

	function insert(){
		return "insert into referencias(titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad)
				values('" . $this -> titulo . "', '" . $this -> editorial . "', '" . $this -> Autores . "', '" . $this -> link . "', '" . $this -> entidades . "', '" . $this -> ciudad . "')";
	}

	function update(){
		return "update referencias set 
				titulo = '" . $this -> titulo . "',
				editorial = '" . $this -> editorial . "',
				Autores = '" . $this -> Autores . "',
				link = '" . $this -> link . "',
				entidades_idEntidades = '" . $this -> entidades . "',
				ciudad_idCiudad = '" . $this -> ciudad . "'	
				where idReferencias = '" . $this -> idReferencias . "'";
	}

	function select() {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias
				where idReferencias = '" . $this -> idReferencias . "'";
	}

	function selectAll() {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias";
	}

	function selectAllByEntidades() {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias
				where entidades_idEntidades = '" . $this -> entidades . "'";
	}

	function selectAllByCiudad() {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias
				where ciudad_idCiudad = '" . $this -> ciudad . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias
				order by " . $orden . " " . $dir;
	}

	function selectAllByEntidadesOrder($orden, $dir) {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias
				where entidades_idEntidades = '" . $this -> entidades . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByCiudadOrder($orden, $dir) {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades, ciudad_idCiudad
				from referencias
				where ciudad_idCiudad = '" . $this -> ciudad . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idReferencias, titulo, editorial, Autores, link, entidades_idEntidades,ciudad_idCiudad
				from referencias
				where titulo like '%" . $search . "%' or editorial like '%" . $search . "%' or Autores like '%" . $search . "%' or link like '%" . $search . "%'";
	}
	
	function traerId(){
	    return "SELECT idReferencias 
                from referencias 
                order by idReferencias DESC 
                limit 1";
	}
}
?>
