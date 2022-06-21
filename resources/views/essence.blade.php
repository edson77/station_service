<?php

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


$day=(int)date('d');$year=(int)date('Y');$month = (int)date('m');
$h11 =0;$h22 =0;$h33 =0;$h44 =0;$h55 =0;$h66 =0;$h77 =0;$h88 =0;$h98 =0;$h100 =0;$h111 =0;$h122 =0;
$h133 =0;$h144 =0;$h155 =0;$h166 =0;$h177 =0;$h188 =0;$h199 =0;$h200 =0;$h211 =0;$h222 =0;$h233 =0;$h244 =0;
$h255 =0;$h266 =0;$h277 =0;$h288 =0;$h299 =0;$h300 =0;$h311 =0;
$lundi1 =0; $mardi1=0; $mercredi1 = 0; $jeudi1 = 0; $vendredi1=0; $samedi1=0; $dimanche1=0;
$janvier1=0;$fevrier1=0;$mars1=0;$avril1=0;$mai1=0;$juin1=0;$juillet1=0;$aout1=0;$septembre1=0;$octobre1=0;$novembre1=0;$decembre1=0;
$janvier121=0;$fevrier121=0;$mars121=0;$avril21=0;$mai121=0;$juin121=0;$juillet121=0;$aout121=0;$septembre121=0;$octobre121=0;$novembre121=0;$decembre121=0;

