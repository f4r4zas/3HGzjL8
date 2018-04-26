<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

//Check if frontinit.php exists

if(!file_exists('core/frontinit.php')){

	header('Location: install/');        

    exit;

}else{

 require_once 'core/frontinit.php';	
 
 require_once 'Client/stripe/config.php';

}

$submitform = "no";

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

	   'name' => [

	     'required' => true,

	     'minlength' => 3

	   ],
       'image' => [

	     'required' => true,

	   ],
       'phone' => [

	     'required' => true,

	   ]

	]);

	 	

	  if (!$validation->fails()) {
	   
       $submitform = "yes";

	  	$profileInsert = DB::getInstance()->insert('sponsors', array(
    
    				   'email' => Input::get('email'),
    
    				   'name' => Input::get('name'),
    
    				   'phone' => Input::get('phone'),
                       
                       'link' => Input::get('link'),
                       
                       'category' => Input::get('category'),
                       
                       'package' => Input::get('package'),
    
    				   'image' => Input::get('image'),
    
    			    ));

		$q2 = DB::getInstance()->get("sponsors", "*", ["ORDER" => "id DESC", "LIMIT" => 1]);
        $q2_result = $q2->results();   	
        $mark = '<form action="Client/stripe/sponsor_charge.php?id=' . escape($q2_result[0]->id) . '&cats='.urlencode(Input::get('category')).'&email='.urlencode(Input::get('email')).'&name='.urlencode(Input::get('name')).'&ph='.urlencode(Input::get('phone')).'&pkg='.urlencode(Input::get('pkg')).'" method="POST">

						  <script

						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"

						    data-key="'. $stripe[publishable] .'"

						    data-name="Sponsor ' . $lang['payments'] . '"

						    data-description="Sponsor ' . $lang['payments'] . '"

						    data-currency="'.$currency_code.'"

						    data-email="'. $q2_result[0]->email .'"

						    data-amount="'. getMoneyAsCents($q2_result[0]->package) .'"
                            
                            data-panel-label="Pay ${{amount}}"

						    data-locale="auto">

						  </script>

						</form>';
                        
              
	  	  

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
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

				

		<!-- ==============================================

		Feauture Detection

		=============================================== -->

		<script src="assets/js/modernizr-custom.js"></script>

		

		<!--[if lt IE 9]>

		 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

		<![endif]-->		
        
        <script>
  UPLOADCARE_LOCALE = "en";
  UPLOADCARE_TABS = "file url facebook gdrive gphotos dropbox instagram";
  UPLOADCARE_PUBLIC_KEY = "f199d7c4921d887bc9e3";
</script>
<script charset="utf-8" src="//ucarecdn.com/libs/widget/3.2.2/uploadcare.full.min.js"></script>
<style>
#header .header-nav__navigation-link {
    font-size: 10px;
}

