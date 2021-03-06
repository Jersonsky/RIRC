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
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteTemaNormatividad = new TemaNormatividad($_GET['idTemaNormatividad']);
	$deleteTemaNormatividad -> select();
	if($deleteTemaNormatividad -> delete()){
		$nameNormatividad = $deleteTemaNormatividad -> getNormatividad() -> getNumero() . " " . $deleteTemaNormatividad -> getNormatividad() -> getAnio();
		$nameTema = $deleteTemaNormatividad -> getTema() -> getDescripcion();
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
			$logAdministrator = new LogAdministrator("","Delete Tema Normatividad", "Desripcion: " . $deleteTemaNormatividad -> getDesripcion() . ";; Normatividad: " . $nameNormatividad . ";; Tema: " . $nameTema, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get All Tema Normatividad of Tema: <em><?php echo $tema -> getDescripcion() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
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
						<th nowrap>Desripcion 
						<?php if($order=="desripcion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=desripcion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="desripcion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByTema.php") ?>&idTema=<?php echo $_GET['idTema'] ?>&order=desripcion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Normatividad</th>
						<th>Tema</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$temaNormatividad = new TemaNormatividad("", "", "", $_GET['idTema']);
					if($order!="" && $dir!="") {
						$temaNormatividads = $temaNormatividad -> selectAllByTemaOrder($order, $dir);
					} else {
						$temaNormatividads = $temaNormatividad -> selectAllByTema();
					}
					$counter = 1;
					foreach ($temaNormatividads as $currentTemaNormatividad) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentTemaNormatividad -> getDesripcion() . "</td>";
						echo "<td><a href='modalNormatividad.php?idNormatividad=" . $currentTemaNormatividad -> getNormatividad() -> getIdNormatividad() . "' data-toggle='modal' data-target='#modalTemaNormatividad' >" . $currentTemaNormatividad -> getNormatividad() -> getNumero() . " " . $currentTemaNormatividad -> getNormatividad() -> getAnio() . "</a></td>";
						echo "<td><a href='modalTema.php?idTema=" . $currentTemaNormatividad -> getTema() -> getIdTema() . "' data-toggle='modal' data-target='#modalTemaNormatividad' >" . $currentTemaNormatividad -> getTema() -> getDescripcion() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/updateTemaNormatividad.php") . "&idTemaNormatividad=" . $currentTemaNormatividad -> getIdTemaNormatividad() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Tema Normatividad' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/temaNormatividad/selectAllTemaNormatividadByTema.php") . "&idTema=" . $_GET['idTema'] . "&idTemaNormatividad=" . $currentTemaNormatividad -> getIdTemaNormatividad() . "&action=delete' onclick='return confirm(\"Confirm to delete Tema Normatividad: " . $currentTemaNormatividad -> getDesripcion() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Tema Normatividad' ></span></a> ";
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
<div class="modal fade" id="modalTemaNormatividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
