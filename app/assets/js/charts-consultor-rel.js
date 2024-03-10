
$(document).ready(function() {
    var vmeses = ["Jan", "Fev", "Mar", "Abr", "Maio", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];

    function cargarConsultores(){
        var consultores = [];
        $('#list2').find('option').each(function() {
            consultores.push($(this).val());
        });

        var param = {
            consultores: consultores,
            mes1:  $('[name="select1"]').val(),
            anio1: $('[name="select2"]').val(),
            mes2:  $('[name="select3"]').val(),
            anio2: $('[name="select4"]').val()
        }

        var data=[];
        $.ajax({
            url: "ajax/con_desem_consultor_rel.php?op=Relatorio",
            type: "POST",
            data: param,
            success: function(e) {
                data=JSON.parse(e)

                $('#table-gen').DataTable().destroy();
                var groupColumn = 0;
                var table = 
                $('#table-gen').DataTable({
                    "processing": true,
                    "data":data,
                    "columnDefs": [{ visible: false, targets: groupColumn }],
                    order: [[groupColumn, 'asc']],
                    displayLength: 25,
                    drawCallback: function (settings) {
                        var api = this.api();
                        var rows = api.rows( {page:'all'} ).nodes();
                        var last=null;
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ? i : 0;
                        };
                        
                        total=[]; total2=[]; total3=[]; total4=[];
                        api.column(0, {page:'all'} ).data().each( function ( group, i ) {
                            group_assoc=group.replaceAll(' ',"_");
                            group_assoc2=group.replaceAll(' ',"_")+'2';
                            group_assoc3=group.replaceAll(' ',"_")+'3';
                            group_assoc4=group.replaceAll(' ',"_")+'4';

                            //console.log(group_assoc);

                            if(typeof total[group_assoc] != 'undefined'){
                                total[group_assoc]=total[group_assoc]+intVal(api.column(2).data()[i]);
                                total2[group_assoc2]=total2[group_assoc2]+intVal(api.column(3).data()[i]);
                                total3[group_assoc3]=total3[group_assoc3]+intVal(api.column(4).data()[i]);
                                total4[group_assoc4]=total4[group_assoc4]+intVal(api.column(5).data()[i]);
                            }else{
                                total[group_assoc]=intVal(api.column(2).data()[i]);
                                total2[group_assoc2]=intVal(api.column(3).data()[i]);
                                total3[group_assoc3]=intVal(api.column(4).data()[i]);
                                total4[group_assoc4]=intVal(api.column(5).data()[i]);
                            }
                            
                            if ( last !== group ) {
                                $(rows).eq( i ).before(
                                '<tr class="group"><td colspan="1"><b>'+group+'</b><td class="'+group_assoc+' align-right"></td><td class="'+group_assoc2+' align-right"></td><td class="'+group_assoc3+' align-right"></td><td class="'+group_assoc4+' align-right"></td></tr>'
                                );
                                last = group;
                            }
                        });
                        for(var key in total) {
                            $("."+key).html("<b>"+formatCurrencyBR(total[key])+"</b>");
                        }

                        for(var key in total2) {
                            $("."+key).html("<b>"+formatCurrencyBR(total2[key])+"</b>");
                        }

                        for(var key in total3) {
                            $("."+key).html("<b>"+formatCurrencyBR(total3[key])+"</b>");
                        }

                        for(var key in total4) {
                            $("."+key).html("<b>"+formatCurrencyBR(total4[key])+"</b>");
                        }

                    },            
                    "columns": [
                    { data: "consultores" },
                    { data: "periodo" },
                    { data: "receita_liquida", className: "align-right", render: $.fn.dataTable.render.number( '.', ',', 2, "R$ " ) },
                    { data: "custo_fixo", className: "align-right", render:$.fn.dataTable.render.number( '.', ',', 2, "R$ "  )  },
                    { data: "comissao", className: "align-right", render: $.fn.dataTable.render.number( '.', ',', 2, "R$ "  )  },
                    { data: "lucro", className: "align-right", render: $.fn.dataTable.render.number( '.', ',', 2, "R$ "  ) }
                    ],
                });                      
        },
        error: function() {
            console.log("There was a problem with the request.")
        }
    });
}

cargarConsultores();

function formatDateBR(date) {
    var d = new Date(date);
    var dd = d.getDate().toString().padStart(2, '0');
    var mm = (d.getMonth() + 1).toString().padStart(2, '0');
    var yyyy = d.getFullYear();
    return dd + '/' + mm + '/' + yyyy;
}

function formatCurrencyBR(amount) {
    var data = amount.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    return data;
}


function cargarGrafico(){
    var consultores = [];
    $('#list2').find('option').each(function() {
        consultores.push($(this).val());
    });

    var param = {
        consultores: consultores,
        mes1:  $('[name="select1"]').val(),
        anio1: $('[name="select2"]').val(),
        mes2:  $('[name="select3"]').val(),
        anio2: $('[name="select4"]').val()
    }

    var data=[];
    $.ajax({
        url: "ajax/con_desem_consultor_rel.php?op=Grafico",
        type: "POST",
        data: param,
        dataType: "json",
        success: function(data) {
            var chart = new Chart($("#myChart"), {
              type: 'bar',
              data: {
                labels: data.labels,
                datasets: data.datasets
            },
            options: {
                title: {
                  display: true,
                  text: vmeses[param.mes1] + ' de '+  param.anio1 + ' a ' + vmeses[param.mes2] + ' de '+  param.anio2
              },
              legend: {
                display: true,
                position: 'bottom'
            }, 
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label;
                        var value = 0, total = 0;
                        var value = parseFloat(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
                        return label + ': ' + formatCurrencyBR(value);
                    }
                }
            },                  

            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value) {
                    return formatCurrencyBR(value);
                }                              
            }
        }]
    }
}
});
},error: function() {
    console.log("There was a problem with the request.")
}

});
}

