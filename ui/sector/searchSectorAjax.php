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
		$sector = new Sector();
		$sectors = $sector -> search($_GET['search']);
		$counter = 1;
		foreach ($sectors as $currentSector) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentSector -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/sector/updateSector.php") . "&idSector=" . $currentSector -> getIdSector() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Sector' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/normatividad/selectAllNormatividadBySector.php") . "&idSector=" . $currentSector -> getIdSector() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Normatividades' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/normatividad/insertNormatividad.php") . "&idSector=" . $currentSector -> getIdSector() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Normatividad' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadBySector.php") . "&idSector=" . $currentSector -> getIdSector() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Relacion Actores Entidad' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/relacionActoresEntidad/insertRelacionActoresEntidad.php") . "&idSector=" . $currentSector -> getIdSector() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Relacion Actores Entidad' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
