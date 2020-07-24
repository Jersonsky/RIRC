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
			<th>Capitulo</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$subcapitulo = new Subcapitulo();
		$subcapitulos = $subcapitulo -> search($_GET['search']);
		$counter = 1;
		foreach ($subcapitulos as $currentSubcapitulo) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentSubcapitulo -> getNombre()) . "</td>";
			echo "<td>" . $currentSubcapitulo -> getCapitulo() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/subcapitulo/updateSubcapitulo.php") . "&idSubcapitulo=" . $currentSubcapitulo -> getIdSubcapitulo() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Subcapitulo' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/archivo/selectAllArchivoBySubcapitulo.php") . "&idSubcapitulo=" . $currentSubcapitulo -> getIdSubcapitulo() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Archivos' ></span></a> ";
						
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
