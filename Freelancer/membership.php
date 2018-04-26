<?php 

//Check if init.php exists

if(!file_exists('../core/init.php')){

	header('Location: ../install/');        

    exit;

}else{

 require_once '../core/init.php';	

}





//Start new Freelancer object

$freelancer = new Freelancer();



//Check if Freelancer is logged in

if (!$freelancer->isLoggedIn()) {

  Redirect::to('../index.php');	

}



require_once 'stripe/config.php';

?>

<!DOCTYPE html>

<html lang="en-US" class="no-js">



    <!-- Include header.php. Contains header content. -->

    <?php include ('template/header.php'); ?>

  
<link href="../assets/css/fr_custom.css" rel="stylesheet" type="text/css" />
<style>
.col-md-3.col-lg-3.col-sm-6.col-xsm-12.boxm {
    padding: 0;
    width: 24%;
}

.col-md-3.col-lg-3.col-sm-6.col-xsm-12.boxm > div {
    margin: 0 29px 0 0;
}
</style>
<body class="skin-green sidebar-mini">

     

     <!-- ==============================================

     Wrapper Section

     =============================================== -->

	 <div class="wrapper">

	 	

        <!-- Include navigation.php. Contains navigation content. -->

	 	<?php include ('template/navigation.php'); ?> 

        <!-- Include sidenav.php. Contains sidebar content. -->

	 	<?php include ('template/sidenav.php'); ?> 

	 	

	  <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1><?php echo $lang['membership']; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active"><?php echo $lang['membership']; ?></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">	 	

		    <!-- Include currency.php. Contains header content. -->

		    <?php include ('template/currency.php'); ?>  

		 <div class="row">	



	 <?php if (!Input::get('id')) : ?>	

		 	

	 <section class="w">

	  <div class="container">



       <div class="row">

		  <?php if(Session::exists(hasError) == true) { //If email is sent ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>

		   </div>

		  <?php } ?>

		  <?php Session::delete(hasError); ?>  

		  

		  <?php if(Session::exists(Cancelled) == true) { //If email is sent ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['cancelled_Payment']; ?>

		   </div>

		  <?php } ?>

		  <?php Session::delete(Cancelled); ?>			       	

       </div>

