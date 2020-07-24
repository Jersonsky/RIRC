<?php
$processed=false;
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
if(isset($_GET['idEntidades'])){
	$entidades=$_GET['idEntidades'];
}
$ciudad="";
if(isset($_POST['ciudad'])){
	$ciudad=$_POST['ciudad'];
}
if(isset($_GET['idCiudad'])){
	$ciudad=$_GET['idCiudad'];
}
if(isset($_POST['insert'])){ 
    $newReferencias = new Referencias("", $titulo, $editorial, $Autores, $link, $entidades, $ciudad);
    $newReferencias -> insert();
    $newReferencias -> traerId();
    $valoresLista=$_POST["lista"];
    
    for($x=0;$x<count($valoresLista);$x++){
        if($valoresLista[$x]!=null){
            $temasRef = new TemaReferencias("","",$valoresLista[$x],$newReferencias -> getIdReferencias());
            $temasRef -> insert();
            
        }
    }
    
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
		$logAdministrator = new LogAdministrator("","Crear Referencias", "Titulo: " . $titulo . ";; Editorial: " . $editorial . ";; Autores: " . $Autores . ";; Link: " . $link . ";; Entidades: " . $nameEntidades . ";; Ciudad: " . $nameCiudad, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	$processed=true;
}
?>
<div class="container p-5">
	<h4 class="card-header border-info bg-transparent card-title">Crear una Referencia</h4>
	<p><small class="text-info">Campos obligatorios (*)</small></p>
		<?php if($processed){ ?>
			<div class="alert alert-success" >La Referencia ha sido creada exitosamente.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php } ?>
			<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/referencias/insertReferencias.php") ?>" class="bootstrap-form needs-validation"   >
				<div class="row">
					<div class="col-md">
						<div class="form-group">
							<label>Titulo*</label>
							<input type="text" class="form-control" name="titulo" value="<?php echo $titulo ?>" required />
						</div>
						<div class="form-group">
							<label>Editorial</label>
							<input type="text" class="form-control" name="editorial" value="<?php echo $editorial ?>"/>
						</div>
						<div class="form-group">
							<label>Autores</label>
							<input type="text" class="form-control" name="Autores" value="<?php echo $Autores ?>"/>
						</div>
					
						<div class="form-group">
							<label>Link</label>
							<input type="text" class="form-control" name="link" value="<?php echo $link ?>"/>
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
						<label>Pais*</label>
						<select class="form-control" name="pais" id="filtro">
							<?php
							$objPais = new Pais();
							$paises = $objPais -> selectAllOrder("nombre", "asc");
							foreach($paises as $currentPais){
								echo "<option value='" . $currentPais -> getIdPais() . "'";
								echo ">" . $currentPais -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Ciudad*</label>
						<select class="form-control" name="ciudad" id="resultados1">
							
						</select>
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
<script type="text/javascript">
$(document).ready(function(){
	$("#filtro").on('click',function(){
		if($("#filtro").val()!=""){
			var valor = "indexAjax.php?pid=<?php echo base64_encode("ui/referencias/ciudadAjax.php" ); ?>&filtro="+$("#filtro").val();
			$("#resultados1").load(valor);
		}
	});
});
</script>
