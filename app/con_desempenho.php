<?php 
require_once('header.php'); 
?>


<SCRIPT language="JavaScript">
    function move(fbox, tbox) {
        var arrFbox = new Array();
        var arrTbox = new Array();
        var arrLookup = new Array();
        var i;
        for (i = 0; i < tbox.options.length; i++) {
            arrLookup[tbox.options[i].text] = tbox.options[i].value;
            arrTbox[i] = tbox.options[i].text;
        }
        var fLength = 0;
        var tLength = arrTbox.length;
        for(i = 0; i < fbox.options.length; i++) {
            arrLookup[fbox.options[i].text] = fbox.options[i].value;
            if (fbox.options[i].selected && fbox.options[i].value != "") {
                arrTbox[tLength] = fbox.options[i].text;
                tLength++;
            }
            else {
                arrFbox[fLength] = fbox.options[i].text;
                fLength++;
            }
        }
        arrFbox.sort();
        arrTbox.sort();
        fbox.length = 0;
        tbox.length = 0;
        var c;
        for(c = 0; c < arrFbox.length; c++) {
            var no = new Option();
            no.value = arrLookup[arrFbox[c]];
            no.text = arrFbox[c];
            fbox[c] = no;
        }
        for(c = 0; c < arrTbox.length; c++) {
            var no = new Option();
            no.value = arrLookup[arrTbox[c]];
            no.text = arrTbox[c];
            tbox[c] = no;
        }
    }


    function MM_openBrWindow(theURL,winName,features) { //v2.0
      window.open(theURL,winName,features);
    }

</script>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1>Financiero</h1>
	</div>
	<div class="content-header-right">
    </div>	
</section>


<section class="content">
<div class="row">
        <div class="col-md-12">
                            
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Por Consultor</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Por Cliente</a></li>
                    </ul>
                    <style type="text/css">
                        .mp0{
                            margin: 1px  !important;
                            padding: 1px !important;
                        }

                        .mp1{
                            margin-top: 0.6em !important; 
                        }                        
                        .center-v{
                            /*display: flex;
                            align-items: center;*/
                        }
                    </style>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box box-info">
                                <div class="box-body">      
                                <form class="form-horizontal " action="" method="">     
                                    <div class="form-group center-v">
                                        <label class="col-sm-1 control-label mp0 mp1" >Período</label>
                                        <div class="col-12 col-xs-12 col-sm-2 col-md-2 mp0" >
                                            <select style="width: 100%;" name="select1" class="form-control mp0 select2">
                                                <option value="1">Jan</option>
                                                <option value="2">Fev</option>
                                                <option value="3">Mar</option>
                                                <option value="4">Abr</option>
                                                <option value="5">Mai</option>                        
                                                <option value="6">Jun</option>
                                                <option value="7">Jul</option>
                                                <option value="8">Ago</option>
                                                <option value="9" selected>Set</option> 
                                                <option value="10">Out</option>                          
                                                <option value="11">Nov</option>
                                                <option value="12">Dez</option>
                                            </select>                                           
                                        </div>

                                        <div class="col-12 col-xs-12 col-sm-2 col-md-2 mp0" >
                                            <select style="width: 100%;" name="select2" class="form-control mp0 select2">
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005">2005</option>
                                                <option value="2006">2006</option>
                                                <option value="2007" selected>2007</option>                        
                                            </select>                                           
                                        </div>

                                        <label class="col-12 col-xs-12 col-sm-2 col-md-2 control-label  mp0 mp1" style="width: 10px;">a</label>
                                        <div class=" col-12 col-xs-12 col-sm-2 col-md-2 mp0" >
                                            <select style="width: 100%;" name="select3" class="form-control mp0 select2">
                                                <option value="1">Jan</option>
                                                <option value="2">Fev</option>
                                                <option value="3">Mar</option>
                                                <option value="4">Abr</option>
                                                <option value="5">Mai</option>                        
                                                <option value="6">Jun</option>
                                                <option value="7">Jul</option>
                                                <option value="8">Ago</option>
                                                <option value="9" selected>Set</option> 
                                                <option value="10">Out</option>                          
                                                <option value="11">Nov</option>
                                                <option value="12">Dez</option>
                                            </select>                                           
                                        </div>

                                        <div class="col-12 col-xs-12 col-sm-2 col-md-2 mp0" >
                                            <select style="width: 100%;" name="select4" class="form-control mp0 select2">
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005">2005</option>
                                                <option value="2006">2006</option>
                                                <option value="2007" selected>2007</option>                        
                                            </select>                                           
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-1 control-label mp0 mp1" >Consultores</label>
                                        <div class="col-12 col-xs-12 col-sm-3 col-md-3 mp0" >
                                            <select multiple size="8" class="form-control" name="list1"  id="list1">
                                                <?=$cdcr->mostrarConsultores()?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-xs-12 col-sm-2 col-md-2 mp0 align-center" style="margin-top: 4%!important; margin-bottom: 20px !important;" >
                                            <input name="button" type="button" class="btn btn-dark" onClick="move(list2,list1)" value="<<">
                                            <input name="button" type="button" class="btn btn-dark" onClick="move(list1,list2)" value=">>">                                                
                                        </div>

                                        <div class="col-12 col-xs-12 col-sm-3 col-md-3 mp0" >
                                            <select multiple size="8" class="form-control" name="list2" id="list2" >
                                            </select>
                                            <input type="hidden"  name="lista_analista" value="">
                                        </div>

                                    </div>

                                    <div class="col-sm-12 " style="margin-top: 10px; display: flex; justify-content: end;">
                                        <button type="button" id="btn-1" class="btn btn-primary pull-left" style="width: 150px; margin-right: 5px;">Relatório</button>               
                                        <button type="button" id="btn-2" class="btn btn-primary pull-left" style="width: 150px; margin-right: 5px;">Gráfico</button>               
                                        <button type="button" id="btn-3" class="btn btn-primary pull-left" style="width: 150px; margin-right: 5px;" >Pizza</button>               

                                    </div>
                                </form>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_2">
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li id="li_tab_r1" class="active"><a href="#tab_r1" data-toggle="tab">Relatório</a></li>
            <li id="li_tab_r2"><a href="#tab_r2" data-toggle="tab">Gráfico</a></li>
            <li id="li_tab_r3"><a href="#tab_r3" data-toggle="tab">Pizza</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_r1">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <div class="box-body table-responsive">
                                <table id="table-gen" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Consultores</th>
                                            <th>Período</th>
                                            <th>Receita Líquida</th>
                                            <th>Custo Fixo</th>
                                            <th>Comissão</th>
                                            <th>Lucro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab_r2">
                <div class="container">
                    <h1 align="center">Performance Comercial</h1>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>                
            </div>

            <div class="tab-pane" id="tab_r3">
                <div class="container">
                    <h1 align="center">Participacao na Recetia liquida</h1>
                    <canvas id="myChart2" width="400" height="200"></canvas>
                </div>                
            </div>
        </div>
    </div>

</section>


<?php require_once('footer.php'); ?>

