<!-- Menu sesion-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
    <a class="navbar-brand" href="#"> <img src="img/LogoPag.png"
		height="40" alt=""></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarColor01" style="">
      <ul class="navbar-nav ml-auto">
	
		<li class="nav-item"><a class="nav-link p-2"
			href='index.php?pid=<?php echo base64_encode("ui/home.php")?>'
			rel="noopener">Inicio sesi&oacute;n |</a></li>
		<li class="nav-item"><a class="nav-link p-2"
			href="https://regioncentralrape.gov.co" target="_blank"
			rel="noopener" aria-label="GitHub">Regi&oacute;n central |</a></li>
		<li class="nav-item"><a class="nav-link p-2"
			href="https://www.udistrital.edu.co" target="_blank" rel="noopener"
			aria-label="GitHub">Universidad Distrital |</a></li>
	</ul>
	<form class="form-inline" method=GET action="http://www.google.com/search" target="_blank">
		<input class="form-control mr-sm-2" type="search" name="q" placeholder="Buscar"
			aria-label="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
	</form>
	</div>
</nav>

<!-- Logos -->
<?php
include 'ui/header.php';
?>

<!-- Menu principal -->
<nav class="navbar nav-masthead navbar-expand-lg navbar-dark mb-3 sticky-top"
	style="background-color: #138743; opacity: 0.9">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
		<div class="navbar-collapse collapse" id="navbarColor02" style="">
			<ul class="navbar-nav mr-auto ml-auto ">
				<li class="nav-item active"><a class="nav-link" href="index.php?pid=<?php echo base64_encode('index.php')?>">Inicio <span
						class="sr-only">(current)</span></a></li>
				<li class='nav-item dropdown'>
            		<a class='nav-link' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Nosotros</a>
            	<ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
            		<li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=<?php echo base64_encode("ui/usuario/mision.php")?>'>Misi&oacute;n</a>
            		<li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=<?php echo base64_encode("ui/usuario/vision.php")?>'>Visi&oacute;n</a>
            		<li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=<?php echo base64_encode("ui/usuario/convenio.php")?>'>Convenio</a>
            	</ul>
            	</li>
            <?php
            $capitulo = new Capitulo();
            $registros = $capitulo->selectAll();
            foreach ($registros as $r) { // CAPITULO
                $subcap = new Subcapitulo("", "", $r->getIdCapitulo());
                $sub = $subcap->selectAllByCapitulo();

                echo "<li class='nav-item dropdown'>";
                echo "<a class='nav-link' href='#' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $r->getNombre() . "</a>";
                echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>";
                foreach ($sub as $s) {// SUBCAPITULO
                    $seccion = new Seccion();
                    $sec = $seccion->traerSeccionPorSub($s->getIdSubcapitulo());
                    $archivo = new Archivo();
                    $cantidad = $archivo -> traerPorSubCapitulo($s->getIdSubcapitulo());
                    if(count($sec)>0){
                        if(count($cantidad)>0){
                            echo "<li class='dropdown-submenu'><a class='dropdown-item dropdown-toggle' href='index.php?pid=".base64_encode('ui/usuario/contenidoMenu.php')."&idSubCapitulo=".$s->getIdSubcapitulo()."'>" . $s->getNombre() . "</a>";
                        }else{
                            echo "<li class='dropdown-submenu'><a class='dropdown-item dropdown-toggle' href='#'>" . $s->getNombre() . "</a>";
                        }
                        
                    }else{
                        if(count($cantidad)>0){
                            echo "<li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=".base64_encode('ui/usuario/contenidoMenu.php')."&idSubCapitulo=".$s->getIdSubcapitulo()."'>" . $s->getNombre() . "</a>";
                        }else{
                            echo "<li class='dropdown-submenu'><a class='dropdown-item' href='#'>" . $s->getNombre() . "</a>";
                        }
                        
                    }
                    
                    if(count($sec)>0){
                        echo "<ul class='dropdown-menu'>";
                        
                        foreach ($sec as $se) { // SECCION
                            echo "<li><a class='dropdown-item' href='index.php?pid=". base64_encode('ui/usuario/contenidoMenu.php')."&idSubCapitulo=".$s->getIdSubcapitulo()."&idSeccion=".$se->getIdSeccion(). "'>" . $se->getNombre() . "</a></li>";
                        }

                    echo "</ul>";
                    }
                    echo "</li>";
                }
                echo "</ul>";
                echo "</li>";
            }
            ?>
            <li class='nav-item dropdown'>
            <a class='nav-link' href='http://example.com' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Buscadores</a>
            <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
            <li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=<?php echo base64_encode("ui/usuario/referencias/searchReferencias.php")?>'>Gesti&oacute;n Documental</a>
            <li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=<?php echo base64_encode("ui/usuario/relacionea/searchRelacionActoresEntidad.php")?>'>Relaci&oacute;n Entidad/Actor</a>
            <li class='dropdown-submenu'><a class='dropdown-item' href='index.php?pid=<?php echo base64_encode("ui/usuario/normatividad/searchNormatividad.php")?>'>Normatividad del Sector Energ&eacute;tico</a>
            </ul>
            </li>
	        </ul>
		</div>
</nav>

