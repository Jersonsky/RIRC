<?php
$processed=false;
$idNormatividad = $_GET['idNormatividad'];
$updateNormatividad = new Normatividad($idNormatividad);
$updateNormatividad -> select();
$numero="";
if(isset($_POST['numero'])){
	$numero=$_POST['numero'];
}
$anio="";
if(isset($_POST['anio'])){
	$anio=$_POST['anio'];
}
$objetivo="";
if(isset($_POST['objetivo'])){
	$objetivo=$_POST['objetivo'];
}
$documentoJuridico="";
if(isset($_POST['documentoJuridico'])){
	$documentoJuridico=$_POST['documentoJuridico'];
}
$entidades="";
if(isset($_POST['entidades'])){
	$entidades=$_POST['entidades'];
}
$sector="";
if(isset($_POST['sector'])){
	$sector=$_POST['sector'];
}
$aplicabilidad="";
if(isset($_POST['aplicabilidad'])){
	$aplicabilidad=$_POST['aplicabilidad'];
}
if(isset($_POST['update'])){
	$updateNormatividad = new Normatividad($idNormatividad, $numero, $anio, $objetivo, $documentoJuridico, $entidades, $sector, $aplicabilidad);
	$updateNormatividad -> update();
	$updateNormatividad -> select();
	$objDocumentoJuridico = new DocumentoJuridico($documentoJuridico);
	$objDocumentoJuridico -> select();
	$nameDocumentoJuridico = $objDocumentoJuridico -> getNombre() ;
	$objEntidades = new Entidades($entidades);
	$objEntidades -> select();
	$nameEntidades = $objEntidades -> getNombre() ;
	$objSector = new Sector($sector);
	$objSector -> select();
	$nameSector = $objSector -> getNombre() ;
	$objAplicabilidad = new Aplicabilidad($aplicabilidad);
	$objAplicabilidad -> select();
	$nameAplicabilidad = $objAplicabilidad -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Edit Normatividad", "Numero: " . $numero . ";; Anio: " . $anio . ";; Objetivo: " . $objetivo . ";; Documento Juridico: " . $nameDocumentoJuridico . ";; Entidades: " . $nameEntidades . ";; Sector: " . $nameSector . ";; Aplicabilidad: " . $nameAplicabilidad, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Normatividad</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >La Normatividad ha sido editada exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/normatividad/updateNormatividad.php") . "&idNormatividad=" . $idNormatividad ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Numero*</label>
							<input type="text" class="form-control" name="numero" value="<?php echo $updateNormatividad -> getNumero() ?>" required />
						</div>
						<div class="form-group">
							<label>Anio*</label>
							<input type="text" class="form-control" name="anio" value="<?php echo $updateNormatividad -> getAnio() ?>" required />
						</div>
						<div class="form-group">
							<label>Objetivo*</label>
							<textarea id="objetivo" name="objetivo" ><?php echo $updateNormatividad -> getObjetivo() ?></textarea>
							<script>
								$('#objetivo').summernote({
									tabsize: 2,
									height: 100
								});
							</script>
						</div>
					<div class="form-group">
						<label>Documento Juridico*</label>
						<select class="form-control" name="documentoJuridico">
							<?php
							$objDocumentoJuridico = new DocumentoJuridico();
							$documentoJuridicos = $objDocumentoJuridico -> selectAllOrder("nombre", "asc");
							foreach($documentoJuridicos as $currentDocumentoJuridico){
								echo "<option value='" . $currentDocumentoJuridico -> getIdDocumentoJuridico() . "'";
								if($currentDocumentoJuridico -> getIdDocumentoJuridico() == $updateNormatividad -> getDocumentoJuridico() -> getIdDocumentoJuridico()){
									echo " selected";
								}
								echo ">" . $currentDocumentoJuridico -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Entidades*</label>
						<select class="form-control" name="entidades">
							<?php
							$objEntidades = new Entidades();
							$entidadess = $objEntidades -> selectAllOrder("nombre", "asc");
							foreach($entidadess as $currentEntidades){
								echo "<option value='" . $currentEntidades -> getIdEntidades() . "'";
								if($currentEntidades -> getIdEntidades() == $updateNormatividad -> getEntidades() -> getIdEntidades()){
									echo " selected";
								}
								echo ">" . $currentEntidades -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Sector*</label>
						<select class="form-control" name="sector">
							<?php
							$objSector = new Sector();
							$sectors = $objSector -> selectAllOrder("nombre", "asc");
							foreach($sectors as $currentSector){
								echo "<option value='" . $currentSector -> getIdSector() . "'";
								if($currentSector -> getIdSector() == $updateNormatividad -> getSector() -> getIdSector()){
									echo " selected";
								}
								echo ">" . $currentSector -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Aplicabilidad*</label>
						<select class="form-control" name="aplicabilidad">
							<?php
							$objAplicabilidad = new Aplicabilidad();
							$aplicabilidads = $objAplicabilidad -> selectAllOrder("nombre", "asc");
							foreach($aplicabilidads as $currentAplicabilidad){
								echo "<option value='" . $currentAplicabilidad -> getIdAplicabilidad() . "'";
								if($currentAplicabilidad -> getIdAplicabilidad() == $updateNormatividad -> getAplicabilidad() -> getIdAplicabilidad()){
									echo " selected";
								}
								echo ">" . $currentAplicabilidad -> getNombre() . "</option>";
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
