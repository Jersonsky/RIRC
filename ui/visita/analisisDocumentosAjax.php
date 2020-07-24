<?php
$capitulo = $_GET['filtro'];

$objSubcapitulo = new Subcapitulo("","",$capitulo);
$subcapitulos = $objSubcapitulo->selectAllByCapitulo();
if(count($subcapitulos>0)){
    foreach ($subcapitulos as $currentSubcapitulo) {
        echo "<option value='" . $currentSubcapitulo->getIdSubcapitulo() . "'";
        echo ">" . $currentSubcapitulo->getNombre() . "</option>";
    }
}

?>