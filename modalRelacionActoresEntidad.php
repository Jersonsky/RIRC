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
$idRelacionActoresEntidad = $_GET ['idRelacionActoresEntidad'];
$relacionActoresEntidad = new RelacionActoresEntidad($idRelacionActoresEntidad);
$relacionActoresEntidad -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Relacion Actores Entidad</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Siglas</th>
			<td><?php echo $relacionActoresEntidad -> getSiglas() ?></td>
		</tr>
		<tr>
			<th>Telefono</th>
			<td><?php echo $relacionActoresEntidad -> getTelefono() ?></td>
		</tr>
		<tr>
			<th>Pagina_ Web</th>
			<td><?php echo $relacionActoresEntidad -> getPagina_Web() ?></td>
		</tr>
		<tr>
			<th>Correo</th>
			<td><?php echo $relacionActoresEntidad -> getCorreo() ?></td>
		</tr>
		<tr>
			<th>Descripcion</th>
			<td><?php echo $relacionActoresEntidad -> getDescripcion() ?></td>
		</tr>
		<tr>
			<th>Entidades</th>
			<td><?php echo $relacionActoresEntidad -> getEntidades() -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Dependencia Contacto</th>
			<td><?php echo $relacionActoresEntidad -> getDependenciaContacto() -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Naturaleza</th>
			<td><?php echo $relacionActoresEntidad -> getNaturaleza() -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Area Influencia</th>
			<td><?php echo $relacionActoresEntidad -> getAreaInfluencia() -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Sector</th>
			<td><?php echo $relacionActoresEntidad -> getSector() -> getNombre() ?></td>
		</tr>
	</table>
</div>
