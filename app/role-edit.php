<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['name_r']) || empty($_POST['file_r'])) {
        $valid = 0;
        $error_message .= ROLE_NAME_CANNOT_BE_EMPTY ."<br>";
    } else {
		// Duplicate Top Category checking
    	// current Top Category name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_roles WHERE id_r=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$name_r = $row['name_r'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_roles WHERE name_r=? and name_r!=?");
    	$statement->execute(array($_POST['name_r'],$name_r));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= ROLE_NAME_ALREADY_EXISTS .'<br>';
    	}
    }

    if($valid == 1) {    	

    	$total=count($V_ACTION);	
		for ($i=0; $i < $total; $i++) {
			if (isset($_POST['ck_'.$i]))
				$V_ACTION_VALUE[$i] = 1;
			else
				$V_ACTION_VALUE[$i] = 0;
		} 

		// updating into the database
		$statement = $pdo->prepare("UPDATE tbl_roles SET name_r=?, file_r=?, add_r=?, edit_r=?, delete_r=?  WHERE id_r=?");
		$statement->execute(array($_POST['name_r'],$_POST['file_r'],$V_ACTION_VALUE[0],$V_ACTION_VALUE[1],$V_ACTION_VALUE[2],$_REQUEST['id']));

    	$success_message = THE_ROLE_WAS_SUCCESSFULLY_UPDATED.'.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_roles WHERE id_r=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=EDIT_ROLE?></h1>
	</div>
	<div class="content-header-right">
		<a href="role.php" class="btn btn-primary btn-sm"><?=VIEW_ALL?></a>
	</div>
</section>


<?php			
$total=count($V_ACTION);				
foreach ($result as $row) {
	$name_r = $row['name_r'];
	$file_r = $row['file_r'];
	$V_ACTION_VALUE[0] = $row['add_r'];
	$V_ACTION_VALUE[1] = $row['edit_r'];
	$V_ACTION_VALUE[2] = $row['delete_r'];
}
?>

<section class="content">

  <div class="row">
    <div class="col-md-12">

		<?php if($error_message): ?>
		<div class="callout callout-danger">
		
		<p>
		<?php echo $error_message; ?>
		</p>
		</div>
		<?php endif; ?>

		<?php if($success_message): ?>
		<div class="callout callout-success">
		
		<p><?php echo $success_message; ?></p>
		</div>
		<?php endif; ?>

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"><?=ROL_NAME?> <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="name_r" onblur="upperCase(this)" value="<?php echo $name_r; ?>">
                    </div>
                </div>

				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><?=ROL_FILE?> <span>*</span></label>
					<div class="col-sm-4">
						<textarea class="form-control" name="file_r" rows="8" cols="50"><?php echo $file_r; ?></textarea>
					</div>
				</div>    
				            
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"><?=ACTION?></label>
				<?php
				//echo $total;
				for ($i=0; $i < $total; $i++) { 
					$selected="";
					if ($V_ACTION_VALUE[$i]==1)
						$selected="checked";

				?>
					<div class="col-sm-1">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="ck_<?=$i?>" class="form-check-input" name="ck_<?=$i?>" <?=$selected?> > <?=$V_ACTION_ICO_CHECK[$i]?>
							</label>
						</div>
					</div>
				<?php
				}
				?>
				</div>
                <div class="form-group">
                	<label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-success pull-left" name="form1"><?=UPDATE?></button>
                    </div>
                </div>

            </div>

        </div>

        </form>



    </div>
  </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>