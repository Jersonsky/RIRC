<?php
class SubcapituloDAO{
	private $idSubcapitulo;
	private $nombre;
	private $capitulo;

	function SubcapituloDAO($pIdSubcapitulo = "", $pNombre = "", $pCapitulo = ""){
		$this -> idSubcapitulo = $pIdSubcapitulo;
		$this -> nombre = $pNombre;
		$this -> capitulo = $pCapitulo;
	}

	function insert(){
		return "insert into subcapitulo(nombre, capitulo_idCapitulo)
				values('" . $this -> nombre . "', '" . $this -> capitulo . "')";
	}

	function update(){
		return "update subcapitulo set 
				nombre = '" . $this -> nombre . "',
				capitulo_idCapitulo = '" . $this -> capitulo . "'	
				where idSubcapitulo = '" . $this -> idSubcapitulo . "'";
	}

	function select() {
		return "select idSubcapitulo, nombre, capitulo_idCapitulo
				from subcapitulo
				where idSubcapitulo = '" . $this -> idSubcapitulo . "'";
	}

	function selectAll() {
		return "select idSubcapitulo, nombre, capitulo_idCapitulo
				from subcapitulo";
	}

	function selectAllByCapitulo() {
		return "select idSubcapitulo, nombre, capitulo_idCapitulo
				from subcapitulo
				where capitulo_idCapitulo = '" . $this -> capitulo . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idSubcapitulo, nombre, capitulo_idCapitulo
				from subcapitulo
				order by " . $orden . " " . $dir;
	}

	function selectAllByCapituloOrder($orden, $dir) {
		return "select idSubcapitulo, nombre, capitulo_idCapitulo
				from subcapitulo
				where capitulo_idCapitulo = '" . $this -> capitulo . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idSubcapitulo, nombre, capitulo_idCapitulo
				from subcapitulo
				where nombre like '%" . $search . "%'";
	}
}
?>
