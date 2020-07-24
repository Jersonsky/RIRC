<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Numero</th>
			<th nowrap>A&ntilde;o</th>
			<th nowrap>Objetivo</th>
			<th>Documento Juridico</th>
			<th>Entidades</th>
			<th>Sector</th>
			<th>Aplicabilidad</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$normatividad = new Normatividad();
		$normatividads = $normatividad -> search($_GET['search']);
		$counter = 1;
		foreach ($normatividads as $currentNormatividad) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentNormatividad -> getNumero()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentNormatividad -> getAnio()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentNormatividad -> getObjetivo()) . "</td>";
			echo "<td>" . $currentNormatividad -> getDocumentoJuridico() -> getNombre() . "</td>";
			echo "<td>" . $currentNormatividad -> getEntidades() -> getNombre() . "</td>";
			echo "<td>" . $currentNormatividad -> getSector() -> getNombre() . "</td>";
			echo "<td>" . $currentNormatividad -> getAplicabilidad() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/normatividad/updateNormatividad.php") . "&idNormatividad=" . $currentNormatividad -> getIdNormatividad() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Normatividad' ></span></a> ";
						}
						/*echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByNormatividad.php") . "&idNormatividad=" . $currentNormatividad -> getIdNormatividad() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar los temas Normatividad' ></span></a> ";
						 if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/insertTemaNormatividad.php") . "&idNormatividad=" . $currentNormatividad -> getIdNormatividad() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Normatividad' ></span></a> ";
						} */
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
