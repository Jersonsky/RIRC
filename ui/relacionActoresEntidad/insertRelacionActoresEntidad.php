<?php
$processed=false;
$siglas="";
if(isset($_POST['siglas'])){
	$siglas=$_POST['siglas'];
}
$telefono="";
if(isset($_POST['telefono'])){
	$telefono=$_POST['telefono'];
}
$pagina_Web="";
if(isset($_POST['pagina_Web'])){
	$pagina_Web=$_POST['pagina_Web'];
}
$correo="";
if(isset($_POST['correo'])){
	$correo=$_POST['correo'];
}
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
$entidades="";
if(isset($_POST['entidades'])){
	$entidades=$_POST['entidades'];
}
if(isset($_GET['idEntidades'])){
	$entidades=$_GET['idEntidades'];
}
$dependenciaContacto="";
if(isset($_POST['dependenciaContacto'])){
	$dependenciaContacto=$_POST['dependenciaContacto'];
}
if(isset($_GET['idDependenciaContacto'])){
	$dependenciaContacto=$_GET['idDependenciaContacto'];
}
$naturaleza="";
if(isset($_POST['naturaleza'])){
	$naturaleza=$_POST['naturaleza'];
}
if(isset($_GET['idNaturaleza'])){
	$naturaleza=$_GET['idNaturaleza'];
}
$areaInfluencia="";
if(isset($_POST['areaInfluencia'])){
	$areaInfluencia=$_POST['areaInfluencia'];
}
if(isset($_GET['idAreaInfluencia'])){
	$areaInfluencia=$_GET['idAreaInfluencia'];
}
$sector="";
if(isset($_POST['sector'])){
	$sector=$_POST['sector'];
}
if(isset($_GET['idSector'])){
	$sector=$_GET['idSector'];
}
if(isset($_POST['insert'])){
	$newRelacionActoresEntidad = new RelacionActoresEntidad("", $siglas, $telefono, $pagina_Web, $correo, $descripcion, $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector);
	$newRelacionActoresEntidad -> insert();
	$newRelacionActoresEntidad -> traerId();
	$valoresLista=$_POST["lista"];
	
	for($x=0;$x<count($valoresLista);$x++){
	    if($valoresLista[$x]!=null){
	        $temasNor = new TemaRelacionActoresEntidad("","",$valoresLista[$x],$newRelacionActoresEntidad -> getIdRelacionActoresEntidad());
	        $temasNor -> insert();
	        
	    }
	}
	
	$objEntidades = new Entidades($entidades);
	$objEntidades -> select();
	$nameEntidades = $objEntidades -> getNombre() ;
	$objDependenciaContacto = new DependenciaContacto($dependenciaContacto);
	$objDependenciaContacto -> select();
	$nameDependenciaContacto = $objDependenciaContacto -> getNombre() ;
	$objNaturaleza = new Naturaleza($naturaleza);
	$objNaturaleza -> select();
	$nameNaturaleza = $objNaturaleza -> getNombre() ;
	$objAreaInfluencia = new AreaInfluencia($areaInfluencia);
	$objAreaInfluencia -> select();
	$nameAreaInfluencia = $objAreaInfluencia -> getNombre() ;
	$objSector = new Sector($sector);
	$objSector -> select();
	$nameSector = $objSector -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Create Relacion Actores Entidad", "Siglas: " . $siglas . ";; Telefono: " . $telefono . ";; Pagina_ Web: " . $pagina_Web . ";; Correo: " . $correo . ";; Descripcion: " . $descripcion . ";; Entidades: " . $nameEntidades . ";; Dependencia Contacto: " . $nameDependenciaContacto . ";; Naturaleza: " . $nameNaturaleza . ";; Area Influencia: " . $nameAreaInfluencia . ";; Sector: " . $nameSector, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	$processed=true;
}
?>
<div class="container p-5">
	<h4 class="card-header border-info bg-transparent card-title">Crear Relacion Actores/Entidad</h4>
	<p><small class="text-info">Campos obligatorios (*)</small></p>
		<?php if($processed){ ?>
			<div class="alert alert-success" >La Relacion ha sido creada exitosamente.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>
			<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/insertRelacionActoresEntidad.php") ?>" class="bootstrap-form needs-validation">
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Siglas*</label>
							<input type="text" class="form-control" name="siglas" value="<?php echo $siglas ?>" required />
							
						</div>
						<div class="form-group">
							<label>Telefono*</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $telefono ?>" required />
						</div>
						<div class="form-group">
							<label>Pagina_ Web*</label>
							<input type="text" class="form-control" name="pagina_Web" value="<?php echo $pagina_Web ?>" required />
						</div>
						<div class="form-group">
							<label>Correo*</label>
							<input type="text" class="form-control" name="correo" value="<?php echo $correo ?>" required />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<textarea id="descripcion" name="descripcion" ><?php echo $descripcion ?></textarea>
							<script>
								$('#descripcion').summernote({
									tabsize: 2,
									height: 100
								});
							</script>
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
						<label>Dependencia Contacto*</label>
						<select class="form-control" name="dependenciaContacto">
							<?php
							$objDependenciaContacto = new DependenciaContacto();
							$dependenciaContactos = $objDependenciaContacto -> selectAllOrder("nombre", "asc");
							foreach($dependenciaContactos as $currentDependenciaContacto){
								echo "<option value='" . $currentDependenciaContacto -> getIdDependenciaContacto() . "'";
								if($currentDependenciaContacto -> getIdDependenciaContacto() == $dependenciaContacto){
									echo " selected";
								}
								echo ">" . $currentDependenciaContacto -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra la dependencia o contacto en la lista, ingreselo en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<label>Naturaleza*</label>
						<select class="form-control" name="naturaleza">
							<?php
							$objNaturaleza = new Naturaleza();
							$naturalezas = $objNaturaleza -> selectAllOrder("nombre", "asc");
							foreach($naturalezas as $currentNaturaleza){
								echo "<option value='" . $currentNaturaleza -> getIdNaturaleza() . "'";
								if($currentNaturaleza -> getIdNaturaleza() == $naturaleza){
									echo " selected";
								}
								echo ">" . $currentNaturaleza -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra la Naturaleza en la lista, ingresela en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<label>Area Influencia*</label>
						<select class="form-control" name="areaInfluencia">
							<?php
							$objAreaInfluencia = new AreaInfluencia();
							$areaInfluencias = $objAreaInfluencia -> selectAllOrder("nombre", "asc");
							foreach($areaInfluencias as $currentAreaInfluencia){
								echo "<option value='" . $currentAreaInfluencia -> getIdAreaInfluencia() . "'";
								if($currentAreaInfluencia -> getIdAreaInfluencia() == $areaInfluencia){
									echo " selected";
								}
								echo ">" . $currentAreaInfluencia -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra el Area de Influencia en la lista, ingresela en la opci&oacute;n crear del menu</p>
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
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra el Sector en la lista, ingresela en la opci&oacute;n crear del menu</p>
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
