<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {

	if($_SESSION['user']['role'] == 'Super Admin') {

		$valid = 1;

	    if(empty($_POST['full_name'])) {
	        $valid = 0;
	        $error_message .= "Name can not be empty<br>";
	    }

	    if(empty($_POST['email'])) {
	        $valid = 0;
	        $error_message .= 'Email address can not be empty<br>';
	    } else {
	    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
		        $valid = 0;
		        $error_message .= 'Email address must be valid<br>';
		    } else {
		    	// current email address that is in the database
		    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
				$statement->execute(array($_SESSION['user']['id']));
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$current_email = $row['email'];
				}


		    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? and email!=?");
		    	$statement->execute(array($_POST['email'],$current_email));
		    	$total = $statement->rowCount();							
		    	if($total) {
		    		$valid = 0;
		        	$error_message .= 'Email address already exists<br>';
		    	}
		    }
	    }

	    if($valid == 1) {
			
			$_SESSION['user']['full_name'] = $_POST['full_name'];
	    	$_SESSION['user']['email'] = $_POST['email'];

			// updating the database
			$statement = $pdo->prepare("UPDATE tbl_user SET full_name=?, email=?, phone=? WHERE id=?");
			$statement->execute(array($_POST['full_name'],$_POST['email'],$_POST['phone'],$_SESSION['user']['id']));

	    	$success_message = 'User Information is updated successfully.';
	    }
	}
	else {
		$_SESSION['user']['phone'] = $_POST['phone'];

		// updating the database
		$statement = $pdo->prepare("UPDATE tbl_user SET phone=? WHERE id=?");
		$statement->execute(array($_POST['phone'],$_SESSION['user']['id']));

		$success_message = 'User Information is updated successfully.';	
	}
}

if(isset($_POST['form2'])) {

	$valid = 1;

	$path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

    	// removing the existing photo
    	if($_SESSION['user']['photo']!='') {
    		if ($_SESSION['user']['photo']!=DEFAULT_PHOTO_USER) 
    			unlink('assets/uploads/'.$_SESSION['user']['photo']);	
    	}

    	// updating the data
    	$final_name = 'user-'.$_SESSION['user']['id'].'.'.$ext;
        move_uploaded_file( $path_tmp, 'assets/uploads/'.$final_name );
        $_SESSION['user']['photo'] = $final_name;

        // updating the database
		$statement = $pdo->prepare("UPDATE tbl_user SET photo=? WHERE id=?");
		$statement->execute(array($final_name,$_SESSION['user']['id']));

        $success_message = 'User Photo is updated successfully.';


        //$FAVICON = 'assets/uploads/'.$logo;
        //$_SESSION['user']['photo']='assets/uploads/'.$final_name;
        //$PHOTO_USER = $final_name;
        //$_SESSION['user']['photo']=$final_name;
       	if (DEFAULT_PHOTO_USER!=$final_name)
            $final_name .='?'.rand(); 


    	echo '<script>
    				document.getElementsByClassName("user-image")[0].src="assets/uploads/'.$final_name.'";
    		 </script>';
    }
}

if(isset($_POST['form3'])) {
	$valid = 1;

	if( empty($_POST['password']) || empty($_POST['re_password']) ) {
        $valid = 0;
        $error_message .= "Password can not be empty<br>";
    }

    if( !empty($_POST['password']) && !empty($_POST['re_password']) ) {
    	if($_POST['password'] != $_POST['re_password']) {
	    	$valid = 0;
	        $error_message .= "Passwords do not match<br>";	
    	}        
    }

    if($valid == 1) {

    	$_SESSION['user']['password'] = md5($_POST['password']);

    	// updating the database
		$statement = $pdo->prepare("UPDATE tbl_user SET password=? WHERE id=?");
		$statement->execute(array(md5($_POST['password']),$_SESSION['user']['id']));

    	$success_message = 'User Password is updated successfully.';
    }
}




