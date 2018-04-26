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
    font-size: 18px;
}
</style>

<body class="greybg">

	

     <!-- Include navigation.php. Contains navigation content. -->

 	 <?php include ('includes/template/navigation.php'); ?> 

 	 
<div class="wow fadeInUp amaze-born" style="background-image: url('https://www.amazetal.com/assets/images/ac257a6ec9313c768998d977cb5fee3c.jpg'); visibility: visible; animation-name: fadeInUp;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 textadj">
                <h2 class="rule">Just KeeHee It!</h2>
                <p class="rule2" style="color: #fff !important;">KeeHeeeeee...</p>

            </div>
        </div>
    </div>
</div>

   <div class="container">
   
	<div class="row">
    <?php if(!isset($_GET['mid'])){?>
    <div class="col-md-12">
        
        <p style="text-align: center;margin-top: 10px; font-size: 19px;">Need a service or want to provide services? Simply click on your desired button below to post a services or search of services.</p>
    </div>
    <?php } ?>
    
    <?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 if(isset($_GET['mid'])){?>
         
         <p style="padding:10px; margin-top:30px;"><img style="margin: 0 auto; display: block; max-width: 10%;" src="https://i.pinimg.com/originals/ff/39/3c/ff393c68c728948d79994563bd34ce5c.gif"/><br /><br /><span style="font-size: 20px;">Oops!</span> The Service Provider's package plans are only for Service Providers. However if you are interesed in providing services to customers, please <a href="login1.php" style="font-weight:bold; color:#5fb2fb;">Login</a> as a Service Provider or <a href="signup.php" style="font-weight:bold; color:#5fb2fb;">Sign up</a> for Service Provider account.<br /><br /></p>
		  
		 <?php }elseif($client->isLoggedIn()) { ?>
         <div class="col-md-12 padoing">

            
            <div class="col-md-12">
			     <a class="panelssin toclick" href="#" style="background: #44115b; color: #fff;">Login As Service Provider</a>
                 <div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="login.php?type=individual" style="background: #e9701c; color: #fff; font-size: 16px;">Professional Individual</a>
    			</div>
    			<div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="login.php?type=business" style="background: #345999; color: #fff; font-size: 16px;">Business</a>
    			</div>
			</div>
            
			
			</div>
         
         <?php } elseif($freelancer->isLoggedIn()) { ?>
            <div class="col-md-12 padoing">
			<div class="col-md-12">
			     <a class="panelssin" href="login.php" style="background: #af0f25; color: #fff;">Login As Customer</a>
			</div>

			</div>
         <?php } else{ ?>
			
			<div class="col-md-12 padoing">
			<div class="col-md-6">
			     <a class="panelssin" href="login.php" style="background: #af0f25; color: #fff;">Login As Customer</a>
			</div>
            
            <div class="col-md-6">
			     <a class="panelssin toclick" href="#" style="background: #44115b; color: #fff;">Login As Service Provider</a>
                 <div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="login.php?type=individual" style="background: #e9701c; color: #fff; font-size: 16px;">Professional Individual</a>
    			</div>
    			<div class="col-md-6 toshow" style="display: none; margin-top: 10px;">
    			     <a class="panelssin" href="login.php?type=business" style="background: #345999; color: #fff; font-size: 16px;">Business</a>
    			</div>
			</div>
            
			
			</div>
        <?php } ?>
            
            <?php if(!isset($_GET['mid'])){?>
            <div class="col-md-12" style="text-align: center; margin: 10px 0px; font-size: 18px;">

			  <span>Don't have an account?</span> <a style="color: #e9701c; font-size: 18px;" href="signup.php" class="more-link">Sign-up</a>

            </div>
            <?php } ?>
	        		
			
	        		
	 
	
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

