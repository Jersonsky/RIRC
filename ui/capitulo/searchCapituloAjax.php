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
		$capitulo = new Capitulo();
		$capitulos = $capitulo -> search($_GET['search']);
		$counter = 1;
		foreach ($capitulos as $currentCapitulo) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCapitulo -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/capitulo/updateCapitulo.php") . "&idCapitulo=" . $currentCapitulo -> getIdCapitulo() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Capitulo' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/subcapitulo/selectAllSubcapituloByCapitulo.php") . "&idCapitulo=" . $currentCapitulo -> getIdCapitulo() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostar Subcapitulo' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/subcapitulo/insertSubcapitulo.php") . "&idCapitulo=" . $currentCapitulo -> getIdCapitulo() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Subcapitulo' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
