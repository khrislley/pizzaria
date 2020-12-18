<?php

function autentica(){
    if((isset($_SESSION['login']))&&(isset($_SESSION['senha'])))
    return 1;
    else
    return 0;
}


function converterHorarioEmString($data){
    $auxData1 = explode(" ", $data); //separando a data da hora
    return $auxData1[0];
}

function converterDataHora($data){
    $auxData1 = explode(" ", $data); //separando a data da hora
    $auxData2 = explode("-", $auxData1[0]); //separando aaaa,mm,dd
    $hora = substr($data, 11, 5);

    return $auxData2[2] . "/" . $auxData2[1] . "/" . $auxData2[0]. "  " . $hora;
}

function traduzDataSql($data){
    $auxData1=explode(" ",$data); //separando a data da hora
    $auxData2=explode("-",$auxData1[0]); //separando aaaa,mm,dd
    return $auxData2[2]."/".$auxData2[1]."/".$auxData2[0];
}

?>