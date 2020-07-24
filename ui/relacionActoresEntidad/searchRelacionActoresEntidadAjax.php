<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Siglas</th>
			<th nowrap>Telefono</th>
			<th nowrap>Pagina_ Web</th>
			<th nowrap>Correo</th>
			<th nowrap>Descripcion</th>
			<th>Entidades</th>
			<th>Dependencia Contacto</th>
			<th>Naturaleza</th>
			<th>Area Influencia</th>
			<th>Sector</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$relacionActoresEntidad = new RelacionActoresEntidad();
		$relacionActoresEntidads = $relacionActoresEntidad -> search($_GET['search']);
		$counter = 1;
		foreach ($relacionActoresEntidads as $currentRelacionActoresEntidad) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRelacionActoresEntidad -> getSiglas()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRelacionActoresEntidad -> getTelefono()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRelacionActoresEntidad -> getPagina_Web()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRelacionActoresEntidad -> getCorreo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRelacionActoresEntidad -> getDescripcion()) . "</td>";
			echo "<td>" . $currentRelacionActoresEntidad -> getEntidades() -> getNombre() . "</td>";
			echo "<td>" . $currentRelacionActoresEntidad -> getDependenciaContacto() -> getNombre() . "</td>";
			echo "<td>" . $currentRelacionActoresEntidad -> getNaturaleza() -> getNombre() . "</td>";
			echo "<td>" . $currentRelacionActoresEntidad -> getAreaInfluencia() -> getNombre() . "</td>";
			echo "<td>" . $currentRelacionActoresEntidad -> getSector() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/relacionActoresEntidad/updateRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Relacion Actores Entidad' ></span></a> ";
						}
						/* echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidadByRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Tema Relacion Actores Entidad' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/insertTemaRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Tema Relacion Actores Entidad' ></span></a> ";
						}
						echo "</td>"; */
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
