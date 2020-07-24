<?php
$administrator = new Administrator($_SESSION['id']);
$administrator -> select();
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark mb-3" >
	<a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrator.php") ?>"><span class="fas fa-home" aria-hidden="true"></span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"> <span class="navbar-toggler-icon"></span></button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Crear nuevo</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/insertAdministrator.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/capitulo/insertCapitulo.php") ?>">Capitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/subcapitulo/insertSubcapitulo.php") ?>">Subcapitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/seccion/insertSeccion.php") ?>">Seccion</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/documentoJuridico/insertDocumentoJuridico.php") ?>">Documento Juridico</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/sector/insertSector.php") ?>">Sector</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/entidades/insertEntidades.php") ?>">Entidades</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/areaInfluencia/insertAreaInfluencia.php") ?>">Area Influencia</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/aplicabilidad/insertAplicabilidad.php") ?>">Aplicabilidad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/normatividad/insertNormatividad.php") ?>">Normatividad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/referencias/insertReferencias.php") ?>">Referencias</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/dependenciaContacto/insertDependenciaContacto.php") ?>">Dependencia Contacto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/insertRelacionActoresEntidad.php") ?>">Relacion Actores Entidad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/tema/insertTema.php") ?>">Tema</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Subir Archivo</a>
				<div class="dropdown-menu">
					
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/archivo/insertArchivourl.php") ?>">Subir Archivo tipo URL</a>
    				<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/archivo/insertArchivopdf.php") ?>">Subir Archivo tipo PDF</a>
					
				</div>
			</li>
			<!-- <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Mostrar Todo</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/capitulo/selectAllCapitulo.php") ?>">Capitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/subcapitulo/selectAllSubcapitulo.php") ?>">Subcapitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/seccion/selectAllSeccion.php") ?>">Seccion</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/archivo/selectAllArchivo.php") ?>">Archivo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/documentoJuridico/selectAllDocumentoJuridico.php") ?>">Documento Juridico</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/sector/selectAllSector.php") ?>">Sector</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/entidades/selectAllEntidades.php") ?>">Entidades</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/areaInfluencia/selectAllAreaInfluencia.php") ?>">Area Influencia</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/aplicabilidad/selectAllAplicabilidad.php") ?>">Aplicabilidad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/normatividad/selectAllNormatividad.php") ?>">Normatividad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/referencias/selectAllReferencias.php") ?>">Referencias</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/dependenciaContacto/selectAllDependenciaContacto.php") ?>">Dependencia Contacto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/selectAllRelacionActoresEntidad.php") ?>">Relacion Actores Entidad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/tema/selectAllTema.php") ?>">Tema</a>
				</div>
			</li> -->
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Buscar</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/searchAdministrator.php") ?>">Administrador</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/capitulo/searchCapitulo.php") ?>">Capitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/subcapitulo/searchSubcapitulo.php") ?>">Subcapitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/seccion/searchSeccion.php") ?>">Seccion</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/archivo/searchArchivo.php") ?>">Archivo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/documentoJuridico/searchDocumentoJuridico.php") ?>">Documento Juridico</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/sector/searchSector.php") ?>">Sector</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/entidades/searchEntidades.php") ?>">Entidades</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/areaInfluencia/searchAreaInfluencia.php") ?>">Area Influencia</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/aplicabilidad/searchAplicabilidad.php") ?>">Aplicabilidad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/normatividad/searchNormatividad.php") ?>">Normatividad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/referencias/searchReferencias.php") ?>">Referencias</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/dependenciaContacto/searchDependenciaContacto.php") ?>">Dependencia Contacto</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/relacionActoresEntidad/searchRelacionActoresEntidad.php") ?>">Relacion Actores Entidad</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/tema/searchTema.php") ?>">Tema</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Analisis</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/visita/visitasTotal.php") ?>">Analisis de visitas</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/visita/visitasCapitulo.php") ?>">Analisis por capitulo</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/visita/analisisDocumentos.php") ?>">Analisis de documentos</a>
				</div>
			</li>  
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Historial</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/logAdministrator/searchLogAdministrator.php") ?>">Historial Administrador</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown"><i class="far fa-user-circle"></i> Administrador: <?php echo $administrator -> getName() . " " . $administrator -> getLastName() ?><span class="caret"></span></a>
				<div class="dropdown-menu" >
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfileAdministrator.php") ?>">Editar Perfil</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updatePasswordAdministrator.php") ?>">Cambiar Contrase&ntilde;a</a>
					<a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfilePictureAdministrator.php") ?>">Cambiar Foto de Perfil</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?logOut=1">Cerrar Sesi&oacute;n</a>
			</li>
		</ul>
	</div>
</nav>
