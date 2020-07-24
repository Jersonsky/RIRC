<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$sector = new Sector($_GET['idSector']); 
$sector -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Normatividad of Sector: <em><?php echo $sector -> getNombre() ?></em></h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Numero 
						<?php if($order=="numero" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividadBySector.php") ?>&idSector=<?php echo $_GET['idSector'] ?>&order=numero&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="numero" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividadBySector.php") ?>&idSector=<?php echo $_GET['idSector'] ?>&order=numero&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Anio 
						<?php if($order=="anio" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividadBySector.php") ?>&idSector=<?php echo $_GET['idSector'] ?>&order=anio&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="anio" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividadBySector.php") ?>&idSector=<?php echo $_GET['idSector'] ?>&order=anio&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Objetivo 
						<?php if($order=="objetivo" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividadBySector.php") ?>&idSector=<?php echo $_GET['idSector'] ?>&order=objetivo&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="objetivo" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividadBySector.php") ?>&idSector=<?php echo $_GET['idSector'] ?>&order=objetivo&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Documento Juridico</th>
						<th>Entidades</th>
						<th>Sector</th>
						<th>Aplicabilidad</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$normatividad = new Normatividad("", "", "", "", "", "", $_GET['idSector'], "");
					if($order!="" && $dir!="") {
						$normatividads = $normatividad -> selectAllBySectorOrder($order, $dir);
					} else {
						$normatividads = $normatividad -> selectAllBySector();
					}
					$counter = 1;
					foreach ($normatividads as $currentNormatividad) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentNormatividad -> getNumero() . "</td>";
						echo "<td>" . $currentNormatividad -> getAnio() . "</td>";
						echo "<td>" . $currentNormatividad -> getObjetivo() . "</td>";
						echo "<td><a href='modalDocumentoJuridico.php?idDocumentoJuridico=" . $currentNormatividad -> getDocumentoJuridico() -> getIdDocumentoJuridico() . "' data-toggle='modal' data-target='#modalNormatividad' >" . $currentNormatividad -> getDocumentoJuridico() -> getNombre() . "</a></td>";
						echo "<td><a href='modalEntidades.php?idEntidades=" . $currentNormatividad -> getEntidades() -> getIdEntidades() . "' data-toggle='modal' data-target='#modalNormatividad' >" . $currentNormatividad -> getEntidades() -> getNombre() . "</a></td>";
						echo "<td><a href='modalSector.php?idSector=" . $currentNormatividad -> getSector() -> getIdSector() . "' data-toggle='modal' data-target='#modalNormatividad' >" . $currentNormatividad -> getSector() -> getNombre() . "</a></td>";
						echo "<td><a href='modalAplicabilidad.php?idAplicabilidad=" . $currentNormatividad -> getAplicabilidad() -> getIdAplicabilidad() . "' data-toggle='modal' data-target='#modalNormatividad' >" . $currentNormatividad -> getAplicabilidad() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/normatividad/updateNormatividad.php") . "&idNormatividad=" . $currentNormatividad -> getIdNormatividad() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Normatividad' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByNormatividad.php") . "&idNormatividad=" . $currentNormatividad -> getIdNormatividad() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Tema Normatividad' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/insertTemaNormatividad.php") . "&idNormatividad=" . $currentNormatividad -> getIdNormatividad() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Tema Normatividad' ></span></a> ";
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
<div class="modal fade" id="modalNormatividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
