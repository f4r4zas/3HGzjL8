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
.textadj p {
    color: #fff !important;
    margin-bottom: 15px;
}
</style>
<body class="greybg">
	
     <!-- Include navigation.php. Contains navigation content. -->
 	 <?php include ('includes/template/navigation.php'); ?> 
 	 <?php /*
      <!-- ==============================================
	 Header
	 =============================================== -->	 
     <!-- ==============================================
	 Hello Section
	 =============================================== -->
     <div class="about-intro">  <div class="container">    <div class="row">      <div class="intro-right col-md-6">        <h1>ABOUT US</h1>        <p>     KeeHee.com is a lead generation platform design to accommodate Customers, local businesses and professional individuals with common interest to conduct business with “No Negotiating and No Hassle!”</p>             </div>      <div class="intro-img col-md-6"> <img src="https://www.amazetal.com/assets/images/118235b42ecfac5ccc026bd3e6330123.jpg" class="img-responsive"alt=""> </div>    </div>  </div></div>
	 <!-- ==============================================
	 Timeline Section
	 =============================================== -->	  
<div class="section3">  <div class="container">    <div class="row">	<div class="col-lg-12 col-md-12 textadj">      <h2>THE PROBLEM</h2>      <div class="intro-text">	  <p>We live in a time of which supplies and demands does not always balance out with the average person’s income. The average American spend at least 40% more incomeon services that he/she needs.Local business does not alter their set prices because they have to afford to stay in business. May 2014, CBSDC reported that in 2017 more than 92 Million American will beout of jobs and seeking some form of employment. These glitches are what causes economic meltdown and recessions. </p> <p class="intro-text1">The average American want to work and live the American dreams. Most people are working with limited budget when they need service, there is always someone out there with the skills set willing to provide services for the price that the customer can afford. </p><p class="intro-text1">How can we fix this unemployment mess? How can we balance supplies and demands for customers? How can we unite communities to help each another? Look no farther!</p></div></div>      <div class="vision col-md-6"> <img src="https://www.amazetal.com/assets/images/adc2420f7fadd37d3455a38f320ff010.jpg" class="img-responsive" alt="">        <div class="text-content">          <h3>OUR VISION</h3>          <p>Our vision to strive to reduce or end poverty by creating the opportunities which enable people to spend or earn money according to their desires.</p>        </div>      </div>      <div class="vision col-md-6"> <img src="https://www.amazetal.com/assets/images/fec619de7fd0cced5fe4b4b1951cb823.jpg" class="img-responsive" alt="">        <div class="text-content">          <h3>OUR MISSION</h3>          <p>Our mission is to unify communities by providing a platform where people of common interest can conduct business with “No Negotiating and No Hassle,”at the end everyone wins!</p>        </div>      </div>    </div>  </div></div><div class="wow fadeInUp amaze-born" style="background-image: url(&quot;https://www.amazetal.com/assets/images/ac257a6ec9313c768998d977cb5fee3c.jpg&quot;); visibility: visible; animation-name: fadeInUp;">  <div class="container">    <div class="row">      <div class="col-md-12 textadj">        <h2 class="rule">#1Rule</h2>        <p class="rule2">NONEGOTIATING and NO HASSLE!</p>      </div>    </div>  </div></div><div class="section4 textadj" style="visibility: visible; animation-name: fadeInUp;display: nonw;">  <div class="container">    <div class="row">      <h2>What Inspire KeeHee?</h2>      <div class="intro-text">	  <p class="intro-text1"> Like all great ideals, it starts with a vision. However, KeeHee was inspired by real life experiences. Let’s take Lisa story for instant. Lisa is a single mother of two beautiful children. She need to move over the weekend, and she’s working with a set budget. She can’t afford to hire a professional moving company because they have a rate is far too expansive and exceed Lisa budget limit. Her two-beautiful little helper are too young to lift the family furniture. </p><p class="intro-text1">Now Lisa is desperate, so she asked her friends and family for help, just to come to a dead end. </p><p class="intro-text1"> if they knew anyone who could help her move over the weekend and she will pay for their service. But all Lisa got was the help was which she didn’t have because she did not to KeeHee.com. </p><p class="intro-text1">At KeeHee.comwe have Paul who live few blocks away from Lisa and work as a professional Furniture Delivery Service guy but enjoy helping people and earning extra income. </p><p class="intro-text1">KeeHee.com makes it easy and connivance for Lisa and Paul to exchange come interest with “No Negotiating and No Hassle!”</p><p class="intro-text1">We all know by now that when we’re in need of a service and working with a limited budget, the last thing you want to hear is some over pricing for local business. Sometimes we may get desperate and hire help by recommendation by family and friend which does not always turn out quick well at times.</p> <p class="intro-text1">With limited access to the opportunities of hiring the perfect help within our budget limit, can sometime get frustrating.</p></div>    </div>  </div></div>
	 */ ?>
     
     <div class="about-intro">
    <div class="container">
        <div class="row">
            <div class="intro-right col-md-6">
                <h1>ABOUT US</h1>
                <p style="color: #fff !important;">KeeHee.com is a lead generation platform designed to accommodate Customers, local businesses and professional individuals with common interests to conduct business with <b>"No Negotiating and No Hassle!"</b></p>
            </div>
            <div class="intro-img col-md-6"> <img src="assets/img/06689e473998a4ef296d36c0b8f008ff.jpg" class="img-responsive" alt=""> </div>
        </div>
    </div>
</div>
<!-- ==============================================
	 Timeline Section
	 =============================================== -->
