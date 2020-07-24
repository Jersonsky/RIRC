<?php
$logInError=false;
$enabledError=false;
if(isset($_POST['logIn'])){
	if(isset($_POST['email']) && isset($_POST['password'])){
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
		$email=$_POST['email'];
		$password=$_POST['password'];
		$administrator = new Administrator();
		if($administrator -> logIn($email, $password)){
		    if($administrator -> getState()==1){
		        $_SESSION['id']=$administrator -> getIdAdministrator();
		        $_SESSION['entity']="Administrator";
				$logAdministrator = new LogAdministrator("", "Inicio de Sesión", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $administrator -> getIdAdministrator());
				//echo $logAdministrator -> getLogAdministradorDAO() -> insert(); 
		        $logAdministrator -> insert();
		        echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/sessionAdministrator.php") . "'</script>";
		    } else {
		        $enabledError=true;
		    }
		}
		$logInError=true;
	}
}
?>
<div align="center">
	<?php include("ui/header.php"); ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h4><strong>RIRC</strong></h4>
				</div>
				<div class="card-body">
					<p>RIRC es un sistema de información en el cual se almacenará la recopilación de datos por el semillero Barión en el convenio marco 064 de 2018 el cual se firmó entre la Region central (RAPE) y la uniersidad distrital Francisco José de Caldas</p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h4><strong>Iniciar Sesión</strong></h4>
				</div>
				<div class="card-body">
				<!-- action="index.php" -->
					<form id="form" method="post"  class="bootstrap-form needs-validation"  >
						<div class="form-group">
							<div class="input-group" >
								<input type="email" class="form-control" name="email" placeholder="Correo" autocomplete="off" required />
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Contraseña" required />
						</div>
						<?php if($enabledError){
							echo "<div class='alert alert-danger' >Usuario Deshabilitado</div>";
						}else if($logInError){
							echo "<div class='alert alert-danger' >Correo o contraseña incorrectos</div>";
						} ?>
						<div class="form-group">
							<a href="index.php?pid=<?php echo base64_encode("ui/recoverPassword.php") ?>">Recuperar Contraseña</a>
						</div>
						<div class="form-group">
							<button type="submit" class="btn" name="logIn">Iniciar Sesión</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
