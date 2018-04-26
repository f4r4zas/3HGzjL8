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


	 	

//Get Withdrawal Data

$freelancerid = $freelancer->data()->freelancerid;

$query = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancerid, "type" => 1], "LIMIT" => 1]);

if ($query->count() === 1) {

 foreach($query->results() as $row) {

 	$email_paypal = $row->email;

 	$confirm_email_paypal = $row->confirm_email;

 }			

}


$bank_account = "";
    
$routing_number = "";

$account_type = "";

$account_holder = "";

$query = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancerid, "type" => 2], "LIMIT" => 1]);

if ($query->count() === 1) {

 foreach($query->results() as $row) {

 	//$email_stripe = $row->email;

 	//$confirm_email_stripe = $row->confirm_email;
    
    $bank_account = $row->account;
    
    $routing_number = $row->routing;
    
    $account_type = $row->account_type;
    
    $account_holder = $row->fullname;

 }
 
 
 $query = DB::getInstance()->get("freelancer", "*", ["AND" => ["freelancerid" => $freelancerid], "LIMIT" => 1]);			
    $query_result = $query->results();
    $email_stripe = $query_result[0]->email;
    $name_stripe = $query_result[0]->name;
    $confirm_email_stripe = $query_result[0]->email;
}



$query = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancerid, "type" => 3], "LIMIT" => 1]);

if ($query->count() === 1) {

 foreach($query->results() as $row) {

 	$email_skrill = $row->email;

 	$confirm_email_skrill = $row->confirm_email;

 }			

}



//Stripe::setApiKey("sk_test_SrG9Yb8SrhcDNkqsGdc5eKu1");




//Edit Paypal Data

if(isset($_POST['data_paypal'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'email' => [

	     'required' => true,

	     'email' => true,

	     'maxlength' => 100,

	     'minlength' => 2,

	  ],

	   'confirm_email' => [

	     'match' => 'email'

	   ]

	]);

		 

    if (!$validation->fails()) {

    	

		$freelancerid = $freelancer->data()->freelancerid;

		$query = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancerid], "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			$Update = DB::getInstance()->update('withdraw',[

			    'email' => Input::get('email'),

			    'confirm_email' => Input::get('confirm_email'),

			    'type' => 1

		    ],[

		    'freelancerid' => $freelancerid

		    ]);

			

			if (count($Update) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

			

		 } else {

		 	

			try{

			   $Insert = DB::getInstance()->insert('withdraw', array(

				   'freelancerid' => $freelancerid,

				   'email' => Input::get('email'),

				   'confirm_email' => Input::get('confirm_email'),

		           'type' => 1,

		           'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($Insert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			}catch(Exception $e){

			 die($e->getMessage());	

			} 			
			 
		 }	

			

	 } else {

     $error = '';

     foreach ($validation->errors()->all() as $err) {

     	$str = implode(" ",$err);

     	$error .= '

	           <div class="alert alert-danger fade in">

	            <a href="#" class="close" data-dismiss="alert">&times;</a>

	            <strong>Error!</strong> '.$str.'

		       </div>

		       ';

     }

   }



  }

 }

}



//Edit Stripe Data

if(isset($_POST['data_stripe'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'account_type' => [

	     'required' => true,

	  ],

	   'routing' => [

	     'required' => true,

	   ],
       'fullname' => [

	     'required' => true,

	   ],
       'account' => [

	     'required' => true,

	   ],

	]);

		 

    if (!$validation->fails()) {
        



//print_r($stripe);

			

			

	 } else {

     $error = '';

     foreach ($validation->errors()->all() as $err) {

     	$str = implode(" ",$err);

     	$error .= '

	           <div class="alert alert-danger fade in">

	            <a href="#" class="close" data-dismiss="alert">&times;</a>

	            <strong>Error!</strong> '.$str.'

		       </div>

		       ';

     }

   }



  }

 }

}



//Edit Skrill Data

