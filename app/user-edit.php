<?php require_once('main_config.php'); ?>
<?php
$photo='user-0.png';

if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['email'])) {
        $valid = 0;
        $error_message .=  USERNAME_CANNOT_BE_EMPTY ."<br>";
    } else {
		// Duplicate Top Category checking
    	// current Top Category name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_email = $row['email'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? and email!=?");
    	$statement->execute(array($_POST['email'],$current_email));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= USERNAME_ALREADY_EXISTS .'<br>';
    	}
    }

    if($valid == 1) {    	
		$billing_type='';
		if(isset($_POST['billing_type'])) {
			foreach($_POST['billing_type'] as $value) {
				$billing_type.=$value.'|';
			}
			$billing_type=substr($billing_type, 0, strlen($billing_type)-1 );
		}


		$status_session=$_POST['status_session'];
		if ($_SESSION['user']['id']!=$_REQUEST['id'])
			$status_session=0;

		$statement = $pdo->prepare("UPDATE tbl_user SET full_name=?, birth_date=?, email=?, email_company=?, phone=?, photo=?, role=?, roles=?, roles_action=?, billing_type=?, status=?, status_session=?,id_b=?, id_up=? WHERE id=?");
		$statement->execute(array($_POST['full_name'],$_POST['birth_date'], $_POST['email'], $_POST['email_company'],$_POST['phone'], $photo, $_POST['role'], $_POST['roles'],$_POST['roles_action'], $billing_type, $_POST['status'], $status_session, $_POST['id_b'], $_POST['id_up'],$_REQUEST['id']));

		if ($_SESSION['user']['id']==$_REQUEST['id']){
			$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
			$statement->execute(array($_REQUEST['id']));
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			$_SESSION['user'] = $result[0];
		}

    	$success_message = USER_UPDATED_SUCCESSFULLY .'.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php require_once('header.php'); ?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=EDIT_USER?></h1>
	</div>
	<div class="content-header-right">
		<a href="user.php" class="btn btn-primary btn-sm"><?=VIEW_ALL?></a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$full_name = $row['full_name'];
	$identification_card_type= $row['identification_card_type'];
	$identification_card= $row['identification_card'];
	$birth_date = $row['birth_date'];
	$email = $row['email'];
	$email_company = $row['email_company'];
	$phone = $row['phone'];
	$role = $row['role'];
	$roles = $row['roles'];
	$roles_action = $row['roles_action'];
	$vroles = explode("|", $row['roles']);
	$vroles_action = explode("|", $row['roles_action']);
	$billing_type = explode("|", $row['billing_type']);
	$status = $row['status'];
	$status_session = $row['status_session'];
	$id_b = $row['id_b'];
	$id_up = $row['id_up'];

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

				<div class="col-sm-6">

					<div class="form-group" style="display: none;">
						<label for="" class="col-sm-4 control-label"></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="status_session" value="<?php echo $status_session; ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><?=BRANCH?> <span>*</span></label>
						<div class="col-sm-8" >
							<select style="width: 100%;" name="id_b" class="form-control select2 top-cat">
							<?php
						    	$statement = $pdo->prepare("SELECT * FROM tbl_branch");
								//$statement->execute(array($_SESSION['user']['id']));
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								foreach($result as $row) {
									$id=$row['id_b'];
									$name=$row['name_b'];
									$selected="";
									if ($id_b == $id)
										$selected="selected";
							?>
								<option value="<?=$id?>" <?=$selected?>><?=$name?></option>
							<?php
								}
							?>
	                        </select>											
						</div>
					</div>


					<div class="form-group">
		                <label for="" class="col-sm-4 control-label"><?=IDENTIFICATION_CARD?> <span>*</span></label>
		                <div class="col-sm-2">
		                    <select id="identification_card_type" name="identification_card_type" class="form-control select2">
		                        <!-- <option value="">Select type</option> -->
							<?php
						    	$statement=$pdo->prepare("SELECT * FROM tbl_type_id WHERE id IN (1,2)");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								foreach($result as $row) {
									$name=$row['name'];
									$selected="";
									if ($identification_card_type == $name)
										$selected="selected";
							?>
								<option value="<?=$name?>" <?=$selected?>><?=$name?></option>
							<?php
								}
							?>
		                    </select>

		                </div>                            
		                <div class="col-sm-6" >
		                    <input type="number" id="identification_card" class="form-control" placeholder="" name="identification_card" value="<?=$identification_card?>" required>
		                </div>
		            </div>

					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><?=NAME?> <span>*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="full_name" onblur="upperCase(this)" value="<?php echo $full_name; ?>" required>
						</div>
					</div>

					<div class="form-group">
			            <label for="" class="col-sm-4 control-label"><?=BIRTHDATE?> <span>*</span></label>
			            <div class="col-sm-8" >
							<input type="date" class="form-control" name="birth_date" value="<?=$birth_date?>" required>

			            </div>
					</div>

					<div class="form-group" style="display: none">
			            <label for="" class="col-sm-4 control-label"><?=EXISTING_PHOTO?> </label>
			            <div class="col-sm-8" style="padding-top:6px;">
			                <img src="assets/uploads/<?php echo $photo; ?>" class="existing-photo" width="140">
			            </div>
			        </div>
					
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><?=EMAIL_ADDRESS?> <span>*</span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" name="email" onblur="upperCase(this)" value="<?php echo $email; ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><?=COMPANY_EMAIL?> <span>*</span></label>
						<div class="col-sm-8">
							<input type="email_company" class="form-control" name="email_company" onblur="upperCase(this)" value="<?php echo $email_company; ?>" required>
						</div>
					</div>	
									
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><?=PHONE?> <span>*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="phone" name="phone" onblur="upperCase(this)"value="<?php echo $phone; ?>" required>
						</div>
					</div>

					<div class="form-group" >
						<label for="" class="col-sm-4 control-label"><?=POSITION?> <span>*</span></label>
						<div class="col-sm-8">
							<select style="width: 100%;" name="id_up" class="form-control select2 top-cat">
							<?php
						    	$statement = $pdo->prepare("SELECT * FROM tbl_user_position");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								foreach($result as $row) {
									$id=$row['id_up'];
									$name=$row['name_up'];
									$selected="";
									if ($id_up == $id)
										$selected="selected";									
							?>
								<option value="<?=$id?>"  <?=$selected?>><?=$name?></option>
							<?php
								}
							?>
	                        </select>											
						</div>
					</div>


					<div class="form-group" hidden>
						<label for="" class="col-sm-4 control-label"><?=BILLING_TYPE?> <span>*</span></label>
						<div class="col-sm-8">
							<select style="width: 100%;" name="billing_type[]" class="form-control select2" multiple="multiple">
							<?php
						    	$statement = $pdo->prepare("SELECT * FROM tbl_type_billing");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								foreach($result as $row) {
									$id=$row['id'];
									$name=$row['name'];

									if(isset($billing_type)) {
										if(in_array($row['id'],$billing_type)) {
											$is_select = 'selected';
										} else {
											$is_select = '';
										}
									}
							?>
								<option value="<?=$id?>" <?=$is_select;?>><?=$name?></option>
							<?php
								}
							?>
	                        </select>											
						</div>
					</div>


					<div class="form-group" style="display: none;">
						<label for="" class="col-sm-4 control-label"><?=ROLE?> <span>*</span></label>
						<div class="col-sm-8" style="padding-top:7px;">
							<select style="width: 100%;" name="role" class="form-control select2 top-cat">
	                            <option value="Super Admin">Super Admin</option>
	                            <option value="Admin">Admin</option>
	                            <option value="ATM" selected>ATM</option>
	                        </select>											
							<?php //echo $role; ?>
						</div>
					</div>
					<div class="form-group" style="display: none;">
						<label for="" class="col-sm-4 control-label"><?=PASSWORD?> </label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="password" name="password" value="<?php //echo $phone; ?>">
						</div>
					</div>		


					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><?=IS_ACTIVE?></label>
						<div class="col-sm-8">
							<select name="status" class="form-control" style="width:auto;">
								<option value="0" <?php if($status == '0'){echo 'selected';} ?>><?=NO?></option>
								<option value="1" <?php if($status == '1'){echo 'selected';} ?>><?=YES?></option>
							</select> 
						</div>
					</div>							
				</div>

				<div class="col-sm-6">
					<div class="form-group" style="display: none;">
						<label for="" class="col-sm-4 control-label"><?=ROLES?> </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="roles" name="roles" value="<?php echo $roles; ?>">
						</div>
					</div>		
					<div class="form-group" style="display: none;">
						<label for="" class="col-sm-4 control-label"><?=ROLES . ' ' . ACTION?> </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="roles_action" name="roles_action" value="<?php echo $roles_action; ?>">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12" >
							<?php
						    	$statement = $pdo->prepare("SELECT * FROM tbl_roles ORDER BY id_order");
								//$statement->execute(array($_SESSION['user']['id']));
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);
								$total = $statement->rowCount();
							?>

							<table id="example3" class="table table-bordered table-striped">
								<thead>
								    <tr>
								        <th>
						                    <div class="checkbox">
							                    <label>
							                        <input type="checkbox" id="rol_all"  onchange="selectedAllRoles(this, <?=$total?>)" class="form-check-input" name="rol_all" > <?=SELECT_ALL?>
							                    </label>
						                    </div>
								        </th>
								        <th class="align-center"><?=$V_ACTION_ICO[0]?></th>
								        <th class="align-center"><?=$V_ACTION_ICO[1]?></th>
								        <th class="align-center"><?=$V_ACTION_ICO[2]?></th>
								    </tr>
								</thead>
					            <tbody>

								<?php
									$i=0; $j=0;
									foreach($result as $row) {
										$id=$row['id_r'];
										$name=$row['name_r'];
										$selected=""; $selected_add=""; $selected_edit="";
										$selected_del="";
										//echo 'CK=' . COUNT($vroles) . '=>' . strlen(array_search($id, $vroles));
										$idx=array_search($id, $vroles); 
										$len=strlen($idx);
										if ($len>0){
											$selected="checked";	
											if (count($vroles_action)>1){
												$vaction =  explode(",", $vroles_action[$idx]);
												if ($vaction[0]==1)
													$selected_add="checked";
												if ($vaction[1]==1)
													$selected_edit="checked";
												if ($vaction[2]==1)
													$selected_del="checked";
											}
											$j++;
										}

								?>
									<tr>
										<td>
						                    <div class="checkbox">
						                    <label>
						                        <input type="checkbox" id="ck_rol<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_rol<?=$i?>" data-user-id="<?=$id?>" <?=$selected?>> <?=$name?>
						                    </label>
						                    </div>
										</td>												
										<td >
						                    <div class="checkbox align-right">
						                    <label>
						                        <input type="checkbox" id="ck_add<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_add<?=$i?>" data-user-id="<?=$id?>" <?=$selected_add?>> 
						                    </label>
						                    </div>
										</td>
										<td>
						                    <div class="checkbox align-right">
						                    <label>
						                        <input type="checkbox" id="ck_edit<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_edit<?=$i?>" data-user-id="<?=$id?>" <?=$selected_edit?>> 
						                    </label>
						                    </div>													
										</td>
										<td>
						                    <div class="checkbox align-right">
						                    <label>
						                        <input type="checkbox" id="ck_del<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_del<?=$i?>" data-user-id="<?=$id?>" <?=$selected_del?>> 
						                    </label>
						                    </div>													
										</td>
									</tr>
								<?php
										$i++;
									}
									//echo $total .'->' . $j; 
									if ($total==$j && $total>0){
										echo '<script>document.getElementById("rol_all").checked = true;
										</script>';
									}
								?>


					            </tbody>
				        	</table>							
						</div>
					</div>
				</div>

				<div class="col-sm-12 " style="margin-top: 10px; display: flex; justify-content: end;">
	                <div class="form-group">
	                	<label for="" class="col-sm-2 control-label"></label>
	                    <div class="col-sm-6">
	                      <button type="submit" class="btn btn-success pull-left" name="form1"><?=UPDATE?></button>
	                    </div>
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