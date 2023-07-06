<?php

function DataInvertida($DataNormal){
    $Dia = substr($DataNormal,0,2);
    $Mes = substr($DataNormal,3,2);
    $Ano = substr($DataNormal,6,4);
    $DataInvetida = $Ano."/".$Mes."/".$Dia;
    return $DataInvetida;
}