<?php require_once('header.php'); ?>



<section class="content-header">
	<h1><?=DASHBOARD?></h1>
</section>

<?php
$total_top_category = 0;
$total_mid_category = 0;
$total_end_category = 0;
$total_product = 0;
$total_order_completed = 0;
$total_shipping_completed = 0;
$total_order_pending = 0;
$total_order_complete_shipping_pending = 0;

//$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
/*$statement = $pdo->prepare("SELECT * FROM tbl_top_category");
$statement->execute();
$total_top_category = $statement->rowCount();

//$statement = $pdo->prepare("SELECT * FROM tbl_mid_category a INNER JOIN tbl_top_category b ON a.tcat_id=b.tcat_id WHERE b.show_on_menu=1");
$statement = $pdo->prepare("SELECT * FROM tbl_mid_category");
$statement->execute();
$total_mid_category = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_end_category");
$statement->execute();
$total_end_category = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_product");
$statement->execute();
$total_product = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment_billing WHERE payment_status=?");
$statement->execute(array(1));
$total_order_completed = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment_billing WHERE shipping_status=?");
$statement->execute(array(1));
$total_shipping_completed = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment_billing WHERE payment_status=?");
$statement->execute(array(0));
$total_order_pending = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM tbl_payment_billing WHERE payment_status=? AND shipping_status=?");
$statement->execute(array(0,1));
$total_order_complete_shipping_pending = $statement->rowCount();*/
?>

<section class="content">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=TOP_CATEGORIES?></span>
					<span class="info-box-number"><?php echo $total_top_category; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=MID_CATEGORIES?></span>
					<span class="info-box-number"><?php echo $total_mid_category; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=END_CATEGORIES?></span>
					<span class="info-box-number"><?php echo $total_end_category; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=PRODUCTS?></span>
					<span class="info-box-number"><?php echo $total_product; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=COMPLETED_ORDERS?></span>
					<span class="info-box-number"><?php echo $total_order_completed; ?></span>
				</div>
			</div>
		</div>
	<div class="col-md-4 col-sm-6 col-xs-12">
			<!-- <div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Completed Shipping</span>
					<span class="info-box-number"><?php echo $total_shipping_completed; ?></span>
				</div>
			</div>  -->
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?=PENDING_ORDERS?></span>
					<span class="info-box-number"><?php echo $total_order_pending; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<!-- <div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-hand-o-right"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pending Shipping (Order Completed)</span>
					<span class="info-box-number"><?php echo $total_order_complete_shipping_pending; ?></span>
				</div>
			</div> -->
		</div>
	</div> 


<style type="text/css">
.responsive-iframe {
  /*position: absolute;*/
  position: relative;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
  overflow-y: hidden;
  overflow-x: hidden;
  z-index: 2;
}    
</style>
 
	<main id="MainContent" style="height: 3684px; overflow-x: hidden; overflow-y: hidden; ">
	  <iframe id="myframe" name="myframe" class="responsive-iframe" scrolling="no" src="charts.php"></iframe>
	</main>

	<script>
	  var div = document.getElementById("myframe");
	    div.onload = function() {
	      var v = 0;
	      div.contentWindow.document.body.style.overflowY = "hidden";           
	      var href = div.contentWindow.document.location.href;
          v = Number(div.contentWindow.document.body.scrollHeight)+50;
	      document.getElementById("MainContent").style.height = v  +'px'; 
	      div.contentWindow.document.body.style.overflowY = "hidden";           
	      div.contentWindow.document.body.style.overflowX = "hidden";           
	    }

	    window.onresize  = function() {
	        div = document.getElementById("myframe");
	        div.contentWindow.document.body.style.overflowY = "hidden";
	        var v = Number(div.contentWindow.document.body.scrollHeight)+50;
	        document.getElementById("MainContent").style.height = div.contentWindow.document.body.scrollHeight + 'px';
	        div.contentWindow.document.body.style.overflowY = "hidden";
	        div.contentWindow.document.body.style.overflowX = "hidden";
	    }
	</script>

	  <!--<div class="row mb-10">
    	<div class="col col-sm-4" >
      		<canvas id="myChart" ></canvas>
      	</div>

	    <div class="col col-sm-4" >
	      <canvas id="myChart2" ></canvas>
	    </div>
	    <div class="col col-sm-4">
	      <canvas id="myChart3" ></canvas>
	    </div>
	  </div>
	<br>
	<br>
	<div class="row">
    	<div class="col col-sm-3" >
    	</div>			
		<div class="col col-sm-6" >
			<canvas id="myChart4" style="width: 70%"></canvas>
		</div>		
    	<div class="col col-sm-3" >
    	</div>			
	</div>-->
	
	<script>

	
	</script>


</section>


<?php require_once('footer.php'); ?>