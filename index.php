<?php 
session_start();
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/Capitulo.php");
require("business/Subcapitulo.php");
require("business/Seccion.php");
require("business/Visitante.php");
require("business/Visita.php");
require("business/Archivo.php");
require("business/DocumentoJuridico.php");
require("business/Sector.php");
require("business/Entidades.php");
require("business/Ciudad.php");
require("business/Pais.php");
require("business/Naturaleza.php");
require("business/AreaInfluencia.php");
require("business/Aplicabilidad.php");
require("business/Normatividad.php");
require("business/Referencias.php");
require("business/DependenciaContacto.php");
require("business/RelacionActoresEntidad.php");
require("business/Tema.php");
require("business/TemaNormatividad.php");
require("business/TemaReferencias.php");
require("business/TemaRelacionActoresEntidad.php");
ini_set("display_errors","1");
error_reporting(E_ERROR | E_WARNING | E_PARSE );
date_default_timezone_set("America/Bogota");
$webPagesNoAuthentication = array(
	'ui/recoverPassword.php',
    'ui/usuario/contenidoMenu.php',
    'ui/usuario/contenidoMenu.php',
    'ui/usuario/relacionea/searchRelacionActoresEntidad.php',
    'ui/usuario/normatividad/searchNormatividad.php',
    'ui/usuario/referencias/searchReferencias.php',
    'ui/usuario/mision.php',
    'ui/usuario/vision.php',
    'ui/usuario/convenio.php',
    'ui/home.php',
);
$webPages = array(
	'ui/sessionAdministrator.php',
	'ui/administrator/insertAdministrator.php',
	'ui/administrator/updateAdministrator.php',
	'ui/administrator/selectAllAdministrator.php',
	'ui/administrator/searchAdministrator.php',
	'ui/administrator/updateProfileAdministrator.php',
	'ui/administrator/updatePasswordAdministrator.php',
	'ui/administrator/updateProfilePictureAdministrator.php',
	'ui/administrator/updatePictureAdministrator.php',
	'ui/logAdministrator/searchLogAdministrator.php',
	'ui/capitulo/insertCapitulo.php',
	'ui/capitulo/updateCapitulo.php',
	'ui/capitulo/selectAllCapitulo.php',
	'ui/capitulo/searchCapitulo.php',
	'ui/subcapitulo/selectAllSubcapituloByCapitulo.php',
	'ui/subcapitulo/insertSubcapitulo.php',
	'ui/subcapitulo/updateSubcapitulo.php',
	'ui/subcapitulo/selectAllSubcapitulo.php',
	'ui/subcapitulo/searchSubcapitulo.php',
	'ui/archivo/selectAllArchivoBySubcapitulo.php',
	'ui/seccion/insertSeccion.php',
	'ui/seccion/updateSeccion.php',
	'ui/seccion/selectAllSeccion.php',
	'ui/seccion/searchSeccion.php',
	'ui/archivo/selectAllArchivoBySeccion.php',
	'ui/visita/visitasTotal.php',
    'ui/visita/visitasCapitulo.php',
    'ui/visita/analisisDocumentos.php',
    'ui/visitante/insertVisitante.php',
	'ui/visitante/updateVisitante.php',
	'ui/visitante/selectAllVisitante.php',
	'ui/visitante/searchVisitante.php',
	'ui/visita/selectAllVisitaByVisitante.php',
	'ui/visita/insertVisita.php',
	'ui/visita/updateVisita.php',
	'ui/visita/selectAllVisita.php',
	'ui/visita/searchVisita.php',
    'ui/archivo/insertArchivourl.php',
    'ui/archivo/insertArchivopdf.php',
	'ui/archivo/updateArchivo.php',
	'ui/archivo/selectAllArchivo.php',
	'ui/archivo/searchArchivo.php',
	'ui/visita/selectAllVisitaByArchivo.php',
	'ui/documentoJuridico/insertDocumentoJuridico.php',
	'ui/documentoJuridico/updateDocumentoJuridico.php',
	'ui/documentoJuridico/selectAllDocumentoJuridico.php',
	'ui/documentoJuridico/searchDocumentoJuridico.php',
	'ui/normatividad/selectAllNormatividadByDocumentoJuridico.php',
	'ui/sector/insertSector.php',
	'ui/sector/updateSector.php',
	'ui/sector/selectAllSector.php',
	'ui/sector/searchSector.php',
	'ui/normatividad/selectAllNormatividadBySector.php',
	'ui/relacionActoresEntidad/selectAllRelacionActoresEntidadBySector.php',
	'ui/entidades/insertEntidades.php',
	'ui/entidades/updateEntidades.php',
	'ui/entidades/selectAllEntidades.php',
	'ui/entidades/searchEntidades.php',
	'ui/normatividad/selectAllNormatividadByEntidades.php',
	'ui/referencias/selectAllReferenciasByEntidades.php',
	'ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByEntidades.php',
	'ui/ciudad/insertCiudad.php',
	'ui/ciudad/updateCiudad.php',
	'ui/ciudad/selectAllCiudad.php',
	'ui/ciudad/searchCiudad.php',
	'ui/pais/insertPais.php',
	'ui/pais/updatePais.php',
	'ui/pais/selectAllPais.php',
	'ui/pais/searchPais.php',
	'ui/ciudad/selectAllCiudadByPais.php',
	'ui/naturaleza/insertNaturaleza.php',
	'ui/naturaleza/updateNaturaleza.php',
	'ui/naturaleza/selectAllNaturaleza.php',
	'ui/naturaleza/searchNaturaleza.php',
	'ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByNaturaleza.php',
	'ui/areaInfluencia/insertAreaInfluencia.php',
	'ui/areaInfluencia/updateAreaInfluencia.php',
	'ui/areaInfluencia/selectAllAreaInfluencia.php',
	'ui/areaInfluencia/searchAreaInfluencia.php',
	'ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByAreaInfluencia.php',
	'ui/aplicabilidad/insertAplicabilidad.php',
	'ui/aplicabilidad/updateAplicabilidad.php',
	'ui/aplicabilidad/selectAllAplicabilidad.php',
	'ui/aplicabilidad/searchAplicabilidad.php',
	'ui/normatividad/selectAllNormatividadByAplicabilidad.php',
	'ui/normatividad/insertNormatividad.php',
	'ui/normatividad/updateNormatividad.php',
	'ui/normatividad/selectAllNormatividad.php',
	'ui/normatividad/searchNormatividad.php',
	'ui/temaNormatividad/selectAllTemaNormatividadByNormatividad.php',
	'ui/referencias/insertReferencias.php',
	'ui/referencias/updateReferencias.php',
	'ui/referencias/selectAllReferencias.php',
	'ui/referencias/searchReferencias.php',
	'ui/temaReferencias/selectAllTemaReferenciasByReferencias.php',
	'ui/dependenciaContacto/insertDependenciaContacto.php',
	'ui/dependenciaContacto/updateDependenciaContacto.php',
	'ui/dependenciaContacto/selectAllDependenciaContacto.php',
	'ui/dependenciaContacto/searchDependenciaContacto.php',
	'ui/relacionActoresEntidad/selectAllRelacionActoresEntidadByDependenciaContacto.php',
	'ui/relacionActoresEntidad/insertRelacionActoresEntidad.php',
	'ui/relacionActoresEntidad/updateRelacionActoresEntidad.php',
	'ui/relacionActoresEntidad/selectAllRelacionActoresEntidad.php',
	'ui/relacionActoresEntidad/searchRelacionActoresEntidad.php',
	'ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidadByRelacionActoresEntidad.php',
	'ui/tema/insertTema.php',
	'ui/tema/updateTema.php',
	'ui/tema/selectAllTema.php',
	'ui/tema/searchTema.php',
	'ui/temaNormatividad/selectAllTemaNormatividadByTema.php',
	'ui/temaReferencias/selectAllTemaReferenciasByTema.php',
	'ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidadByTema.php',
	'ui/temaNormatividad/insertTemaNormatividad.php',
	'ui/temaNormatividad/updateTemaNormatividad.php',
	'ui/temaNormatividad/selectAllTemaNormatividad.php',
	'ui/temaNormatividad/searchTemaNormatividad.php',
	'ui/temaReferencias/insertTemaReferencias.php',
	'ui/temaReferencias/updateTemaReferencias.php',
	'ui/temaReferencias/selectAllTemaReferencias.php',
	'ui/temaReferencias/searchTemaReferencias.php',
	'ui/temaRelacionActoresEntidad/insertTemaRelacionActoresEntidad.php',
	'ui/temaRelacionActoresEntidad/updateTemaRelacionActoresEntidad.php',
	'ui/temaRelacionActoresEntidad/selectAllTemaRelacionActoresEntidad.php',
	'ui/temaRelacionActoresEntidad/searchTemaRelacionActoresEntidad.php',
);
if(isset($_GET['logOut'])){
	$_SESSION['id']="";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>RIRC</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="estilos/estilo.css" />
		<link rel="icon" type="image/png" href="img/IconPag.png" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
		<script charset="utf-8">
			$(function () { 
				$("[data-toggle='tooltip']").tooltip(); 
			});
		</script>
		 <script src="estilos/chartkick.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->

    <script>
      Chartkick.CustomChart = function (element, dataSource, options) {};
    </script>
	</head>
	<body>
		<div class="container p-0" style="background-color: white;">
		<?php
		if(empty($_GET['pid'])){
			include('ui/usuario/inicio.php');
		}else{
			$pid=base64_decode($_GET['pid']);
			if(in_array($pid, $webPagesNoAuthentication)){
				include($pid);
			}else{
				if($_SESSION['id']==""){
					header("Location: index.php");
					die();
				}
				if($_SESSION['entity']=="Administrator"){
					include('ui/menuAdministrator.php');
				}
				if (in_array($pid, $webPages)){
					include($pid);
				}else{
					include('ui/error.php');
				}
			}
		}
		include 'ui/footer.php';
		?>
		</div>
	</body>
</html>
