<div class="container">

	<h2 class='font-weight-bold text-center'>An&aacute;lisis de documentos registrados</h2>
	<h4 class='text-muted text-center'>Por mes</h4>
	<hr>
	
    <div id="pie-dataset" style="height: 300px;"></div>
	    <script>
	      new Chartkick.PieChart("pie-dataset", [
		  <?php 
		  
          $documento = new Visita();
          $doc = $documento -> controlDocumentos();
          foreach($doc as $d){
              $rest = $d->getIdVisita();
              if($rest == "01"){
                  $rest="Enero";
              }else if($rest == "02"){
                  $rest="Febrero";
              }else if($rest == "03"){
                  $rest="Marzo";
              }else if($rest == "04"){
                  $rest="Abril";
              }else if($rest == "05"){
                  $rest="Mayo";
              }else if($rest == "06"){
                  $rest="Junio";
              }else if($rest == "07"){
                  $rest="Julio";
              }else if($rest == "08"){
                  $rest="Agosto";
              }else if($rest == "09"){
                  $rest="Septiembre";
              }else if($rest == "10"){
                  $rest="Octubre";
              }else if($rest == "11"){
                  $rest="Noviembre";
              }else if($rest == "12"){
                  $rest="Diciembre";
              }
              echo "['".$rest."',".$d -> getArchivo()."],";
          }
           
          ?>
          ], {dataset: {borderWidth: 3}});
    </script>

<div class="jumbotron pb-3 mt-3">
	<div class="form-row">
		<div class="col-md-8 col-sm-3">	
  			<h1 class="display-4">¿Desea consultar las visitas de un documento?</h1>
  			<p class="lead">Seleccione el capitulo, el subcap&iacute;tulo y ver&aacute; los documentos que corresponden.</p>
  		</div>
  		<div class="col">
  		<form id="form" method="post"
		action="index.php?pid=<?php echo base64_encode("ui/visita/analisisDocumentos.php") ?>"
		class="bootstrap-form needs-validation">
			<div class="card border-dark mb-3 p-3">
  				<div class="card-body bg-light text-dark">
    			<div class="card-text">		
    				<div class="form-group">
						<label>Capitulo*</label> 
						<select class="form-control" name="capitulo" id="filtro">
						<option selected>Seleccione...</option>
        				<?php
                        $objCapitulo = new Capitulo();
                        $capitulos = $objCapitulo->selectAllOrder("nombre", "asc");
                        foreach ($capitulos as $currentCapitulo) {
                        echo "<option value='" . $currentCapitulo->getIdCapitulo() . "'";
                        echo ">" . $currentCapitulo->getNombre() . "</option>";
                        }
                        ?>
    					</select>
    				</div>
    				<div class="form-group">
						<label>Subcapitulo*</label> 
						<select class="form-control" name="subcapitulo" id="resultados1" required>
							
						</select>
					</div>
					<div class="form-group">
						<hr><button type="submit" class="btn btn-block btn-info" name="btnCapitulo">Graficar</button>
					</div>
				</div>
  				</div>
  			</div>
		</form>
		</div>
	</div>
</div>
	
	<?php 
	if(isset($_POST['btnCapitulo'])){
	    $sub = $_POST['subcapitulo'];
	    
	    $subcap = new Subcapitulo($sub);
	    $subcap ->select();	    
	    $visita = new Visita();
	    $vis = $visita -> graficaPorDocumento($sub);
	    

	    echo "<h2 class='font-weight-bold text-center'>An&aacute;lisis de Visitas</h2>";
	    echo "<h4 class='text-muted text-center'>Por documento, del<br> cap&iacute;tulo ". $subcap -> getCapitulo() -> getNombre(). " y subcap&iacute;tulo ". $subcap -> getNombre()."</h4><hr>";
    ?>
	
	<div id="multiple-bar" style="height: 300px;"></div>
	    <script>
	    new Chartkick.BarChart("multiple-bar", [
	    	 <?php 
	    	 
	    	 foreach($vis as $a){
	    	     echo "{name: '".$a -> getFecha() -> getNombre()."',data: [";
	    	     foreach($vis as $v){
	    	         if($a -> getFecha() == $v -> getFecha()){
	    	        
    	    	         $rest = $v->getIdVisita();
    	    	         if($rest == "01"){
    	    	             $rest="Enero";
    	    	         }else if($rest == "02"){
    	    	             $rest="Febrero";
    	    	         }else if($rest == "03"){
    	    	             $rest="Marzo";
    	    	         }else if($rest == "04"){
    	    	             $rest="Abril";
    	    	         }else if($rest == "05"){
    	    	             $rest="Mayo";
    	    	         }else if($rest == "06"){
    	    	             $rest="Junio";
    	    	         }else if($rest == "07"){
    	    	             $rest="Julio";
    	    	         }else if($rest == "08"){
    	    	             $rest="Agosto";
    	    	         }else if($rest == "09"){
    	    	             $rest="Septiembre";
    	    	         }else if($rest == "10"){
    	    	             $rest="Octubre";
    	    	         }else if($rest == "11"){
    	    	             $rest="Noviembre";
    	    	         }else if($rest == "12"){
    	    	             $rest="Diciembre";
    	    	         }
    	    	         echo "['".$rest."',".$v -> getArchivo()."],";
    	    	         }
	    	         
	    	     }
	    	     echo "]},";
	    	 }
	    	 ?>
			], {});
	    </script>
	  <?php   
	
	  $archivo = new Archivo("","","","","","","",$sub);
	  $arch = $archivo -> selectAllBySubcapitulo();
	  
	  
	  
	  echo "<div class='table-responsive'>";
	  echo "<table class='table'>";
	  echo "<thead>";
	  echo "<tr>";
	  echo "<th scope='col'>Nombre Documento</th>";
	  echo "<th scope='col'>Visitas</th>";
	  echo "<th scope='col'>Secci&oacute;n</th>";
	  echo "</tr>";
	  echo "</thead>";
	  
	  
	  echo "<tbody>";
	  foreach($arch as $a){
	      $viss= new Visita();
	      $viss -> graficaPorDocumentoTotal($a -> getIdArchivo());
	      //echo $viss -> getVisitaDAO() -> graficaPorDocumentoTotal($a -> getIdArchivo());
	      echo "<tr>";
	      echo "<th>".$a -> getNombre()."</th>";
	      if($viss -> getArchivo() == null){
	          echo "<td>0</td>";
	      }else{
	          echo "<td>". $viss -> getArchivo() ."</td>";
	      }
	      
	      echo "<td>".$a -> getSeccion() -> getNombre()."</td>";
	      echo "</tr>";
	      
	  }
	  echo "</tbody>";
	  echo "</table>";
	  echo "</div>";
	}
	
	
	?>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#filtro").on('click',function(){
		if($("#filtro").val()!=""){
			var valor = "indexAjax.php?pid=<?php echo base64_encode("ui/visita/analisisDocumentosAjax.php" ); ?>&filtro="+$("#filtro").val();
			$("#resultados1").load(valor);
		}
	});
});
</script>

