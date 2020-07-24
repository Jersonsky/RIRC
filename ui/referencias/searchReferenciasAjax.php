<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Titulo</th>
			<th nowrap>Editorial</th>
			<th nowrap>Autores</th>
			<th nowrap>Link</th>
			<th>Entidades</th>
			<th>Pais</th>
			<th>Ciudad</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$referencias = new Referencias();
		$referenciass = $referencias -> search($_GET['search']);
		$counter = 1;
		foreach ($referenciass as $currentReferencias) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getTitulo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getEditorial()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getAutores()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getLink()) . "</td>";
			echo "<td>" . $currentReferencias -> getEntidades() -> getNombre() . "</td>";
			echo "<td>". $currentReferencias -> getCiudad() -> getPais() -> getNombre() . "</td>";
			echo "<td>" . $currentReferencias -> getCiudad() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/referencias/updateReferencias.php") . "&idReferencias=" . $currentReferencias -> getIdReferencias() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Referencia' ></span></a> ";
						}
						/* echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/selectAllTemaReferenciasByReferencias.php") . "&idReferencias=" . $currentReferencias -> getIdReferencias() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Tema Referencias' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/insertTemaReferencias.php") . "&idReferencias=" . $currentReferencias -> getIdReferencias() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Tema Referencias' ></span></a> ";
						} */
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
