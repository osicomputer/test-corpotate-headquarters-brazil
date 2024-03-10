<?php 
//incluir la conexion de base de datos
class ConDesemConsultorRel{
    private $backgroundColor= [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];
    private $borderColor = [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    public function __construct(){
    }
    public function mostrarConsultores(){
        $r='';
        $result = EJECUTAR_CONSULTA_SIMPLE_FILA("SELECT a.co_usuario, a.no_usuario  FROM CAO_USUARIO a INNER JOIN PERMISSAO_SISTEMA b ON a.CO_USUARIO=b.CO_USUARIO WHERE CO_SISTEMA = 1 AND IN_ATIVO = 'S' AND CO_TIPO_USUARIO IN(0,1,2) ORDER BY a.no_usuario");
        foreach ($result as $row) {
            $co_usuario = $row["co_usuario"]; $no_usuario = $row["no_usuario"];
            $r.=  "<option value='{$co_usuario}'>{$no_usuario}</option>";
        }
        return $r;
    }

    public function relatorioConsultores($vconsultores,$mes1,$anio1,$mes2,$anio2){
        $r='';
        $consultores=implode(",", $vconsultores);
        $consultores="'".str_replace(',', "','", $consultores)."'";
        $receita_liquida = "SUM(valor)-(SUM(valor)*(MAX(b.total_imp_inc)/100))";
        $comissao = "(SUM(valor) - ( SUM(valor) * (MAX(b.total_imp_inc)/100) ))*(b.comissao_cn/100)";
        $lucro = "{$receita_liquida} - (MAX(d.brut_salario)+{$comissao})";
        $sql="SELECT c.no_usuario consultores,  CONCAT(UPPER(LEFT(DATE_FORMAT(b.data_emissao, '%M %Y'), 1)), LOWER(SUBSTRING(DATE_FORMAT(b.data_emissao, '%M %Y'), 2))) periodo, {$receita_liquida} receita_liquida, MAX(d.brut_salario) custo_fixo, {$comissao} comissao, {$lucro} lucro FROM CAO_OS a INNER JOIN CAO_FATURA b ON a.co_os=b.co_os INNER JOIN CAO_USUARIO c ON a.co_usuario=c.co_usuario INNER JOIN CAO_SALARIO d ON a.co_usuario=d.co_usuario WHERE a.co_usuario IN ({$consultores}) AND YEAR(b.data_emissao)>={$anio1} AND YEAR(b.data_emissao)<={$anio2} AND MONTH(b.data_emissao)>={$mes1} AND MONTH(b.data_emissao)<={$mes2} GROUP BY c.no_usuario, DATE_FORMAT(b.DATA_EMISSAO, '%M %Y') ORDER BY DATA_EMISSAO";

        $data = EJECUTAR_CONSULTA_SIMPLE_FILA($sql);

        return json_encode($data);
    }


    public function relatorioGrafico($vconsultores,$mes1,$anio1,$mes2,$anio2){
        $r='';
        $consultores=implode(",", $vconsultores);
        $consultores="'".str_replace(',', "','", $consultores)."'";
        $vmeses = ["Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
        $mess=array();
        for ($i=0; $i < count($vmeses); $i++) { 
            $z='0'.($i+1);
            array_push($mess, "SUM(CASE WHEN date_format(b.data_emissao,'%m')='{$z}' THEN valor-(valor*(b.total_imp_inc/100)) ELSE 0 END) AS '{$vmeses[$i]}'");
        }

        $meses=implode(',', $mess);
        $sql="SELECT c.no_usuario consultores,{$meses}
            FROM CAO_OS a LEFT JOIN CAO_FATURA b ON a.co_os=b.co_os LEFT JOIN CAO_USUARIO c ON a.co_usuario=c.co_usuario 
            WHERE a.co_usuario IN ({$consultores}) AND YEAR(b.data_emissao)>={$anio1} AND YEAR(b.data_emissao)<={$anio2} AND MONTH(b.data_emissao)>={$mes1} AND MONTH(b.data_emissao)<={$mes2} GROUP BY c.no_usuario ORDER BY DATA_EMISSAO";

        $sql2="SELECT SUM(brut_salario)/COUNT(co_usuario) AS brut_salario FROM CAO_SALARIO WHERE co_usuario IN ({$consultores})";

        $result  = EJECUTAR_CONSULTA_SIMPLE_FILA($sql);
        $result2 = EJECUTAR_CONSULTA_SIMPLE_FILA($sql2);

        $labels = $vmeses;

        $datasets =array();
        $i=0;
        foreach ($result as $row) {
            $data= array();
            for ($j=0; $j < count($vmeses); $j++)  
                array_push($data, $row[$vmeses[$j]]);
            
            array_push($datasets, array("label"=> "{$row['consultores']}",
            "type"=> "bar",
            "data"=>$data,
            "borderColor"=> "{$this->borderColor[$i]}",
            "backgroundColor"=> "{$this->backgroundColor[$i]}"));
            $i++;
        }

        //Agregar Custo Fixo Médio
        $data= array();
        foreach ($result2 as $row) {
            for ($j=0; $j < count($vmeses); $j++){
                array_push($data, $row['brut_salario']);
            }

            array_push($datasets, array("label"=> "Custo Fixo Médio",
            "type"=> "line",
            "data"=>$data,
            "borderColor"=> "{$this->borderColor[$i]}",
            "backgroundColor"=> "{$this->backgroundColor[$i]}"));            
        }

        $response = json_encode([
          "labels" => $labels,
          "datasets" => $datasets
        ]);

        return $response;
    }    


    public function relatorioPizza($vconsultores,$mes1,$anio1,$mes2,$anio2){
        $r='';
        $consultores=implode(",", $vconsultores);
        $consultores="'".str_replace(',', "','", $consultores)."'";

        $sql="SELECT c.no_usuario consultores, IFNULL(SUM(valor)-(SUM(valor)*(b.total_imp_inc/100)),0) receita_liquida
            FROM CAO_OS a LEFT JOIN CAO_FATURA b ON a.co_os=b.co_os LEFT JOIN CAO_USUARIO c ON a.co_usuario=c.co_usuario 
            WHERE a.co_usuario IN ({$consultores}) AND YEAR(b.data_emissao)>={$anio1} AND YEAR(b.data_emissao)<={$anio2} AND MONTH(b.data_emissao)>={$mes1} AND MONTH(b.data_emissao)<={$mes2} GROUP BY c.no_usuario ORDER BY DATA_EMISSAO";
        
        $result  = EJECUTAR_CONSULTA_SIMPLE_FILA($sql);
        
        $labels = array();
        $datasets = array();
        $dataper = array();
        $total=0;
        $i=0;
        foreach ($result as $row) {
            array_push($labels, $row['consultores']);
            array_push($datasets, $row['receita_liquida']);
            $total+=$row['receita_liquida'];
            /*array_push($datasets, array("data"=>$row['receita_liquida'], 
            "borderColor"=> "{$this->borderColor[$i]}",
            "backgroundColor"=> "{$this->backgroundColor[$i]}"));*/
            $i++;
        }

        /*for ($i=0; $i < count($datasets); $i++) { 
            $datasets
            array_push($dataper, $row['receita_liquida']);
        }*/

        /*array_push($datasets, array("label"=> "{$row['consultores']}",
        //"type"=> "pie",
        "data"=>$data,
        "borderColor"=> "{$this->borderColor[$i]}",
        "backgroundColor"=> "{$this->backgroundColor[$i]}"));*/

        
        $response = json_encode([
          "labels" => $labels,
          "data" => $datasets,
          "dataper" => $datasets,
          "backgroundColor"=> $this->backgroundColor,
          "borderColor"=> $this->borderColor
        ]);

        return $response;
    }
}
 ?>