<?php
class VisitaDAO{
	private $idVisita;
	private $fecha;
	private $archivo;
	private $visitante;

	function VisitaDAO($pIdVisita = "", $pFecha = "", $pArchivo = "", $pVisitante = ""){
		$this -> idVisita = $pIdVisita;
		$this -> fecha = $pFecha;
		$this -> archivo = $pArchivo;
		$this -> visitante = $pVisitante;
	}

	function insert(){
		return "insert into visita(fecha, archivo_idArchivo, visitante_idVisitante)
				values('" . $this -> fecha . "', '" . $this -> archivo . "', '" . $this -> visitante . "')";
	}

	function update(){
		return "update visita set 
				fecha = '" . $this -> fecha . "',
				archivo_idArchivo = '" . $this -> archivo . "',
				visitante_idVisitante = '" . $this -> visitante . "'	
				where idVisita = '" . $this -> idVisita . "'";
	}

	function select() {
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita
				where idVisita = '" . $this -> idVisita . "'";
	}

	function selectAll() {
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita";
	}

	function selectAllByArchivo() {
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita
				where archivo_idArchivo = '" . $this -> archivo . "'";
	}

	function selectAllByVisitante() {
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita
				where visitante_idVisitante = '" . $this -> visitante . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita
				order by " . $orden . " " . $dir;
	}

	function selectAllByArchivoOrder($orden, $dir) {
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita
				where archivo_idArchivo = '" . $this -> archivo . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByVisitanteOrder($orden, $dir) {
		return "select idVisita, fecha, archivo_idArchivo, visitante_idVisitante
				from visita
				where visitante_idVisitante = '" . $this -> visitante . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from visita
				where idVisita = '" . $this -> idVisita . "'";
	}
	
	function totalVisitas(){
	    return "SELECT COUNT(fecha), fecha  
                FROM visita 
                GROUP BY MONTH(fecha)
                ORDER BY fecha ASC";
	}
	
	function traerVisita($archivo){
	    return "select v.*
                from visita as v
                INNER JOIN archivo as a on v.archivo_idArchivo=a.idArchivo
                WHERE a.idArchivo=".$archivo."";
	}
	
	function traerVisitaPorCapitulo(){
	    return "select v.fecha, c.nombre, count(v.fecha)
                from visita v
                INNER JOIN archivo a on v.archivo_idArchivo=a.idArchivo
                inner join subcapitulo s on a.subcapitulo_idSubcapitulo = s.idSubcapitulo
                inner join capitulo c on s.capitulo_idCapitulo = c.idCapitulo
                group by v.fecha, c.nombre
                ORDER by v.fecha asc";
	}
	
	function graficaPorSubcapitulo($subcapitulo){
	    return "SELECT MONTH(v.fecha), s.nombre, count(v.fecha)
                FROM visita v
                INNER JOIN archivo a on v.archivo_idArchivo=a.idArchivo
                INNER JOIN subcapitulo s on a.subcapitulo_idSubcapitulo = s.idSubcapitulo
                INNER JOIN capitulo c on s.capitulo_idCapitulo = c.idCapitulo
                WHERE c.idCapitulo = '".$subcapitulo."'
                GROUP BY MONTH(v.fecha), s.nombre
                ORDER BY v.fecha asc";
	}
	
	function graficaPorDocumento($subcapitulo){
	    return "SELECT MONTH(v.fecha), a.idArchivo, count(v.fecha)
                FROM visita v
                INNER JOIN archivo a on v.archivo_idArchivo=a.idArchivo
                INNER JOIN subcapitulo s on a.subcapitulo_idSubcapitulo = s.idSubcapitulo
                WHERE s.idSubcapitulo = '".$subcapitulo."' and a.fechapublicacion=(SELECT MAX(a.fechapublicacion) from archivo a
                where a.subcapitulo_idSubcapitulo='".$subcapitulo."') and a.estado='0'
                GROUP BY MONTH(v.fecha), a.nombre
                ORDER BY v.fecha asc";
	}
	
	function graficaPorDocumentoTotal($archivo){
	    return "SELECT MONTH(v.fecha), a.idArchivo, count(v.fecha)
                FROM visita v
                INNER JOIN archivo a on v.archivo_idArchivo=a.idArchivo
                INNER JOIN subcapitulo s on a.subcapitulo_idSubcapitulo = s.idSubcapitulo
                WHERE a.idArchivo = '".$archivo."' 
                GROUP BY MONTH(v.fecha), a.nombre
                ORDER BY v.fecha asc";
	}
	
	function controlDocumentos(){
	    return "SELECT MONTH(fechapublicacion),nombre, COUNT(fechapublicacion)
                FROM archivo 
                GROUP BY MONTH(fechapublicacion)
                ORDER BY fechapublicacion asc";
	}
}
?>
