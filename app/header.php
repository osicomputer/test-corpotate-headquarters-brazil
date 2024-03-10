<?php
require_once("main_config.php");


if(isset($_SESSION['user'])) {
    $statement = $pdo->prepare("SELECT * FROM tbl_roles WHERE file_r LIKE '%?%'");
    $statement->execute(array($CUR_PAGE));
    if ($statement->rowCount()>0){
		$ROL_CURRENT = GET_ROLES($CUR_PAGE);
		if ($ROL_CURRENT[0]==0) :
		    header("location: ".$DEFAULT_URL);
		endif;
    }
}else{
	header('location: login.php');
	exit;	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<title>Admin Panel </title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="shortcut icon" href="assets/uploads/<?php echo $FAVICON.'?'.rand(); ?>" type="image/png">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
	
	<script type="text/javascript" src="js/chartjs-plugin-labels.js"></script>
	<script src="js/chartjs-plugin-colorschemes.min.js"></script>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/datepicker3.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<!--<link rel="stylesheet" href="css/dataTables.bootstrap.css">-->
	<link rel="stylesheet" href="css/jquery.fancybox.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">
	<link rel="stylesheet" href="css/on-off-switch.css"/>
	<link rel="stylesheet" href="css/summernote.css">
 	<link rel="stylesheet" href="css/style.css?v=<?=time()?>">

	<link rel="stylesheet" href="https://cdn.datatables.net/searchbuilder/1.4.2/css/searchBuilder.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.0/css/dataTables.dateTime.min.css">
	<link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">   
	<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">   
	
	
	<style type="text/css">


	</style>


</head>

<script type="text/javascript">
    function upperCase(e){
        e.value = e.value.toUpperCase();
    }
</script>


<body class="hold-transition fixed skin-blue sidebar-mini" lang="es">

	<input type="text" id="base_url" name="base_url" value="<?=BASE_URL?>" hidden>
	<input type="text" id="decimal_point" name="decimal_point" value="<?=DECIMAL_POINT?>" hidden>
	<input type="text" id="separator" name="separator" value="<?=SEPARATOR?>" hidden>

	<div class="wrapper">

		<header class="main-header" >

			<?php 
				$ROL_CURRENT = GET_ROLES($CUR_PAGE)
			?>		
			<a href="index.php" class="logo" >
				<span class="logo-lg"><?=$COMPANY_NAME?></span>
			</a>

			<nav class="navbar navbar-static-top">
				
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation </span>
				</a>

				<span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin Panel</span>
    			<!-- Top Bar ... User Inforamtion .. Login/Log out Area -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php
								   	$photo = $_SESSION['user']['photo'];
                    				if (DEFAULT_PHOTO_USER!=$photo)
                        				$photo .='?'.rand(); 
								?>
								<img src="assets/uploads/<?=$photo?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo $_SESSION['user']['full_name']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-footer">
									<div>
										<a href="logout.php" class="btn btn-default btn-flat"><?=LOG_OUT?></a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>

			</nav>
		</header>

  		
<!-- Side Bar to Manage Shop Activities -->
  		<aside class="main-sidebar" >
    		<section class="sidebar">
      			<ul class="sidebar-menu">
				    <li class="treeview <?php if($CUR_PAGE == 'con_agence.php?titulo=Agence') {echo 'active';} ?>">
				        <a href="con_agence.php?titulo=Agence">
				    	    <i  class="fa fa-address-book-o"></i> <span> Agence</span>
				        </a>
				    </li>

			        <li class="treeview <?php if( ($CUR_PAGE == 'con_agence.php?titulo=Projetos') ) {echo 'active';} ?>">
			          <a href="con_agence.php?titulo=Projetos">
			            <i  class="fa fa-first-order"></i> <span>Projetos</span>
			          </a>
			        </li>

			        <li class="treeview <?php if( ($CUR_PAGE == 'con_agence.php?titulo=Administrativo') ) {echo 'active';} ?>">
			          <a href="con_agence.php?titulo=Administrativo">
			            <i  class="fa fa-pencil-square-o"></i> <span>Administrativo</span>
			          </a>
			        </li>
	   
					<li class="treeview <?php if( ($CUR_PAGE == 'con_agence.php?titulo=Comercial') ) {echo 'active';} ?>">
			          <a href="con_agence.php?titulo=Comercial">
			            <i  class="fa fa-users"></i> <span>Comercial</span>
			          </a>
			        </li>
	 				
	 				<li class="treeview <?php if( ($CUR_PAGE == 'con_desempenho.php') ) {echo 'active';} ?>">
				          <a href="con_desempenho.php">
				            <i  class="fa fa-money"></i> <span>Financeiro</span>
				          </a>
				    </li>
      			</ul>

      			<script type="text/javascript">
      				if (document.getElementById("data_settings").getElementsByTagName("ul")[0].innerText.trim()=="")
      					document.getElementById("data_settings").style.display="none";
      				else
      					document.getElementById("data_settings").style.display="block";
      			</script>
    		</section>
  		</aside>
  		<?php

  			if ($CUR_PAGE!=="profile-edit.php"){
				$ROL_CURRENT = GET_ROLES($CUR_PAGE);
				if ($ROL_CURRENT[0]==0)
				   header("location: ". $DEFAULT_URL);
  			}
		?>

  		<div class="content-wrapper">
