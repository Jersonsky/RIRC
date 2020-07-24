<?php
$processed=false;
$descripcion="";
if(isset($_POST['descripcion'])){
	$descripcion=$_POST['descripcion'];
}
$tema="";
if(isset($_POST['tema'])){
	$tema=$_POST['tema'];
}
if(isset($_GET['idTema'])){
	$tema=$_GET['idTema'];
}
$referencias="";
if(isset($_POST['referencias'])){
	$referencias=$_POST['referencias'];
}
if(isset($_GET['idReferencias'])){
	$referencias=$_GET['idReferencias'];
}
if(isset($_POST['insert'])){
	$newTemaReferencias = new TemaReferencias("", $descripcion, $tema, $referencias);
	$newTemaReferencias -> insert();
	$objTema = new Tema($tema);
	$objTema -> select();
	$nameTema = $objTema -> getDescripcion() ;
	$objReferencias = new Referencias($referencias);
	$objReferencias -> select();
	$nameReferencias = $objReferencias -> getTitulo() . " " . $objReferencias -> getEditorial() . " " . $objReferencias -> getAutores() . " " . $objReferencias -> getLink() ;
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
		$logAdministrator = new LogAdministrator("","Create Tema Referencias", "Descripcion: " . $descripcion . ";; Tema: " . $nameTema . ";; Referencias: " . $nameReferencias, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Tema Referencias</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/temaReferencias/insertTemaReferencias.php") ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Descripcion*</label>
							<input type="text" class="form-control" name="descripcion" value="<?php echo $descripcion ?>" required />
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
						<label>Referencias*</label>
						<select class="form-control" name="referencias">
							<?php
							$objReferencias = new Referencias();
							$referenciass = $objReferencias -> selectAllOrder("titulo", "asc");
							foreach($referenciass as $currentReferencias){
								echo "<option value='" . $currentReferencias -> getIdReferencias() . "'";
								if($currentReferencias -> getIdReferencias() == $referencias){
									echo " selected";
								}
								echo ">" . $currentReferencias -> getTitulo() . " " . $currentReferencias -> getEditorial() . " " . $currentReferencias -> getAutores() . " " . $currentReferencias -> getLink() . "</option>";
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
