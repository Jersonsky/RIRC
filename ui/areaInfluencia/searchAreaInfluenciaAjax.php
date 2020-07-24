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
		$areaInfluencia = new AreaInfluencia();
		$areaInfluencias = $areaInfluencia -> search($_GET['search']);
		$counter = 1;
		foreach ($areaInfluencias as $currentAreaInfluencia) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentAreaInfluencia -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/areaInfluencia/updateAreaInfluencia.php") . "&idAreaInfluencia=" . $currentAreaInfluencia -> getIdAreaInfluencia() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar  Area Influencia' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByAreaInfluencia.php") . "&idAreaInfluencia=" . $currentAreaInfluencia -> getIdAreaInfluencia() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Relacion Actores Entidad' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/relacionActoresEntidad/insertRelacionActoresEntidad.php") . "&idAreaInfluencia=" . $currentAreaInfluencia -> getIdAreaInfluencia() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Relacion Actores Entidad' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
