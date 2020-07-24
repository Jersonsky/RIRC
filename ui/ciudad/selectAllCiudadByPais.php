<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$pais = new Pais($_GET['idPais']); 
$pais -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteCiudad = new Ciudad($_GET['idCiudad']);
	$deleteCiudad -> select();
	if($deleteCiudad -> delete()){
		$namePais = $deleteCiudad -> getPais() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Delete Ciudad", "Nombre: " . $deleteCiudad -> getNombre() . ";; Pais: " . $namePais, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get All Ciudad of Pais: <em><?php echo $pais -> getNombre() ?></em></h4>
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
						<th nowrap>Nombre 
						<?php if($order=="nombre" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Ascending' href='index.php?pid=<?php echo base64_encode("ui/ciudad/selectAllCiudadByPais.php") ?>&idPais=<?php echo $_GET['idPais'] ?>&order=nombre&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="nombre" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Sort Descending' href='index.php?pid=<?php echo base64_encode("ui/ciudad/selectAllCiudadByPais.php") ?>&idPais=<?php echo $_GET['idPais'] ?>&order=nombre&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Pais</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$ciudad = new Ciudad("", "", $_GET['idPais']);
					if($order!="" && $dir!="") {
						$ciudads = $ciudad -> selectAllByPaisOrder($order, $dir);
					} else {
						$ciudads = $ciudad -> selectAllByPais();
					}
					$counter = 1;
					foreach ($ciudads as $currentCiudad) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCiudad -> getNombre() . "</td>";
						echo "<td><a href='modalPais.php?idPais=" . $currentCiudad -> getPais() -> getIdPais() . "' data-toggle='modal' data-target='#modalCiudad' >" . $currentCiudad -> getPais() -> getNombre() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/ciudad/updateCiudad.php") . "&idCiudad=" . $currentCiudad -> getIdCiudad() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Ciudad' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/ciudad/selectAllCiudadByPais.php") . "&idPais=" . $_GET['idPais'] . "&idCiudad=" . $currentCiudad -> getIdCiudad() . "&action=delete' onclick='return confirm(\"Confirm to delete Ciudad: " . $currentCiudad -> getNombre() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Ciudad' ></span></a> ";
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
<div class="modal fade" id="modalCiudad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
