<?php
$processed=false;
$idRelacionActoresEntidad = $_GET['idRelacionActoresEntidad'];
$updateRelacionActoresEntidad = new RelacionActoresEntidad($idRelacionActoresEntidad);
$updateRelacionActoresEntidad -> select();
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
$dependenciaContacto="";
if(isset($_POST['dependenciaContacto'])){
	$dependenciaContacto=$_POST['dependenciaContacto'];
}
$naturaleza="";
if(isset($_POST['naturaleza'])){
	$naturaleza=$_POST['naturaleza'];
}
$areaInfluencia="";
if(isset($_POST['areaInfluencia'])){
	$areaInfluencia=$_POST['areaInfluencia'];
}
$sector="";
if(isset($_POST['sector'])){
	$sector=$_POST['sector'];
}
if(isset($_POST['update'])){
	$updateRelacionActoresEntidad = new RelacionActoresEntidad($idRelacionActoresEntidad, $siglas, $telefono, $pagina_Web, $correo, $descripcion, $entidades, $dependenciaContacto, $naturaleza, $areaInfluencia, $sector);
	$updateRelacionActoresEntidad -> update();
	$updateRelacionActoresEntidad -> select();
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
		$logAdministrator = new LogAdministrator("","Edit Relacion Actores Entidad", "Siglas: " . $siglas . ";; Telefono: " . $telefono . ";; Pagina_ Web: " . $pagina_Web . ";; Correo: " . $correo . ";; Descripcion: " . $descripcion . ";; Entidades: " . $nameEntidades . ";; Dependencia Contacto: " . $nameDependenciaContacto . ";; Naturaleza: " . $nameNaturaleza . ";; Area Influencia: " . $nameAreaInfluencia . ";; Sector: " . $nameSector, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Relacion Actores/Entidad</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >La Relacion ha sido editada exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/updateRelacionActoresEntidad.php") . "&idRelacionActoresEntidad=" . $idRelacionActoresEntidad ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Siglas*</label>
							<input type="text" class="form-control" name="siglas" value="<?php echo $updateRelacionActoresEntidad -> getSiglas() ?>" required />
						</div>
						<div class="form-group">
							<label>Telefono*</label>
							<input type="text" class="form-control" name="telefono" value="<?php echo $updateRelacionActoresEntidad -> getTelefono() ?>" required />
						</div>
						<div class="form-group">
							<label>Pagina_ Web*</label>
							<input type="text" class="form-control" name="pagina_Web" value="<?php echo $updateRelacionActoresEntidad -> getPagina_Web() ?>" required />
						</div>
						<div class="form-group">
							<label>Correo*</label>
							<input type="text" class="form-control" name="correo" value="<?php echo $updateRelacionActoresEntidad -> getCorreo() ?>" required />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<textarea id="descripcion" name="descripcion" ><?php echo $updateRelacionActoresEntidad -> getDescripcion() ?></textarea>
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
								if($currentEntidades -> getIdEntidades() == $updateRelacionActoresEntidad -> getEntidades() -> getIdEntidades()){
									echo " selected";
								}
								echo ">" . $currentEntidades -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Dependencia Contacto*</label>
						<select class="form-control" name="dependenciaContacto">
							<?php
							$objDependenciaContacto = new DependenciaContacto();
							$dependenciaContactos = $objDependenciaContacto -> selectAllOrder("nombre", "asc");
							foreach($dependenciaContactos as $currentDependenciaContacto){
								echo "<option value='" . $currentDependenciaContacto -> getIdDependenciaContacto() . "'";
								if($currentDependenciaContacto -> getIdDependenciaContacto() == $updateRelacionActoresEntidad -> getDependenciaContacto() -> getIdDependenciaContacto()){
									echo " selected";
								}
								echo ">" . $currentDependenciaContacto -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Naturaleza*</label>
						<select class="form-control" name="naturaleza">
							<?php
							$objNaturaleza = new Naturaleza();
							$naturalezas = $objNaturaleza -> selectAllOrder("nombre", "asc");
							foreach($naturalezas as $currentNaturaleza){
								echo "<option value='" . $currentNaturaleza -> getIdNaturaleza() . "'";
								if($currentNaturaleza -> getIdNaturaleza() == $updateRelacionActoresEntidad -> getNaturaleza() -> getIdNaturaleza()){
									echo " selected";
								}
								echo ">" . $currentNaturaleza -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Area Influencia*</label>
						<select class="form-control" name="areaInfluencia">
							<?php
							$objAreaInfluencia = new AreaInfluencia();
							$areaInfluencias = $objAreaInfluencia -> selectAllOrder("nombre", "asc");
							foreach($areaInfluencias as $currentAreaInfluencia){
								echo "<option value='" . $currentAreaInfluencia -> getIdAreaInfluencia() . "'";
								if($currentAreaInfluencia -> getIdAreaInfluencia() == $updateRelacionActoresEntidad -> getAreaInfluencia() -> getIdAreaInfluencia()){
									echo " selected";
								}
								echo ">" . $currentAreaInfluencia -> getNombre() . "</option>";
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
								if($currentSector -> getIdSector() == $updateRelacionActoresEntidad -> getSector() -> getIdSector()){
									echo " selected";
								}
								echo ">" . $currentSector -> getNombre() . "</option>";
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
