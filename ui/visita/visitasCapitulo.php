<div class="container">
<h2 class='font-weight-bold text-center'>An&aacute;lisis de Visitas</h2>
<h4 class='text-muted text-center'>Por cap&iacute;tulo</h4>
<hr>

<div id="multiple-area" style="height: 300px;"></div>

<script>
	new Chartkick.AreaChart("multiple-area", [
    <?php
    $capitulo = new Capitulo();
    $capitulos = $capitulo->selectAll();
    $visita = new Visita();
    $fecha = $visita->traerVisitaPorCapitulo();
    foreach ($capitulos as $c) {
        echo "{'name':'" . $c->getNombre() . "','data':{";
        foreach ($fecha as $f) {
            if ($c->getNombre() == $f->getFecha()) {
                echo "'" . $f->getIdVisita() . "':" . $f->getArchivo() . ",";
            }
        }
        echo "}},";
    }
    ?>
    ]);
</script>

<div class="jumbotron pb-3">
	<div class="form-row">
		<div class="col-md-8 col-sm-3">		
  			<h1 class="display-4">¿Desea consultar un cap&iacute;tulo?</h1>
  			<p class="lead">Seleccione el cap&iacute;tulo y ver&aacute; los subcap&iacute;tulos que corresponden.</p>
  		</div>
  		<form id="form" method="post"
			action="index.php?pid=<?php echo base64_encode("ui/visita/visitasCapitulo.php") ?>"
			class="bootstrap-form needs-validation">
			<div class="card border-dark mb-3 p-3">
  				<div class="card-body bg-light text-dark">
    			<div class="card-text">		
    				<div class="form-group">
						<label>Capitulo* </label>
						<select class="form-control" name="capitulo" >
        				<?php
                        $objCapitulo = new Capitulo();
                        $capitulos = $objCapitulo->selectAllOrder("nombre", "asc");
                        foreach ($capitulos as $currentCapitulo) {
                            echo "<option value='" . $currentCapitulo->getIdCapitulo() . "'";
                        if ($currentCapitulo->getIdCapitulo() == $capitulo) {
                            echo " selected";
                        }
                        echo ">" . $currentCapitulo->getNombre() . "</option>";
                        }
                        ?>
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


<?php 
    if(isset($_POST['btnCapitulo'])){
        $cap = $_POST['capitulo'];
        $obcap = new Capitulo($cap);
        $obcap -> select();        
        $subcapitulo = new Subcapitulo("","",$cap);
        $sub = $subcapitulo -> selectAllByCapitulo();
        $visita = new Visita();
        $vis = $visita -> graficaPorSubcapitulo($cap);
        
        echo "<h2 class='font-weight-bold text-center'>An&aacute;lisis de Visitas</h2>";
        echo "<h4 class='text-muted text-center'>Subcap&iacute;tulo ". $obcap -> getNombre()."</h4><hr>";
        
        ?>
        <div id="column-labels" style="height: 300px;"></div>
        <script>
        new Chartkick.ColumnChart("column-labels", [
            <?php 
            
            foreach($sub as $s){
                echo "{'name':'".$s -> getNombre()."','data':[";
                foreach($vis as $v){
                    if($s -> getNombre() == $v -> getFecha()){
                    
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
                        echo "['".$rest."',".$v->getArchivo()."],";
                    }
                }
                echo "]},";
            }
            ?>
            ], {});
        </script>
<?php         
    }
?>
</div>

