<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$capitulo = new Capitulo($_GET['idCapitulo']); 
$capitulo -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Listar Subcapitulo del Capitulo: <em><?php echo $capitulo -> getNombre() ?></em></h4>
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
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/subcapitulo/selectAllSubcapituloByCapitulo.php") ?>&idCapitulo=<?php echo $_GET['idCapitulo'] ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/subcapitulo/selectAllSubcapituloByCapitulo.php") ?>&idCapitulo=<?php echo $_GET['idCapitulo'] ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Capitulo</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$subcapitulo = new Subcapitulo("", "", $_GET['idCapitulo']);
					if($order!="" && $dir!="") {
						$subcapitulos = $subcapitulo -> selectAllByCapituloOrder($order, $dir);
					} else {
						$subcapitulos = $subcapitulo -> selectAllByCapitulo();
					}
					$counter = 1;
					foreach ($subcapitulos as $currentSubcapitulo) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentSubcapitulo -> getNombre() . "</td>";
						echo "<td><a href='modalCapitulo.php?idCapitulo=" . $currentSubcapitulo -> getCapitulo() -> getIdCapitulo() . "' data-toggle='modal' data-target='#modalSubcapitulo' >" . $currentSubcapitulo -> getCapitulo() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/subcapitulo/updateSubcapitulo.php") . "&idSubcapitulo=" . $currentSubcapitulo -> getIdSubcapitulo() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Subcapitulo' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/archivo/selectAllArchivoBySubcapitulo.php") . "&idSubcapitulo=" . $currentSubcapitulo -> getIdSubcapitulo() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Archivos' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/archivo/insertArchivo.php") . "&idSubcapitulo=" . $currentSubcapitulo -> getIdSubcapitulo() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Archivo' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalSubcapitulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
