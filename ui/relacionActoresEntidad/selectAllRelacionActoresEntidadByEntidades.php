<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$entidades = new Entidades($_GET['idEntidades']); 
$entidades -> select();
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Relacion Actores Entidad of Entidades: <em><?php echo $entidades -> getNombre() ?></em></h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Siglas 
						<?php if($order=="siglas" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=siglas&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="siglas" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=siglas&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Telefono 
						<?php if($order=="telefono" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=telefono&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="telefono" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=telefono&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Pagina_ Web 
						<?php if($order=="pagina_Web" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=pagina_Web&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="pagina_Web" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=pagina_Web&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if($order=="correo" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=correo&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="correo" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=correo&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Descripcion 
						<?php if($order=="descripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=descripcion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="descripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php") ?>&idEntidades=<?php echo $_GET['idEntidades'] ?>&order=descripcion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
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
					$relacionActoresEntidad = new RelacionActoresEntidad("", "", "", "", "", "", $_GET['idEntidades'], "", "", "", "");
					if($order!="" && $dir!="") {
						$relacionActoresEntidads = $relacionActoresEntidad -> selectAllByEntidadesOrder($order, $dir);
					} else {
						$relacionActoresEntidads = $relacionActoresEntidad -> selectAllByEntidades();
					}
					$counter = 1;
					foreach ($relacionActoresEntidads as $currentRelacionActoresEntidad) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentRelacionActoresEntidad -> getSiglas() . "</td>";
						echo "<td>" . $currentRelacionActoresEntidad -> getTelefono() . "</td>";
						echo "<td>" . $currentRelacionActoresEntidad -> getPagina_Web() . "</td>";
						echo "<td>" . $currentRelacionActoresEntidad -> getCorreo() . "</td>";
						echo "<td>" . $currentRelacionActoresEntidad -> getDescripcion() . "</td>";
						echo "<td><a href='modalEntidades.php?idEntidades=" . $currentRelacionActoresEntidad -> getEntidades() -> getIdEntidades() . "' data-toggle='modal' data-target='#modalRelacionActoresEntidad' >" . $currentRelacionActoresEntidad -> getEntidades() -> getNombre() . "</a></td>";
						echo "<td><a href='modalDependenciaContacto.php?idDependenciaContacto=" . $currentRelacionActoresEntidad -> getDependenciaContacto() -> getIdDependenciaContacto() . "' data-toggle='modal' data-target='#modalRelacionActoresEntidad' >" . $currentRelacionActoresEntidad -> getDependenciaContacto() -> getNombre() . "</a></td>";
						echo "<td><a href='modalNaturaleza.php?idNaturaleza=" . $currentRelacionActoresEntidad -> getNaturaleza() -> getIdNaturaleza() . "' data-toggle='modal' data-target='#modalRelacionActoresEntidad' >" . $currentRelacionActoresEntidad -> getNaturaleza() -> getNombre() . "</a></td>";
						echo "<td><a href='modalAreaInfluencia.php?idAreaInfluencia=" . $currentRelacionActoresEntidad -> getAreaInfluencia() -> getIdAreaInfluencia() . "' data-toggle='modal' data-target='#modalRelacionActoresEntidad' >" . $currentRelacionActoresEntidad -> getAreaInfluencia() -> getNombre() . "</a></td>";
						echo "<td><a href='modalSector.php?idSector=" . $currentRelacionActoresEntidad -> getSector() -> getIdSector() . "' data-toggle='modal' data-target='#modalRelacionActoresEntidad' >" . $currentRelacionActoresEntidad -> getSector() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/relacionActoresEntidad/updateRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Relacion Actores Entidad' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidadByRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'><span class='fas fa-search-plus' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Tema Relacion Actores Entidad' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaRelacionActoresEntidad/insertTemaRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'><span class='fas fa-pen' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Tema Relacion Actores Entidad' ></span></a> ";
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
<div class="modal fade" id="modalRelacionActoresEntidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
