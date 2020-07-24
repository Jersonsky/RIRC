<?php
$visitantes = new Visitante();
$vis=$visitantes -> traerIP(getenv('REMOTE_ADDR'));

if(count($vis)>=1){
    $visitantess= new Visitante("",getenv('REMOTE_ADDR'));
    $visitantess-> selectPorNombre();
    $ar="NULL";
    $visitass=new Visita("",date("Y-m-d"),$ar,$visitantess->getIdVisitante());
    $visitass->insert();    
}else{
    $visit = new Visitante("",getenv('REMOTE_ADDR'));
    $visit -> insert();
    $visit -> selectPorNombre();
    $ar="NULL";
    $visitass=new Visita("",date("Y-m-d"),$ar,$visit->getIdVisitante());
    $visitass->insert();
}
?>