<?php
$processed = false;
$error = 0;

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
$fechapublicacion= date('y-m-d h:i:s');
if(isset($_POST['fechapublicacion'])){
    $fechapublicacion= date('y-m-d h:i:s');
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
if(isset($_GET['idSubcapitulo'])){
    $subcapitulo=$_GET['idSubcapitulo'];
}
$tema="";
if(isset($_POST['tema'])){
    $tema=$_POST['tema'];
}
if(isset($_GET['idTema'])){
    $tema=$_GET['idTema'];
}
$seccion="";
if(isset($_POST['seccion'])){
    $seccion=$_POST['seccion'];
}

$state="";
if(isset($_POST['state'])){
    $state=$_POST['state'];
}


if(isset($_POST['insert'])){
    $localPath=$_FILES['url']['tmp_name'];
    $type=$_FILES['url']['type'];
    if($type!="application/pdf"){
        $error=1;
    } else {
                
        $objSubcapitulo = new Subcapitulo($subcapitulo);
        $objSubcapitulo -> select();
        $nameSubcapitulo = $objSubcapitulo -> getNombre() ;
        $objTema = new Tema($tema);
        $objTema -> select();
        $nameTema = $objTema -> getDescripcion() ;
        $objSeccion = new Seccion($seccion);
        $objSeccion -> select();
        $nameSeccion = $objSeccion -> getNombre() ;
        
        $serverPath = "Documents/" . time() . ".pdf";
        copy($localPath,$serverPath);
        
        $newArchivo = new Archivo("", $nombre, $descripcion,$serverPath , $fechapublicacion, $fechatemporalidad, $fuente, $subcapitulo, $tema, $seccion, $state,$_SESSION['id']);
		$newArchivo -> insert();
		

		
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
            $logAdministrator = new LogAdministrator("","Crear Archivo: ","Nombre: " . $nombre . ";; Descripcion: " . $descripcion . ";; Url: " . $url . ";; Fechapublicacion: " . $fechapublicacion . ";; Fechatemporalidad: " . $fechatemporalidad . ";; Fuente: " . $fuente . ";; Subcapitulo: " . $nameSubcapitulo . ";; Tema: " . $nameTema . ";; Seccion: " . $nameSeccion ,date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			
			$logAdministrator -> insert();
        }
        $processed = true;
    }
}
?>
<div class="container p-5">
	<h4 class="card-header border-info bg-transparent card-title">Crear Archivo</h4>
	<p><small class="text-info">Campos obligatorios (*)</small></p>
		<?php if($processed){ ?>
			<div class="alert alert-success" >El Archivos se ha subido satisfactoriamente.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>
		<form id="form" action="index.php?pid=<?php echo base64_encode("ui/archivo/insertArchivopdf.php") ?>" method="post" enctype="multipart/form-data"  class="bootstrap-form needs-validation">
			<div class="row">
				<div class="col-md">
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>" required />
						</div>
						<div class="form-group">
							<label>Descripción*</label>
							<textarea id="descripcion" name="descripcion" ><?php echo $descripcion ?></textarea>
							<script>
								$('#descripcion').summernote({
									tabsize: 2,
									height: 100
								});
							</script>
						</div>
						<div class="form-group">
							<label>Año de la Investigación*</label>
							<input type="text" class="form-control" name="fechatemporalidad" value="<?php echo $fechatemporalidad ?>" required />
						</div>
						<div class="form-group">
							<label>Fuente</label>
							<input type="text" class="form-control" name="fuente" value="<?php echo $fuente ?>"  />
						</div>
				</div>
				<div class="col-md">	
					<div class="form-group">
						<label>Subcapitulo*</label>
						<select class="form-control" name="subcapitulo">
							<?php
							$objSubcapitulo = new Subcapitulo();
							$subcapitulos = $objSubcapitulo -> selectAll();
							foreach($subcapitulos as $currentSubcapitulo){
								echo "<option value='" . $currentSubcapitulo -> getIdSubcapitulo() . "'";
								if($currentSubcapitulo -> getIdSubcapitulo() == $subcapitulo){
									echo " selected";
								}
								echo ">" . $currentSubcapitulo -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra el Subcapitulo en la lista, ingreselo en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<label>Tema*</label>
						<select class="form-control" name="tema">
							<?php
							$objTema = new Tema();
							$temas = $objTema -> selectAll();
							foreach($temas as $currentTema){
								echo "<option value='" . $currentTema -> getIdTema() . "'";
								if($currentTema -> getIdTema() == $tema){
									echo " selected";
								}
								echo ">" . $currentTema -> getDescripcion() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra el Tema en la lista, ingreselo en la opci&oacute;n crear del menu</p>
					</div>
					<div class="form-group">
						<?php if($processed){ ?>
							<div class="alert alert-success" >Archivo subido
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } else if($error == 1) { ?>
							<div class="alert alert-danger" >Error. Solo archivos de tipo PDF
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>
					</div>
					
					<div class="form-group">
						<label>Archivo*</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="url"  id="customFileLang" required="required" lang="es">
                            <label class="custom-file-label" for="customFileLang">Seleccione un archivo PDF</label>
                          </div>
                          <script>
							$(".custom-file-input").on("change", function() {
  							var fileName = $(this).val().split("\\").pop();
  							$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
							});
						</script>
					</div>

					<div class="form-group">
						<label>Seccion*</label>
						<select class="form-control" name="seccion">
							<?php 
							$objSeccion = new Seccion();
							$Secciones = $objSeccion -> selectAll();
							foreach($Secciones as $currentSeccion){
								echo "<option value='" . $currentSeccion -> getIdSeccion() . "'";
								if($currentSeccion -> getIdSeccion() == $seccion){
									echo " selected";
								}
								echo ">" . $currentSeccion -> getNombre() . "</option>";
							}
							?>
						</select>
						<p class="text-muted"><i class="fas fa-exclamation-circle"></i> Sino se encuentra la Secci&oacute;n en la lista, ingresela en la opci&oacute;n crear del men&uacute;</p>
					</div>
					<div class="form-group">
							<label>Estado*</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" name="state" value="1" checked />
							<label class="form-check-label">Habilitado</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="radio" class="form-check-input" name="state" value="0" />
							<label class="form-check-label" >Desabilitado</label>
						</div>
					</div>
				</div>
			</div>
		<hr>
		<button type="submit" class="btn btn-outline-info btn-block" name="insert">Subir Archivo</button>
	</form>
</div>
