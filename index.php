<?php

//Check if init.php exists

if(!file_exists('core/frontinit.php')){

	header('Location: install/');        

    exit;

}else{

 require_once 'core/frontinit.php';	

}

if(isset($_GET['verify']) && !empty($_GET['verify']) && isset($_GET['type'])){

$email = urldecode($_GET['verify']);
if($_GET['type'] == 'business' || $_GET['type'] == 'individual'){
    $get_type = 'freelancer';
    $login_link = '?type='.$_GET['type'];
}else {
    $get_type = 'client';
    $login_link = '';
}
$query = DB::getInstance()->get($get_type, "*", ["email" => $email]);

if ($query->count()) {
	$userUpdate = DB::getInstance()->update($get_type,[

	   'active' => 1

	],[

	    'email' => $email

	  ]);

	     	echo '<div class="alert alert-success fade in">

		            <a href="#" class="close" data-dismiss="alert">&times;</a>

		            <strong>Account verified please <a href="login.php'.$login_link.'">click here</a> to login now!</strong> <br/>

			       </div>

			       ';

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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<style>
.fruite {
    font-size: 21px;
    color: #fbff02;
}

section.after_banner .welcome_box {
    margin-top: 8px;
        max-width: 502px;
}


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
        /*background: rgba(0,0,0,0.4);*/
        background: rgba(0,0,0,0.2);
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

.welcome_box p {
    color: #fff !important;
}
.testimonies .feedback-box .client-image {
    display: none;
}

.editable_w.section_3 {
    color: #fff !important;
}

.categories h6 {
    margin-bottom: 15px;
}
</style>

<body class="greybg">

	

     <!-- Include navigation.php. Contains navigation content. -->

 	 <?php include ('includes/template/navigation.php'); ?> 

 	 

      <!-- ==============================================

	 Header

	 =============================================== -->	 
<div class="sli1">
<div class="slider" style="width: 10792px; left: 0px; display: block; transition: all 1000ms ease 0s; transform: translate3d(0px, 0px, 0px);">
<div class="owl-item" style="width: 1349px;">
		<div class="item"> 
		<img src="/assets/img/header/1489406013.jpg" alt="The Last of us">
		<div class="slide-content container">
		<h3 class="fruite">KeeHee.com is a lead generation platform design to accommodate</h3>
	
		<h1 class="large">
		Customers, local businesses and professional individuals with common interest </h3>
		</h1>
			<h3 class="fruite">	
			 to conduct business with <b>“No Negotiating and No Hassle!”</b>
		
		</div>
		</div>

</div>
<div class="owl-item" style="width: 1349px;">
		<div class="item"> 
		<img src="/assets/img/header/141028-cpi-kentucky-tease_oxowsq.jpg" alt="The Last of us">
		<div class="slide-content container">
		<h3 class="fruite">For Customers who don’t want to over spend for services</h3>
		<h1 class="large">SET YOUR BUDGET, POST YOUR AD AND HIRE THE PERFECT HELP!</h1>
		<h3 class="fruite">You have the money, you’re the boss!</h3>
		
		</div>
		</div>

</div>
<div class="owl-item" style="width: 1349px;">
		<div class="item"> 
		<img src="/assets/img/header/wiki-Office-Business-Park-1920x1080-PIC-WPC008189.jpg" alt="The Last of us">
		<div class="slide-content container">
		<h3 class="fruite">Are you a local business, marketers or a recruiter? </h3>
		<h1 class="large">SAVE OVER $1,500 PER YEAR ON ADVERTISEMENTS</h1>
		<h3 class="fruite">Customers need your services, just click “Provide Service” and sign-up for FREE.</h3>
	
		</div>
		</div>

</div>
<div class="owl-item" style="width: 1349px;">
		<div class="item"> 
		<img src="/assets/img/header/1_bAsgRTQEgioxvbv0ztVbfw.jpg" alt="The Last of us">
		<div class="slide-content container">
		<h3 class="fruite">You don’t own a business, but have great skill set?</h3>
		<h1 class="large">KEEHEE IS PERFECT FOR PROFESSIONAL INDIVIDUAL AND JOB CANDIDATES</h1>
		<h3 class="fruite">Who wants to earn extra income or gain temporary employment.</h3>
		</div>
		</div>

</div>
</div>
	
</div>	
	 
	<!--
	 <header class="header" style="

	 <?php if ($header_img !== 'assets/img/header/1.jpg') { ?>

    background: linear-gradient(

      rgba(34,34,34,0.5), 

      rgba(34,34,34,0.5)

    ), url('<?php echo $header_img; ?>') no-repeat center center fixed;

   background-size: cover;

  background-position: center center;

  -webkit-background-size: cover;

  -moz-background-size: cover;

  -o-background-size: cover;

  color: #fff;

  height: 100vh;

  width: 100%;

  

  display: flex;

  flex-direction: column;

  justify-content: center;

  align-items: center;

  text-align: center;	 	
		 
	 <?php }else{ ?>

  background: url('<?php echo $header_img; ?>') repeat 50% 0;

  color: #fff;

  height: 100vh;

  width: 100%;

  

  display: flex;

  flex-direction: column;

  justify-content: center;

  align-items: center;

  text-align: center;"

	 <?php } ?>>

      <div class="container">

	   

        <div class="row">

		<div class="banner-content">

		<h2 class="banner-title"><?php echo $top_title; ?></h2>

       	<?php if($show_downtitle === '1'): ?>

		<h3 class="banner-description"><?php echo $down_title; ?></h3>

       	<?php endif; ?> 

		

		 <form action="searchpage.php" method="get" class="list-s">

		  <button><?php echo $lang['get']; ?> <?php echo $lang['a']; ?> <?php echo $lang['quote']; ?></button>

		  <input type="text" class="form-control" name="searchterm" placeholder="<?php echo $searchterm; ?>" value=""/>   

		  <div class="clearfix"></div>

		 </form>

		<p><?php echo $lang['trending']; ?> <?php echo $lang['services']; ?>:

        <?php

				

	        $dbc = mysqli_connect(Config::get('mysql/host'), Config::get('mysql/username'), Config::get('mysql/password'), Config::get('mysql/db')) OR die('Could not connect because:' .mysqli_connect_error());

			

			$q5 = "SELECT catid, count(catid) AS cnt FROM job GROUP BY catid ORDER BY cnt DESC LIMIT 3";

			$r5 = mysqli_query($dbc, $q5);

			while ($row5 = mysqli_fetch_assoc($r5)) {

				$catid = $row5['catid'];

				

          $query = DB::getInstance()->get("category", "*", ["catid" => $catid]);

		 if($query->count()) {

		 	

		    $x = 1;

		    $out = array();

			foreach($query->results() as $row) {

                

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 



		 if ($admin->isLoggedIn() || $client->isLoggedIn() || $freelancer->isLoggedIn()) { 				

			     $List .= '

			           <a href="searchcat.php?searchterm='. escape($row->name) .'" style="color: #fff !important;">

                        '. escape($row->name) .'

					   </a>

						 ';
        } else {
                $List .= '

			           <a href="login1.php" style="color: #fff !important;">

                        '. escape($row->name) .'

					   </a>

						 ';
            
        } 

				 $lists[] = $List;		 

                 array_push($out, $List);

	             unset($List);	 

				 $x++;		

				

			}			

		

				}





			 }	

             echo $string = implode(',', $lists);

        ?>			</p>

        

		</div>

        </div><!--./row -->

        

	  </div><!--./container -->

     </header><!--./header -->	

      <!-- ==============================================

	 Categories Section

	 =============================================== -->
	<section class="after_banner">
		<div class="sec_inner">
			 <div class="container">
			 	<div class="row">
			 		<div class="col-md-6 box12">
                    <h3 style="margin-top: -25px; margin-bottom: -10px; text-align: center; font-weight: bold;">How it works?</h3>
						<div class="videoss">
						<div class="embbed_video">
                            <video class="videos" src="/assets/IMG_1893.mp4" type="video/mp4" poster="/assets/img/keehee.jpg" controls>
                            Your browser does not support the video tag.
                            </video>
						</div>
					</div>
					</div>
					
			 		<div class="col-md-6 box122">
					<div class="welcome_box">
					<ul class='tabs nav nav-pills'>
					  <li><a href='#tab1'>Customers</a></li>
					  <li><a href='#tab2'>Local Business</a></li>
					  <li><a href='#tab3'>Professional Individual</a></li>
					</ul>
					<div class="mainmove">
					<div id='tab1' class=" bgblck">
					<div class="heading">KeeHee is perfect for you:</div>
					  <p>At KeeHee customers can receive the services that they desire without exceeding their budget limits.</p>
					    <!--<input type="button" value="SignUp" class="siginupbtn">-->
                        <a href="register.php" style="padding: 11px; color: #fff;" class="siginupbtn">Sign-up for FREE</a>
					</div>
					<div id='tab2' class=" bgblck">
					<div class="heading">KeeHee is perfect for you:</div>					
					<p>Local businesses, marketers and recruiters prefer KeeHee because they can save time and money on marketing and promotions packages while focusing more on what they do best, which is providing excellent service to extraordinary customers.</p>
					  <!--<input type="button" value="SignUp" class="siginupbtn">-->
                      <a href="register.php?type=business" style="padding: 11px; color: #fff;" class="siginupbtn">Sign-up for FREE</a>
					</div>
					<div id='tab3'class=" bgblck">
					<div class="heading">KeeHee is perfect for you:</div>
					  <p>KeeHee is perfect for Professional Individual and job candidates who are seeking to earn extra income or to gain temporary employment.</p>
					  <!--<input type="button" value="SignUp" class="siginupbtn">-->
                      <a href="register.php?type=individual" style="padding: 11px; color: #fff;" class="siginupbtn">Sign-up for FREE</a>
					</div>
					</div>
				</div>
<!--
						<div class="subs_box">
							<div class="fields_in">
								<label for="email">Email *</label>
								<input type="text" name="email" id="email" class="theme-input">
								<input type="button" value="Subscribe!" class="theme-btn">
							</div>
						</div> 
						-->
					</div>
				</div>
			 </div>
		</div>
	</section>
	 
	 <!-- ======================= -->
<?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 

		 if ($admin->isLoggedIn()) { ?>

		<?php } elseif($freelancer->isLoggedIn()) { ?>

		<?php } elseif($client->isLoggedIn()) { ?>
        
        <section class="we-perfect" style="background: #fff;">
				<div class="container">
            <div class="row">
              <!--edit to here -->
                 <div class="col-md-12 editable_S">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

		  <a href="Client/addjob.php"  style="background: rgb(76, 42, 87);" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> <?php echo $lang['post']; ?> <?php echo $lang['a']; ?> <?php echo $lang['job']; ?>, <?php echo $lang['it\'s']; ?> <?php echo $lang['free']; ?> !

		  </a>

		 </div><!-- /.col-lg-3 -->
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
         </div>
         </div>
         </div>
         </section>

		<?php } else { ?>
        
        <section style="background: #fff; padding: 20px;">
				<div class="container">
            <div class="row">
              <!--edit to here -->
                 <div class="col-md-12 editable_S">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

		  <a href="login.php" style="background: rgb(76, 42, 87);" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> <?php echo $lang['post']; ?> <?php echo $lang['a']; ?> <?php echo $lang['job']; ?>, <?php echo $lang['it\'s']; ?> <?php echo $lang['free']; ?> !

		  </a>

		 </div><!-- /.col-lg-3 -->
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
         </div>
         </div>
         </div>
         </section>

		 <?php } ?>
	 <section class="categories">

	  <div class="container">

       <div class="row">

       	

       	<div class="text-center">

		 <h3><?php echo $lang['popular']; ?> <?php echo $lang['categories']; ?></h3>

		 <hr class="mint">

		 <p class="top-p"><?php echo $cattagline; ?></p>

		</div> 

       </div><!-- /.row -->

       <br />

       

		  <?php

          $query = DB::getInstance()->get("category", "*", ["ORDER" => "id ASC"]);

		 if($query->count()) {

		 	

          /*

            Start with variables to help with row creation;

          */

            $startRow = true;

            $postCounter = 0;

		    $x = 1;

			foreach($query->results() as $row) {
			 
             //$subsquery = DB::getInstance()->get("skills", "*", ["ORDER" => "id ASC"]);
             
             $subs = explode(',',$row->sub_category);
			 foreach($subs as $sub){
			     if(strtolower(trim($sub)) != "other" && strtolower(trim($sub)) != "others"){
    			    $jobUpdate = DB::getInstance()->update('skills',[
    
            		   'name' => trim($sub),
            
            		   'catid' => $row->id,
            
            		   'date_added' => date('Y-m-d H:i:s'),
            
            		   'active' => 1,
            
            		   'delete_remove' => 0
            
            		],[
            
            		    'id' => $x
            
            		  ]); 
                      
                       $x++;
			     }
             
             }
             

		    $List = '';

			/*

              Check whether we need to add the start of a new row.

              If true, echo a div with the "row" class and set the startRow variable to false 

              If false, do nothing. 

            */

            if ($startRow) {

              echo '<!-- START OF INTERNAL ROW --><div class="row">';

              $startRow = false;

            } 

            /* Add one to the counter because a new post is being added to your page.  */ 

              $postCounter += 1; 



		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 



		 if ($admin->isLoggedIn() || $client->isLoggedIn() || $freelancer->isLoggedIn()) {

		    echo $List .= '

			        <div class="col-lg-4 col-md-4 col-sm-12 randombg">

					 <a class"randomegg" id="randomegg" href="searchcat.php?searchterm='. escape($row->name) .'" style="height: 370px;">

			          <i class="fa '. $row->icon .'"></i>

			          <h6>'. escape($row->name) .'</h6>

			          <p>'. escape($row->sub_category) .'</p>

			         </a>	

					</div>  

					 ';
                     
         } else {
            
            echo $List .= '

			        <div class="col-lg-4 col-md-4 col-sm-12 randombg">

					 <a class"randomegg" id="randomegg" href="login1.php" style="height: 370px;">

			          <i class="fa '. $row->icon .'"></i>

			          <h6>'. escape($row->name) .'</h6>

			          <p>'. escape($row->sub_category) .'</p>

			         </a>	

					</div>  

					 ';
            
         } 

				

             unset($List);	 

					

			

            /*

            Check whether the counter has hit 3 posts.  

            If true, close the "row" div.  Also reset the $startRow variable so that before the next post, a new "row" div is being created. Finally, reset the counter to track the next set of three posts.

            If false, do nothing. 

            */

            if ( 3 === $postCounter ) {

                echo '</div><!-- END OF INTERNAL ROW -->';

                $startRow = true;

                $postCounter = 0;

            }  

		   }

		}else {

		 echo $List = '<p>'.$lang['no_content_found'].'</p>';

		}

       ?>

              

      </div><!-- /.container -->

     </section><!-- /.section -->     

	 <!-- ================================== -->
	

		<?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 

		 if ($admin->isLoggedIn()) { ?>

		<?php } elseif($freelancer->isLoggedIn()) { ?>

		<?php } elseif($client->isLoggedIn()) { ?>
        
        <section style="background: #fff; padding: 20px;">
				<div class="container">
            <div class="row">
              <!--edit to here -->
                 <div class="col-md-12 editable_S">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

		  <a href="jobs.php" style="background: rgb(49, 94, 42);" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> Service provider seeking a job?

		  </a>

		 </div><!-- /.col-lg-3 -->
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
         </div>
         </div>
         </div>
         </section>

		<?php } else { ?>
        
        <section style="background: #fff; padding: 20px;">
				<div class="container">
            <div class="row">
              <!--edit to here -->
                 <div class="col-md-12 editable_S">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
		 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

		  <a href="jobs.php" style="background: rgb(49, 94, 42);" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> Service provider seeking a job?

		  </a>

		 </div><!-- /.col-lg-3 -->
         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            </div>
         </div>
         </div>
         </div>
         </section>

		 <?php } ?>	
			
	
	
	<section class="we-perfect">
				<div class="container">
            <div class="row">
              <!--edit to here -->
                 <div class="col-md-12 editable_S">
                <h2 style="text-decoration: underline;" class="editable_w section_3 bgyello">WHY US?</h2>
                <h3 class="editable_w section_3">Services</h3>
                <p class="editable_w section_3">Get the service you need without exceeding your budget.</p>
				<h3 class="editable_w section_3">Convenience</h3>
                <p class="editable_w section_3">Hire Professionals Service Providers with NO NEGOTIATING and NO HASSLE!</p>
				<h3 class="editable_w section_3">Satisfaction</h3>
                <p class="editable_w section_3">Customers and Service Providers unify to conduct business of comment interest and everyone wins!</p>
              </div>
            </div>
          </div>	

	</section>


	<section class="how-works">
		<div class="container">
			<div style="text-decoration: underline;" class="sec_heading">How It Works?</div>
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12 nopading">
					<div class="heading">Customers</div>
					<div class="work-box">
						<div class="bx">
							<div class="title">Sign Up</div>
							<small>Create your free account. It's fun!</small>
						</div>
						<div class="bx">
							<div class="title">Create & Post</div>
							<small>Create a classified ad for the service you need, set your budget limit and post.</small>
						</div>
						<div class="bx">
							<div class="title">Review</div>
							<small>Review Service providers profiles who request to "Provide Service" to you. </small>
						</div>
						<div class="bx">
							<div class="title">Hire or Reject</div>
							<small>Decide to hire or reject Service Providers request to "Provide Service"</small>
						</div>
						<div class="bx">
							<div class="title">Rating</div>
							<small>Upon hiring a Service Provider, share your experience, give them a star rating and write a review.</small>
						</div>
					</div>
				</div>

				

				<div class="col-md-6 col-sm-12 col-xs-12 nopading">
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

	 <!-- ==============================================

	 Stats Section

	 =============================================== -->

	 <section class="stats" style="display: none;">

	  <div class="container">

       <div class="row">

       	

       	<div class="text-center">

		 <h3><?php echo $lang['site']; ?> <?php echo $lang['stats']; ?></h3>

		<hr class="mint-white">

		 <p class="top-p"><?php echo $statstagline; ?></p>

		</div> 

       </div><!-- /.row -->

        <br />

       <?php

       $query = DB::getInstance()->get("job", "*", ["AND"=>["active" => 1, "delete_remove" => 0]]); 

	   if ($query->count() === '') {
		   $jobsposted = 0;
	   } else {

		   $jobsposted = $query->count();
	   }
	    

       $q1 = DB::getInstance()->get("job", "*", ["AND"=>["active" => 1, "delete_remove" => 0, "completed" => 1]]);  

	   if ($q1->count() === '') {

		   $jobscompleted = 0;

	   } else {

		   $jobscompleted = $q1->count();

	   }  

	   

       $q2 = DB::getInstance()->get("freelancer", "*", ["AND"=>["active" => 1, "delete_remove" => 0]]);  

	   if ($q2->count() === '') {

		   $freelancercount = 0;

	   } else {

		   $freelancercount = $q2->count();

	   }	

	   

       $q3 = DB::getInstance()->get("client", "*", ["AND"=>["active" => 1, "delete_remove" => 0]]);  

	   if ($q3->count() === '') {

		   $clientcount = 0;

	   } else {

		   $clientcount = $q3->count();

	   }	         

       

       ?> 

       <div class="row"> 

		 <ul class="job-stats row showing-4">

          <li class="job-stat col-md-3 col-sm-6 col-xs-12">
			<div class="thumbnail1"> <img src="/assets/img/service/services.png" alt=""> </div>
		   <strong><?php echo $jobsposted; ?></strong><?php echo $lang['jobs']; ?> <?php echo $lang['posted']; ?>				

		  </li>

		  <li class="job-stat col-md-3 col-sm-6 col-xs-12">
<div class="thumbnail1"> <img src="/assets/img/service/a.png" alt=""> </div>
		   <strong><?php echo $jobscompleted; ?></strong><?php echo $lang['jobs']; ?> <?php echo $lang['completed']; ?>				

		  </li>

		  <li class="job-stat col-md-3 col-sm-6 col-xs-12">
<div class="thumbnail1"> <img src="/assets/img/service/b.png" alt=""> </div>
		   <strong><?php echo $clientcount; ?></strong> <?php echo $lang['clients']; ?>				

		  </li>

		  <li class="job-stat col-md-3 col-sm-6 col-xs-12">
<div class="thumbnail1"> <img src="/assets/img/service/c.png" alt=""></div>
		   <strong><?php echo $freelancercount; ?></strong><?php echo $lang['freelancers']; ?>				

		  </li>

		 </ul>

		 

		</div>  

		</div>

		</section>	 

	 

	 <!-- ==============================================

	 Testimonies Section

	 =============================================== -->		  


	 <section class="testimonies">

	  <div class="container">

       <div class="row">
	<div class="text-center">
		 <h3><?php echo $lang['testimonies']; ?></h3>

		 <hr class="mint-white">

		 <p class="top-p"><?php echo $testtagline; ?></p>

		</div> 

       </div><!-- /.row -->

       <br />
       

	   <div class="bgmange">
<div class="slider1" >
 
		
		


		  <?php

          $query = DB::getInstance()->get("team", "*", ["testimony" => 1]);
          


		 if($query->count()) {

		 	

          /*

            Start with variables to help with row creation;

          */

            $startRow = true;

            $postCounter = 0;

		    $x = 1;

			foreach($query->results() as $row) {

		    //$List = '';

			/*

              Check whether we need to add the start of a new row.

              If true, echo a div with the "row" class and set the startRow variable to false 

              If false, do nothing. 

            */

            if ($startRow) {

              echo '<!-- START OF INTERNAL ROW --><div class="owl-item col-sm-12 col-md-12" style="width: 1349px;">
		<div class="item"><div class="row">';

              $startRow = false;

            } 

            /* Add one to the counter because a new post is being added to your page.  */ 

              $postCounter += 1; 

			  

		    echo '

				  	<div class="col-lg-4 col-md-12 col-sm-12 noblock">

				  	 <div class="feedback-box">

					  <div class="message">

		               '. $row->description .'

					  </div>

					  <div class="client">

					   <div class="quote red-text">

						<i class="fa fa-quote-left"></i>

					   </div>

					   <div class="client-info">

					    <span class="client-name" href="">'. escape($row->name) .'</span>

						<div class="client-company">

						 '. escape($row->title) .'

						</div>

					   </div>

					   <div class="client-image hidden-xs">

						<img src="Admin/'. escape($row->imagelocation) .'" class="img-responsive" alt="">

					   </div>

					  </div> 

					 </div>

					</div> 

					 ';

				

             //unset($List);	 

			 $x++;		

			

            /*

            Check whether the counter has hit 3 posts.  

            If true, close the "row" div.  Also reset the $startRow variable so that before the next post, a new "row" div is being created. Finally, reset the counter to track the next set of three posts.

            If false, do nothing. 

            */
            if($postCounter % 3 == 0) {
            //if ( 3 === $postCounter ) {

                echo '</div></div>
</div><!-- END OF INTERNAL ROW -->';

                $startRow = true;

                $postCounter = 0;

            }  

		   }

		}else {

		 echo $List = '<p>'.$lang['no_content_found'].'</p>';

		}

       ?>       

  

<!--<div class="owl-item" style="width: 1349px;">
		
<div class="item">
2nd testimonial

</div>

</div>-->
</div>
	  </div><!-- /container -->
</div>
	 </section><!-- /w -->		   	 




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
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
      <!--<script src="assets/js/kafe.js" type="text/javascript"></script>--> 

<script>


$(document).ready(function() {
    var randomColors = ["#4C2A57","#AB322C","#F1CE40","#396433","#3C5D8C","#EC6E30","#AB322C","#4C2A57","#AB322C","#F1CE40","#396433","#3C5D8C","#EC6E30","#AB322C","#4C2A57","#AB322C","#F1CE40","#396433","#3C5D8C","#EC6E30","#AB322C"];
    
    $(".randombg > a").each(function(index) {
        
        //var len = randomColors.length;
        //var randomNum = Math.floor(Math.random()*len);
        $(this).css("backgroundColor",randomColors[index]);
        $(this).css("border","1px solid "+randomColors[index]);
        //Removes color from array so it can't be used again
        //randomColors.splice(randomNum, 1);
    });
	
	   // var randomColors = ["#4C2A57","#AB322C","#F1CE40"];
    /*$(".categories .row:last-child .randombg > a ").each(function(index) {
        var len = randomColors.length;
        var randomNum = Math.floor(Math.random()*len);
        $(this).css("backgroundColor",randomColors[randomNum]);
        //Removes color from array so it can't be used again
        randomColors.splice(randomNum, 1);
    });*/
	
	
	
});

 
   

	$(document).ready(function(){
		$('.slider').bxSlider({
		auto: true,
		pause: 4000,
        autoHover: true,
		});

	});
	
	
	$(document).ready(function(){
		$('.slider1').bxSlider({
		auto: true,
		pause: 4000,
        autoHover: true,
		});

	});






 $('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and its associated content
  var $active, $content, $links = $(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  $active.addClass('active');

  $content = $($active[0].hash);

  // Hide the remaining content
  $links.not($active).each(function () {
    $(this.hash).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $(this.hash);

    // Make the tab active.
    $active.addClass('active');
    $content.show();

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});
  
$(document).ready(function() {
    var randomColors = ["#4B2956","#F1CE3F","#3A5B8B"];
    $(".tabs > li > a").each(function(index) {
        var len = randomColors.length;
        var randomNum = Math.floor(Math.random()*len);
        var tab = $(this).attr("href");
        $(this).css("backgroundColor",randomColors[randomNum]);
        $(tab+" .siginupbtn").css("backgroundColor",randomColors[randomNum]);
        //Removes color from array so it can't be used again
        randomColors.splice(randomNum, 1);
       
        
    });
	/*var randomColors = ["#4B2956","#F1CE3F","#3A5B8B"];
    $(".siginupbtn").each(function(index) {
        var len = randomColors.length;
        var randomNum = Math.floor(Math.random()*len);
        $(this).css("backgroundColor",randomColors[randomNum]);
        //Removes color from array so it can't be used again
        randomColors.splice(randomNum, 1);
    });*/
});  






   


</script>


</body>

</html>

