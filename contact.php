<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');        
    exit;
}else{
 require_once 'core/frontinit.php';	
}

//Edit Data
if (Input::exists()) {
 if(Token::check(Input::get('token'))){

	$errorHandler = new ErrorHandler;
	
	$validator = new Validator($errorHandler);
	
	$validation = $validator->check($_POST, [
	  'name' => [
	     'required' => true,
	     'minlength' => 2
	  ],
	  'email' => [
	     'required' => true,
	     'minlength' => 2
	  ],
	  'message' => [
	     'required' => true,
	     'minlength' => 2
	  ]
	]);
		 
    if (!$validation->fails()) {
		

		$subject = 'New message from '.Input::get('name');
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: Input::get('name') \n\nEmail: Input::get('email') \n\nSubject: $subject \n\nMessage: Input::get('message')";
		$headers = 'From: ' .' <'.Input::get('email').'>' . "\r\n" . 'Reply-To: ' . $mail;

		mail($mail, $subject, $body, $headers);
        
        $noError = true;
			
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

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('includes/template/header.php'); ?> 

<body class="greybg">
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('includes/template/navigation.php'); ?> 
 	 <?php /*
      <!-- ==============================================
	 Header
	 =============================================== -->	 <div class="wow fadeInUp amaze-born" style="background-image: url('https://www.amazetal.com/assets/images/ac257a6ec9313c768998d977cb5fee3c.jpg'); visibility: visible; animation-name: fadeInUp;">    <div class="container">        <div class="row">            <div class="col-md-12 textadj">                <h2 class="rule">#1Rule</h2>                <p class="rule2">NO NEGOTIATING and NO HASSLE!</p>            </div>        </div>    </div></div><!--- form ---->	  <div class="container">	   <div class="row">	   			 <div class="col-lg-12">	      <?php if(isset($hasError)) { //If errors are found ?>	       <div class="alert alert-danger fade in">	        <a href="#" class="close" data-dismiss="alert">&times;</a>	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>		   </div>	      <?php } ?>			  <?php if(isset($noError) && $noError == true) { //If email is sent ?>		   <div class="alert alert-success fade in">		   <a href="#" class="close" data-dismiss="alert">&times;</a>		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['updated_success']; ?></strong>		   </div>		  <?php } ?>		  		  <?php if (isset($error)) {			  echo $error;		  } ?>          </div>	   		   	    <div class="text-center">		 <h3><?php echo $lang['have']; ?> <?php echo $lang['more']; ?> <?php echo $lang['questions']; ?></h3>		 <hr class="mint">		 <p class="top-p"><?php echo $contact_top_title; ?></p>	    </div>	          				   </div><!-- /.row -->	  </div><!-- /.container -->		  <!-- The contactform --><div class="container padoing">		<form method="post" id="contactform">		 <fieldset>		  <div class="col-lg-12 col-md-12">           <!-- Name -->			<div class="col-md-4">		   <label for="name" accesskey="U"><i class="fa fa-user"></i></label>		   <input name="name" type="text" id="name" size="30" value="" placeholder="Name" />		   </div>			<div class="col-md-4">		   <!-- Email -->		   <label for="email" accesskey="E"><i class="fa fa-envelope-o"></i></label>		   <input name="email" type="text" id="email" size="30" value=""placeholder="Email" />		   </div>		<div class="col-md-4">				            <select name="general_q" class="selctno">              <option>General questions</option>            </select>          		  </div>		  <div class="col-lg-12 col-md-12">		   <!-- Comments / Message -->		   <label for="comments" accesskey="C"><i class="fa fa-comment"></i></label>		   <textarea name="message" id="comments" placeholder="comments"></textarea>		  </div>		  <div class="col-lg-12 text-center">           <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />		   <button type="submit" class="kafe-btn kafe-btn-mint full-width">Submit</button>          </div>		 </fieldset>		</form>		</div>
     <!-- ==============================================
     Map Section
     =============================================== -->
     
     */?>
     
     
     <!-- ==============================================
	 Header
	 =============================================== -->
<div class="wow fadeInUp amaze-born" style="background-image: url('https://www.amazetal.com/assets/images/ac257a6ec9313c768998d977cb5fee3c.jpg'); visibility: visible; animation-name: fadeInUp;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 textadj">
                <h2 class="rule">#1Rule</h2>
                <p class="rule2">NO NEGOTIATING and NO HASSLE!</p>
            </div>
        </div>
    </div>
</div>
<!--- form ---->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if(isset($hasError)) { //If errors are found ?>
            <div class="alert alert-danger fade in"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong><?php echo $lang['hasError']; ?></strong>
                <?php echo $lang['has_Error']; ?> </div>
            <?php } ?>
            <?php if(isset($noError) && $noError == true) { //If email is sent ?>
            <div class="alert alert-success fade in"> <a href="#" class="close" data-dismiss="alert">&times;</a> <strong><?php echo $lang['noError']; ?></strong>
                <?php echo $lang['updated_success']; ?>
                </strong>
            </div>
            <?php } ?>
            <?php if (isset($error)) {			  echo $error;		  } ?> </div>
        <div class="text-center">
            <h3>
                <?php echo $lang['have']; ?>
                <?php echo $lang['more']; ?>
                <?php echo $lang['questions']; ?>
            </h3>
            <hr class="mint">
            <p class="top-p">
                <?php echo $contact_top_title; ?>
            </p>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<!-- The contactform -->
<div class="container padoing">
    <form method="post" id="contactform">
        <fieldset>
            <div class="col-lg-12 col-md-12">
                <!-- Name -->
                <div class="col-md-4"> <label for="name" accesskey="U"><i class="fa fa-user"></i></label> <input name="name" type="text" id="name" size="30" value="" placeholder="Name" /> </div>
                <div class="col-md-4">
                    <!-- Email --><label for="email" accesskey="E"><i class="fa fa-envelope-o"></i></label> <input name="email" type="text" id="email" size="30" value="" placeholder="Email" /> </div>
                <div class="col-md-4"> 
                    <select name="general_q" class="selctno">
                        <option value="" hidden="">Reason</option> 
                        <option value="service">service</option> 
                        <option value="payment">payment</option> 
                        <option value="press">press</option> 
                        <option value="sponsor">sponsor</option> 
                        <option value="account">account</option>            
                    </select> 
                </div>
                <div class="col-lg-12 col-md-12">
                    <!-- Comments / Message --><label for="comments" accesskey="C"><i class="fa fa-comment"></i></label> <textarea name="message" id="comments" placeholder="comments"></textarea> </div>
                <div class="col-lg-12 text-center"> <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" /> <button type="submit" class="kafe-btn kafe-btn-mint full-width">Submit</button> </div>
        </fieldset>
    </form>
    </div>
    <!-- ==============================================
     Map Section
     =============================================== -->
     
	 <div class="map" style="display: none;">
	  <div class="container-fluid">
	   <div class="row">
	   	<?php //echo $contact_map; ?>
	   	</div><!-- /.row -->
	  </div><!-- /.container-fluid -->
	 </div><!-- /.map -->
	 
     <!-- ==============================================
     Contact Section
     =============================================== -->	  	 
     <!-- Include footer.php. Contains footer content. -->
 	 <?php include ('includes/template/footer.php'); ?> 
	 
     <a id="scrollup">Scroll</a>
	 
     <!-- ==============================================
	 Scripts
	 =============================================== -->
	 
     <!-- jQuery 2.1.4 -->
     <script src="assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>
     <!-- Bootstrap 3.3.6 JS -->
     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
     <!-- Kafe JS -->
     <script src="assets/js/kafe.js" type="text/javascript"></script>

</body>
</html>
