<?php
$processed=false;
$idSubcapitulo = $_GET['idSubcapitulo'];
$updateSubcapitulo = new Subcapitulo($idSubcapitulo);
$updateSubcapitulo -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$capitulo="";
if(isset($_POST['capitulo'])){
	$capitulo=$_POST['capitulo'];
}
if(isset($_POST['update'])){
	$updateSubcapitulo = new Subcapitulo($idSubcapitulo, $nombre, $capitulo);
	$updateSubcapitulo -> update();
	$updateSubcapitulo -> select();
	$objCapitulo = new Capitulo($capitulo);
	$objCapitulo -> select();
	$nameCapitulo = $objCapitulo -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Editar Subcapitulo", "Nombre: " . $nombre . ";; Capitulo: " . $nameCapitulo, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Editar Subcapitulo</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >El Subcapitulo ha sido editado exitosamente.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/subcapitulo/updateSubcapitulo.php") . "&idSubcapitulo=" . $idSubcapitulo ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateSubcapitulo -> getNombre() ?>" required />
						</div>
					<div class="form-group">
						<label>Capitulo*</label>
						<select class="form-control" name="capitulo">
							<?php
							$objCapitulo = new Capitulo();
							$capitulos = $objCapitulo -> selectAllOrder("nombre", "asc");
							foreach($capitulos as $currentCapitulo){
								echo "<option value='" . $currentCapitulo -> getIdCapitulo() . "'";
								if($currentCapitulo -> getIdCapitulo() == $updateSubcapitulo -> getCapitulo() -> getIdCapitulo()){
									echo " selected";
								}
								echo ">" . $currentCapitulo -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
