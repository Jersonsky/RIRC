<?php
$processed=false;
$idCiudad = $_GET['idCiudad'];
$updateCiudad = new Ciudad($idCiudad);
$updateCiudad -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$pais="";
if(isset($_POST['pais'])){
	$pais=$_POST['pais'];
}
if(isset($_POST['update'])){
	$updateCiudad = new Ciudad($idCiudad, $nombre, $pais);
	$updateCiudad -> update();
	$updateCiudad -> select();
	$objPais = new Pais($pais);
	$objPais -> select();
	$namePais = $objPais -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Edit Ciudad", "Nombre: " . $nombre . ";; Pais: " . $namePais, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Ciudad</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >La Ciudad se ha editado exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/ciudad/updateCiudad.php") . "&idCiudad=" . $idCiudad ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateCiudad -> getNombre() ?>" required />
						</div>
					<div class="form-group">
						<label>Pais*</label>
						<select class="form-control" name="pais">
							<?php
							$objPais = new Pais();
							$paiss = $objPais -> selectAllOrder("nombre", "asc");
							foreach($paiss as $currentPais){
								echo "<option value='" . $currentPais -> getIdPais() . "'";
								if($currentPais -> getIdPais() == $updateCiudad -> getPais() -> getIdPais()){
									echo " selected";
								}
								echo ">" . $currentPais -> getNombre() . "</option>";
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