$jours1 =  DB::select("SELECT EXTRACT( YEAR FROM date_jour ) annee,
                      EXTRACT( MONTH FROM date_jour ) mois,
                      EXTRACT( DAY FROM date_jour ) jour,
                      SUM(carburantConsommer) total
                      FROM systeme_de_controle_operations
                      WHERE typeCarburant = 'gazoil'
                      GROUP BY annee, mois,jour");
foreach($jours1 as $test){

    if ((int)$test->mois = (int) date('m')){
        if($test->jour == 1){ $h11= (int)$test->total;}
        if($test->jour == 2){ $h22 = (int)$test->total;}
        if($test->jour == 3){ $h33= (int)$test->total;}
        if($test->jour == 4){ $h44= (int)$test->total;}
        if($test->jour == 5){ $h55= (int)$test->total;}
        if($test->jour == 6){ $h66= (int)$test->total;}
        if($test->jour == 7){ $h77= (int)$test->total;}
        if($test->jour == 8){ $h88= (int)$test->total;}
        if($test->jour == 9){ $h99= (int)$test->total;}
        if($test->jour == 10){ $h100= (int)$test->total;}
        if($test->jour == 11){ $h111= (int)$test->total;}
        if($test->jour == 12){ $h122= (int)$test->total;}
        if($test->jour == 13){ $h133= (int)$test->total;}
        if($test->jour == 14){ $h144= (int)$test->total;}
        if($test->jour == 15){ $h155= (int)$test->total;}
        if($test->jour == 16){ $h166= (int)$test->total;}
        if($test->jour == 17){ $h177= (int)$test->total;}
        if($test->jour == 18){ $h188= (int)$test->total;}
        if($test->jour == 19){ $h199= (int)$test->total;}
        if($test->jour == 20){ $h200= (int)$test->total;}
        if($test->jour == 21){ $h211= (int)$test->total;}
        if($test->jour == 22){ $h222= (int)$test->total;}
        if($test->jour == 23){ $h233= (int)$test->total;}
        if($test->jour == 24){ $h244= (int)$test->total;}
        if($test->jour == 25){ $h255= (int)$test->total;}
        if($test->jour == 26){ $h266= (int)$test->total;}
        if($test->jour == 27){ $h277= (int)$test->total;}
        if($test->jour == 28){ $h288= (int)$test->total;}
        if($test->jour == 29){ $h299= (int)$test->total;}
        if($test->jour == 30){ $h300= (int)$test->total;}
        if($test->jour == 31){ $h311= (int)$test->total;}
    }



}
$semaime11 = $h11 +$h22 + $h33 + $h44 + $h55 +$h66 +$h77 + $h88;
$semaime22 = $h99 + $h100 + $h111 + $h122 + $h133 +$h144 + $h155 + $h166;
$semaime33 = $h177 + $h188 + $h199 + $h200 + $h211 +$h222 +$h233 ;
$semaime44 = $h244 + $h255 + $h266 + $h277 + $h288 + $h299 +$h300 +$h311;

$mois1=  DB::select("SELECT EXTRACT( YEAR FROM date_jour ) annee,
                      EXTRACT( MONTH FROM date_jour ) mois,
                      SUM(carburantConsommer) total
                      FROM systeme_de_controle_operations
                      WHERE typeCarburant = 'gazoil'
                      GROUP BY annee, mois");
foreach($mois1 as $test){

    if ((int)$test->annee = (int) date('Y')){
        if($test->mois == 1){ $janvier1= (int)$test->total;}
        if($test->mois == 2){ $fevrier1 = (int)$test->total;}
        if($test->mois == 3){ $mars1 = (int)$test->total;}
        if($test->mois == 4){ $avril1 = (int)$test->total;}
        if($test->mois == 5){ $mai1 =(int)$test->total;}
        if($test->mois == 6){ $juin1 = (int)$test->total;}
        if($test->mois == 7){ $juillet1 = (int)$test->total;}
        if($test->mois == 8){ $aout1 = (int)$test->total;}
        if($test->mois == 9){ $septembre1 = (int)$test->total;}
        if($test->mois == 10){ $octobre1 = (int)$test->total;}
        if($test->mois == 11){ $novembre1 = (int)$test->total;}
        if($test->mois == 12){ $decembre1 =(int)$test->total;}

    }
}



/*foreach($semaines as $test){

    if ((int)$test->mois = (int) date('m')){
        if($test->heure == 1){ $h1= (int)$test->total;}
        if($test->heure == 2){ $h2 = (int)$test->total;}
        if($test->heure == 3){ $h3= (int)$test->total;}
        if($test->heure == 4){ $h4= (int)$test->total;}
        if($test->heure == 5){ $h5= (int)$test->total;}
        if($test->heure == 6){ $h6= (int)$test->total;}
        if($test->heure == 7){ $h7= (int)$test->total;}

    }



}*/
$trimestre11 = $janvier1 + $fevrier1 + $mars1;
$trimestre22 = $avril1 + $mai1 + $juin1;
$trimestre33 = $juillet1 + $aout1 + $septembre1;
$trimestre44 = $octobre1 + $novembre1 + $decembre1;

//dd($jours);

?>

<script>
    //les vartiables pour le graphe1
    let h11 = <?=$h11?>;
    let h22 = <?=$h22?>;
    let h33 = <?=$h33?>;
    let h44 = <?=$h44?>;
    let h55 = <?=$h55?>;
    let h66 = <?=$h66?>;
    let h77 = <?=$h77?>;
    let h88 = <?=$h88?>;
    let h99 = <?=$h99?>;
    let h100 = <?=$h100?>;
    let h111 = <?=$h111?>;
    let h122 = <?=$h122?>;
    let h133 = <?=$h133?>;
    let h144 = <?=$h144?>;
    let h155 = <?=$h155?>;
    let h166 = <?=$h166?>;
    let h177 = <?=$h177?>;
    let h188 = <?=$h188?>;
    let h199 = <?=$h199?>;
    let h200 = <?=$h200?>;
    let h211 = <?=$h211?>;
    let h222 = <?=$h222?>;
    let h233 = <?=$h233?>;
    let h244 = <?=$h244?>;
    let h255 = <?=$h255?>;
    let h266 = <?=$h266?>;
    let h277 = <?=$h277?>;
    let h288 = <?=$h288?>;
    let h299 = <?=$h299?>;
    let h300 = <?=$h300?>;
    let h311 = <?=$h311?>;

    let semaine11 =<?=$semaime11?>;
    let semaine22 =<?=$semaime22?>;
    let semaine33 =<?=$semaime33?>;
    let semaine44 =<?=$semaime44?>;

    let trimestre11 =<?=$trimestre11?>;
    let trimestre22 =<?=$trimestre22?>;
    let trimestre33 =<?=$trimestre33?>;
    let trimestre44 =<?=$trimestre44?>;

    let janvier1 = <?=$janvier1?>;
    let fevrier1 = <?=$fevrier1?>;
    let mars1 = <?=$mars1?>;
    let avril1 = <?=$avril1?>;
    let mai1 = <?=$mai1?>;
    let juin1 = <?=$juin1?>;
    let juillet1 = <?=$juillet1?>;
    let aout1 = <?=$aout1?>;
    let septembre1 = <?=$septembre1?>;
    let octobre1 = <?=$octobre1?>;
    let novembre1 = <?=$novembre1?>;
    let decembre1 = <?=$decembre1?>;



    //consommation par jour
    new Chart(document.getElementsByClassName("conso-jour-gazoil"), {
        type: 'bar',
        data: {
            labels: ["1", "2", "3", "4", "5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"],
            datasets: [
                {
                    label: "Nombre de litres consommé",
                    backgroundColor: ["#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9","#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9"],
                    data: [h11,h22,h33,h44,h55,h66,h77,h88,h99,h100,h111,h122,h133,h144,h155,h166,h177,h188,h199,h200,h211,h222,h233,h244,h255,h266,h277,h288,h299,h300,h311]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Consommation par jour'
            }
        }
    });

    //consommation par semaine
    new Chart(document.getElementsByClassName("conso-semaine-gazoil"), {
        type: 'bar',
        data: {
            labels: ["semaine 1", "semaine 2", "semaine 3", "semaine 4",],
            datasets: [
                {
                    label: "nombre de litres consommé",
                    backgroundColor: ["#253279", "#b83ac1","#877e28","#bc3838"],
                    data: [semaine11,semaine22,semaine33,semaine44]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Consommation par semaine'
            }
        }
    });


    new Chart(document.getElementsByClassName("consommation-annee-gazoil"), {
        type: 'bar',
        data: {
            labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"],
            datasets: [
                {
                    label: "nombre de litres consommé",
                    backgroundColor: ["#253279", "#2b9131","#877e28","#bc3838","#42c2c6","#b83ac1","#cec460","#180c2b","#1a5720","#523618","##c18adc","#734dc9"],
                    data: [janvier1,fevrier1,mars1,avril1,mai1,juin1,juillet1,aout1,septembre1,octobre1,novembre1,decembre1]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Consommation par an'
            }
        }
    });


    //consommation par trimestre
    new Chart(document.getElementsByClassName("conso-trimestre-gazoil"), {
        type: 'bar',
        data: {
            labels: ["Trimestre 1", "Trimestre 2", "trimestre 3", "Trimestre 4",],
            datasets: [
                {
                    label: "Nombre de litres consommé",
                    backgroundColor: ["#253279", "#b83ac1","#877e28","#bc3838"],
                    data: [trimestre11,trimestre22,trimestre33,trimestre44]
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Consommation/Trimestre'
            }
        }
    });

</script>
