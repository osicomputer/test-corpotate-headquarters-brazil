<?php require_once('header.php'); ?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=VIEW_USERS?></h1>
	</div>
	<div class="content-header-right">
		<a href="user-add.php" class="btn btn-primary btn-sm"><?=ADD_NEW?></a>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th><?=SL?></th>
                    <th><?=PHOTO?></th>
			        <th><?=NAME?></th>
                    <th><?=EMAIL?></th>
			        <th><?=PHONE?></th>
                    <th><?=POSITION?></th>
                    <th><?=BRANCH?></th>
                    <th><?=IS_ACTIVE?></th>
                    <th><?=ACTION?></th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT t1.*, t3.name_up, t2.name status, t4.name_b   FROM tbl_user t1 LEFT JOIN tbl_on_off t2 ON t1.status=t2.id LEFT JOIN tbl_user_position t3 ON t1.id_up=t3.id_up 
                    LEFT JOIN tbl_branch t4 ON t1.id_b=t4.id_b  
                    WHERE t1.id<>0 ORDER BY id DESC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
                    $full_name = $row['full_name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $name_up = $row['name_up'];
                    $status = $row['status'];
                    $photo = $row['photo'];
                    $name_b=$row['name_b'];

                    if (DEFAULT_PHOTO_USER!=$row['photo'])
                        $photo .='?'.rand(); 

            		$i++;
                    if ($email!=='OSICOMPUTER@GMAIL.COM'):
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
                        <td style="width:35px;"><img src="assets/uploads/<?=$photo?>" alt="<?=$full_name; ?>" style="width:30px;"></td>                        
	                    <td><?=$full_name?></td>
                        <td><?=$email?></td>
                        <td><?=$phone?></td>
                        <td><?=$name_up?></td>
                        <td><?=$name_b?></td>
                        <td><?=$status?></td>
	                    <td>
	                        <a href="user-edit.php?id=<?=$row['id'];?>" class="btn btn-primary btn-xs"><?=EDIT?></a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="user-delete.php?id=<?=$row['id'];?>" data-toggle="modal" data-target="#confirm-delete"><?=DELETE?></a>
	                    </td>
	                </tr>
            		<?php
                    endif;
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div>
  

</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?=DELETE_CONFIRMATION?></h4>
            </div>
            <div class="modal-body">
                <p><?=ARE_YOU_SURE_WANT_TO_DELETE_THIS_ITEM?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?=CANCEL?></button>
                <a class="btn btn-danger btn-ok"><?=DELETE?></a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>

<script type="text/javascript">
    $("#example1").DataTable({
        dom: 'PQlfrtip',
        language: {
            "url": "DataTables/es-ES.json"
        },
        /*columnDefs:[
           { visible: false, targets: [5] } 
        ],*/         
        searchPanes: {
            //viewTotal: true,
            cascadePanes: true,
            initCollapsed: true,               
            columns: [5,6], 
            //targets: [5,6]
        },        
    });    
</script>