<div class="section3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 textadj">
                <h2 style="font-weight: bold;">THE PROBLEM</h2>
                <div class="intro-text">
                    <p>We live in a time which supply and demand do not always balance out with the average person’s income. The average American spends at least 40% of their income on services that he/she needs. Local businesses do not alter set prices because they have to afford to stay in business. May 2014, CBSDC reported that in 2017 more than 92 Million Americans will be out of jobs and seeking some form of employment.  The KeeHee service providers can adequately supplement his/her income by doing what they love, operating within the KeeHee infrastructure.  The KeeHee platform helps to create jobs and build communities.  Eliminating some of the glitches that cause economic meltdown and recessions. </p>
                    <p class="intro-text1">The average American wants to work and live the American dream.  On the one hand, most people are working with limited budgets when they need service.  On the other, there is always someone out there with the skillset willing to provide services for the price that the customer can afford. </p>
                    <p class="intro-text1">How can KeeHee contribute to lowering unemployment? How can we balance supply and demand for customers? How can we unite communities to help each another? Look no farther! Just KeeHee it!</p>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 textadj">
                <h2 style="font-weight: bold;">THE SOLUTION</h2>
                <div class="intro-text">
                    <p>KeeHee is designed for the customer who is in need of services, wants to hire Professional help but DOES NOT want to exceed his/her budget limit. The KeeHee customer has full control of how much money he/she wants to spend and whom they decide to hire with <b>"No Negotiating and No Hassle!"</b> Our platform is also designed to service local business. </p>
                    <p class="intro-text1">With just a few clicks, local businesses can save a minimum of $1,500 per year on advertisements and focus more on providing excellent service to extraordinary customers. Our top priority is to make a comprehensive contribution to reducing unemployment in America.  Our primary goal is to create an equal opportunity networking system which allows Professional individuals and job candidates with skillsets, talents, and abilities to provide excellent service to others while earning extra income or to gain temporary employment.</p>
                </div>
            </div>
            
            <div class="clearfix"></div>
            
            <div class="vision col-md-6"> <img src="https://www.amazetal.com/assets/images/fec619de7fd0cced5fe4b4b1951cb823.jpg" class="img-responsive" alt="">
                <div class="text-content">
                    <h3>OUR VISION</h3>
                    <p style="color: #fff !important;">Our vision to strive to reduce or end poverty by creating the opportunities which enable people to spend or earn money according to their desires.</p>
                </div>
            </div>
            <div class="vision col-md-6"> <img src="https://www.amazetal.com/assets/images/adc2420f7fadd37d3455a38f320ff010.jpg" class="img-responsive" alt="">
                <div class="text-content">
                    <h3>OUR MISSION</h3>
                    <p style="color: #fff !important;">Our mission is to unify communities by providing a platform where people of common interest can conduct business with “No Negotiating and No Hassle,” in the end everyone wins!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display: none;" class="wow fadeInUp amaze-born" style="background-image: url('https://www.amazetal.com/assets/images/ac257a6ec9313c768998d977cb5fee3c.jpg'); visibility: visible; animation-name: fadeInUp;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 textadj">
                <h2 class="rule">#1Rule</h2>
                <p class="rule2">NO NEGOTIATING and NO HASSLE!</p>
            </div>
        </div>
    </div>
</div>
<div class="section4 textadj" style="visibility: visible; animation-name: fadeInUp;display: nonw;">
    <div class="container">
        <div class="row">
            <h2 style="text-decoration: underline;">What Inspire KeeHee?</h2>
            <div class="intro-text">
                <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1"> Like all great ideas, it starts with a vision. However, KeeHee was inspired by real life experiences. Let’s take Lisa’s story for instance. Lisa is a single mother of two beautiful children. She needs to move over the weekend, and she’s working with a set budget. She can’t afford to hire a professional moving company because their rate is far too expansive and exceeds Lisa’s budget. Her two-beautiful little helpers are too young to lift the family furniture. </p>
                <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">Now Lisa is desperate, so she asks her friends and family for help, but it all comes to a dead end</p>
                    <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">If only she knew anyone who could help her move over the weekend and she will pay for their service. Lisa needs the services of KeeHee.com.  Lisa just needs to KeeHee! </p>
                    <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">At KeeHee.com we have Paul who lives few blocks away from Lisa and works as a professional Furniture Delivery Service worker but enjoys helping people in his free time for some extra income.</p>
                    <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">KeeHee.com makes it easy and convenient for Lisa and Paul to exchange a common interest with “No Negotiating and No Hassle!”  Lisa posts her ad specifying how much she can afford to pay for moving on KeeHee.com. Paul considers and accepts Lisa’s price with “No Negotiating and No Hassle!”</p>
                    <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">When we’re in need of a service and working with a limited budget, the last thing we want to hear is a costly estimate for service. Sometimes in desperation we hire help based on a recommendation by family or friends, which does not always work out right.</p>
                    <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">Hiring the perfect help can become tedious and frustrating, especially when you’re working with a limited budget. </p>
                    
                    <p style="color: #fff !important; margin-bottom: 15px;" class="intro-text1">KeeHee.com has revolutionize the process by giving you unlimited access to service providers willing to work with your budget At KeeHee.com, customers set budgets and hire the perfect help without NO NEGOTIATING and NO HASSLE!  It is your money, no one should tell you how to spend it!</p>
                    
                    <p style="color: #fff !important;" class="intro-text1">Conversely, for business owners and professional individuals, it’s convenient and since it takes a lot of the guesswork out, they can focus more on providing excellent service to extraordinary customersSign up today for your free account at KeeHee.com and experience the total convenience of connecting with the right service provider on this spectacular and innovative platform. Get involved in the seamless exchange of transactions between customers, local business and professional individuals with NO HASSLE and NO NEGOTIATION! In the end, everyone wins!</p>
            </div>
        </div>
    </div>
</div>
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
