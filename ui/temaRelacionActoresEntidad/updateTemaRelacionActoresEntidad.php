<?php
$processed=false;
$idTemaRelacionActoresEntidad = $_GET['idTemaRelacionActoresEntidad'];
$updateTemaRelacionActoresEntidad = new TemaRelacionActoresEntidad($idTemaRelacionActoresEntidad);
$updateTemaRelacionActoresEntidad -> select();
$desripcion="";
if(isset($_POST['desripcion'])){
	$desripcion=$_POST['desripcion'];
}
$tema="";
if(isset($_POST['tema'])){
	$tema=$_POST['tema'];
}
$relacionActoresEntidad="";
if(isset($_POST['relacionActoresEntidad'])){
	$relacionActoresEntidad=$_POST['relacionActoresEntidad'];
}
if(isset($_POST['update'])){
	$updateTemaRelacionActoresEntidad = new TemaRelacionActoresEntidad($idTemaRelacionActoresEntidad, $desripcion, $tema, $relacionActoresEntidad);
	$updateTemaRelacionActoresEntidad -> update();
	$updateTemaRelacionActoresEntidad -> select();
	$objTema = new Tema($tema);
	$objTema -> select();
	$nameTema = $objTema -> getDescripcion() ;
	$objRelacionActoresEntidad = new RelacionActoresEntidad($relacionActoresEntidad);
	$objRelacionActoresEntidad -> select();
	$nameRelacionActoresEntidad = $objRelacionActoresEntidad -> getSiglas() . " " . $objRelacionActoresEntidad -> getTelefono() . " " . $objRelacionActoresEntidad -> getCorreo() ;
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
		$logAdministrator = new LogAdministrator("","Edit Tema Relacion Actores Entidad", "Desripcion: " . $desripcion . ";; Tema: " . $nameTema . ";; Relacion Actores Entidad: " . $nameRelacionActoresEntidad, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Edit TemaRelacionActoresEntidad</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/temaRelacionActoresEntidad/updateTemaRelacionActoresEntidad.php") . "&idTemaRelacionActoresEntidad=" . $idTemaRelacionActoresEntidad ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Desripcion*</label>
							<input type="text" class="form-control" name="desripcion" value="<?php echo $updateTemaRelacionActoresEntidad -> getDesripcion() ?>" required />
						</div>
					<div class="form-group">
						<label>Tema*</label>
						<select class="form-control" name="tema">
							<?php
							$objTema = new Tema();
							$temas = $objTema -> selectAllOrder("descripcion", "asc");
							foreach($temas as $currentTema){
								echo "<option value='" . $currentTema -> getIdTema() . "'";
								if($currentTema -> getIdTema() == $updateTemaRelacionActoresEntidad -> getTema() -> getIdTema()){
									echo " selected";
								}
								echo ">" . $currentTema -> getDescripcion() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Relacion Actores Entidad*</label>
						<select class="form-control" name="relacionActoresEntidad">
							<?php
							$objRelacionActoresEntidad = new RelacionActoresEntidad();
							$relacionActoresEntidads = $objRelacionActoresEntidad -> selectAllOrder("siglas", "asc");
							foreach($relacionActoresEntidads as $currentRelacionActoresEntidad){
								echo "<option value='" . $currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() . "'";
								if($currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() == $updateTemaRelacionActoresEntidad -> getRelacionActoresEntidad() -> getIdRelacionActoresEntidad()){
									echo " selected";
								}
								echo ">" . $currentRelacionActoresEntidad -> getSiglas() . " " . $currentRelacionActoresEntidad -> getTelefono() . " " . $currentRelacionActoresEntidad -> getCorreo() . "</option>";
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
