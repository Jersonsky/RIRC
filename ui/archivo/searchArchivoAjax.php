<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nombre</th>
			<th nowrap>Descripcion</th>
			<th nowrap>Url</th>
			<th nowrap>Fecha publicación</th>
			<th nowrap>Año investigación</th>
			<th nowrap>Fuente</th>
			<th>Subcapitulo</th>
			<th>Tema</th>
			<th>Seccion</th>
			<th>Administrador</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$archivo = new Archivo();
		$archivos = $archivo -> search($_GET['search']);
		$counter = 1;
		foreach ($archivos as $currentArchivo) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArchivo -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArchivo -> getDescripcion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArchivo -> getUrl()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArchivo -> getFechapublicacion()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArchivo -> getFechatemporalidad()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentArchivo -> getFuente()) . "</td>";
			echo "<td>" . $currentArchivo -> getSubcapitulo() -> getNombre() . "</td>";
			echo "<td>" . $currentArchivo -> getTema() -> getDescripcion() . "</td>";
			echo "<td>" . $currentArchivo -> getSeccion() -> getNombre() . "</td>";
			echo "<td>" . $currentArchivo -> getAdministrador() -> getName(). "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/archivo/updateArchivo.php") . "&idArchivo=" . $currentArchivo -> getIdArchivo() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Archivo' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/visita/selectAllVisitaByArchivo.php") . "&idArchivo=" . $currentArchivo -> getIdArchivo() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Listar Visita' ></span></a> ";
						
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
