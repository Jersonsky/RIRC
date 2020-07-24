<h2 class='font-weight-bold text-center'>An&aacute;lisis de Visitas</h2>
<h4 class='text-muted text-center'>Por mes</h4>
<hr>
    
<div class="container" id="donut-example"></div>

<script>
new Morris.Donut({
element: 'donut-example',
resize: true,
data: [
   
<?php
$visita = new Visita();
$visitas = $visita ->totalVisitas();

$tvisitas = 0;
foreach ($visitas as $v){
    $rest = substr($v -> getFecha(),-5, -3);
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
    echo "{label: '". $rest ."', value: ". $v -> getIdVisita() ."},";
    $tvisitas= $tvisitas +$v -> getIdVisita();
}
?>
]
});
</script>

<?php 

echo "<hr><h3 class='font-weight-bold text-center text-muted'>En total hay ". $tvisitas ." Visitas</h3>";
?>