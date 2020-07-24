<?php

$objCiudad = new Ciudad("","", $_GET['filtro']);
$ciudads = $objCiudad -> selectAllByPaisOrder("nombre", "asc");

if(count($ciudads)>0){ 
    foreach($ciudads as $currentCiudad){
        echo "<option value='" . $currentCiudad -> getIdCiudad() . "'";
        echo ">" . $currentCiudad -> getNombre() . "</option>";
    }
}
?>