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
		$documentoJuridico = new DocumentoJuridico();
		$documentoJuridicos = $documentoJuridico -> search($_GET['search']);
		$counter = 1;
		foreach ($documentoJuridicos as $currentDocumentoJuridico) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentDocumentoJuridico -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/documentoJuridico/updateDocumentoJuridico.php") . "&idDocumentoJuridico=" . $currentDocumentoJuridico -> getIdDocumentoJuridico() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Documento Juridico' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/normatividad/selectAllNormatividadByDocumentoJuridico.php") . "&idDocumentoJuridico=" . $currentDocumentoJuridico -> getIdDocumentoJuridico() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Normatividades' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/normatividad/insertNormatividad.php") . "&idDocumentoJuridico=" . $currentDocumentoJuridico -> getIdDocumentoJuridico() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Normatividad' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
