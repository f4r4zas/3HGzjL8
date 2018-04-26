     

     <!-- ==============================================

	 Footer Section

	 =============================================== -->

     <div class="footer">

	  <div class="container">

	   <div class="row">

	  

	    <div class="col-md-5 col-sm-6 text-left">
<!--
	     <h4 class="heading no-margin"><?php echo $lang['about']; ?> <?php echo $lang['us']; ?></h4>
-->
		 <hr class="mint">
<!--
		 <p><?php echo $footer_about; ?></p>
-->

		<div class="col-md-6 forh" style="text-align: center; padding: 0px 5px;">
			<h2	>CUSTOMERS</h2>
			<h3 style="font-size: 15px;">Create</h3>
			<p style="padding: 0;">Create an ad and set your budget.</p>
			<h3 style="font-size: 15px;">Post</h3>
			<p style="padding: 0;">Post your ad and view profiles.</p>
			<h3 style="font-size: 15px;">Hire</h3>
			<p style="padding: 0;">Hire Professionals Service Provider with peace of mind</p>	
		</div>
		<div class="col-md-6 forh" style="text-align: center; padding: 0px 5px;">
			<h2>SERVICE PROVIDERS</h2>
			<h3 style="font-size: 15px;">SEARCH</h3>
			<p style="padding: 0;">Search for job and accept posted budge limit.</p>
			<h3 style="font-size: 15px;">REQUEST</h3>
			<p style="padding: 0;">Request to "provide service"</p>
			<h3 style="font-size: 15px;">SERVICE</h3>
			<p style="padding: 0;">Provide service, get paid and get review.</p>	
		</div>
			
		
		
	
	    </div><!-- /.col-md-4 -->

	   

	    <div class="col-md-5 col-sm-6 text-left paddingleft">

		<h4 class="heading no-margin myfolow">Follow <?php echo $lang['us']; ?></h4>
	     <!-- <h4 class="heading no-margin"><?php echo $lang['company']; ?></h4>

		 <hr class="mint">

		 <div class ="no-padding">

		  <a href="index.php"><?php echo $lang['home']; ?></a>

		  <a href="jobs.php"><?php echo $lang['jobs']; ?></a>

		  <a href="services.php"><?php echo $lang['services']; ?></a>

		  <a href="about.php"><?php echo $lang['about']; ?></a>

		  <a href="how.php"><?php echo $lang['how']; ?> <?php echo $lang['it']; ?> <?php echo $lang['works']; ?></a>

		 </div>

	    </div>

		

		<div class="col-md-3 col-sm-6 text-left">

	     <h4 class="heading no-margin"><?php echo $lang['other']; ?> <?php echo $lang['services']; ?></h4>

		 <hr class="mint">

		 <div class="no-padding">

		  <a href="login.php"><?php echo $lang['login']; ?></a>

		  <a href="register.php"><?php echo $lang['register']; ?></a>		 

		  <a href="faq.php"><?php echo $lang['faq']; ?></a>	

		  <a href="contact.php"><?php echo $lang['contact']; ?></a>		 	 

		 </div> -->

		 <ul class="social-links">

		  <li><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-fw"></i></a></li>

		  <li><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter fa-fw"></i></a></li>

		  <!--<li><a href="<?php echo $google; ?>"><i class="fa fa-google-plus fa-fw"></i></a></li>-->

		  <li><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram fa-fw"></i></a></li>

		  <!--<li><a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin fa-fw"></i></a></li>-->

		 </ul>
			
			<a>In Loving Memory of</a>
			<a>James E. Cochran - Co-CEO</a>
<a>Sept. 11, 1977 - Dec. 27, 2017</a>
			
			
			
	    </div>

		

	    <div class="col-md-2 col-sm-6 text-left">

	    <h4 class="heading no-margin"><?php //echo $lang['contact']; ?> <?php //echo $lang['us']; ?>
		Useful Links
		</h4>

		<hr class="mint">

		 <div class="no-padding">
<!--
		   <a><?php echo $contact_location; ?></a>

		   <a><?php echo $contact_phone; ?></a>

		   <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>	  
-->
			<li class="header-nav__navigation-item <?php echo $active = ($basename == 'pricing') ? ' active' : ''; ?>">

	          <a href="pricing.php" class="header-nav__navigation-link ">

	            <?php echo $lang['pricing']; ?>

	          </a>

	        </li>
			<li class="header-nav__navigation-item <?php echo $active = ($basename == 'faq') ? ' active' : ''; ?>">

	          <a href="faq.php" class="header-nav__navigation-link ">

	            <?php echo $lang['faq']; ?>

	          </a>

	        </li>
			<li class="header-nav__navigation-item <?php echo $active = ($basename == 'contact') ? ' active' : ''; ?>">

	          <a href="contact.php" class="header-nav__navigation-link ">

	            <?php echo $lang['contact']; ?>

	          </a>

	        </li>
            
            <li class="header-nav__navigation-item ">

	          <a style="color:#fff;" href="privacy.php">Privacy policy</a>

	        </li>
            
            <li class="header-nav__navigation-item">

	          <a style="color:#fff;" href="terms.php">Terms of use</a>

	        </li>

		  </div>

		 </div><!-- /.col-md-3 -->

		 

	    </div><!-- /.row -->

	   <div class="clearfix"></div>

	  </div><!-- /.container-->

     </div><!-- /.footer -->			

	 

	 <!-- ==============================================

	 Bottom Footer Section

	 =============================================== -->	

     <footer id="main-footer" class="main-footer">

	  <div class="container">

	   <div class="row">

	   

	    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

		 <!-- <ul class="social-links">

		  <li><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook fa-fw"></i></a></li>

		  <li><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter fa-fw"></i></a></li>

		  <li><a href="<?php echo $google; ?>"><i class="fa fa-google-plus fa-fw"></i></a></li>

		  <li><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram fa-fw"></i></a></li>

		  <li><a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin fa-fw"></i></a></li>

		 </ul> -->

		</div>

	    <!-- /.col-sm-4 -->

		

		<div style="text-align: center;" class="col-lg-8 col-md-8 col-sm-12 col-xs-12 revealOnScroll" data-animation="bounceIn" data-timeout="200">

	       <p style="display: inline-block; color:#fff !important;"><?php auto_copyright('','All Rights Reserved'); ?> </p> | <a style="color:#fff;" href="terms.php">Terms of use</a> | <a style="color:#fff;" href="privacy.php">Privacy policy</a>

		</div>

		<!-- /.col-sm-4 -->

		

		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right revealOnScroll" data-animation="slideInRight" data-timeout="200">

		 

		</div>

		<!-- /.col-sm-4 -->

				

	   </div><!-- /.row -->

	  </div><!-- /.container -->

	 </footer><!-- /.footer -->  

	 

     <a id="scrollup">Scroll</a>