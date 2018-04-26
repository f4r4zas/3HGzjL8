<?php
//Check if init.php exists
if(!file_exists('core/frontinit.php')){
	header('Location: install/');        
    exit;
}else{
 require_once 'core/frontinit.php';	
}


?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
	
    <!-- Include header.php. Contains header content. -->
    <?php include ('includes/template/header.php'); ?> 
<style>
h3.editable_w.section_3 {
        font-size: 25px;
    }
    
    .editable_w.section_3 {
        margin: 0;
        font-size: 19px;
        line-height: 52.5px;
        color: #fff !important;
    }
    
    
    .editable_w.section_3.bgyello {
        background: transparent;
        font-size: 33px !important;
        font-weight: bold;
        color: #F1CE3F;
    }
section.how-works {
    padding: 40px 0;
    background: #ffffff !important;
    text-align: center;
    color: #000;
}

section.how-works1 .heading {
    color: #000;
}

.how-works1 .sec_heading {
    color: #000;
}
</style>
<body class="greybg">
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('includes/template/navigation.php'); ?> 
     
     <?php /*
 	 
      <!-- ==============================================
	 Header
	 =============================================== -->	 <section class="how-works how-works1">		<div class="container">			<div class="sec_heading">How It Works</div>			<div class="row rflex">				<div class="col-md-6 nopading">					<div class="heading">Customers</div>					<div class="work-box">						<div class="bx">							<div class="title">Sign Up</div>							<small>Create your free account. Its fun !</small>						</div>						<div class="bx">							<div class="title">Create &amp; Post</div>							<small>Create a classified ad for the service you need, set your budget limited and post</small>						</div>						<div class="bx">							<div class="title">Review</div>							<small>Review Service provide profiles who request to service provide to you</small>						</div>						<div class="bx">							<div class="title">Hire or Reject</div>							<small>Decide to hire or reject Service Provider’s request to “Provide Service”</small>						</div>						<div class="bx">							<div class="title">Rating</div>							<small>Upon hiring a Service Provide, share your exprience, give them a star rating and write a review</small>						</div>					</div>				</div>								<div class="col-md-6 nopading">					<div class="heading">Providers</div>					<div class="work-box">						<div class="bx">							<div class="title">Sign Up</div>							<small>Create your free account. Its fun !</small>						</div>						<div class="bx">							<div class="title">Create &amp; Post</div>							<small>Create a classified ad for the service you need, set your budget limited and post</small>						</div>						<div class="bx">							<div class="title">Review</div>							<small>Review Service provide profiles who request to service provide to you</small>						</div>						<div class="bx">							<div class="title">Hire or Reject</div>							<small>Decide to hire or reject Service Provider’s request to “Provide Service”</small>						</div>						<div class="bx">							<div class="title">Rating</div>							<small>Upon hiring a Service Provide, share your exprience, give them a star rating and write a review</small>						</div>					</div>				</div>			</div>		</div>	</section>
	 
	 <!-- ==============================================-->
	 <section class="we-perfect weperfect1">				<div class="container">            <div class="row">              <!--edit to here -->                 <div class="col-md-12 editable_S">                <h2 class="editable_w section_3 bgyello">WHY US</h2>                <h3 class="editable_w section_3">Services</h3>                <p class="editable_w section_3">Get the service you need without exceeding budget limit.</p>				<h3 class="editable_w section_3">Convenience</h3>                <p class="editable_w section_3">Hire Professionals Service Providers with NONEGOTIATING and NO HASSLE!</p>				<h3 class="editable_w section_3">Satisfaction</h3>                <p class="editable_w section_3">Customers and Service Providers unify to conduct business of comment interest andeveryone wins!</p>              </div>            </div>          </div>		</section>
		<!-- ================================================ -->		  
     */ ?>
     
     
     <!-- ==============================================
	 Header
	 =============================================== -->
<section class="how-works how-works1 col-md-12">
    <div class="container">
        <div class="sec_heading" style="text-decoration: underline;">How It Works?</div>
        <div class="row" style="padding: 0 30px;">
            <div class="col-md-6 col-sm-12 col-xs-12 nopading">
					<div class="heading">Customers</div>
					<div class="work-box">
						<div class="bx">
							<div class="title">Sign Up</div>
							<small>Create your free account. It's fun!</small>
						</div>
						<div class="bx">
							<div class="title">Create & Post</div>
							<small>Create a classified ad for the service you need, set your budget limit and post. <br /> &nbsp;</small>
						</div>
						<div class="bx">
							<div class="title">Review</div>
							<small>Review Service providers profiles who request to "Provide Service" to you.<br />&nbsp;</small>
						</div>
						<div class="bx">
							<div class="title">Hire or Reject</div>
							<small>Decide to hire or reject Service Providers request to "Provide Service"<br />&nbsp;</small>
						</div>
						<div class="bx">
							<div class="title">Rating</div>
							<small>Upon hiring a Service Provider, share your experience, give them a star rating and write a review.</small>
						</div>
					</div>
				</div>

				

				<div class="col-md-6 col-xs-12 col-sm-12 nopading">
					<div class="heading">Service Providers</div>
					<div class="work-box">
						<div class="bx">
							<div class="title">Sign Up</div>
							<small>Create your Free account. It's easy</small>
						</div>
						<div class="bx">
							<div class="title">Create</div>
							<small>Create an eye-catching business or professional Individual profile about the services you provide.</small>
						</div>
						<div class="bx">
							<div class="title">Search</div>
							<small>Search customers ads and request to "Provide Service" for services you will like to and have the expertise to provide.</small>
						</div>
						<div class="bx">
							<div class="title">Get Hire</div>
							<small>Upon being hired, present and preform your best job leaving the customer with an outstanding impression.</small>
						</div>
						<div class="bx">
							<div class="title">Rating</div>
							<small>Read about what customers are saying you. Remember, reviews can affect the next customer’s decision about hiring you.</small>
						</div>
					</div>
				</div>
        </div>
    </div>
</section>


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

<!-- ==============================================-->
<section class="we-perfect">
				<div class="container">
            <div class="row">
              <!--edit to here -->
                 <div class="col-md-12 editable_S">
                <h2 style="text-decoration: underline;" class="editable_w section_3 bgyello">WHY US?</h2>
                <h3 class="editable_w section_3">Services</h3>
                <p class="editable_w section_3">Get the service you need without exceeding budget limit.</p>
				<h3 class="editable_w section_3">Convenience</h3>
                <p class="editable_w section_3">Hire Professionals Service Providers with NO NEGOTIATING and NO HASSLE!</p>
				<h3 class="editable_w section_3">Satisfaction</h3>
                <p class="editable_w section_3">Customers and Service Providers unify to conduct business of comment interest and everyone wins!</p>
              </div>
            </div>
          </div>	

	</section>
<!-- ================================================ -->
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
