<!-- DATA TABLE -->
<?php require_once("main_config.php");?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.4.2/css/searchBuilder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.0/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">

</head>
<body>
    <table id="example1" class="display">
        <thead>
            <tr>
                <th width="30"><?=SL?></th>
                <th><?=BRANCH_NAME?></th>
                <th class="align-right"><?=BILLING_START?></th>
                <th class="align-right"><?=BILLING_END?></th>
                <!-- <th><?=ACTION?></th> -->
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.4.2/js/dataTables.searchBuilder.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.0/js/dataTables.dateTime.min.js"></script> 
    <script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script> 
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script> 

    <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script> 
</body>
</html>



<style type="text/css">
    table.dataTable td > i {
        margin-left: 0.5em;
        opacity: 0.3;
        float: right;
        cursor: pointer;
    }    
</style>

<script type="text/javascript">
var editor; 
$(function () {

    editor = new $.fn.dataTable.Editor( {
        ajax: "settings-billing-view.php",
        table: "#example1",
        fields: [ {
                label: "Id:",
                name: "id_b"
            }, {
                label: "Name:",
                name: "name_b"
            }, {
                label: "Position:",
                name: "position"
            }, {
                label: "Inicio:",
                name: "billing_begin"
            }, {
                label: "Fin:",
                name: "billing_begin"
            }
        ]
    } );


    var editIcon = function ( data, type, row ) {
        if ( type === 'display' ) {
            return data + ' <i class="fa fa-pencil"/>';
        }
        return data;
    };

    /*$('#example tbody').on( 'click', 'td i', function (e) {
        e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
 
        editor.inline( $(this).parent() );
    } );*/
 



    $('#example1').DataTable({
        language: {
            "url": "DataTables/es-ES.json"
        },
        //dom: 'Pfrtip',
        //dom: 'QBfrtip',
        dom: 'Bfrtip',
        ajax: {
            url: "settings-billing-view.php",
            type: "POST",
            data: {edit: 0, del: 0}
        },   
        columns: [
            { data: 'id_b' },
            { data: 'name_b' },
            { data: 'billing_begin', className: "align-right" , render: editIcon},
            { data: 'billing_end', className: "align-right", render: editIcon },
        ],
        select: true,
        processing: true,
        serverSide: true,

    
    });
});

</script>
<!-- END DATA TABLE -->





<!-- FORM SUBMIT -->
<?php
/*require_once("header.php");


if (isset($_POST['form1'])) {
    $statement = $pdo->prepare("SELECT * FROM tbl_type_billing");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $type_billing=1;
    foreach ($result as $row) {
        $id=$row['id'];
        $name_tb = 'type_billing'.$id;
        echo $name_tb .'<br>';
        if (isset($_POST[$name_tb])){
            $type_billing=$id;

        }
        unset($_POST[$name_tb]);
    }
    
    echo $type_billing .'<br>';
    //echo 'FIN';
}*/
/*date_default_timezone_set('America/Caracas');
$miFecha= gmmktime(12,0,0,1,15,2089);

setlocale(LC_ALL, 'es_VE.UTF-8');

echo 'Después de setlocale es_ES.UTF-8 strftime devuelve: '.strftime("%A, %d de %B de %Y %H:%M", $miFecha).'<br/>';

echo 'Fecha actual: '.strftime("%A, %d de %B de %Y %H:%M").'<br/>';

date_default_timezone_set ('Europe/Madrid');

echo 'Establecida zona horaria Europe/Madrid obtenemos: '.strftime("%A, %d de %B de %Y %H:%M", $miFecha).'<br/>';

echo 'Ahora fecha actual es: '.strftime("%A, %d de %B de %Y %H:%M").'<br/>';*/


?>


<!-- <h2>HTML Forms</h2>

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>

  <div class="col-sm-12">                
    <div class="form-group">
        <label for="" class="col-xs-2 col-sm-2 col-md-2 control-label"><?=BILLING_TYPE?></label>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="btn-group" data-toggle="buttons">
                <?php
                $statement = $pdo->prepare("SELECT * FROM tbl_type_billing");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $i=0;
                foreach ($result as $row) {
                    $name_tb='type_billing'. $row['id'];
                    echo '<label  class="btn btn-default">
                    <input id="'.$name_tb.'" name="'. $name_tb.'" type="radio">'. $row['name'].'
                    </label>';
                    $i++;
                }
                ?>                            
            </div>
        </div>
    </div>
 </div>

  <input type="submit" name="form1" value="Submit">



</form>  -->


<?php //require_once('footer.php'); ?>
<!-- END FORM SUBMIT -->




