<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/Capitulo.php");
require("business/Subcapitulo.php");
require("business/Seccion.php");
require("business/Visitante.php");
require("business/Visita.php");
require("business/Archivo.php");
require("business/DocumentoJuridico.php");
require("business/Sector.php");
require("business/Entidades.php");
require("business/Ciudad.php");
require("business/Pais.php");
require("business/Naturaleza.php");
require("business/AreaInfluencia.php");
require("business/Aplicabilidad.php");
require("business/Normatividad.php");
require("business/Referencias.php");
require("business/DependenciaContacto.php");
require("business/RelacionActoresEntidad.php");
require("business/Tema.php");
require("business/TemaNormatividad.php");
require("business/TemaReferencias.php");
require("business/TemaRelacionActoresEntidad.php");
require_once("persistence/Connection.php");
$idReferencias = $_GET ['idReferencias'];
$referencias = new Referencias($idReferencias);
$referencias -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Referencias</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Titulo</th>
			<td><?php echo $referencias -> getTitulo() ?></td>
		</tr>
		<tr>
			<th>Editorial</th>
			<td><?php echo $referencias -> getEditorial() ?></td>
		</tr>
		<tr>
			<th>Autores</th>
			<td><?php echo $referencias -> getAutores() ?></td>
		</tr>
		<tr>
			<th>Link</th>
			<td><?php echo $referencias -> getLink() ?></td>
		</tr>
		<tr>
			<th>Entidades</th>
			<td><?php echo $referencias -> getEntidades() -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Ciudad</th>
			<td><?php echo $referencias -> getCiudad() -> getNombre() ?></td>
		</tr>
	</table>
</div>
