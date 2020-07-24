<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$archivo = new Archivo($_GET['idArchivo']); 
$archivo -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteVisita = new Visita($_GET['idVisita']);
	$deleteVisita -> select();
	if($deleteVisita -> delete()){
		$nameArchivo = $deleteVisita -> getArchivo() -> getNombre();
		$nameVisitante = $deleteVisita -> getVisitante() -> getNombre();
		$user_ip = getenv('REMOTE_ADDR');
		$agent = $_SERVER["HTTP_USER_AGENT"];
		$browser = "-";
		if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
			$browser = "Internet Explorer";
		} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Chrome";
		} else if (preg_match('/Edge\/\d+/', $agent) ) {
			$browser = "Edge";
		} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Firefox";
		} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Opera";
		} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Safari";
		}
		if($_SESSION['entity'] == 'Administrator'){
			$logAdministrator = new LogAdministrator("","Delete Visita", "Fecha: " . $deleteVisita -> getFecha() . ";; Archivo: " . $nameArchivo . ";; Visitante: " . $nameVisitante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"> Visitas del Archivo: <em><?php echo $archivo -> getNombre() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >La visita ha sido eliminada correctamente.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >La visita no ha podido ser eliminada.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Fecha 
						<?php if($order=="fecha" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/visita/selectAllVisitaByArchivo.php") ?>&idArchivo=<?php echo $_GET['idArchivo'] ?>&order=fecha&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="fecha" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/visita/selectAllVisitaByArchivo.php") ?>&idArchivo=<?php echo $_GET['idArchivo'] ?>&order=fecha&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Archivo</th>
						<th>Visitante</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$visita = new Visita("", "", $_GET['idArchivo'], "");
					if($order!="" && $dir!="") {
						$visitas = $visita -> selectAllByArchivoOrder($order, $dir);
					} else {
						$visitas = $visita -> selectAllByArchivo();
					}
					$counter = 1;
					foreach ($visitas as $currentVisita) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentVisita -> getFecha() . "</td>";
						echo "<td><a href='modalArchivo.php?idArchivo=" . $currentVisita -> getArchivo() -> getIdArchivo() . "' data-toggle='modal' data-target='#modalVisita' >" . $currentVisita -> getArchivo() -> getNombre() . "</a></td>";
						echo "<td><a href='modalVisitante.php?idVisitante=" . $currentVisita -> getVisitante() -> getIdVisitante() . "' data-toggle='modal' data-target='#modalVisita' >" . $currentVisita -> getVisitante() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						/* if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/visita/updateVisita.php") . "&idVisita=" . $currentVisita -> getIdVisita() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Visita' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/visita/selectAllVisitaByArchivo.php") . "&idArchivo=" . $_GET['idArchivo'] . "&idVisita=" . $currentVisita -> getIdVisita() . "&action=delete' onclick='return confirm(\"Confirm to delete Visita: " . $currentVisita -> getFecha() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Visita' ></span></a> ";
						} */
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
<div class="modal fade" id="modalVisita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
