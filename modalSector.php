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
$idSector = $_GET ['idSector'];
$sector = new Sector($idSector);
$sector -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Sector</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $sector -> getNombre() ?></td>
		</tr>
	</table>
</div>
