<?php

//Check if frontinit.php exists

if(!file_exists('core/frontinit.php')){

	header('Location: install/');        

    exit;

}else{

 require_once 'core/frontinit.php';	

}



//Get Site Settings Data

$query = DB::getInstance()->get("settings", "*", ["id" => 1]);

if ($query->count()) {

 foreach($query->results() as $row) {

 	$title = $row->title;

 	$use_icon = $row->use_icon;

 	$site_icon = $row->site_icon;

 	$tagline = $row->tagline;

 	$description = $row->description;

 	$keywords = $row->keywords;

 	$author = $row->author;

 	$bgimage = $row->bgimage;

 }			

}



//Log In Function

if (Input::exists()) {

 if(Token::check(Input::get('token'))){

	 

	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'email' => [

	     'required' => true,

	     'maxlength' => 255,

	     'email' => true

	   ],

	   'password' => [

	     'required' => true,

	     'minlength' => 6

	   ]

	]);

	 	

	  if (!$validation->fails()) {

	  	

		if (Input::get('user_type') === 'on') {

			 	

			 //Log Client In

	         $client = new Client();

			 

			 $remember = (Input::get('remember') === 'on') ? true : false;

			 $login = $client->login(Input::get('email'), Input::get('password'), $remember);

			 

			 if ($login === true) {

	           Redirect::to('Client/');

			 }else {

			   $hasError = true;

			 }			
			
		} else {

		

			 //Log freelancer In

			 $freelancer = new Freelancer();

	

			 $remember = (Input::get('remember') === 'on') ? true : false;

			 $login = $freelancer->login(Input::get('email'), Input::get('password'), $remember);

			 

			 if ($login === true) {

	           Redirect::to('Freelancer/');

			 }else {

			   $hasError = true;

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



?>

<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->

<html lang="en" class="no-js"> 

<!--<![endif]-->

<head>



	    <!-- ==============================================

		Title and Meta Tags

		=============================================== -->

		<meta charset="utf-8">

        <title><?php echo escape($title) .' - '. escape($tagline) ; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="description" content="<?php echo escape($description); ?>">

        <meta name="keywords" content="<?php echo escape($keywords); ?>">

        <meta name="author" content="<?php echo escape($author); ?>">

		

		<!-- ==============================================

		Favicons

		=============================================== --> 

		<link rel="shortcut icon" href="img/favicons/favicon.ico">

		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">

		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">

		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">

		

	    <!-- ==============================================

		CSS

		=============================================== -->

        <!-- Style-->

        <link href="assets/css/login.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/hopler.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/fr_custom.css" rel="stylesheet" type="text/css" />

				

		<!-- ==============================================

		Feauture Detection

		=============================================== -->

		<script src="assets/js/modernizr-custom.js"></script>

		

		<!--[if lt IE 9]>

		 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

		<![endif]-->		

	<style>
    #header .header-nav__navigation-link {

    font-size: 10px;
    }
    
    #scrollup{
        display: none !important;
    }
    </style>	
<?php echo $google_analytics; ?>
</head>



<body>



	<!-- Paste this code after body tag -->

    <div class="loader">

	<div class="se-pre-con"></div>

    </div>

    

 <? 

$basename = basename($_SERVER["REQUEST_URI"], ".php");

$editname = basename($_SERVER["REQUEST_URI"]);

$test = $_SERVER["REQUEST_URI"];

?>

     <!-- ==============================================

     Navigation Section

     =============================================== -->

	<header id="header" headroom="" role="banner" tolerance="5" offset="700" class="navbar navbar-fixed-top navbar--white ng-isolate-scope headroom headroom--top">

	  <nav role="navigation">

	    <div class="navbar-header">

	      <button type="button" class="navbar-toggle header-nav__button" data-toggle="collapse" data-target=".navbar-main">

	        <span class="icon-bar header-nav__button-line"></span>

	        <span class="icon-bar header-nav__button-line"></span>

	        <span class="icon-bar header-nav__button-line"></span>

	      </button>

	      <div class="header-nav__logo">

	        <a class="header-nav__logo-link navbar-brand" href="index.php">

	       	<?php if($use_icon === '1'): ?>

	       		<!-- <i class="fa <?php echo $site_icon; ?>"></i> -->

	       	<?php endif; ?> 

	       	<!-- <?php echo escape($title); ?> -->

					 <div class="brand_logo">
 							<img src="assets/img/logo-1.png" alt="KeeHee">
					 </div>

					 </a>
	      </div>

	    </div>

	    <div class="collapse navbar-collapse navbar-main navbar-right">

	      <ul class="nav navbar-nav header-nav__navigation">

	        <li class="header-nav__navigation-item

	         <?php echo $active = ($basename == 'index') ? ' active' : ''; ?>">

	          <a href="index.php" class="header-nav__navigation-link">

	            <?php echo $lang['home']; ?>

	          </a>

	        </li>
            
            
             <?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 



		 if ($admin->isLoggedIn() || $client->isLoggedIn() || $freelancer->isLoggedIn()) { ?>

	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'jobs') ? ' active' : ''; echo $active = ($editname == 'jobpost.php?title='. Input::get('title').'') ? ' active' : '';?>">

	          <a href="jobs.php" class="header-nav__navigation-link ">

	            <?php echo $lang['jobs']; ?>

	          </a>

	        </li>
            
         <?php } else { ?>
            <li class="header-nav__navigation-item <?php echo $active = ($basename == 'jobs') ? ' active' : ''; echo $active = ($editname == 'jobpost.php?title='. Input::get('title').'') ? ' active' : '';?>">

	          <a href="login1.php" class="header-nav__navigation-link ">

	            <?php echo $lang['jobs']; ?>

	          </a>

	        </li>
         <?php } ?>

	        <!--<li class="header-nav__navigation-item <?php echo $active = ($basename == 'services') ? ' active' : ''; echo $active = ($editname == 'freelancer.php?a='. Input::get('a').'&id='. Input::get('id').'') ? ' active' : ''; echo $active = ($editname == 'searchpage.php?searchterm='. Input::get('searchterm').'') ? ' active' : ''; ?>">

	          <a href="services.php" class="header-nav__navigation-link ">

	            <?php echo $lang['services']; ?>

	          </a>

	        </li>-->

	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'about') ? ' active' : ''; ?>">

	          <a href="about.php" class="header-nav__navigation-link ">

	            <?php echo $lang['about']; ?>

	          </a>

	        </li>

	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'how') ? ' active' : ''; ?>">

	          <a href="how.php" class="header-nav__navigation-link ">

	            <?php echo $lang['how']; ?> <?php echo $lang['it']; ?> <?php echo $lang['works']; ?>

	          </a>

	        </li>

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

	        <li class="header-nav__navigation-item <?php echo $active = ($basename == 'sponsor') ? ' active' : ''; ?>">

	          <a href="sponsor.php" class="header-nav__navigation-link ">

	            Sponsor<?php //echo $lang['contact']; ?>

	          </a>

	        </li>

		 <?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 

		 if ($admin->isLoggedIn()) { ?>
         

              <li class="user user-menu">

                <!-- Menu Toggle Button -->

                <a href="Admin/dashboard.php" >

                  <!-- The user image in the navbar-->

            	<?php // echo $profileimg; ?>

                  <img src="Admin/<?php echo escape($admin->data()->imagelocation); ?>" class="user-image" alt="User Image"/>

                

                  <!-- hidden-xs hides the username on small devices so only the image appears. -->

                  <span class="hidden-xs">

                  	<?php echo escape($admin->data()->name); ?>

                  </span>

                </a>

                <!--<ul class="dropdown-menu" >

						<li class="m_2"><a href="Admin/dashboard.php"><i class="fa fa-dashboard"></i><?php echo $lang['dashboard']; ?></a></li>

						<li class="m_2"><a href="Admin/profile.php?a=profile"><i class="fa fa-user"></i><?php echo $lang['view']; ?> <?php echo $lang['profile']; ?></a></li>

						<li class="m_2"><a href="Admin/logout.php"><i class="fa fa-lock"></i> <?php echo $lang['logout']; ?></a></li>	

        		</ul>-->

              </li>

		<?php } elseif($client->isLoggedIn()) { ?>

              <li class=" user user-menu">

                <!-- Menu Toggle Button -->

                <a href="Client/">

                  <!-- The user image in the navbar-->

            	<?php // echo $profileimg; ?>

                  <img src="Client/<?php echo escape($client->data()->imagelocation); ?>" class="user-image" alt="User Image"/>

                

                  <!-- hidden-xs hides the username on small devices so only the image appears. -->

                  <span class="hidden-xs">

                  	<?php echo escape($client->data()->name); ?>

                  </span>

                </a>

                <!--<ul class="dropdown-menu">

						<li class="m_2"><a href="Client/"><i class="fa fa-dashboard"></i><?php echo $lang['dashboard']; ?></a></li>

						<li class="m_2"><a href="Client/profile.php?a=profile"><i class="fa fa-user"></i><?php echo $lang['view']; ?> <?php echo $lang['profile']; ?></a></li>

						<li class="m_2"><a href="Client/logout.php"><i class="fa fa-lock"></i> <?php echo $lang['logout']; ?></a></li>	

        		</ul>-->

              </li>

		<?php } elseif($freelancer->isLoggedIn()) { ?>

              <li class="user user-menu">

                <!-- Menu Toggle Button -->

                <a href="Freelancer/index.php">

                  <!-- The user image in the navbar-->

            	<?php // echo $profileimg; ?>

                  <img src="Freelancer/<?php echo escape($freelancer->data()->imagelocation); ?>" class="user-image" alt="User Image"/>

                

                  <!-- hidden-xs hides the username on small devices so only the image appears. -->

                  <span class="hidden-xs">

                  	<?php echo escape($freelancer->data()->name); ?>

                  </span>

                </a>

                <!--<ul class="dropdown-menu">

						<li class="m_2"><a href="Freelancer/index.php"><i class="fa fa-dashboard"></i><?php echo $lang['dashboard']; ?></a></li>

						<li class="m_2"><a href="Freelancer/profile.php?a=profile"><i class="fa fa-user"></i><?php echo $lang['view']; ?> <?php echo $lang['profile']; ?></a></li>

						<li class="m_2"><a href="Freelancer/logout.php"><i class="fa fa-lock"></i> <?php echo $lang['logout']; ?></a></li>	

        		</ul>-->

              </li>

		<?php } else { ?>		 		        


	    
	        <li class="header-nav__navigation-item logins">
			
			<a href="login1.php" class="dropdown-toggle header-nav__navigation-item logina" type="button" id="dropdownMenuButton" ><?php echo $lang['login']; ?></a>
			
			
	
	        </li>
			
			<li class="header-nav__navigation-item logins">
			
			<a href="signup.php" class="dropdown-toggle header-nav__navigation-item logina" type="button" id="dropdownMenuButton" ><?php echo 'Sign-up'; ?></a>
			
			
	 
	        </li>

		 <?php } ?>              		 	



              <li style="display: none;" class="dropdown user user-menu">

                <!-- Menu Toggle Button -->

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  	<?php echo $lang['languages']; ?>

                </a>

                <ul class="dropdown-menu">

					<li class="m_2"><a href="<?php echo $test; ?>?lang=english">English</a></li>

					<li class="m_2"><a href="<?php echo $test; ?>?lang=french">French</a></li>

					<li class="m_2"><a href="<?php echo $test; ?>?lang=german">German</a></li>	

					<li class="m_2"><a href="<?php echo $test; ?>?lang=portuguese">Portuguese</a></li>

					<li class="m_2"><a href="<?php echo $test; ?>?lang=spanish">Spanish</a></li>

					<li class="m_2"><a href="<?php echo $test; ?>?lang=russian">Russian</a></li>	

					<li class="m_2"><a href="<?php echo $test; ?>?lang=chinese">Chinese</a></li>	

        		</ul>

              </li>





              	        

	      </ul>

	    </div>

	  </nav>

	</header>       

	 

     <!-- ==============================================

	 Header

	 =============================================== -->	 

	 <header class="header-login" style=" display: none;

    background: linear-gradient(

      rgba(34,34,34,0.7), 

      rgba(34,34,34,0.7)

    ), url('<?php echo $bgimage; ?>') no-repeat center center fixed;

   background-size: cover;

  background-position: center center;

  -webkit-background-size: cover;

  -moz-background-size: cover;

  -o-background-size: cover;

  color: #fff;

  height: 60vh;

  width: 100%;

  

  /*display: flex;*/

  flex-direction: column;

  justify-content: center;

  align-items: center;

  text-align: center; ">

      <div class="container">

	   <div class="content">

	    <div class="row">

	     <h1 class="revealOnScroll" data-animation="fadeInDown">

	       	<?php if($use_icon === '1'): ?>

	       		<i class="fa <?php echo $site_icon; ?>"></i>

	       	<?php endif; ?>  <?php echo escape($title); ?></h1>

		 <div id="typed-strings">

		  <span><?php echo escape($tagline); ?></span>

		 </div>

		 <p id="typed"></p>

        </div><!-- /.row -->

       </div><!-- /.content -->

	  </div><!-- /.container -->

     </header><!-- /header -->

	 

     <!-- ==============================================

     Banner Login Section

     =============================================== -->

	 <section class="banner-login">

	  <div class="container">

	  		  	

	   <div class="row">

	   

	    <main class="main main-signup col-lg-12">

	     <div class="col-lg-6 col-lg-offset-3 text-center">

	     	

        <?php if(isset($hasError)) { //If errors are found ?>

        <div class="alert alert-danger fade in">

         <a href="#" class="close" data-dismiss="alert">&times;</a>

         <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['login_error']; ?>

	    </div>

        <?php } ?>

        

        <?php if (isset($error)) {

			echo $error;

		} ?>

				

	     	

		  <div class="form-sign">

		   <form method="post">

		    <div class="form-head">