.select2-selection.select2-selection--multiple {
    height: auto;
    min-height: 52px;
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

	 <header class="header-login" style=" display:none;

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
     
     <?php if($_GET['success']):?>
     <div class="alert alert-success fade in">

		            <a href="#" class="close" data-dismiss="alert">&times;</a>

		            <strong>Payment successfull!</strong> Your ad will be display on users profile pages and customer's service ads according to selected category

			       </div>
    <?php endif;?>

	 

     <!-- ==============================================

     Banner Login Section

     =============================================== -->

	 <section class="banner-login">

	  <div class="container">

	  		  	

	   <div class="row">

	   

	    <main class="main main-signup col-lg-12">

	     <div class="col-lg-7 col-lg-offset-3 text-center">

	     	

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
          
          <?php echo ($submitform == "yes")?$mark:''; ?>

		   <form method="post" <?php echo ($submitform == "yes")?'style="display:none"':''; ?>>

		    <div class="form-head">

			 <h3 style="font-weight: bold;"><?php echo "Sponsor"; ?></h3>
             
             <p style="color: #fff !important; margin-top: 15px;">Just KeeHee It by becoming a sponsor and get notice by the KeeHee community. Sign-up now and start driving real traffic to your website.</p>

			</div><!-- /.form-head -->

            <div class="form-body">

            	



            <!-- List group -->
              	
            <div class="form-row">

			  <div class="form-controls">

			   <input name="name" placeholder="Payee's Full <?php echo $lang['name']; ?>" class="field" type="text">

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->
            	

			 <div class="form-row">

			  <div class="form-controls">

			   <input name="email" placeholder="<?php echo $lang['email']; ?>" class="field" type="text">

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->



			 <div class="form-row">

			  <div class="form-controls">

			   <input name="phone" id="phone" placeholder="<?php echo $lang['phone']; ?>" class="field" type="text">

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->
             
             
             <div class="form-row">

			  <div class="form-controls">
              
                <select class="field js-example-basic-multiple" name="category multipleheight" required 
				id="userRequest_activity" required multiple="multiple"
				>
                    <?php

					  $query = DB::getInstance()->get("category", "*", ["AND" => ["active" => 1, "delete_remove" => 0]]);

						if ($query->count()) {

						   $categoryname = '';

						   $x = 1;

							 foreach ($query->results() as $row) {

							  echo $categoryname .= '<option value = "' . $row->catid . '">' . $row->name . '</option>';

							  unset($categoryname); 

							  $x++;

						     }

						}

					 ?>
                </select>

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->
             
             
             <div class="form-row">

			  <div class="form-controls">
              
                <select id="pkg_select" class="field" name="package" required>
                    <option value="">Select package</option>
                    <option value="299">$299 for 1 month</option>
                    <option value="229">$229 for 3 weeks</option>
                    <option value="139">$139 for 2 weeks</option>
                    <option value="89">$89 for 1 week</option>
                    <option value="49">$49 for 4 days</option>
                    <option value="19">$19 for 1 day</option>
                </select>
                
                <input type="hidden" name="pkg" value="" id="pkg"/>

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->
             
             
             
             <div class="form-row">

			  <div class="form-controls">

			   <input name="link" placeholder="Provide <?php echo 'Link'; ?> For Leads" class="field" type="url">

			  </div><!-- /.form-controls -->

			 </div><!-- /.form-row -->
             
             
             
             <div class="form-row">	

				    <label style="color: #fff;">Upload image</label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="image"
                       data-images-only="true"
                       data-multiple="false"
                       data-crop="4:3"
                       data-clearable="true" />

			 </div><!-- /.form-row -->

			 



			 <div class="form-row">

			  <div class="form-controls" style="color: #fff;">
             <input type="checkbox" name="terms" id="coupon_question" required=""/>
                      By submitting up this form you agree to KeeHee's <a style="color: #e9701c;" target="_blank" href="terms.php">Term of use</a> and <a style="color: #e9701c;" target="_blank" href="privacy.php">Privacy Policy</a>
             </div>
             </div>

		    </div><!-- /.form-body -->



			<div class="form-foot">

			 <div class="form-actions">					

              <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			  <input value="<?php echo 'submit'; ?>" class="form-btn" type="submit">

			 </div><!-- /.form-actions -->


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
     
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

     <script src="assets/js/typed.min.js" type="text/javascript"></script>

     <!-- Kafe JS -->

     <script src="assets/js/kafe.js" type="text/javascript"></script>




<script>

$("#pkg_select").change(function(){
    $("#pkg").val($( "#pkg_select option:selected").text());
});


$(document).ready(function() {
    
    
    
    $('.js-example-basic-multiple').select2({
    maximumSelectionLength: 3,
    placeholder: 'Select 3 categories you will like to showcase your ad',
    });
    
    /**
 * charCode [48,57] 	Numbers 0 to 9
 * keyCode 46  			"delete"
 * keyCode 9  			"tab"
 * keyCode 13  			"enter"
 * keyCode 116 			"F5"
 * keyCode 8  			"backscape"
 * keyCode 37,38,39,40	Arrows
 * keyCode 10			(LF)
 */
function validate_int(myEvento) {
  if ((myEvento.charCode >= 48 && myEvento.charCode <= 57) || myEvento.keyCode == 9 || myEvento.keyCode == 10 || myEvento.keyCode == 13 || myEvento.keyCode == 8 || myEvento.keyCode == 116 || myEvento.keyCode == 46 || (myEvento.keyCode <= 40 && myEvento.keyCode >= 37)) {
    dato = true;
  } else {
    dato = false;
  }
  return dato;
}

function phone_number_mask() {
  var myMask = "(___) ___-____";
  var myCaja = document.getElementById("phone");
  var myText = "";
  var myNumbers = [];
  var myOutPut = ""
  var theLastPos = 1;
  myText = myCaja.value;
  //get numbers
  for (var i = 0; i < myText.length; i++) {
    if (!isNaN(myText.charAt(i)) && myText.charAt(i) != " ") {
      myNumbers.push(myText.charAt(i));
    }
  }
  //write over mask
  for (var j = 0; j < myMask.length; j++) {
    if (myMask.charAt(j) == "_") { //replace "_" by a number 
      if (myNumbers.length == 0)
        myOutPut = myOutPut + myMask.charAt(j);
      else {
        myOutPut = myOutPut + myNumbers.shift();
        theLastPos = j + 1; //set caret position
      }
    } else {
      myOutPut = myOutPut + myMask.charAt(j);
    }
  }
  document.getElementById("phone").value = myOutPut;
  document.getElementById("phone").setSelectionRange(theLastPos, theLastPos);
}

document.getElementById("phone").onkeypress = validate_int;
document.getElementById("phone").onkeyup = phone_number_mask;
});

$(document).ready(function($) {
    <?php
    if ($submitform == "yes") { ?>
                $(".stripe-button-el").trigger("click");
    <?php } ?>
    
    $('[role=uploadcare-uploader]').each(function(){
        var input = $(this);
            var widget = uploadcare.Widget(input);
        	widget.onUploadComplete(function(info) {
        	   
               console.log(info);
                //var xyz = $(this).val();
                //if(xyz){
                    $(input).siblings(".uploadcare--widget_status_loaded").after('<div class="form-row"><p style="text-align:center;color:#fff;">Ad Preview</p><img class="viewimg" style="width:50%" src="'+info.cdnUrl+'"></div>');
                //}
            });
        });
        
        
    $( ".uploadcare--widget__button_type_remove" ).click(function() {
        
        //console.log("found");
        
        console.log($(this).closest('div').siblings(".viewimg").length);
			if($(this).closest('div').siblings(".viewimg").length > 0){
			 
			 $(this).closest('div').siblings(".viewimg").remove();
			}
    
    });
    
    });

	
$("#userRequest_activity").on('click', 'option', function() {
    if ($("select option:selected").length > 3) {
        $(this).removeAttr("selected");
        // alert('You can select upto 3 options only');
    }
});

	
</script>
</body>

</html>

