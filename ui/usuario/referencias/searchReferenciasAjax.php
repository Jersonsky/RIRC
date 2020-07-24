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
		</tr>
	</thead>
	</tbody>
		<?php
		$referencias = new Referencias();
		$referenciasd = $referencias -> search($_GET['search']);
		$counter = 1;
		foreach ($referenciasd as $currentReferencias) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getTitulo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getEditorial()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getAutores()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentReferencias -> getLink()) . "</td>";
			echo "<td>" . $currentReferencias -> getEntidades() -> getNombre() . "</td>";
			echo "<td>". $currentReferencias -> getCiudad() -> getPais() -> getNombre() . "</td>";
			echo "<td>" . $currentReferencias -> getCiudad() -> getNombre() . "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
