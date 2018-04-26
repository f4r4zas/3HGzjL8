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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<style>



    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    
    .bx-wrapper img {
        width: 100%;
    }
    
    .bx-viewport{
        max-height: 547px;
    }
    
    .slide-content.container {
        width: 100%;
        left: 0; 
        background: rgba(0,0,0,0.8);
        padding: 0px 45px;
    }
    
    h3.editable_w.section_3 {
        font-size: 25px;
    }
    
    .editable_w.section_3 {
        margin: 0;
        font-size: 19px;
        line-height: 52.5px;
    }
    
    
    .editable_w.section_3.bgyello {
        background: transparent;
        font-size: 33px !important;
        font-weight: bold;
        color: #F1CE3F;
    }


.testimonies .feedback-box .client-image {
    display: none;
}

.panelssin {
    font-size: 16px;

}
</style>

<body class="greybg">

	

     <!-- Include navigation.php. Contains navigation content. -->

 	 <?php include ('includes/template/navigation.php'); ?> 

 	 
<div class="wow fadeInUp amaze-born" style="background-image: url('https://www.amazetal.com/assets/images/ac257a6ec9313c768998d977cb5fee3c.jpg'); visibility: visible; animation-name: fadeInUp;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 textadj">
                <h2 class="rule">#1Rule</h2>
                <p class="rule2" style="color: #fff !important;">NO NEGOTIATING and NO HASSLE!</p>
            </div>
        </div>
    </div>
</div>

   <div class="container">
   
	<div class="row">
    
    <div class="col-md-12">
        
        <p style="text-align: center;margin-top: 10px; font-size: 19px;">Click on your desired button below to sign-up and join the KeeHee community of people just like you who enjoy saving or earning money.</p>
    </div>
			<?php if($client->isLoggedIn()) { ?>
            <div class="col-md-12 padoing">
            <div class="col-md-12">
			     <a class="panelssin toclick" href="#" style="background: #e9701c; color: #fff;">Sign-up As Service Provider</a>
                 <div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="register.php?type=individual" style="background: #44115b; color: #fff; font-size: 16px;">Professional Individual</a>
    			</div>
    			<div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="register.php?type=business" style="background: #9c0e22; color: #fff; font-size: 16px;">Business</a>
    			</div>
			</div>
            
			
			</div>
            
            <?php } elseif($freelancer->isLoggedIn()) { ?>
            <div class="col-md-12 padoing">
			<div class="col-md-12">
			     <a class="panelssin" href="register.php" style="background: #345999; color: #fff;">Sign-up As Customer</a>
			</div>
            
			</div>
            
            <?php } else { ?>
			<div class="col-md-12 padoing">
			<div class="col-md-6">
			     <a class="panelssin" href="register.php" style="background: #345999; color: #fff;">Sign-up As Customer</a>
			</div>
            
            <div class="col-md-6">
			     <a class="panelssin toclick" href="#" style="background: #e9701c; color: #fff;">Sign-up As Service Provider</a>
                 <div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="register.php?type=individual" style="background: #44115b; color: #fff; font-size: 16px;">Professional Individual</a>
    			</div>
    			<div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="register.php?type=business" style="background: #9c0e22; color: #fff; font-size: 16px;">Business</a>
    			</div>
			</div>
            
			
			</div>
            <?php } ?>
            
            <div class="col-md-12" style="text-align: center; margin: 10px 0px; font-size: 18px;">

			  <span>Already have an account?</span> <a style="color: #e9701c; font-size: 18px;" href="login1.php" class="more-link">Login</a>

            </div>
	        		
		
	        		
	 
	
	</div>
   
   </div>
	 

    
	 
     <!-- Include footer.php. Contains footer content. -->

 	 <?php include ('includes/template/footer.php'); ?> 

	 

     <!-- ==============================================

	 Scripts

	 =============================================== -->

	 

     <!-- jQuery 2.1.4 -->

     <script src="assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>

     <!-- Bootstrap 3.3.6 JS -->

     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

     <!-- Typed JS -->
     
     <script>
     $(".toclick").click(function(e){
        e.preventDefault();
        $(".toshow").toggle();
        });
     
     </script>

     <script src="assets/js/typed.min.js" type="text/javascript"></script>

     <!-- Kafe JS -->

     <script src="assets/js/kafe.js" type="text/javascript"></script>



</body>

</html>

