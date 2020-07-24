<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th nowrap>Siglas</th>
			<th nowrap>Telefono</th>
			<th nowrap>Pagina Web</th>
			<th nowrap>Correo</th>
			<th nowrap>Descripci&oacute;n &nbsp;&nbsp;</th>
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
		foreach ($relacionActoresEntidads as $currentRelacionActoresEntidad) {
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
			echo "</tr>";
		}
		?>
	</tbody>
</table>
</div>