if(isset($_POST['data_skrill'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'email' => [

	     'required' => true,

	     'email' => true,

	     'maxlength' => 100,

	     'minlength' => 2,

	  ],

	   'confirm_email' => [

	     'match' => 'email'

	   ]

	]);

		 

    if (!$validation->fails()) {
/*
    	

		$freelancerid = $freelancer->data()->freelancerid;

		$query = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancerid], "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			$Update = DB::getInstance()->update('withdraw',[

			    'email' => Input::get('email'),

			    'confirm_email' => Input::get('confirm_email'),

			    'type' => 3

		    ],[

		    'freelancerid' => $freelancerid

		    ]);

			

			if (count($Update) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

			

		 } else {

		 	

			try{

			   $Insert = DB::getInstance()->insert('withdraw', array(

				   'freelancerid' => $freelancerid,

				   'email' => Input::get('email'),

				   'confirm_email' => Input::get('confirm_email'),

		           'type' => 3,

		           'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($Insert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			}catch(Exception $e){

			 die($e->getMessage());	

			} 			

			 

		 }	

			
*/
	 } else {

     $error = '';

     foreach ($validation->errors()->all() as $err) {

     	$str = implode(" ",$err);

     	$error .= '

	           <div class="alert alert-danger fade in">

	            <a href="#" class="close" data-dismiss="alert">&times;</a>

	            <strong>Error!</strong> '.$str.'

		       </div>

		       ';

     }

   }



  }

 }

}

?>

<!DOCTYPE html>

<html lang="en-US" class="no-js">



    <!-- Include header.php. Contains header content. -->

    <?php include ('template/header.php'); ?>

 <!-- .env start-->



<!-- .env end-->

<!-- Auth.blade start -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
Stripe.setPublishableKey( 'pk_live_wKgb17oWu3lauFLt8lFc7AOH' );
</script>

<!-- Auth.blade end -->


<!-- js file end -->



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

          <h1><?php echo $lang['withdrawal']; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active"><?php echo $lang['withdrawal']; ?></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">	 	

		    <!-- Include currency.php. Contains header content. -->

		    <?php include ('template/currency.php'); ?>  

		 <div class="row">	
<form id="payment-form" action="stripe/withdraw1.php" method="post">
<input type="hidden" name="stripeToken" id="stripeToken" value=""/>
<input type="hidden" name="name" value="<?php echo $name_stripe;?>"/>
<input type="hidden" name="email" value="<?php echo $email_stripe;?>"/>
</form>


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

       <div class="row">

       	<div class="col-lg-12">

         <h3><?php echo $lang['choose']; ?> 

         	                   <?php echo $lang['withdrawal']; ?> 

         	                   <?php echo $lang['method']; ?></h3>

        </div> 	                   

       </div>

       <br />

	  <div class="row">

       <?php

		$q1 = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancer->data()->freelancerid], "LIMIT" => 1]);

		if ($q1->count()) {

		 foreach($q1->results() as $r1) {

		 	$type = $r1->type;

		 }

		}	

			

	   ?>			  	

	  	<?php if ($type === '1') : ?>

	  	<div class="col-lg-3" style="display: none;">

         <div class="panel panel-default">

          <div class="panel-body text-center"> 

	  	   <a href="withdraw.php?id=1" class="btn btn-success btn-block">Paypal</a>

	  	   <h4><?php echo $lang['selected']; ?></h4> 

	  	  </div>

	  	 </div> 

	   </div>

	   <?php else :?>

	  	<div class="col-lg-3" style="display: none;">

	  	   <a href="withdraw.php?id=1" class="btn btn-success btn-block">Paypal</a>

	   </div>

	   <?php endif; ?>

	   

	  	<?php if ($type === '2') : ?>

	  	<div class="col-lg-3" style="float: none; margin: 0 auto;">

         <div class="panel panel-default">

          <div class="panel-body text-center"> 

	  	   <a href="withdraw.php?id=2" class="btn btn-success btn-block">Stripe</a>

	  	   <h4><?php echo $lang['selected']; ?></h4> 

	  	  </div>

	  	 </div> 

	   </div>

	   <?php else :?>

	  	<div class="col-lg-3" style="float: none; margin: 0 auto;">

	  	   <a href="withdraw.php?id=2" class="btn btn-success btn-block">Stripe</a>

	   </div>

	   <?php endif; ?>	 

	   

	  	<?php if ($type === '3') : ?>

	  	<div class="col-lg-3" style="display: none;">

         <div class="panel panel-default">

          <div class="panel-body text-center"> 

	  	   <a href="withdraw.php?id=3" class="btn btn-success btn-block">Skrill</a>

	  	   <h4><?php echo $lang['selected']; ?></h4> 

	  	  </div>

	  	 </div> 

	   </div>

	   <?php else :?>

	  	<div class="col-lg-3" style="display: none;">

	  	   <a href="withdraw.php?id=3" class="btn btn-success btn-block">Skrill</a>

	   </div>

	   <?php endif; ?>	

	  </div>	



	  </div> <!-- /.container -->

     </section><!-- End section-->

  

	 <?php elseif (Input::get('id') === '1') : 

	 	

	 	?>

	 	<div class="col-lg-12">



		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['updated_success']; ?></strong>

		   </div>

		  <?php } ?>

		 	

		  <?php if (isset($error)) {

			  echo $error;

		  } ?>

	        

         <?php if(isset($hasError)) { //If errors are found ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>

		   </div>

	      <?php } ?>

	

		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['saved_success']; ?></strong>

		   </div>

		  <?php } ?>	 		

	 		

	 	</div>

	 	

	 	

           

		 <div class="col-lg-12">

		 

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title">Paypal <?php echo $lang['withdrawal']; ?> <?php echo $lang['setup']; ?></h3>

                </div>

                <div class="box-body">

                 <form role="form" method="post" id="addform"> 

                 	

                  <div class="form-group">	

				    <label><?php echo $lang['your']; ?> <?php echo $lang['email']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <input type="text" name="email" class="form-control" value="<?php

                         if (isset($_POST['data_paypal'])) {

							 echo escape(Input::get('email')); 

						  } else {

						  echo escape($email_paypal); 

						  } ?>"/>

                   </div>

                  </div>    

                  <div class="form-group">	

				    <label><?php echo $lang['confirm']; ?> <?php echo $lang['email']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <input type="text" name="confirm_email" class="form-control"  value="<?php

                         if (isset($_POST['data_paypal'])) {

							 echo escape(Input::get('confirm_email')); 

						  } else {

						  echo escape($confirm_email_paypal); 

						  } ?>"/>

                   </div>

                  </div>        

                           

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="data_paypal" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button><br/><br />

                    <a href="withdraw.php" class="btn btn-info full-width"><?php echo $lang['back']; ?></a>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

		 

		</div><!-- /.col -->   		 

		



  

	 <?php elseif (Input::get('id') === '2') : 

	 	

	 	?>

	 	<div class="col-lg-12">



		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['updated_success']; ?></strong>

		   </div>

		  <?php } ?>

		 	

		  <?php if (isset($error)) {

			  echo $error;

		  } ?>

	        

         <?php if(isset($hasError)) { //If errors are found ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>

		   </div>

	      <?php } ?>

	

		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['saved_success']; ?></strong>

		   </div>

		  <?php } ?>	 		

	 		

	 	</div>

	 	

	 	

           

		 <div class="col-lg-12">

