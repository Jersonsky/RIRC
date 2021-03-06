<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$tema = new Tema($_GET['idTema']); 
$tema -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Mostrar Archivos por Tema: <em><?php echo $tema -> getDescripcion() ?></em></h4>
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
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=descripcion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Url 
						<?php if($order=="url" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=url&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="url" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=url&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Fechapublicacion 
						<?php if($order=="fechapublicacion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=fechapublicacion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fechapublicacion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=fechapublicacion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Fechatemporalidad 
						<?php if($order=="fechatemporalidad" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=fechatemporalidad&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fechatemporalidad" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=fechatemporalidad&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Fuente 
						<?php if($order=="fuente" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=fuente&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fuente" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivoByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=fuente&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Subcapitulo</th>
						<th>Tema</th>
						<th>Seccion</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$archivo = new Archivo("", "", "", "", "", "", "", "", $_GET['idTema'], "");
					if($order!="" && $dir!="") {
						$archivos = $archivo -> selectAllByTemaOrder($order, $dir);
					} else {
						$archivos = $archivo -> selectAllByTema();
					}
					$counter = 1;
					foreach ($archivos as $currentArchivo) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentArchivo -> getNombre() . "</td>";
						echo "<td>" . $currentArchivo -> getDescripcion() . "</td>";
						echo "<td>" . $currentArchivo -> getUrl() . "</td>";
						echo "<td>" . $currentArchivo -> getFechapublicacion() . "</td>";
						echo "<td>" . $currentArchivo -> getFechatemporalidad() . "</td>";
						echo "<td>" . $currentArchivo -> getFuente() . "</td>";
						echo "<td><a href='modalSubcapitulo.php?idSubcapitulo=" . $currentArchivo -> getSubcapitulo() -> getIdSubcapitulo() . "' data-toggle='modal' data-target='#modalArchivo' >" . $currentArchivo -> getSubcapitulo() -> getNombre() . "</a></td>";
						echo "<td><a href='modalTema.php?idTema=" . $currentArchivo -> getTema() -> getIdTema() . "' data-toggle='modal' data-target='#modalArchivo' >" . $currentArchivo -> getTema() -> getDescripcion() . "</a></td>";
						echo "<td><a href='modalSeccion.php?idSeccion=" . $currentArchivo -> getSeccion() -> getIdSeccion() . "' data-toggle='modal' data-target='#modalArchivo' >" . $currentArchivo -> getSeccion() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/archivo/updateArchivo.php") . "&idArchivo=" . $currentArchivo -> getIdArchivo() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Archivo' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/visita/selectAllVisitaByArchivo.php") . "&idArchivo=" . $currentArchivo -> getIdArchivo() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostar Visita' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/visita/insertVisita.php") . "&idArchivo=" . $currentArchivo -> getIdArchivo() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Visita' ></span></a> ";
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
<div class="modal fade" id="modalArchivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
