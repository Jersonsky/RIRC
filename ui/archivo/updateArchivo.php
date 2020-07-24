<?php
$processed=false;
$idArchivo = $_GET['idArchivo'];
$updateArchivo = new Archivo($idArchivo);
$updateArchivo -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
$url="";
if(isset($_POST['url'])){
	$url=$_POST['url'];
}
$fechapublicacion=date("d/m/Y");
if(isset($_POST['fechapublicacion'])){
	$fechapublicacion=$_POST['fechapublicacion'];
}
$fechatemporalidad="";
if(isset($_POST['fechatemporalidad'])){
	$fechatemporalidad=$_POST['fechatemporalidad'];
}
$fuente="";
if(isset($_POST['fuente'])){
	$fuente=$_POST['fuente'];
}
$subcapitulo="";
if(isset($_POST['subcapitulo'])){
	$subcapitulo=$_POST['subcapitulo'];
}
$tema="";
if(isset($_POST['tema'])){
	$tema=$_POST['tema'];
}
$seccion="";
if(isset($_POST['seccion'])){
	$seccion=$_POST['seccion'];
}
$state="";
if(isset($_POST['state'])){
    $state=$_POST['state'];
}
if(isset($_POST['update'])){
	$updateArchivo = new Archivo($idArchivo, $nombre, $descripcion, $url, $fechapublicacion, $fechatemporalidad, $fuente, $subcapitulo, $tema, $seccion,$state);
	$updateArchivo -> update();
	$updateArchivo -> select();
	$objSubcapitulo = new Subcapitulo($subcapitulo);
	$objSubcapitulo -> select();
	$nameSubcapitulo = $objSubcapitulo -> getNombre() ;
	$objTema = new Tema($tema);
	$objTema -> select();
	$nameTema = $objTema -> getDescripcion() ;
	$objSeccion = new Seccion($seccion);
	$objSeccion -> select();
	$nameSeccion = $objSeccion -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Editar Archivo", "Nombre: " . $nombre . ";; Descripcion: " . $descripcion . ";; Url: " . $url . ";; Fechapublicacion: " . $fechapublicacion . ";; Fechatemporalidad: " . $fechatemporalidad . ";; Fuente: " . $fuente . ";; Subcapitulo: " . $nameSubcapitulo . ";; Tema: " . $nameTema . ";; Seccion: " . $nameSeccion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Archivo</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >El Archivo ha sido Editado correctamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/archivo/updateArchivo.php") . "&idArchivo=" . $idArchivo ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateArchivo -> getNombre() ?>" required />
						</div>
						<div class="form-group">
							<label>Descripcion*</label>
							<textarea id="descripcion" name="descripcion" ><?php echo $updateArchivo -> getDescripcion() ?></textarea>
							<script>
								$('#descripcion').summernote({
									tabsize: 2,
									height: 100
								});
							</script>
						</div>
						<div class="form-group">
							<label>Archivo*</label>
							<input type="text" class="form-control" readonly="readonly" name="url" value="<?php echo $updateArchivo -> getUrl() ?>" required />
						</div>
						<div class="form-group">
							<label>Fecha de publicacion del archivo*</label>
							<input type="date" readonly="readonly" class="form-control" name="fechapublicacion" id="fechapublicacion" value="<?php echo $updateArchivo -> getFechapublicacion() ?>" autocomplete="off" />
						</div>
						<div class="form-group">
							<label>Año de la Investigación*</label>
							<input type="text" class="form-control" name="fechatemporalidad" value="<?php echo $updateArchivo -> getFechatemporalidad() ?>" required />
						</div>
						<div class="form-group">
							<label>Fuente*</label>
							<input type="text" class="form-control" name="fuente" value="<?php echo $updateArchivo -> getFuente() ?>" required />
						</div>
					<div class="form-group">
						<label>Subcapitulo*</label>
						<select class="form-control" name="subcapitulo">
							<?php
							$objSubcapitulo = new Subcapitulo();
							$subcapitulos = $objSubcapitulo -> selectAllOrder("nombre", "asc");
							foreach($subcapitulos as $currentSubcapitulo){
								echo "<option value='" . $currentSubcapitulo -> getIdSubcapitulo() . "'";
								if($currentSubcapitulo -> getIdSubcapitulo() == $updateArchivo -> getSubcapitulo() -> getIdSubcapitulo()){
									echo " selected";
								}
								echo ">" . $currentSubcapitulo -> getNombre() . "</option>";
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
								if($currentTema -> getIdTema() == $updateArchivo -> getTema() -> getIdTema()){
									echo " selected";
								}
								echo ">" . $currentTema -> getDescripcion() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Seccion*</label>
						<select class="form-control" name="seccion">
							<?php
							$objSeccion = new Seccion();
							$seccions = $objSeccion -> selectAllOrder("nombre", "asc");
							foreach($seccions as $currentSeccion){
								echo "<option value='" . $currentSeccion -> getIdSeccion() . "'";
								if($currentSeccion -> getIdSeccion() == $updateArchivo -> getSeccion() -> getIdSeccion()){
									echo " selected";
								}
								echo ">" . $currentSeccion -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
							<label>Estado*</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="state" value="0" <?php echo ($updateArchivo -> getEstado()==0)?"checked":"" ?>/>
							<label class="form-check-label">Habilitado</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="state" value="1" <?php echo ($updateArchivo -> getEstado()==1)?"checked":"" ?>/>
							<label class="form-check-label" >Deshabilitado</label>
						</div>
						</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