<div class="form-group acc_tit" id="personal" style="display: none;">	

<label id="ac_text">Account Name</label>

<div class="input-group">

<span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

<input type="text" name="fullname" class="form-control" value=""/>

</div>

</div>


<div class="form-group acc_tit" id="business" style="display: none;">	

<label id="ac_text">Business Name</label>

<div class="input-group">

<span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

<input type="text" name="fullname" class="form-control" value=""/>

</div>

</div>	

 
<div class="form-group acc_tit" id="business1" style="display: none;">	

<label id="ac_text">Owner's Name</label>

<div class="input-group">

<span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

<input type="text" name="fullname" class="form-control" value=""/>

</div>

</div>	 

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title">Fill the form below to setup your direct deposit account to receive payments</h3>

                </div>

                <div class="box-body">

                 <form role="form" method="post" id="addform"> 

                 	<div class="form-group">	

				    <label>Account Type</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <select name="account_type" id="ac_type" class="form-control">
                        <option value="individual">Personal</option>
                        <option value="business">Business</option>
                    </select>

                   </div>

                  </div>

                   <div class="form-group acc_tit">	

                    <label id="ac_text">Account Name</label>
                    
                    <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>
                    
                    <input type="text" name="fullname" class="form-control" value=""/>
                    <input type="hidden" name="fullname1" class="form-control" value=""/>
                    
                    </div>
                    
                    </div>   

                     
                  
                  
                  <div class="form-group">	

				    <label>Routing Number</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <input type="text" name="routing" class="form-control"  value=""/>

                   </div>

                  </div>   
                  
                  
                  <div class="form-group">	

				    <label>Bank Account Number</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <input type="text" name="account" class="form-control"  value=""/>

                   </div>

                  </div>  
                  
                  
                   

                           

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="data_stripe" class="btn btn-primary full-width submit"><?php echo $lang['submit']; ?></button><br/><br />

                    <!--<a href="withdraw.php" class="btn btn-info full-width"><?php echo $lang['back']; ?></a>-->

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

		 

		</div><!-- /.col -->   		 			

		



  

	 <?php elseif (Input::get('id') === '3') : 

	 	

	 	?>

	 	<div class="col-lg-12">



		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['updated_success']; ?></strong>

		   </div>

		  <?php } ?>

		 	

		  <?php if (isset($error)) {

			  echo $error;

		  } ?>

	        

         <?php if(isset($hasError)) { //If errors are found ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>

		   </div>

	      <?php } ?>

	

		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['saved_success']; ?></strong>

		   </div>

		  <?php } ?>	 		

	 		

	 	</div>

	 	

	 	

           

		 <div class="col-lg-12">

		 

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title">Skrill <?php echo $lang['withdrawal']; ?> <?php echo $lang['setup']; ?></h3>

                </div>

                <div class="box-body">

                 <form role="form" method="post" id="addform"> 

                 	

                  <div class="form-group">	

				    <label><?php echo $lang['your']; ?> <?php echo $lang['email']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <input type="text" name="email" class="form-control" value="<?php

                         if (isset($_POST['data_skrill'])) {

							 echo escape(Input::get('email')); 

						  } else {

						  echo escape($email_skrill); 

						  } ?>"/>

                   </div>

                  </div>    

                  <div class="form-group">	

				    <label><?php echo $lang['confirm']; ?> <?php echo $lang['email']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-mail-reply"></i></span>

                    <input type="text" name="confirm_email" class="form-control"  value="<?php

                         if (isset($_POST['data_skrill'])) {

							 echo escape(Input::get('confirm_email')); 

						  } else {

						  echo escape($confirm_email_skrill); 

						  } ?>"/>

                   </div>

                  </div>        

                           

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="data_skrill" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button><br/><br />

                    <a href="withdraw.php" class="btn btn-info full-width"><?php echo $lang['back']; ?></a>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

		 

		</div><!-- /.col -->   		 					

							 

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
    
    
    <!-- js file start -->
    
