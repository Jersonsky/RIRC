<?php
class VisitanteDAO{
	private $idVisitante;
	private $nombre;

	function VisitanteDAO($pIdVisitante = "", $pNombre = ""){
		$this -> idVisitante = $pIdVisitante;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into visitante(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update visitante set 
				nombre = '" . $this -> nombre . "'	
				where idVisitante = '" . $this -> idVisitante . "'";
	}

	function select() {
		return "select idVisitante, nombre
				from visitante
				where idVisitante = '" . $this -> idVisitante . "'";
	}

	function selectAll() {
		return "select idVisitante, nombre
				from visitante";
	}

	function selectAllOrder($orden, $dir){
		return "select idVisitante, nombre
				from visitante
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from visitante
				where idVisitante = '" . $this -> idVisitante . "'";
	}
	
	function traerIP($ip){
	    return "select idVisitante, nombre
				from visitante
				where nombre ='".$ip."';";
	    
	}
	
	function selectPorNombre() {
	    return "select idVisitante, nombre
				from visitante
				where nombre = '" . $this -> nombre . "'";
	}
}
?>
