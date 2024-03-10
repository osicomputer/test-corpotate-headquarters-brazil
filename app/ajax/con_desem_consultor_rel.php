<?php 
    require_once("../main_config.php");
    $consultores=isset($_POST["consultores"])? $_POST["consultores"]:[];
    $mes1=isset($_POST["mes1"])? $_POST["mes1"]:1;
    $anio1=isset($_POST["anio1"])? $_POST["anio1"]:0;
    $mes2=isset($_POST["mes2"])? $_POST["mes2"]:1;
    $anio2=isset($_POST["anio2"])? $_POST["anio2"]:0;

    switch ($_GET["op"]) {
        case 'Relatorio':
            $r='';
            echo  $cdcr->relatorioConsultores($consultores,$mes1,$anio1,$mes2,$anio2);
            break;
        case 'Grafico':
            echo  $cdcr->relatorioGrafico($consultores,$mes1,$anio1,$mes2,$anio2);
            break;
        case 'Pizza':
            echo  $cdcr->relatorioPizza($consultores,$mes1,$anio1,$mes2,$anio2);
            break;
    }
 ?>