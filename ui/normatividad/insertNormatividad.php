<?php
$processed=false;
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
if(isset($_GET['idDocumentoJuridico'])){
	$documentoJuridico=$_GET['idDocumentoJuridico'];
}
$entidades="";
if(isset($_POST['entidades'])){
	$entidades=$_POST['entidades'];
}
if(isset($_GET['idEntidades'])){
	$entidades=$_GET['idEntidades'];
}
$sector="";
if(isset($_POST['sector'])){
	$sector=$_POST['sector'];
}
if(isset($_GET['idSector'])){
	$sector=$_GET['idSector'];
}
$aplicabilidad="";
if(isset($_POST['aplicabilidad'])){
	$aplicabilidad=$_POST['aplicabilidad'];
}
if(isset($_GET['idAplicabilidad'])){
	$aplicabilidad=$_GET['idAplicabilidad'];
}
if(isset($_POST['insert'])){
	$newNormatividad = new Normatividad("", $numero, $anio, $objetivo, $documentoJuridico, $entidades, $sector, $aplicabilidad);
	$newNormatividad -> insert();
	$newNormatividad -> traerId();
	$valoresLista=$_POST["lista"];
	
	for($x=0;$x<count($valoresLista);$x++){
	    if($valoresLista[$x]!=null){
	        $temasNor = new TemaNormatividad("","",$newNormatividad -> getIdNormatividad(),$valoresLista[$x]);
	        $temasNor -> insert();
	        
	    }
	}
	
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
		$logAdministrator = new LogAdministrator("","Create Normatividad", "Numero: " . $numero . ";; Anio: " . $anio . ";; Objetivo: " . $objetivo . ";; Documento Juridico: " . $nameDocumentoJuridico . ";; Entidades: " . $nameEntidades . ";; Sector: " . $nameSector . ";; Aplicabilidad: " . $nameAplicabilidad, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	$processed=true;
}
?>
<div class="container p-5">
	<h4 class="card-header border-info bg-transparent card-title">Crear Normatividad</h4>
	<p><small class="text-info">Campos obligatorios (*)</small></p>
			<?php if($processed){ ?>
				<div class="alert alert-success" >La Normatividad ha sido creada exitosamente.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php } ?>
		<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/normatividad/insertNormatividad.php") ?>" class="bootstrap-form needs-validation"   >
			<div class="row">
				<div class="col-md">
						<div class="form-group">
							<label>Número*</label>
							<input type="text" class="form-control" name="numero" value="<?php echo $numero ?>" required />
						</div>
						<div class="form-group">
							<label>Año*</label>
							<input type="text" class="form-control" name="anio" value="<?php echo $anio ?>" required />
						</div>
						<div class="form-group">
							<label>Objetivo*</label>
							<textarea id="objetivo" name="objetivo" ><?php echo $objetivo ?></textarea>
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
								if($currentDocumentoJuridico -> getIdDocumentoJuridico() == $documentoJuridico){
									echo " selected";
								}
								echo ">" . $currentDocumentoJuridico -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra el Documento Juridico en la lista, ingreselo en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<label>Entidades*</label>
						<select class="form-control" name="entidades">
							<?php
							$objEntidades = new Entidades();
							$entidadess = $objEntidades -> selectAllOrder("nombre", "asc");
							foreach($entidadess as $currentEntidades){
								echo "<option value='" . $currentEntidades -> getIdEntidades() . "'";
								if($currentEntidades -> getIdEntidades() == $entidades){
									echo " selected";
								}
								echo ">" . $currentEntidades -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra la Entidad en la lista, ingresela en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<label>Sector*</label>
						<select class="form-control" name="sector">
							<?php
							$objSector = new Sector();
							$sectors = $objSector -> selectAllOrder("nombre", "asc");
							foreach($sectors as $currentSector){
								echo "<option value='" . $currentSector -> getIdSector() . "'";
								if($currentSector -> getIdSector() == $sector){
									echo " selected";
								}
								echo ">" . $currentSector -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra el Sector en la lista, ingreselo en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<label>Aplicabilidad*</label>
						<select class="form-control" name="aplicabilidad">
							<?php
							$objAplicabilidad = new Aplicabilidad();
							$aplicabilidads = $objAplicabilidad -> selectAllOrder("nombre", "asc");
							foreach($aplicabilidads as $currentAplicabilidad){
								echo "<option value='" . $currentAplicabilidad -> getIdAplicabilidad() . "'";
								if($currentAplicabilidad -> getIdAplicabilidad() == $aplicabilidad){
									echo " selected";
								}
								echo ">" . $currentAplicabilidad -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra la Aplicabilidad en la lista, ingresela en la opci&oacute;n crear del menu</p>
					</div>
					</div>
				<div class="col-md">
					<div  class="form-group">
						<label>Temas* <small class="text-info">(Selecionar uno o m&aacute;s)</small></label>
						
						<?php
							$objTema = new Tema();
							$temas = $objTema -> selectAll();
							foreach($temas as $currentTema){
							    echo "<div class='form-check'>";
							    echo "<input class='form-check-input' type='checkbox' name='lista[]' value='".$currentTema -> getIdTema()."' id='defaultCheck1' >";
							    echo "<label class='form-check-label' for='defaultCheck'>";
							    echo $currentTema -> getDescripcion();
							    echo "</label>";
							    echo "</div>";							    
							}
							?>
                          
                        
					</div>
				</div>
				</div>
				<hr>
				<button type="submit" class="btn btn-outline-info btn-block" name="insert">Crear</button>
			</form>
</div>