<script type="text/javascript">
$("#ac_type").change(function(){
    if($(this).val() == "business"){
       // $("#ac_text").html("Owner Name And Business Name");
       $(".acc_tit").remove();
       $(this).parents('.form-group').after('<div class="form-group acc_tit"><label id="ac_text">Business Name</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-mail-reply"></i></span><input type="text" name="fullname" class="form-control" value=""/></div></div><div class="form-group acc_tit"><label id="ac_text">Owner Name</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-mail-reply"></i></span><input type="text" name="fullname1" class="form-control" value=""/></div></div>');
    } else {

       $(".acc_tit").remove();
       $(this).parents('.form-group').after('<div class="form-group acc_tit"><label id="ac_text">Account Name</label><div class="input-group"><span class="input-group-addon"><i class="fa fa-mail-reply"></i></span><input type="text" name="fullname" class="form-control" value=""/><input type="hidden" name="fullname1" class="form-control" value=""/></div></div>');
    }
});


<?php
if(isset($_POST['data_stripe'])){
if (!$validation->fails()) {?>
$(document).ready(function(){
    var $form = $('#addform');        
     $form.find('.submit').prop('disabled', true);       
            Stripe.bankAccount.createToken({
  country: 'us',
  currency: 'USD',
  routing_number: "<?php echo Input::get('routing');?>",
  account_number: "<?php echo Input::get('account');?>",
  account_holder_name: "<?php echo Input::get('fullname');?> <?php echo Input::get('fullname1');?>",
  account_holder_type: "<?php echo Input::get('account_type');?>"
}, stripeResponseHandler);
});




	

	function stripeResponseHandler(status, response) {

		// Grab the form:
		var $form = $('#addform');

		if (response.error) { // Problem!
            alert('error:'+response.error.message);
			// Show the errors on the form:
			//$.msgShow('.payment-errors', response.error.message, 'error', '');
			$form.find('.submit').prop('disabled', false); // Re-enable submission

		} else { // Token was created!

			// Get the token ID:
			var token = response.id;
            
            console.log('success:'+token);
			// Insert the token ID into the form so it gets submitted to the server:
			$('#stripeToken').val(token);
            
            $('#payment-form').submit();
			//$form.append($('<input type="hidden"  id="card_id">').val(response.card.id));
			//submitCard();
		}
	};

	function submitCard() {

		var $form = $('#payment-form');
		// Disable the submit button to prevent repeated clicks:
		$form.find('.submit').prop('disabled', true);


		$('.spinner-class').show();
		var request = $.ajax({
			url: 'https://keehee.com/Freelancer/withdraw1.php',
			data: data,
			type: 'POST',
			dataType: 'json'
		});
		request.done(function (data) {
			

		});
		request.fail(function (jqXHR, textStatus) {
		  alert(textStatus);
			/*$('.spinner-class').hide();
			showErrors('.payment-errors', jqXHR);
			$form.find('.submit').prop('disabled', false);*/
		});
	}
<?php } } ?>
</script>

</body>

</html>

