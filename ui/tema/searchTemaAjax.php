<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Descripcion</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$tema = new Tema();
		$temas = $tema -> search($_GET['search']);
		$counter = 1;
		foreach ($temas as $currentTema) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentTema -> getDescripcion()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/tema/updateTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Tema' ></span></a> ";
						}
						/* echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Tema Normatividad' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/insertTemaNormatividad.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Normatividad' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/selectAllTemaReferenciasByTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Tema Referencias' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/insertTemaReferencias.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Referencias' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidadByTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Tema Relacion Actores Entidad' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/insertTemaRelacionActoresEntidad.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Relacion Actores Entidad' ></span></a> ";
						} */
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
