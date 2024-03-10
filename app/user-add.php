<?php require_once('header.php'); ?>

<?php


$photo='user-0.png';
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['email']) || empty($_POST['email_company'])) {
        $valid = 0;
        $error_message .= USERNAME_CANNOT_BE_EMPTY."<br>";
    } else {
    	// Duplicate Category checking
    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE identification_card_type=? AND identification_card=?");
    	$statement->execute(array($_POST['identification_card_type'],$_POST['identification_card']));
    	$total = $statement->rowCount();
    	if($total)
    	{
    		$valid = 0;
        	$error_message .= USERNAME_ALREADY_EXISTS."<br>";
    	}

    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=?");
    	$statement->execute(array($_POST['email']));
    	$total = $statement->rowCount();
    	if($total)
    	{
    		$valid = 0;
        	$error_message .= THE_MAIL_ALREADY_EXISTS."<br>";
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

		$statement = $pdo->prepare("SELECT Max(id)+1 id FROM tbl_user");
    	$statement->execute();
		$result = $statement->fetchAll(PDO::FETCH_ASSOC); 

		$id=$result[0]['id'];
		$statement = $pdo->prepare("INSERT IGNORE INTO tbl_user (id, full_name, identification_card_type, identification_card, birth_date, email, email_company, phone, password, photo, role, roles, roles_action, billing_type, status, id_b, id_up) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

		$date=date_create($_POST['birth_date']);
		$birth_date=date_format($date,'Y-m-d');
		$statement->execute(array($id, $_POST['full_name'],$_POST['identification_card_type'],$_POST['identification_card'], $birth_date, $_POST['email'], $_POST['email_company'], $_POST['phone'], md5($_POST['password']), $photo,$_POST['role'], $_POST['roles'],$_POST['roles_action'],$billing_type,$_POST['status'], $_POST['id_b'], $_POST['id_up']));
	
    	$success_message = THE_USER_WAS_ADDED_SUCCESSFULLY.'.';
    }
}


$full_name = ASSING_POST('full_name');
$identification_card_type = ASSING_POST('identification_card_type','V');
$identification_card = ASSING_POST('identification_card'); 
$email = ASSING_POST('email'); 
$phone = ASSING_POST('phone'); 
$birth_date = ASSING_POST('birth_date'); 
$email_company = ASSING_POST('email_company'); 

$billing_type='';
if(isset($_POST['billing_type'])) {
	foreach($_POST['billing_type'] as $value) {
		$billing_type.=$value.'|';
	}
	$billing_type=substr($billing_type, 0, strlen($billing_type)-1 );
}else{
	$statement = $pdo->prepare("SELECT * FROM tbl_type_billing");
	$statement->execute();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$billing_type='';
	foreach($result as $row) 
		$billing_type.=$row['id'].'|';
	
	if ($billing_type!='')
		$billing_type=substr($billing_type, 0, strlen($billing_type)-1);
	
}


$billing_type=explode("|", $billing_type);

?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=ADD_USER?></h1>
	</div>
	<div class="content-header-right">
		<a href="user.php" class="btn btn-primary btn-sm"><?=VIEW_ALL?></a>
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
						<div class="col-sm-6">
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
									?>
										<option value="<?=$id?>"><?=$name?></option>
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
									<input type="text" class="form-control" name="full_name" value="<?=$full_name; ?>" onblur="upperCase(this)" required>
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
									<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" onblur="upperCase(this)" required>
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
									<input type="text" class="form-control" name="phone" onblur="upperCase(this)"value="<?php echo $phone; ?>" required>
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
											if ($id==8)
												$selected="selected";

									?>
										<option value="<?=$id?>" <?=$selected?>><?=$name?></option>
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
										<option value="0"><?=NO?></option>
										<option value="1" selected><?=YES?></option>
									</select> 
								</div>
							</div>							
						</div>

						<div class="col-sm-6">
							<div class="form-group" style="display: none;">
								<label for="" class="col-sm-4 control-label"><?=ROLES?> </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="roles" name="roles" value="<?php //echo $phone; ?>">
								</div>
							</div>		
							<div class="form-group" style="display: none;">
								<label for="" class="col-sm-4 control-label"><?=ROLES . ' ' . ACTION?> </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="roles_action" name="roles_action" value="<?php //echo $phone; ?>">
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
											$i=0;
											foreach($result as $row) {
												$id=$row['id_r'];
												$name=$row['name_r'];

										?>
											<tr>
												<td>
								                    <div class="checkbox">
								                    <label>
								                        <input type="checkbox" id="ck_rol<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_rol<?=$i?>" data-user-id="<?=$id?>" > <?=$name?>
								                    </label>
								                    </div>
												</td>												
												<td >
								                    <div class="checkbox align-right">
								                    <label>
								                        <input type="checkbox" id="ck_add<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_add<?=$i?>" data-user-id="<?=$id?>"> 
								                    </label>
								                    </div>
												</td>
												<td>
								                    <div class="checkbox align-right">
								                    <label>
								                        <input type="checkbox" id="ck_edit<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_edit<?=$i?>" data-user-id="<?=$id?>"> 
								                    </label>
								                    </div>													
												</td>
												<td>
								                    <div class="checkbox align-right">
								                    <label>
								                        <input type="checkbox" id="ck_del<?=$i?>" onchange="selectedRoles(this, <?=$total?>)" class="form-check-input" name="ck_del<?=$i?>" data-user-id="<?=$id?>"> 
								                    </label>
								                    </div>													
												</td>
											</tr>
										<?php
												$i++;
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
									<button type="submit" class="btn btn-success pull-left" name="form1"><?=SUBMIT?></button>
								</div>
							</div>
						</div>

					</div>
				</div>

			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>

<script type="text/javascript">
//document.getElementById("password").value = genPassword();
document.getElementById("password").value = '12345678';
</script>