<div class="form-head">

			 <h3 style="text-align: center; font-weight: bold;">Service Providers Membership Plans</h3>

			</div><!-- /.form-head -->	  
      
      
      
      <div class="section padsec" style="padding: 15px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri">HAPPY </div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Request up to 20 jobs leads per month </div>
                        <div class="textprice"> Receive Payment 5-7 days </div>
                        <div class="textprice"> 25% Transaction services change fees </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag"> <a href="login1.php">							<span class="currencytag">$39</span>.99<span class="permnth">Per Month</span>							</a> </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri redke">SMILE </div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Add 3 additional Regions to your current regions </div>
                        <div class="textprice"> Receive Payment 3-5 days </div>
                        <div class="textprice"> Priority lead Alert notifications </div>
                        <div class="textprice"> Auto follow up messages </div>
                        <div class="textprice"> Request up to 35 jobs leads per month </div>
                        <div class="textprice"> 15% transaction services charge fees </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag redke"> <a href="login1.php">							<span class="currencytag">$59</span>.99<span class="permnth">Per Month</span>							</a> </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri orngkee">LAUGH</div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Add 7 additional Regions to your current regions </div>
                        <div class="textprice"> Receive Payment 2-3 days </div>
                        <div class="textprice"> Priority lead Alert notifications </div>
                        <div class="textprice"> Auto follow up messages </div>
                        <div class="textprice"> Request up to 50 jobs leads per month </div>
                        <div class="textprice"> 9% transaction services charge fees </div>
                        <div class="textprice"> Profile Verification </div>
                        <div class="textprice"> Unlimited messaging </div>
                        <div class="textprice"> Review reply option </div>
                        <div class="textprice"> Increase Profile Security </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag orngkee"> <a href="login1.php"><span class="currencytag">$79</span>.99<span class="permnth">Per Month</span>						</a> </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-6 col-xsm-12 boxm">
                <div class="bader">
                    <div style="font-weight: 600;" class="Headerpri yellokee">KEEHEE</div>
                    <div class="botmprice">
                        <div class="textprice"> Free sign up </div>
                        <div class="textprice"> Covers 2 region </div>
                        <div class="textprice"> Add 14 additional Regions to your current regions </div>
                        <div class="textprice"> Receive Payment - <b>NEXT DAY</b></div>
                        <div class="textprice"> Priority lead Alert notifications </div>
                        <div class="textprice"> Auto follow up messages </div>
                        <div class="textprice"> Request unlimited job leads </div>
                        <div class="textprice"> 5% transaction services charge fees </div>
                        <div class="textprice"> Profile Verification </div>
                        <div class="textprice"> Unlimited messaging </div>
                        <div class="textprice"> Review reply option </div>
                        <div class="textprice"> Increase Profile Security </div>
                        <div class="textprice"> Review respond </div>
                        <div class="textprice"> Profile Verification </div>
                    </div>
                    <div class="pricetag yellokee"> <a href="login1.php">														<span class="currencytag">$99</span>.99<span class="permnth">Per Month</span>						</a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      	

	         

	  </div> <!-- /.container -->

     </section><!-- End section-->

  

	 <?php elseif (Input::get('id')) : ?>



	 <section class="w" style="display: none;">

	  <div class="container">

	  	<div class="row pricing">

		  <?php

          $membershipid = Input::get('id');

            $query = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => Input::get('id')]);

			if ($query->count() === 1) {

              $q1 = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => Input::get('id')]);
			} else {

              $q1 = DB::getInstance()->get("membership_agency", "*", ["membershipid" => Input::get('id')]);
			}
			
		  

		 if($q1->count()) {

		 	

            $postCounter = 0;

		    $x = 1;

			foreach($query->results() as $row) {

		    $List = '';

			$price = $row->price;	

            $rollover = (escape($row->rollover) === '1') ? Yes : No;

            $buy = (escape($row->buy) === '1') ? Yes : No;

            $see = (escape($row->see) === '1') ? Yes : No;

            $team = (escape($row->team) === '1') ? Yes : No;



		    echo $List .= '

		            <div class="col-lg-6">

		             <div class="price-full">	

		              <h6>'. escape($row->name) .'</h6>

		              <div class="price">

		                <sup>'. escape($currency_symbol) .'</sup>'. escape($row->price) .'

                        <span>per month</span>

		              </div>

		              <hr>

		              <p>'.$lang['number'].' '.$lang['of'].' '.$lang['bids'].'  :- <strong>'. escape($row->bids) .'</strong></p>

		              <p>'.$lang['rollover'].' '.$lang['of'].' '.$lang['bids'].'  :- <strong>'. $rollover .'</strong></p>

		              <p>'.$lang['can'].' '.$lang['be'].' '.$lang['able'].' '.$lang['to'].' '.$lang['buy'].' '.$lang['additional'].' '.$lang['bids'].' :- <strong>'. $buy .'</strong></p>

		              <p>'.$lang['can'].' '.$lang['be'].' '.$lang['able'].' '.$lang['to'].' '.$lang['see'].' '.$lang['other'].' '.$lang['bids'].' :- <strong>'. $see .'</strong></p>

		              <p>'.$lang['can'].' '.$lang['be'].' '.$lang['able'].' '.$lang['to'].' '.$lang['add'].' '.$lang['team'].' '.$lang['members'].' :- <strong>'. $team .'</strong></p>

		              <br>

		             </div> 

		            </div>

					 ';

				

             unset($List);	 

			 $x++;		

			

		   }

		}else {

		 echo $List = '<p>'.$lang['no_content_found'].'</p>';

		}

       ?>     

		 <div class="col-lg-6"> 

			<form action="stripe/membership_charge.php?id=<?php echo $membershipid; ?>" method="POST">

			  <script

			    src="https://checkout.stripe.com/checkout.js" class="stripe-button"

			    data-key="<?php echo $stripe[publishable]; ?>"

			    data-name="<?php echo $lang['membership']; ?> <?php echo $lang['payments']; ?>"

			    data-description="<?php echo $lang['payments']; ?>"

			    data-currency="<?php echo $currency_code; ?>"

			    data-email="<?php echo $freelancer->data()->email; ?>"

			    data-amount="<?php echo getMoneyAsCents($price);?>"

			    data-locale="auto">

			  </script>

			</form>		

			<br/>

		  <a href="paypal/addpayment.php?id=<?php echo $membershipid; ?>" class="btn btn-success btn-block"><?php echo $lang['pay']; ?> <?php echo $lang['with']; ?> Paypal</a> 	

		 </div>	

       </div><!-- /.row -->

         

	  </div> <!-- /.container -->

     </section><!-- End section-->	    		 				 

		 <?php endif; ?>     		 	

		 	 

	    </div><!-- /.row -->		  		  

	   </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

	 	

      <!-- Include footer.php. Contains footer content. -->	

	  <?php include 'template/footer.php'; ?>	

	 	

     </div><!-- /.wrapper -->   



	

	 <!-- ==============================================

	 Scripts

	 =============================================== -->

	 

    <!-- jQuery 2.1.4 -->

    <script src="../assets/js/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.6 JS -->

    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- DATA TABES SCRIPT -->

    <script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->

    <script src="../assets/js/app.min.js" type="text/javascript"></script>

    <!-- page script -->

    <script type="text/javascript">

      $(function () {

        $("#example1").dataTable({

        /* No ordering applied by DataTables during initialisation */

        "order": []

        });

      });

    </script>

    <script type="text/javascript">

	$(function() {

	

	

	$(".btn-danger").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['delete_job']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/delete/deletejob.php",

				 data: info,

				 success: function()

					   {

						parent.fadeOut('slow', function() {$(this).remove();});

					   }

				});

			 

	

			  }

		   return false;

	

		});

	

	});

	</script>



	<script type="text/javascript">

	$(function() {

	

	$(".btn-info").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['activate_job']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/activatejob.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

			 

	

			  }

		   return false;

	

		});	

	

	});

	</script>

	

	<script type="text/javascript">

	$(function() {

	

	$(".btn-default").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['deactivate_job']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/deactivatejob.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

			 

	

			  }

		   return false;

	

		});		

	

	});

	</script>	

	<script type="text/javascript">

	$(function() {

	

	$(".btn-kafe").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['make_public']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/makepublic.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

			 

	

			  }

		   return false;

	

		});	

	

	});

	</script>

	

	<script type="text/javascript">

	$(function() {

	

	$(".btn-warning").click(function(){

	

	//Save the link in a variable called element

	var element = $(this);

	

	//Find the id of the link that was clicked

	var id = element.attr("id");

	

	//Built a url to send

	var info = 'id=' + id;

	 if(confirm("<?php echo $lang['hide_public']; ?>"))

			  {

			var parent = $(this).parent().parent();

				$.ajax({

				 type: "GET",

				 url: "template/actions/hidepublic.php",

				 data: info,

				 success: function()

					   {

						window.location.reload();

					   }

				});

			 

	

			  }

		   return false;

	

		});		

	

	});

	</script>		

    

</body>

</html>

