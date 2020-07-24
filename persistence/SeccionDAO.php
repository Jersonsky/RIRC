<?php
class SeccionDAO{
	private $idSeccion;
	private $nombre;

	function SeccionDAO($pIdSeccion = "", $pNombre = ""){
		$this -> idSeccion = $pIdSeccion;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into seccion(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update seccion set 
				nombre = '" . $this -> nombre . "'	
				where idSeccion = '" . $this -> idSeccion . "'";
	}

	function select() {
		return "select idSeccion, nombre
				from seccion
				where idSeccion = '" . $this -> idSeccion . "'";
	}

	function selectAll() {
		return "select idSeccion, nombre
				from seccion";
	}

	function selectAllOrder($orden, $dir){
		return "select idSeccion, nombre
				from seccion
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idSeccion, nombre
				from seccion
				where nombre like '%" . $search . "%'";
	}
	function traerSeccionPorSub($subCapitulo){
	    return "select DISTINCT(s.idSeccion), s.nombre
                from archivo a
                inner join seccion s on a.seccion_idSeccion = s.idSeccion
                where a.subcapitulo_idSubcapitulo=".$subCapitulo."";
	}
}
?>
