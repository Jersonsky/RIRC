<?php
$processed=false;
$idTemaNormatividad = $_GET['idTemaNormatividad'];
$updateTemaNormatividad = new TemaNormatividad($idTemaNormatividad);
$updateTemaNormatividad -> select();
$desripcion="";
if(isset($_POST['desripcion'])){
	$desripcion=$_POST['desripcion'];
}
$normatividad="";
if(isset($_POST['normatividad'])){
	$normatividad=$_POST['normatividad'];
}
$tema="";
if(isset($_POST['tema'])){
	$tema=$_POST['tema'];
}
if(isset($_POST['update'])){
	$updateTemaNormatividad = new TemaNormatividad($idTemaNormatividad, $desripcion, $normatividad, $tema);
	$updateTemaNormatividad -> update();
	$updateTemaNormatividad -> select();
	$objNormatividad = new Normatividad($normatividad);
	$objNormatividad -> select();
	$nameNormatividad = $objNormatividad -> getNumero() . " " . $objNormatividad -> getAnio() ;
	$objTema = new Tema($tema);
	$objTema -> select();
	$nameTema = $objTema -> getDescripcion() ;
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
		$logAdministrator = new LogAdministrator("","Edit Tema Normatividad", "Desripcion: " . $desripcion . ";; Normatividad: " . $nameNormatividad . ";; Tema: " . $nameTema, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Edit TemaNormatividad</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/temaNormatividad/updateTemaNormatividad.php") . "&idTemaNormatividad=" . $idTemaNormatividad ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Desripcion*</label>
							<input type="text" class="form-control" name="desripcion" value="<?php echo $updateTemaNormatividad -> getDesripcion() ?>" required />
						</div>
					<div class="form-group">
						<label>Normatividad*</label>
						<select class="form-control" name="normatividad">
							<?php
							$objNormatividad = new Normatividad();
							$normatividads = $objNormatividad -> selectAllOrder("numero", "asc");
							foreach($normatividads as $currentNormatividad){
								echo "<option value='" . $currentNormatividad -> getIdNormatividad() . "'";
								if($currentNormatividad -> getIdNormatividad() == $updateTemaNormatividad -> getNormatividad() -> getIdNormatividad()){
									echo " selected";
								}
								echo ">" . $currentNormatividad -> getNumero() . " " . $currentNormatividad -> getAnio() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Tema*</label>
						<select class="form-control" name="tema">
							<?php
							$objTema = new Tema();
							$temas = $objTema -> selectAllOrder("descripcion", "asc");
							foreach($temas as $currentTema){
								echo "<option value='" . $currentTema -> getIdTema() . "'";
								if($currentTema -> getIdTema() == $updateTemaNormatividad -> getTema() -> getIdTema()){
									echo " selected";
								}
								echo ">" . $currentTema -> getDescripcion() . "</option>";
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