if(isset($_POST['form4'])) {

	if($_SESSION['user']['role'] == 'Super Admin') {

		$valid = 1;

	    if(empty($_POST['full_name'])) {
	        $valid = 0;
	        $error_message .= "Name can not be empty<br>";
	    }

	    if(empty($_POST['email'])) {
	        $valid = 0;
	        $error_message .= 'Email address can not be empty<br>';
	    } else {
	    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
		        $valid = 0;
		        $error_message .= 'Email address must be valid<br>';
		    } else {
		    	// current email address that is in the database
		    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
				$statement->execute(array($_SESSION['user']['id']));
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$current_email = $row['email'];
				}

		    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? and email!=?");
		    	$statement->execute(array($_POST['email'],$current_email));
		    	$total = $statement->rowCount();							
		    	if($total) {
		    		$valid = 0;
		        	$error_message .= 'Email address already exists<br>';
		    	}
		    }
	    }

			
		if(empty($_POST['password']) || empty($_POST['role'])) {
			$valid = 0;
		}

		if (!isset($_POST['phone'])){
			$_POST['phone'] = '';
		}
		


	    if($valid == 1) {
			
			$statement = $pdo->prepare("INSERT INTO tbl_user VALUES (?,?,?,?,?,?,?,?)");
			$statement->execute(array(null,$_POST['full_name'],$_POST['email'],$_POST['phone'], md5($_POST['password']), 'user-0.png', $_POST['role'], 'Active'));
	    	$success_message = 'User Information is add successfully.';

		    $to = $_POST['email'];
		    
		    $subject = str_replace('YOUR WEBSITE', 'Cleannig Services ', LANG_VALUE_150);
		    
		    //$verify_link = BASE_URL.'verify.php?email='.$to.'&token='.$token;
		    $message = ''.str_replace('To active your account click on the link below:', '', LANG_VALUE_151) .'<br><br>'.
		    'User: '. $to . '<br>'.
		    'Password: ' . $_POST['password'];
		      $headers = "From: noreply@" . BASE_URL2 . "\r\n" .
		                 "Reply-To: noreply@" . BASE_URL2 . "\r\n" .
		                 "X-Mailer: PHP/" . phpversion() . "\r\n" . 
		                 "MIME-Version: 1.0\r\n" . 
		                 "Content-Type: text/html; charset=ISO-8859-1\r\n";
		      
		    // Sending Email
		    mail($to, $subject, $message, $headers);

		    unset($_POST['full_name']);
		    unset($_POST['email']);
		    unset($_POST['phone']);
		    unset($_POST['password']);
		    unset($_POST['role']);
	    }
	}
	else {
	}
}

?>

<section class="content-header header-pt">
	<div class="content-header-left">
		<h1><?=EDIT_PROFILE?></h1>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
$statement->execute(array($_SESSION['user']['id']));
$statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$full_name = $row['full_name'];
	$email     = $row['email'];
	$phone     = $row['phone'];
	$photo     = $row['photo'];
  	if (DEFAULT_PHOTO_USER!=$photo)
       $photo .='?'.rand(); 

	$status    = $row['status'];
	$role      = $row['role'];
}
?>

