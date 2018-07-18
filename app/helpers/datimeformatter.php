<?php

function datetimeformatter($datetime){

    //Separation de la date et de l'heure
    $dateAndTime=explode(' ',$datetime);
    $time=$dateAndTime[1];
    $date=$dateAndTime[0];

    //Bien formatter la date on doit encore l'eclater
    $dateExploded=explode('-',$date);
    $jour=$dateExploded[2];
    $mois=$dateExploded[1];
    $annee=$dateExploded[0];
    $affichage=$jour."/".$mois."/".$annee." a ".$time;
    return $affichage;
}