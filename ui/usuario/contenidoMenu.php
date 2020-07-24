<?php
include 'ui/usuario/menu.php';

$archivo = new Archivo();
$visitas=new Visita();
$visitantes = new Visitante();
$vis=$visitantes -> traerIP(getenv('REMOTE_ADDR'));

if (isset($_GET['idSubCapitulo']) && isset($_GET['idSeccion'])== null ) {
    //Cuando el contenido se referencia solo al subcapitulo
    $subcapitulo = $_GET['idSubCapitulo'];
    $nsubcap = new Subcapitulo($subcapitulo);
    $nsubcap -> select();
    $registro= $archivo -> traerPorSubCapitulo($subcapitulo);
    $idArchivo=  $archivo -> traeridArchivo($subcapitulo);
    if(count($vis)>=1){
        foreach($idArchivo as $i){
            $visitantess= new Visitante("",getenv('REMOTE_ADDR'));
            $visitantess-> selectPorNombre();
            $id = $i -> getIdArchivo();
            $visitas -> traerVisita($id);
            $visitass=new Visita("",date("Y-m-d"),$id,$visitantess->getIdVisitante());
            $visitass->insert();
            
        }
    }else{
        
        $visit = new Visitante("",getenv('REMOTE_ADDR'));
        $visit -> insert();
        foreach($idArchivo as $i){
            $visitantess= new Visitante("",getenv('REMOTE_ADDR'));
            $visitantess-> selectPorNombre();
            $id = $i -> getIdArchivo();
            $visitas -> traerVisita($id);
            $visitass=new Visita("",date("Y-m-d"),$id,$visitantess->getIdVisitante());
            $visitass->insert();
            
        }
    }
    echo "<h2 class='font-weight-bold text-center'>". $nsubcap -> getNombre() ."</h2>";
    echo "<hr>";
?>
	<div class="container" style="background-color: white;">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  			<?php
            echo "<ol class='carousel-indicators'>";
                $con = 0;
                foreach ($registro as $r){
                    echo (count($registro)>1)? "<li data-target='#carouselExampleIndicators' data-slide-to='. $con .' ></li>":"";
                    $con++;
                }
            echo "</ol>";
            echo "<div class='carousel-inner'>";
            $co = 0;
            foreach ($registro as $r){
                echo ($co>0) ? "<div class='carousel-item' data-pause='true'>" : "<div class='carousel-item active' data-pause='true'>";
                echo "<embed src='".$r -> getUrl()."' type='application/pdf' width='100%' height='700px' />";
                echo "<div class='carousel-caption d-none d-md-block' style='background: #000000; opacity: 0.7;'>";
                echo "<b>Nombre:</b> ". $r -> getNombre(). "  <b>Fecha temporalidad:</b> " . $r -> getFechatemporalidad(). "<br><b>Fuente:</b> " . $r -> getFuente();
                echo "</div>";
                echo "</div>";
                $co++;
            }
    
            if(count($registro)>1){?>
	  			<a class="carousel-control-prev" style="height:50%; margin: auto" href="#carouselExampleIndicators" role="button" data-slide="prev">
		    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    			<span class="sr-only">Anterior</span>
  				</a>
		  		<a class="carousel-control-next" style="height:50%; margin: auto" href="#carouselExampleIndicators" role="button" data-slide="next">
			    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    			<span class="sr-only">Siguiente</span>
  				</a>
  			<?php 
            }
            echo "</div>";?>
		</div>
	</div>

<?php     
}else{
    //Cuando el contenido se referencia a seccion
    $seccion = $_GET['idSeccion'];
    $subcapitulo = $_GET['idSubCapitulo'];
    $registro= $archivo -> traerPorArchivoSeccionSub($subcapitulo, $seccion);
    $nsubcap = new Subcapitulo($subcapitulo);
    $nsubcap -> select();
    $nseccion = new Seccion($seccion);
    $nseccion -> select();
    
    $idArchivoSeccion = $archivo -> traerPorIDArchivoSeccionSub($subcapitulo, $seccion);
    if(count($vis)>=1){
        foreach($idArchivoSeccion as $ias){
            $visitantess= new Visitante("",getenv('REMOTE_ADDR'));
            $visitantess-> selectPorNombre();
            $id = $ias -> getIdArchivo();
            $visitas -> traerVisita($id);
            $visitass=new Visita("",date("Y-m-d"),$id,$visitantess->getIdVisitante());
            $visitass->insert();
            
        }
    }else{
        
        $visit = new Visitante("",getenv('REMOTE_ADDR'));
        $visit -> insert();
        
        foreach($idArchivoSeccion as $ias){
            $visitantess= new Visitante("",getenv('REMOTE_ADDR'));
            $visitantess-> selectPorNombre();
            $id = $ias -> getIdArchivo();
            $visitas -> traerVisita($id);
            $visitass=new Visita("",date("Y-m-d"),$id,$visitantess->getIdVisitante());
            $visitass->insert();
            
        }
    }
    echo "<div class='container p-4'>";
    echo "<h2 class='font-weight-bold text-center'>". $nsubcap -> getNombre() ."</h2>";
    echo "<h3 class='text-muted text-center'>". $nseccion ->getNombre(). "</h3>";
    echo "<hr>";
    if($seccion == 3){//cifras y graficas
?>
  			<div class="row">
  			
			    <div class="col-12 col-md-6 col-sm-12">
    				<?php 
                        foreach ($registro as $r){
                            $rest = substr($r -> getUrl(), -4);
                            if($rest==".pdf"){
                                
                            }else{
                                echo $r -> getUrl();
                            }
                            
                        }
                    ?>
    			</div>
    			<div class="col-12 col-md-6 col-sm-12">
    				<?php 
                        foreach ($registro as $r){
                            $rest = substr($r -> getUrl(), -4);
                            if($rest==".pdf"){
                                echo "<embed src='".$r -> getUrl()."' type='application/pdf' width='100%' height='700px' />";
                            }
                        }
                    ?>
    			</div>
  			</div>
<?php 
    }else if($seccion == 2){//Referencias
        echo "<div class='container'>";
        echo "<div class='row'>";
        
        $u = 1;
        foreach ($registro as $ref){
            echo "<div class='col-md-6'>";
            echo "<div class='card border-secondary mb-3 px-4 py-2'>";
            echo "  <div class='row justify-content-between'>";
            echo "		<div class='col-8'>";
            echo "			<i class='far fa-file-pdf fa-1x' style='color: red'> [". $u ."]</i> ". $ref ->getNombre() ;
            echo "      </div>";
            echo "		<div class='col-4 text-right'>";
            echo "			<button type='button' class='btn btn-outline-success btn-sm' data-toggle='modal' data-target='#u". $u ."'>";
            echo "				<i class='far fa-eye'></i>";
            echo "			</button>";
            echo "		</div>";
            echo "	</div>";
            echo "</div>";
            echo "</div>";
            
            echo "<div class='modal fade bd-example-modal-lg' id='u". $u ."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>";
            echo "	<div class='modal-dialog modal-lg' role='document'>";
            echo "		<div class='modal-content'>";
            echo "			<div class='modal-header'>";
            echo "				<h5 class='modal-title text-uppercase' id='exampleModalLongTitle'>". $ref ->getNombre()."</h5>";
            echo "				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            echo "					<span aria-hidden='true'>&times;</span>";
            echo "				</button>";
            echo "			</div>";
            echo "			<div class='modal-body'>";
            echo "				<embed src='".$ref -> getUrl()."' type='application/pdf' width='100%' height='500px' />";
            echo "			</div>";
            echo "		</div>";
            echo "	</div>";
            echo "</div>";
            $u++;
         }
         echo "</div>";
         echo "</div>";

    }else{//solo pdf
?>
		<p>La información referente a los archivos que se encuentran en esta sección, se detallan a continuación:</p>
		<?php if(count($registro) < 4){ ?>
		<div class="table-responsive">
		<table class="table table-borderless table-sm">
  			<thead>
    			<tr>
      			<th scope="col">#</th>
      			<th scope="col">Nombre</th>
      			<th scope="col">Descripción</th>
      			<th scope="col">Temporalidad</th>
      			<th scope="col">Fuente</th>
      			<th scope="col">Tema</th>
    			</tr>
  			</thead>
  			<tbody>
  				<?php
                $num=1;
                foreach ($registro as $r){
                    echo "<tr>";
                    echo "<th scope='row'>". $num ."</th>";
                    echo "<td>". $r -> getNombre() ."</td>";
                    echo "<td>". $r -> getDescripcion() ."</td>";
                    echo "<td>". $r -> getFechatemporalidad() ."</td>";
                    echo "<td>". $r -> getFuente() ."</td>";
                    echo "<td>". $r -> getTema() -> getDescripcion() ."</td>";
                    echo "</tr>";
                    $num++;
                }
                ?>
  			</tbody>
		</table>
		</div>
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  					<?php 
  					echo "<ol class='carousel-indicators'>";
                    $con = 0;
                    foreach ($registro as $r){
                        echo (count($registro)>1 && $con<4)? "<li data-target='#carouselExampleIndicators' data-slide-to='. $con .' ></li>":"";
                        $con++;
                    }
                    echo "</ol>";
                    echo "<div class='carousel-inner'>";
                    $co = 0;
                    foreach ($registro as $r){
                        if($co < 4){
                            
                            echo ($co>0) ? "<div class='carousel-item' data-pause='true'>" : "<div class='carousel-item active' data-pause='true'>";
                            echo "<embed src='".$r -> getUrl()."' type='application/pdf' width='100%' height='700px' />";
                            echo "<div class='carousel-caption d-none d-md-block' style='background: #000000; opacity: 0.7;'>";
                            echo "<b>Nombre:</b> ". $r -> getNombre(). "  <b>Fecha temporalidad:</b> " . $r -> getFechatemporalidad(). "<br><b>Fuente:</b> " . $r -> getFuente();
                            echo "</div>";
                            echo "</div>";
                        }
                        $co++;
                    }
                    $co = 0;
                    if(count($registro)>1 && $co<4){
 ?>
  						<a class="carousel-control-prev" style="height:50%; margin: auto" href="#carouselExampleIndicators" role="button" data-slide="prev">
    						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    						<span class="sr-only">Anterior</span>
  						</a>
  						<a class="carousel-control-next" style="height:50%; margin: auto" href="#carouselExampleIndicators" role="button" data-slide="next">
    						<span class="carousel-control-next-icon" aria-hidden="true"></span>
    						<span class="sr-only">Siguiente</span>
  						</a>
 					<?php 
                    }
                    echo "</div>";?>
			</div>
<?php 
    }else{
       ?>
       <div class="table-responsive">
		<table class="table table-borderless table-sm">
  			<thead>
    			<tr>
      			<th scope="col">#</th>
      			<th scope="col">Nombre</th>
      			<th scope="col">Descripción</th>
      			<th scope="col">Temporalidad</th>
      			<th scope="col">Fuente</th>
      			<th scope="col">Tema</th>
      			<th scope="col">Ver/Descargar</th>
    			</tr>
  			</thead>
  			<tbody>
  				<?php
                $num=1;
                $u=1;
                foreach ($registro as $r){
                    echo "<tr>";
                    echo "<th scope='row'>". $num ."</th>";
                    echo "<td>". $r -> getNombre() ."</td>";
                    echo "<td>". $r -> getDescripcion() ."</td>";
                    echo "<td>". $r -> getFechatemporalidad() ."</td>";
                    echo "<td>". $r -> getFuente() ."</td>";
                    echo "<td>". $r -> getTema() -> getDescripcion() ."</td>";
                    echo "		<td class='text-center'>";
                    echo "			<button type='button' class='btn btn-outline-success btn-sm' data-toggle='modal' data-target='#u". $u ."'>";
                    echo "				<i class='fas fa-file-pdf'></i>";
                    echo "			</button>";
                    echo "		</td>";
                    echo "</tr>";
                    $num++;
                    
                    echo "<div class='modal fade bd-example-modal-lg' id='u". $u ."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>";
                    echo "	<div class='modal-dialog modal-lg' role='document'>";
                    echo "		<div class='modal-content'>";
                    echo "			<div class='modal-header'>";
                    echo "				<h5 class='modal-title text-uppercase' id='exampleModalLongTitle'>". $r ->getNombre()."</h5>";
                    echo "				<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                    echo "					<span aria-hidden='true'>&times;</span>";
                    echo "				</button>";
                    echo "			</div>";
                    echo "			<div class='modal-body'>";
                    echo "				<embed src='".$r -> getUrl()."' type='application/pdf' width='100%' height='500px' />";
                    echo "			</div>";
                    echo "		</div>";
                    echo "	</div>";
                    echo "</div>";
                    $u++;
                }
                
                ?>
                
  			</tbody>
		</table>
		</div>
    <?php        
    }
    echo "</div>";
    }
}
?>







	
