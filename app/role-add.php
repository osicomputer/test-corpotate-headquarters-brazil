<?php require_once('header.php'); ?>

<?php

$total=count($V_ACTION);

if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['name_r']) || empty($_POST['file_r']) ) {
        $valid = 0;
        $error_message .= ROLE_NAME_CANNOT_BE_EMPTY."<br>";
    } else {
    	// Duplicate Category checking
    	$statement = $pdo->prepare("SELECT * FROM tbl_roles WHERE name_r=?");
    	$statement->execute(array($_POST['name_r']));
    	$total = $statement->rowCount();
    	if($total)
    	{
    		$valid = 0;
        	$error_message .= ROLE_NAME_ALREADY_EXISTS."<br>";
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
		
		// Saving data into the main table tbl_top_category
		$statement = $pdo->prepare("INSERT INTO tbl_roles (name_r, file_r, add_r, edit_r, delete_r, id_order) VALUES (?,?,?,?,?,?)");
		$statement->execute(array($_POST['name_r'], $_POST['file_r'], $V_ACTION_VALUE[0], $V_ACTION_VALUE[1], $V_ACTION_VALUE[2], $total+1));
	
    	$success_message = THE_ROLE_WAS_ADDED_SUCCESSFULLY.'.';
    }

	$total=count($V_ACTION);
}




?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=ADD_ROLE?></h1>
	</div>
	<div class="content-header-right">
		<a href="role.php" class="btn btn-primary btn-sm"><?=VIEW_ALL?></a>
	</div>
</section>


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
								<input type="text" class="form-control" name="name_r" onblur="upperCase(this)">
							</div>
						</div>
				
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"><?=ROL_FILE?> <span>*</span></label>
							<div class="col-sm-4">
								<textarea class="form-control" name="file_r" rows="8" cols="50"></textarea>
							</div>
						</div>

						<div class="form-group">
							<input type="number" name="total_ck" id="total_ck" value="<?=$total?>" hidden>
							<label for="" class="col-sm-2 control-label"><?=ACTION?></label>
						<?php
						//echo $total;
						for ($i=0; $i < $total; $i++) { 
							$name= "ck_". $i;
						?>
							<div class="col-sm-1">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="<?=$name?>" class="form-check-input" name="<?=$name?>" value="true" checked> <?=$V_ACTION_ICO_CHECK[$i]?>
									</label>
								</div>
							</div>
						<?php
						}
						?>
						</div>
						<!-- <script type="text/javascript">
							var total = document.getElementById("total_ck").value;
							for (var i = 0; i < total; i++) {
								document.getElementById("ck_"+i).checked=true;
							}
						</script> -->

						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1"><?=SUBMIT?></button>
							</div>
						</div>
					</div>
				</div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>