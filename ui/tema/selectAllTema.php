<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Listar Temas</h4>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/tema/selectAllTema.php") ?>&order=descripcion&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/tema/selectAllTema.php") ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$tema = new Tema();
					if($order != "" && $dir != "") {
						$temas = $tema -> selectAllOrder($order, $dir);
					} else {
						$temas = $tema -> selectAll();
					}
					$counter = 1;
					foreach ($temas as $currentTema) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentTema -> getDescripcion() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/tema/updateTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Tema' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Tema Normatividad' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/insertTemaNormatividad.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Normatividad' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/selectAllTemaReferenciasByTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Tema Referencias' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/insertTemaReferencias.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Referencias' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidadByTema.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Tema Relacion Actores Entidad' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/insertTemaRelacionActoresEntidad.php") . "&idTema=" . $currentTema -> getIdTema() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Tema Relacion Actores Entidad' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalTema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
