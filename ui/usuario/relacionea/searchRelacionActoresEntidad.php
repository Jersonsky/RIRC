<?php
include 'ui/usuario/menu.php';
require 'ui/usuario/InsertarVisitasYVisitantes.php';
?>
<div class="container-fluid">
	<div class="container mb-3">
		<div class="row">
			<div class="col text-right pr-0">
				<img alt="" src="img/tablas.jpeg" width="100px">
			</div>
			<div class="col text-left pl-0 pt-2">
				<div class="text-uppercase text-success">
					Relacion <br>entidad<br> actor
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<div class="text-muted text-center">Este modulo esta diseñado explicitamente para buscar informacion asociada a las investigaciones que componen este sistema de informacion, 
					solo debe escribir en el siguiente cuadro una palabra o frase relacionada.</div>
					<br>
				<input type="text" class="form-control border border-success" id="search"
					placeholder="Buscador de Relacion Actores/Entidad"
					autocomplete="off" />
			</div>
		</div>
	</div>
	<div id="searchResult"></div>
</div>
<script>
$(document).ready(function(){
	$("#search").keyup(function(){
		if($("#search").val().length > 2){
			var search = $("#search").val().replace(" ", "%20");
			var path = "indexAjax.php?pid=<?php echo base64_encode("ui/usuario/relacionea/searchRelacionActoresEntidadAjax.php"); ?>&search="+search;
			$("#searchResult").load(path);
		}
	});
});
</script>
