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
			<h4 class="card-title">Listar Referencias</h4>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Titulo 
						<?php if($order=="titulo" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=titulo&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="titulo" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=titulo&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Editorial 
						<?php if($order=="editorial" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=editorial&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="editorial" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=editorial&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Autores 
						<?php if($order=="Autores" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=Autores&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="Autores" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=Autores&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Link 
						<?php if($order=="link" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=link&dir=asc'>
							<span class='fas fa-sort-amount-up' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' ></span></a>
						<?php } ?>
						<?php if($order=="link" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>&order=link&dir=desc'>
							<span class='fas fa-sort-amount-down' data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' ></span></a>
						<?php } ?>
						</th>
						<th>Entidades</th>
						<th>Pais</th>
						<th>Ciudad</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$referencias = new Referencias();
					if($order != "" && $dir != "") {
						$referenciass = $referencias -> selectAllOrder($order, $dir);
					} else {
						$referenciass = $referencias -> selectAll();
					}
					$counter = 1;
					foreach ($referenciass as $currentReferencias) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentReferencias -> getTitulo() . "</td>";
						echo "<td>" . $currentReferencias -> getEditorial() . "</td>";
						echo "<td>" . $currentReferencias -> getAutores() . "</td>";
						echo "<td>" . $currentReferencias -> getLink() . "</td>";
						echo "<td><a href='modalEntidades.php?idEntidades=" . $currentReferencias -> getEntidades() -> getIdEntidades() . "' data-toggle='modal' data-target='#modalReferencias' >" . $currentReferencias -> getEntidades() -> getNombre() . "</a></td>";
						echo "<td><a href='modalCiudad.php?idCiudad=" . $currentReferencias -> getCiudad() -> getPais() -> getIdPais() . "' data-toggle='modal' data-target='#modalReferencias' >" . $currentReferencias -> getCiudad() -> getPais() -> getNombre() . "</a></td>";
						echo "<td><a href='modalCiudad.php?idCiudad=" . $currentReferencias -> getCiudad() -> getIdCiudad() . "' data-toggle='modal' data-target='#modalReferencias' >" . $currentReferencias -> getCiudad() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/referencias/updateReferencias.php") . "&idReferencias=" . $currentReferencias -> getIdReferencias() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Referencias' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/selectAllTemaReferenciasByReferencias.php") . "&idReferencias=" . $currentReferencias -> getIdReferencias() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Tema Referencias' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaReferencias/insertTemaReferencias.php") . "&idReferencias=" . $currentReferencias -> getIdReferencias() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Tema Referencias' ></span></a> ";
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
<div class="modal fade" id="modalReferencias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
