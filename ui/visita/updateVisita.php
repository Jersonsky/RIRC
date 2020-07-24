<?php
$processed=false;
$idVisita = $_GET['idVisita'];
$updateVisita = new Visita($idVisita);
$updateVisita -> select();
$fecha=date("d/m/Y");
if(isset($_POST['fecha'])){
	$fecha=$_POST['fecha'];
}
$archivo="";
if(isset($_POST['archivo'])){
	$archivo=$_POST['archivo'];
}
$visitante="";
if(isset($_POST['visitante'])){
	$visitante=$_POST['visitante'];
}
if(isset($_POST['update'])){
	$updateVisita = new Visita($idVisita, $fecha, $archivo, $visitante);
	$updateVisita -> update();
	$updateVisita -> select();
	$objArchivo = new Archivo($archivo);
	$objArchivo -> select();
	$nameArchivo = $objArchivo -> getNombre() ;
	$objVisitante = new Visitante($visitante);
	$objVisitante -> select();
	$nameVisitante = $objVisitante -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Edit Visita", "Fecha: " . $fecha . ";; Archivo: " . $nameArchivo . ";; Visitante: " . $nameVisitante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Edit Visita</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/visita/updateVisita.php") . "&idVisita=" . $idVisita ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Fecha*</label>
							<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $updateVisita -> getFecha() ?>" autocomplete="off" />
						</div>
					<div class="form-group">
						<label>Archivo*</label>
						<select class="form-control" name="archivo">
							<?php
							$objArchivo = new Archivo();
							$archivos = $objArchivo -> selectAllOrder("nombre", "asc");
							foreach($archivos as $currentArchivo){
								echo "<option value='" . $currentArchivo -> getIdArchivo() . "'";
								if($currentArchivo -> getIdArchivo() == $updateVisita -> getArchivo() -> getIdArchivo()){
									echo " selected";
								}
								echo ">" . $currentArchivo -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Visitante*</label>
						<select class="form-control" name="visitante">
							<?php
							$objVisitante = new Visitante();
							$visitantes = $objVisitante -> selectAllOrder("nombre", "asc");
							foreach($visitantes as $currentVisitante){
								echo "<option value='" . $currentVisitante -> getIdVisitante() . "'";
								if($currentVisitante -> getIdVisitante() == $updateVisita -> getVisitante() -> getIdVisitante()){
									echo " selected";
								}
								echo ">" . $currentVisitante -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
