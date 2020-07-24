<?php
$processed=false;
$idReferencias = $_GET['idReferencias'];
$updateReferencias = new Referencias($idReferencias);
$updateReferencias -> select();
$titulo="";
if(isset($_POST['titulo'])){
	$titulo=$_POST['titulo'];
}
$editorial="";
if(isset($_POST['editorial'])){
	$editorial=$_POST['editorial'];
}
$Autores="";
if(isset($_POST['Autores'])){
	$Autores=$_POST['Autores'];
}
$link="";
if(isset($_POST['link'])){
	$link=$_POST['link'];
}
$entidades="";
if(isset($_POST['entidades'])){
	$entidades=$_POST['entidades'];
}
$ciudad="";
if(isset($_POST['ciudad'])){
	$ciudad=$_POST['ciudad'];
}
if(isset($_POST['update'])){
	$updateReferencias = new Referencias($idReferencias, $titulo, $editorial, $Autores, $link, $entidades, $ciudad);
	$updateReferencias -> update();
	$updateReferencias -> select();
	$objEntidades = new Entidades($entidades);
	$objEntidades -> select();
	$nameEntidades = $objEntidades -> getNombre() ;
	$objCiudad = new Ciudad($ciudad);
	$objCiudad -> select();
	$nameCiudad = $objCiudad -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Edit Referencias", "Titulo: " . $titulo . ";; Editorial: " . $editorial . ";; Autores: " . $Autores . ";; Link: " . $link . ";; Entidades: " . $nameEntidades . ";; Ciudad: " . $nameCiudad, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Referencia</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >La Referencia ha sido editada exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/referencias/updateReferencias.php") . "&idReferencias=" . $idReferencias ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Titulo*</label>
							<input type="text" class="form-control" name="titulo" value="<?php echo $updateReferencias -> getTitulo() ?>" required />
						</div>
						<div class="form-group">
							<label>Editorial</label>
							<input type="text" class="form-control" name="editorial" value="<?php echo $updateReferencias -> getEditorial() ?>"/>
						</div>
						<div class="form-group">
							<label>Autores</label>
							<input type="text" class="form-control" name="Autores" value="<?php echo $updateReferencias -> getAutores() ?>"/>
						</div>
						<div class="form-group">
							<label>Link</label>
							<input type="text" class="form-control" name="link" value="<?php echo $updateReferencias -> getLink() ?>"/>
						</div>
					<div class="form-group">
						<label>Entidades*</label>
						<select class="form-control" name="entidades">
							<?php
							$objEntidades = new Entidades();
							$entidadess = $objEntidades -> selectAllOrder("nombre", "asc");
							foreach($entidadess as $currentEntidades){
								echo "<option value='" . $currentEntidades -> getIdEntidades() . "'";
								if($currentEntidades -> getIdEntidades() == $updateReferencias -> getEntidades() -> getIdEntidades()){
									echo " selected";
								}
								echo ">" . $currentEntidades -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Ciudad*</label>
						<select class="form-control" name="ciudad">
							<?php
							$objCiudad = new Ciudad();
							$ciudads = $objCiudad -> selectAllOrder("nombre", "asc");
							foreach($ciudads as $currentCiudad){
								echo "<option value='" . $currentCiudad -> getIdCiudad() . "'";
								if($currentCiudad -> getIdCiudad() == $updateReferencias -> getCiudad() -> getIdCiudad()){
									echo " selected";
								}
								echo ">" . $currentCiudad -> getNombre() . "</option>";
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
