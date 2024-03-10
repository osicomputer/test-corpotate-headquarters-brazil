<?php require_once('header.php'); ?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=VIEW_ROLES?></h1>
	</div>
	<div class="content-header-right">
		<a href="role-add.php" class="btn btn-primary btn-sm"><?=ADD_NEW?></a>
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
			        <th><?=ROL_NAME?></th>
			        <th><?=ROL_FILE?></th>
			        <th><i class="fa fa-plus"></th>
			        <th><i class="fa fa-edit"></th>
			        <th><i class="fa fa-trash-o"></th>
					<th><?=ACTION?></th>			        	
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT * FROM tbl_roles ORDER BY id_order");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
	                    <td><?php echo $row['name_r']; ?></td>
	                    <td><?php echo $row['file_r']; ?></td>
	                    <td>
	                    	<?php echo $ON_OFF[$row['add_r']]; ?>	
					    </td>
	                    <td><?php echo $ON_OFF[$row['edit_r']]; ?>	</td>
	                    <td><?php echo $ON_OFF[$row['delete_r']]; ?></td>
	                    <td>
	                        <a href="role-edit.php?id=<?php echo $row['id_r']; ?>" class="btn btn-primary btn-xs"><?=$V_ACTION_ICO[1]?></a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="role-delete.php?id=<?php echo $row['id_r']; ?>" data-toggle="modal" data-target="#confirm-delete"><?=$V_ACTION_ICO[2]?></a>
	                    </td>
	                </tr>
            		<?php
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