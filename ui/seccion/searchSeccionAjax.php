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
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$seccion = new Seccion();
		$seccions = $seccion -> search($_GET['search']);
		$counter = 1;
		foreach ($seccions as $currentSeccion) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentSeccion -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/seccion/updateSeccion.php") . "&idSeccion=" . $currentSeccion -> getIdSeccion() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Seccion' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/archivo/selectAllArchivoBySeccion.php") . "&idSeccion=" . $currentSeccion -> getIdSeccion() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Archivos' ></span></a> ";
						/* if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/archivo/insertArchivo.php") . "&idSeccion=" . $currentSeccion -> getIdSeccion() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Archivo' ></span></a> ";
						} */
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
