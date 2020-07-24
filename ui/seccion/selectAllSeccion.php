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
			<h4 class="card-title">Listar Secciones</h4>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/seccion/selectAllSeccion.php") ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/seccion/selectAllSeccion.php") ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$seccion = new Seccion();
					if($order != "" && $dir != "") {
						$seccions = $seccion -> selectAllOrder($order, $dir);
					} else {
						$seccions = $seccion -> selectAll();
					}
					$counter = 1;
					foreach ($seccions as $currentSeccion) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentSeccion -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/seccion/updateSeccion.php") . "&idSeccion=" . $currentSeccion -> getIdSeccion() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Seccion' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/archivo/selectAllArchivoBySeccion.php") . "&idSeccion=" . $currentSeccion -> getIdSeccion() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Archivo' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/archivo/insertArchivo.php") . "&idSeccion=" . $currentSeccion -> getIdSeccion() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Archivo' ></span></a> ";
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
<div class="modal fade" id="modalSeccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