function cargarPizza(){
    var consultores = [];
    $('#list2').find('option').each(function() {
        consultores.push($(this).val());
    });
    

    var param = {
        consultores: consultores,
        mes1:  $('[name="select1"]').val(),
        anio1: $('[name="select2"]').val(),
        mes2:  $('[name="select3"]').val(),
        anio2: $('[name="select4"]').val()
    }
    

    $.ajax({
        url: "ajax/con_desem_consultor_rel.php?op=Pizza",
        method: "POST",
        data: param,
        dataType: "json",
        success: function(data) {
            var chart = new Chart($("#myChart2"), {
                type: 'pie',
                data: {
                    labels: data.labels,
                    datasets: [{
                        data: data.data,
                        backgroundColor: data.backgroundColor,
                        borderColor: data.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: vmeses[param.mes1] + ' de '+  param.anio1 + ' a ' + vmeses[param.mes2] + ' de '+  param.anio2
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index];
                                var value = 0, total = 0;
                                var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                for (var i = 0; i < data.datasets[tooltipItem.datasetIndex].data.length; i++) {
                                    total+=parseFloat(data.datasets[tooltipItem.datasetIndex].data[i]);
                                }
                                value = parseFloat(value);
                                var percentage = ((value / total)*100).toFixed(2) + '%';
                                return label + ': ' + formatCurrencyBR(value) + ' (' + percentage + ')';
                            }
                        }
                    },                  
                    /*plugins: {
                        labels: {
                            render: 'percentage',
                            fontColor: '#000',
                            precision: 2
                        },
                        datalabels: {
                            color: '#000',
                            anchor: 'center',
                            align: 'center',
                            formatter: function(value, context) {
                                return value + '%';
                            }
                        }              
                    }*/
                }
            });
        }
    });

}



$("#btn-1").click(function (event) {
    $("#li_tab_r1").addClass('active');
    $("#li_tab_r1").show(); $("#tab_r1").show(); 
    $("#li_tab_r2").hide(); $("#tab_r2").hide(); 
    $("#li_tab_r3").hide(); $("#tab_r3").hide();  
    cargarConsultores();
});

$("#btn-2").click(function (event) {
    $("#li_tab_r2").addClass('active');
    $("#li_tab_r1").hide(); $("#tab_r1").hide(); 
    $("#li_tab_r2").show(); $("#tab_r2").show(); 
    $("#li_tab_r3").hide(); $("#tab_r3").hide();
    cargarGrafico();
});

$("#btn-3").click(function (event) {
    $("#li_tab_r3").addClass('active');
    $("#li_tab_r1").hide(); $("#tab_r1").hide(); 
    $("#li_tab_r2").hide(); $("#tab_r2").hide(); 
    $("#li_tab_r3").show(); $("#tab_r3").show();
    cargarPizza();
});
});
