<?php
$processed=false;
$desripcion="";
if(isset($_POST['desripcion'])){
	$desripcion=$_POST['desripcion'];
}
$tema="";
if(isset($_POST['tema'])){
	$tema=$_POST['tema'];
}
if(isset($_GET['idTema'])){
	$tema=$_GET['idTema'];
}
$relacionActoresEntidad="";
if(isset($_POST['relacionActoresEntidad'])){
	$relacionActoresEntidad=$_POST['relacionActoresEntidad'];
}
if(isset($_GET['idRelacionActoresEntidad'])){
	$relacionActoresEntidad=$_GET['idRelacionActoresEntidad'];
}
if(isset($_POST['insert'])){
	$newTemaRelacionActoresEntidad = new TemaRelacionActoresEntidad("", $desripcion, $tema, $relacionActoresEntidad);
	$newTemaRelacionActoresEntidad -> insert();
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
		$logAdministrator = new LogAdministrator("","Create Tema Relacion Actores Entidad", "Desripcion: " . $desripcion . ";; Tema: " . $nameTema . ";; Relacion Actores Entidad: " . $nameRelacionActoresEntidad, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Tema Relacion Actores Entidad</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/temaRelacionActoresEntidad/insertTemaRelacionActoresEntidad.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Desripcion*</label>
							<input type="text" class="form-control" name="desripcion" value="<?php echo $desripcion ?>" required />
						</div>
					<div class="form-group">
						<label>Tema*</label>
						<select class="form-control" name="tema">
							<?php
							$objTema = new Tema();
							$temas = $objTema -> selectAllOrder("descripcion", "asc");
							foreach($temas as $currentTema){
								echo "<option value='" . $currentTema -> getIdTema() . "'";
								if($currentTema -> getIdTema() == $tema){
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
								if($currentRelacionActoresEntidad -> getIdRelacionActoresEntidad() == $relacionActoresEntidad){
									echo " selected";
								}
								echo ">" . $currentRelacionActoresEntidad -> getSiglas() . " " . $currentRelacionActoresEntidad -> getTelefono() . " " . $currentRelacionActoresEntidad -> getCorreo() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="insert">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