<section class="content">

	<div class="row">
		<div class="col-md-12">
				
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab"><?=UPDATE_INFORMATION?></a></li>
						<li><a href="#tab_2" data-toggle="tab"><?=UPDATE_PHOTO?></a></li>
						<li><a href="#tab_3" data-toggle="tab"><?=UPDATE_PASSWORD?></a></li>
						<?php if($_SESSION['user']['role'] == 'Super Admin') { ?>
						<li><a href="#tab_4" data-toggle="tab"><?=ADD_USER?></a></li>
						<?php } ?>

					</ul>
					<div class="tab-content">
          				<div class="tab-pane active" id="tab_1">
							
							<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"><?=NAME?> <span>*</span></label>
										<?php
										if($_SESSION['user']['role'] == 'Super Admin') {
											?>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="full_name" value="<?php echo $full_name; ?>">
												</div>
											<?php
										} else {
											?>
												<div class="col-sm-4" style="padding-top:7px;">
													<?php echo $full_name; ?>
												</div>
											<?php
										}
										?>
										
									</div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label"><?=EXISTING_PHOTO?></label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <img src="assets/uploads/<?php echo $photo ?>" class="existing-photo" width="140">
							            </div>
							        </div>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"><?=EMAIL_ADDRESS?> <span>*</span></label>
										<?php
										if($_SESSION['user']['role'] == 'Super Admin') {
											?>
												<div class="col-sm-4">
													<input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
												</div>
											<?php
										} else {
											?>
											<div class="col-sm-4" style="padding-top:7px;">
												<?php echo $email; ?>
											</div>
											<?php
										}
										?>
										
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"><?=PHONE?> </label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
										</div>
									</div>
									<div class="form-group" style="display: none;">
										<label for="" class="col-sm-2 control-label"><?=ROLE?> <span>*</span></label>
										<div class="col-sm-4" style="padding-top:7px;">
											<?php echo $role; ?>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form1"><?=UPDATE_INFORMATION?></button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>
          				<div class="tab-pane" id="tab_2">
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label"><?=NEW_PHOTO?></label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form2"><?=UPDATE_PHOTO?></button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>
          				<div class="tab-pane" id="tab_3">
							<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"><?=PASSWORD?> </label>
										<div class="col-sm-4">
											<input type="password" class="form-control" name="password">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"><?=RETYPE_PASSWORD?> </label>
										<div class="col-sm-4">
											<input type="password" class="form-control" name="re_password">
										</div>
									</div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form3"><?=UPDATE_PASSWORD?></button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>

						<div class="tab-pane " id="tab_4">
							<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><?=BRANCH?> <span>*</span></label>
											<div class="col-sm-8" style="padding-top:7px;">
												<select style="width: 100%;" name="role" class="form-control select2 top-cat">
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
											<label for="" class="col-sm-4 control-label"><?=NAME?> <span>*</span></label>
											<?php
											if($_SESSION['user']['role'] == 'Super Admin') {
												?>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="full_name" value="<?php //echo $full_name; ?>">
													</div>
												<?php
											} else {
												?>
													<div class="col-sm-8" style="padding-top:7px;">
														<?php echo $full_name; ?>
													</div>
												<?php
											}
											?>
										</div>
										
										<div class="form-group" style="display: none">
								            <label for="" class="col-sm-4 control-label"><?=EXISTING_PHOTO?></label>
								            <div class="col-sm-8" style="padding-top:6px;">
								                <img src="assets/uploads/<?php //echo $photo; ?>" class="existing-photo" width="140">
								            </div>
								        </div>
										
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><?=EMAIL_ADDRESS?> <span>*</span></label>
											<?php
											if($_SESSION['user']['role'] == 'Super Admin') {
												?>
													<div class="col-sm-8">
														<input type="email" class="form-control" name="email" value="<?php //echo $email; ?>">
													</div>
												<?php
											} else {
												?>
												<div class="col-sm-8" style="padding-top:7px;">
													<?php echo $email; ?>
												</div>
												<?php
											}
											?>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-4 control-label"><?=PHONE?> </label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="phone" value="<?php //echo $phone; ?>">
											</div>
										</div>
										<div class="form-group">
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
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<!-- <label for="" class="col-sm-2 control-label"><?=ROLE?> <span>*</span></label> -->
											<div class="col-sm-12" >
												<?php
											    	$statement = $pdo->prepare("SELECT * FROM tbl_roles");
													//$statement->execute(array($_SESSION['user']['id']));
													$statement->execute();
													$result = $statement->fetchAll(PDO::FETCH_ASSOC);
													foreach($result as $row) {
														$id=$row['id_r'];
														$name=$row['name_r'];
												?>
								                    <div class="checkbox">
								                    <label>
								                        <input type="checkbox" id="rol<?=$id?>" class="form-check-input" name="rol<?=$id?>" > <?=$name?>
								                    </label>
								                    </div>
													
												<?php

													}
												?>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form4"><?=ADD_USER?></button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>          				
          			</div>
				</div>			

		</div>
	</div>
</section>


<?php require_once('footer.php'); ?>


<script type="text/javascript">
document.getElementById("password").value = genPassword();
</script>