<h3 style="font-weight: bold;"><?php echo $lang['login']; ?> As <?php echo (isset($_GET['type']) && strtolower($_GET['type']) == 'business')?'Business':''?><?php echo (isset($_GET['type']) && strtolower($_GET['type']) == 'individual')?'Professional individual':''?><?php echo (!isset($_GET['type']))?'Customer':''?></h3>
             
             <p style="color: #fff !important; margin-top: 15px;">
             <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'We have extraordinary customers waiting for your expertise, log-in and request to provide service.':''?><?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'Express your unique skill set by logging in and request to provide service. Start earning extra income by what you enjoy doing.':''?><?php echo (!isset($_GET['type']))?'This platform is design to serve you. Simply log-in to post your service, set your budget limit and watch the magic happen. It\'s that easy!':''?>
             </p>

			</div><!-- /.form-head -->

            <div class="form-body">

            	



            <!-- List group -->

            <ul class="list-group" style="display: none;">

             <li class="list-group-item">

              <div class="material-switch pull-center">

	           <span class="pull-left"><?php echo $lang['freelancer']; ?></span>

                <input id="someSwitchOptionDefault" <?php echo (!isset($_GET['type']))?'checked':''?> name="user_type" type="checkbox"/>

                <label for="someSwitchOptionDefault" class="label-success"></label>

	           <span class="pull-right"><?php echo $lang['client']; ?></span>

              </div>

             </li>

            </ul>              	

            	

			 <div class="form-row">

			  <div class="form-controls">

			   <input name="email" placeholder="<?php echo $lang['email']; ?>" class="field" type="text">

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->



			 <div class="form-row">

			  <div class="form-controls">

			   <input name="password" placeholder="<?php echo $lang['password']; ?>" class="field" type="password">

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->

			 

			 <div class="form-row">

			  <div class="material-switch pull-left">

			   <input id="someSwitchOptionSuccess" name="remember" type="checkbox"/>

			   <label for="someSwitchOptionSuccess" class="label-success"></label>

			   <span><?php echo $lang['remember_me']; ?></span>

			  </div>

			 </div><!-- /.form-row -->

			 

		    </div><!-- /.form-body -->



			<div class="form-foot">

			 <div class="form-actions">					

              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			  <input value="<?php echo $lang['login']; ?>" class="form-btn" type="submit" style="background: #e9701c;">

			 </div><!-- /.form-actions -->
             
             <div class="form-head">

			  <span style="color: #fff;">Don't have an account?</span> <a style="color: #e9701c;" href="signup.php" class="more-link">Sign-up</a>

			 </div>

             <div class="form-head">

			  <a href="forgot.php" class="more-link"><?php echo $lang['forgot_password']; ?></a>

			 </div>

			</div><!-- /.form-foot -->

		   </form>

		   

		  </div><!-- /.form-sign -->

	     </div><!-- /.col-lg-6 -->

        </main>

		

	   </div><!-- /.row -->

	  </div><!-- /.container -->

     </section><!-- /section -->

	 
<?php include ('includes/template/footer.php'); ?> 
     <!-- ==============================================

	 Scripts

	 =============================================== -->

	 

     <!-- jQuery 2.1.4 -->

     <script src="assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script>

     <!-- Bootstrap 3.3.6 JS -->

     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

     <!-- Typed JS -->

     <script src="assets/js/typed.min.js" type="text/javascript"></script>

     <!-- Kafe JS -->

     <script src="assets/js/kafe.js" type="text/javascript"></script>



</body>

</html>

