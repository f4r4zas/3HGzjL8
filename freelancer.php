<?php

//Check if init.php exists

if(!file_exists('core/frontinit.php')){

header('Location: install/');        

exit;

}else{

require_once 'core/frontinit.php';	

require_once 'Client/stripe/config.php';

}

$requestid = Input::get('requestid');

$request_query = DB::getInstance()->get("proposal", "*", ["proposalid" => $requestid, "LIMIT" => 1]);
if ($request_query->count() < 1) {
    Redirect::to('Client');
}else {

$request_query_result = $request_query->results();



$job_query = DB::getInstance()->get("job", "*", ["jobid" => $request_query_result[0]->jobid, "LIMIT" => 1]);

$job_query_result = $job_query->results();
}

//Get Freelancer's Data

$freelancerid = Input::get('id');

$query = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);

if ($query->count() === 1) {

foreach($query->results() as $row) {

$name = $row->name;

$username = $row->username;

$email = $row->email;

$phone = $row->phone;

$freelancer_imagelocation = $row->imagelocation;

$freelancer_bgimage = $row->bgimage;

$freelancer_type = $row->business;

}

} else {

Redirect::to('index.php');

}



$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancerid, "LIMIT" => 1]);

if ($query->count()) {

foreach($query->results() as $row) {

$nid = $row->id;

$location = $row->location;

$postal_code = $row->postal_code;

$city = $row->city;

$country = $row->country;

$rate = $row->rate;

$website = $row->website;

$userlinkedin = $row->linkedin;

$usertwitter = $row->twitter; 

$userfacebook = $row->facebook;

$usergoogle = $row->google;                

$about = $row->about;

$education_profile = $row->education;

$work_profile = $row->work;

$awards_profile = $row->awards;

$skills = $row->skills;

$arr=explode(',',$skills);

}			

} else {

Redirect::to('index.php');

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

<style>
header.header-freelancer,
.about::after {
    display: none !important;
}
.hiring_div {
    margin-top: 20px;
}

.hiring_div a.hireMe {
    display: block;
    text-align: center;
    background-color: #05cb95;
    margin: 0 auto;
    font-family: 'Varela Round', sans-serif;
    font-size: 14px !important;
    font-weight: 300 !important;
    padding: 6px 15px;
    letter-spacing: 1px;
}

.hiring_div a.hireMe:hover {
    color: #fff !important;
}

.hiring_div a.rejectMe {
    display: block;
    color: #333;
    text-align: center;
    padding: 10px 15px;
    text-decoration: underline;
    font-weight: 300 !important;
    font-family: 'Varela Round', sans-serif;
}
.socials-rating .heading {
    font-weight:  300 !important;
    font-size: 18px;
    font-family:  'Varela Round', sans-serif;
    letter-spacing:  1px;
    padding-bottom: 10px;
}

.socials-rating ul.social-links li {
    /*display:  block;*/
}

.socials-rating ul.social-links li > a {
    display:  inline;
    background-color:  transparent;
}

.socials-rating ul.social-links li.fb > a {
    background-color: #4267B2;
    color:  #fff;
    padding: 5px 10px;
}

.socials-rating ul.social-links li.google > a {
    color: #fff;
    padding: 5px 10px;
    background: red;
}

.socials-rating ul.social-links li.twitter > a {
    color: #fff;
    padding: 5px 10px;
    background: #1da1f2;
}

.socials-rating ul.social-links li > a:hover {
}

.socials-rating ul.social-links li.insta > a {
    color: #fff;
    padding: 5px 10px;
    background: #0077B5;
}

.socials-rating ul.social-links {
    text-align:  center;
}

.overview .label-success {
        display: inline-block;
}

</style>

	<!-- Include navigation.php. Contains navigation content. -->

	<?php include ('includes/template/navigation.php'); ?> 	 



<!-- ==============================================

Header

=============================================== -->

<header class="header-freelancer" style=" display:none;



background: linear-gradient(

	rgba(34,34,34,0.7), 

	rgba(34,34,34,0.7)

	), url('Freelancer/<?php echo $freelancer_bgimage; ?>') no-repeat center center fixed;

background-size: cover;

background-position: center center;

-webkit-background-size: cover;

-moz-background-size: cover;

-o-background-size: cover;

color: #fff;

height: 85vh;

width: 100%;



display: flex;

flex-direction: column;

justify-content: center;

align-items: center;

text-align: center;">



<div class="container">

	<div class="content">

		<div class="row">

			<div class="col-lg-12">

				<img src="Freelancer/<?php echo $freelancer_imagelocation; ?>" class="img-thumbnail img-responsive revealOnScroll" data-animation="fadeInDown" data-timeout="200" alt="">

				<h1 class="revealOnScroll" data-animation="bounceIn" data-timeout="200"> <?php echo $name; ?></h1>

				<p class="revealOnScroll" data-animation="fadeInUp" data-timeout="400"><i class="fa fa-map-marker"></i> <?php echo $location; ?>, <?php echo $city; ?>, <?php echo $country; ?></p>

				<?php

				//Start new Admin object

				$admin = new Admin();

				//Start new Client object

				$client = new Client();

				//Start new Freelancer object

				$freelancer = new Freelancer(); 



				if ($admin->isLoggedIn()) { 

			} elseif($freelancer->isLoggedIn()) {



		} elseif($client->isLoggedIn()) {

		/*echo $sen .='	 

		<a href="Client/invite.php?id='. escape($freelancerid) .'" class="kafe-btn kafe-btn-mint-small">

			<i class="fa fa-align-left"></i> ' . $lang['send'] . ' ' . $lang['job'] . ' ' . $lang['invitation'] . '</a>

			';*/
			echo $sen .="";

		} else {
		echo $sen .="";

		/*echo $sen .='	 

		<a href="login.php" class="kafe-btn kafe-btn-mint-small">

			<i class="fa fa-align-left"></i> ' . $lang['send'] . ' ' . $lang['job'] . ' ' . $lang['invitation'] . '</a>

			';*/

		}

		?> 		  

	</div><!-- /.col-lg-12 -->

</div><!-- /.row -->

</div><!-- /.content -->

</div><!-- /.container -->

</header><!-- /header -->



<!-- ==============================================

Overview Section

=============================================== -->



<section class="overview" id="overview">

	<div class="container">

		<div class="row">

			<?php if (Input::get('a') == 'overview') : ?>		 

				<div class="<?php echo ((!empty($usertwitter) && strpos($usertwitter, 'twitter') !== false) || (!empty($userlinkedin) && strpos($userlinkedin, 'linkedin') !== false))?'col-lg-8':"col-lg-12" ?> white-2">

				<div class="row">
				
				<div class="col-lg-4">
					<img src="Freelancer/<?php echo $freelancer_imagelocation; ?>" class="img-thumbnail img-responsive revealOnScroll" data-animation="fadeInDown" data-timeout="200" alt="">
                    <div class="socials-rating">
                    	<div class="row">
                    			
                    			<ul class="social-links">
                                    <?php if(!empty($userfacebook) && strpos($userfacebook, 'facebook') !== false){ ?>
                    				<li class="fb">
                    					<a href="<?php echo $userfacebook;?>" class="fb-lnk">facebook</a>
                    				</li>
                                    <?php } ?>
                                    <?php if(!empty($usergoogle) && strpos($usergoogle, 'google') !== false){ ?>
                    				<li class="google">
                    					<a href="<?php echo $usergoogle;?>" class="google-lnk">Google+</a>
                    				</li>
                                    <?php } ?>
                                    <?php if(!empty($userlinkedin) && strpos($userlinkedin, 'linkedin') !== false){ ?>
                    				<li class="insta">
                    					<a href="<?php echo $userlinkedin;?>" class="insta-lnk">Linkedin</a>
                    				</li>
                                    <?php }?>
                                    <?php if(!empty($usertwitter) && strpos($usertwitter, 'twitter') !== false){ ?>
                                    <li class="twitter">
                    					<a href="<?php echo $usertwitter;?>" class="twitter-lnk">Twitter</a>
                    				</li>
                                    <?php } ?>
                    			</ul>
                    		
                    	</div>
                    </div>
					<div class="hiring_div">
						<a href="#" onclick="paynow();" class="hireMe">Hire</a>
						<a href="#" class="rejectMe">Reject</a>
					</div>	
                    <?php 
                    $new_budget = ((5 / 100) * $job_query_result[0]->budget) + $job_query_result[0]->budget;
                    
                    echo '<form style="display:none;" action="Client/template/actions/assign.php?id=' . escape($request_query_result[0]->proposalid) . '" method="POST">

						  <script

						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"

						    data-key="'. $stripe[publishable] .'"

						    data-name="Escrow ' . $lang['payments'] . '"

						    data-description="' . $job_query_result[0]->title . '"

						    data-currency="'.$currency_code.'"

						    data-email="'. $client->data()->email .'"

						    data-amount="'. getMoneyAsCents($new_budget) .'"
                            
                            data-panel-label="Pay ${{amount}}"

						    data-locale="auto">

						  </script>

						</form>'
                        ?>						
				</div>

								<div class="col-lg-8">
								<style>.about::after{display:none;!important}</style>
										<div class="about">

							<h1 class="revealOnScroll" data-animation="bounceIn" data-timeout="200"> <?php echo $name; ?></h1>

						<p class="revealOnScroll" data-animation="fadeInUp" data-timeout="400"><i class="fa fa-map-marker"></i> <?php echo $city; ?>, <?php echo $postal_code; ?>, <?php echo $country; ?></p>
                        
                        
                        <div class="col-lg-12 top-sec">
                        <?php

							foreach ($arr as $key => $value) {

							echo '<label class="label label-success">'. $value .'</label> &nbsp;'; 

						}

						?>
                        </div>


						<h3 style="float: left;"><?php echo $lang['about']; ?></h3>

						<div class="col-lg-12 top-sec">

							<?php echo $about; ?>

							<!-- <h4><?php //echo $lang['skills']; ?></h4> -->

									   

					</div><!-- /.col-lg-12 --> 	



					<div class="row bottom-sec">



						<div class="col-lg-12">



							<div class="col-lg-12">

								<hr class="small-hr">

							</div><!-- /.col-lg-12 --> 



							<div class="col-lg-3" style="display: none;">

								<h5> <?php echo $lang['location']; ?> </h5>

								<p><i class="fa fa-map-marker"></i> <?php echo $country; ?></p>

							</div><!-- /.col-lg-2 -->

							<div class="col-lg-3" style="display: none;">

								<h5><?php echo $lang['jobs']; ?> <?php echo $lang['invites']; ?> </h5>

								<p>

									<?php	

									$query = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => $freelancerid, "invite" => 1]]);

									echo $query->count();

									?>	

								</p>

							</div><!-- /.col-lg-2 -->

							<div class="col-lg-4">

								<h5><?php echo $lang['jobs']; ?> <?php echo $lang['assigned']; ?> </h5>

								<p>

									<?php	

									$query = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => $freelancerid, "accepted" => 1]]);

									echo $query->count();

									?>	

								</p>

							</div><!-- /.col-lg-2 -->

							<div class="col-lg-4">

								<h5><?php echo $lang['jobs']; ?> <?php echo $lang['completed']; ?> </h5>

								<p>

									<?php	

									$query = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => $freelancerid, "completed" => 1]]);

									echo $query->count();

									?>	

								</p>

							</div><!-- /.col-lg-2 -->

							<!--</div>--><!-- /.col-lg-12 -->



<!--<div class="col-lg-12">



<div class="col-lg-12">

<hr class="small-hr">

</div>--><!-- /.col-lg-12 --> 



<div class="col-lg-4">

	<h5> <?php echo $lang['ratings']; ?> 

		(<?php	

		$query = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $freelancerid]]);

		$count = $query->count();

		echo $re = $count/7;

		?>)</h5>

		<p><i class="fa fa-star"></i>

			<i class="fa fa-star"></i>

			<i class="fa fa-star"></i>

			<i class="fa fa-star"></i>

			<i class="fa fa-star"></i></p>

		</div><!-- /.col-lg-2 -->

		<div class="col-lg-6" style="display: none;">

			<h5><?php echo $lang['payments']; ?> <?php echo $lang['received']; ?> </h5>

			<p>

				<?php	

				$query = DB::getInstance()->get("job", "*", ["AND" =>["freelancerid" => $freelancerid, "invite" => "0", "delete_remove" => 0, "accepted" => 1]]);

				if ($query->count()) {

				foreach($query->results() as $row) {





				$q1 = DB::getInstance()->get("milestone", "*", ["AND" =>["jobid" => $row->jobid]]);

				if ($q1->count()) {

				foreach($q1->results() as $r1) {					 	



				$query = DB::getInstance()->sum("transactions", "payment", ["AND" => ["membershipid" => $r1->id, "freelancerid" => $r1->clientid]]);

				foreach($query->results()[0] as $payy) {

				$paj[] = $payy;

			}



		}

	}		



}

}

echo $currency_symbol.'&nbsp;';

echo array_sum($paj);

?>	

</p>

</div><!-- /.col-lg-2 -->

</div><!-- /.col-lg-12 -->		   



<div class="col-lg-12">



	<div class="col-lg-12">

		<hr class="small-hr">

	</div><!-- /.col-lg-12 --> 
<h3>Contact information</h3>


	<div class="col-lg-4" style="display: none;">

		<h5> <?php echo $lang['website']; ?> </h5>

		<p><?php echo $website; ?></p>

	</div><!-- /.col-lg-3 -->

	<div class="col-lg-2" style="display: none;">

		<h5> <?php echo $lang['rate_hour']; ?> </h5>

		<p><?php echo $currency_symbol; ?> <?php echo $rate; ?></p>

	</div><!-- /.col-lg-1 -->

	<div class="col-lg-6">

		<h5> <?php echo $lang['phone']; ?> </h5>

		<p><i class="fa fa-phone"></i> <?php echo $phone; ?></p>

	</div><!-- /.col-lg-3 -->

	<div class="col-lg-6">

		<h5> <?php echo $lang['email']; ?> </h5>

		<p> <?php echo $email; ?></p>

	</div><!-- /.col-lg-3 -->



</div><!-- /.col-lg-12 -->

</div><!-- /.col-lg-12 -->

</div><!-- /.about -->
</div> <!-- /.col-about -->

</div>




<?php if($freelancer_type == 0):?>
	<div class="education">		  

		<h3><?php echo $lang['education']; ?></h3>

		<div class="row">

			<div class="col-lg-12">

				<div class="col-md-12">

					<?php echo $education_profile; ?>

				</div><!-- /.col-lg-12 -->

			</div><!-- /.col-lg-12 -->  

		</div><!-- /.row -->



	</div><!-- Education-->



	<div class="work">		  

		<h3><?php echo $lang['work']; ?> <?php echo $lang['experience']; ?></h3>



		<div class="row">

			<div class="col-lg-12">

				<div class="col-lg-12">

					<?php echo $work_profile; ?>

				</div><!-- /.col-lg-12 -->

			</div> <!-- /.col-lg-12 --> 

		</div><!-- /.row -->



	</div><!-- Work-->



	<div class="awards">		  

		<h3><?php echo $lang['awards']; ?> <?php echo $lang['and']; ?> <?php echo $lang['achievements']; ?></h3>



		<div class="row">

			<div class="col-lg-12">

				<div class="col-lg-12">

					<?php echo $awards_profile; ?>

				</div><!-- /.col-lg-12 -->

			</div><!-- /.col-lg-12 -->

		</div><!-- /.row -->



	</div><!-- Awards-->
<?php else:?>
<div class="row">

			<div class="col-lg-12">

				<div class="col-lg-12">

					<iframe
                      width="100%"
                      height="450"
                      frameborder="0" style="border:0"
                      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDZ6v5rVNIY_XwJfCdIntpT1jNj0wLVReY
                        &q=<?php echo urlencode($location);?>" allowfullscreen>
                    </iframe>

				</div><!-- /.col-lg-12 -->

			</div> <!-- /.col-lg-12 --> 

		</div><!-- /.row -->
<?php endif;?>

<?php



$query = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancerid, "LIMIT" => 1]);

if ($query->count()) {

foreach($query->results() as $row) {	        

$membershipid = $row->membershipid; 



}

}	



$q = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);

if ($q->count() === 1) {

$q1 = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);

} else {

$q1 = DB::getInstance()->get("membership_agency", "*", ["membershipid" => $membershipid]);

}

if ($q1->count()) {

foreach($q1->results() as $r1) {

$team_membership = $r1->team;

}

} 		 		 

?>		



<?php if($team_membership === '1'): ?>



	<div class="ourteam">		  

		<h3><?php echo $lang['our']; ?> <?php echo $lang['team']; ?></h3>



		<div class="row">

			<div class="col-lg-12">



				<?php

				$query = DB::getInstance()->get("team", "*", ["userid" => $freelancerid]);

				if ($query->count()) {



				$teamList = '';

				$x = 1;	



				foreach($query->results() as $row) {



				echo $teamList .= '



				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 profile">

					<div class="img-box">

						<img src="Freelancer/'. escape($row->imagelocation) .'" class="img-responsive" alt="">

						<ul class="text-center">

							<li><a href="'. escape($row->facebook) .'" target="_blank"><i class="fa fa-facebook"></i></a></li>

							<li><a href="'. escape($row->twitter) .'" target="_blank"><i class="fa fa-twitter"></i></a></li>

							<li><a href="'. escape($row->linkedin) .'" target="_blank"><i class="fa fa-linkedin"></i></a></li>

						</ul>

					</div>

					<h4>'. escape($row->name) .'</h4>

					<h5>'. escape($row->title) .'</h5>

					<p>'. escape($row->description) .'</p>

				</div><!-- /.col-lg-4 -->			

				';



				unset($teamList);	 

				$x++;								

			}

		} else {

		echo $teamList .='';

	}		   





	?>				



</div><!-- /.col-lg-12 -->  

</div><!-- /.row -->

</div><!-- Awards-->			  		    

<? endif; ?>

</div><!-- /.col-lg-8 -->

			<div id="sidebar" class="col-lg-4" <?php echo ((!empty($usertwitter) && strpos($usertwitter, 'twitter') !== false) || (!empty($userlinkedin) && strpos($userlinkedin, 'linkedin') !== false))?'':"style='display:none'" ?>>

				<div class="list">

					<div class="list-group">



						<a class="list-group-item active cat-list">

							<em class="fa fa-fw fa-user"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['freelancer']; ?> references

						</a>



					</div><!-- ./.list-group -->

				</div><!-- ./.list --> 



				<?php $overview = (Input::get('a') == 'overview') ? ' active' : ''; ?>

				<?php $portfolio = (Input::get('a') == 'portfolio') ? ' active' : ''; ?>

				<?php $services = (Input::get('a') == 'services') ? ' active' : ''; ?>

				<?php $jobs = (Input::get('a') == 'jobs') ? ' active' : ''; ?>

				<?php $reviews = (Input::get('a') == 'reviews') ? ' active' : ''; ?>

				<div class="list" style="display: none;">

					<div class="list-group">



						<a href="freelancer.php?a=overview&id=<?php echo $freelancerid ?>" class="list-group-item <?php echo $overview; ?> cat-list">

							<em class="fa fa-fw fa-align-justify"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['overview']; ?>

						</a>

						<a href="freelancer.php?a=portfolio&id=<?php echo $freelancerid ?>" class="list-group-item <?php echo $portfolio; ?> cat-list">

							<em class="fa fa-fw fa-align-justify"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['portfolio']; ?>

						</a>

						<a style="display: none;" href="freelancer.php?a=services&id=<?php echo $freelancerid ?>" class="list-group-item <?php echo $services; ?> cat-list">

							<em class="fa fa-fw fa-align-justify"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['services']; ?>

						</a>

						<a href="freelancer.php?a=jobs&id=<?php echo $freelancerid ?>" class="list-group-item <?php echo $jobs; ?> cat-list">

							<em class="fa fa-fw fa-align-justify"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['jobs']; ?> 

							<?php echo $lang['completed']; ?> &

							<?php echo $lang['assigned']; ?>

						</a>

						<a href="freelancer.php?a=reviews&id=<?php echo $freelancerid ?>" class="list-group-item <?php echo $reviews; ?> cat-list">

							<em class="fa fa-fw fa-align-justify"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['reviews']; ?>

						</a>



					</div><!-- ./.list-group -->

				</div><!-- ./.list --> 

				<?php $path = rtrim($userlinkedin, '/');
				$path_to_array = explode("/",$path);
				$linkdin_company = end($path_to_array); 

				if (strpos($path, 'linkedin') !== false && $path_to_array[3] == "in") {?>
				<div class="secondcontainerarea" style="margin: 10px 0px;">

					<script type="IN/MemberProfile" data-width="330" data-id="<?php echo $userlinkedin;?>" data-format="inline" data-related="false"></script>
				</div>
				<?php } elseif(strpos($path, 'linkedin') !== false){?>
				<div class="secondcontainerarea" style="margin: 10px 0px;">
					<script type="IN/CompanyProfile" data-width="330" data-id="<?php echo $linkdin_company;?>" data-format="inline" data-related="false"></script>

				</div>
				<?php }
				?>

				<?php if(!empty($usertwitter) && strpos($usertwitter, 'twitter') !== false){ ?>
				<div class="secondcontainerarea" style="margin: 10px 0px;">
					<a class="twitter-timeline" href="<?php echo $usertwitter;?>" data-height="400" data-chrome=""></a>
				</div>
				<?php } //echo $usertwitter; ?>



			</div><!-- ./.col-lg-4 -->


<?php elseif (Input::get('a') == 'portfolio') : ?>



	<div class="col-lg-8 white-2" id="portfolio">



		<div class="row">

			<div class="col-lg-12">

				<h3><?php echo $lang['portfolio']; ?></h3>

			</div><!-- /.col-lg-12 -->

		</div><!-- /.row -->

		<br/> 



		<div class="row">

			<div class="col-lg-12">



				<?php

				$query = DB::getInstance()->get("portfolio", "*", ["userid" => $freelancerid]);

				if ($query->count()) {



				$portfolioList = '';

				$x = 1;	



				foreach($query->results() as $row) {



				$portfolio_title = $row->title;

				$portfolio_date = $row->date;

				$portfolio_client = $row->client;	

				$portfolio_website = $row->website;	

				$portfolio_desc = $row->description;	

				$portfolio_imagelocation = $row->imagelocation;						



				echo $portfolioList .= '



				<div class="col-sm-6 portfolio-item">

					<a href="#project-modal" class="portfolio-link" data-toggle="modal">

						<div class="caption">

							<div class="caption-content">

								<i class="fa fa-search-plus fa-3x"></i>

							</div><!-- /.caption-content -->

						</div><!-- /.caption -->

						<img src="Freelancer/'. escape($row->imagelocation) .'" class="img-responsive" alt="" />

					</a>

				</div><!-- /.col-lg-6 -->					  		

				';



				echo $modal .='						   

				'; 		 



				unset($portfolioList);	 

				$x++;								

			}

		} else {

		echo $portfolioList .='<h3>'.$lang['no_content_found'].'</h3>';

	}		   





	?>		   	



</div><!-- ./col-lg-12--> 

</div><!-- Row-->		  





</div><!-- ./col-lg-8--> 	



<?php elseif (Input::get('a') == 'services' && !Input::get('sid')) : ?>	





	<div class="col-lg-8 white-2 jobslist">

		<div class="col-lg-12"> 		 	



			<?php

			$query = DB::getInstance()->get("ratings", "*", ["AND" => ["freelancerid" => $freelancerid]]);

			$count = $query->count();

			$re = $count/7;



			$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);

			$limit = $service_limit;

			$startpoint = ($page * $limit) - $limit;	  



			$q1 = DB::getInstance()->get("service", "*", ["userid" => $freelancerid]);

			$total = $q1->count();



			$query = DB::getInstance()->get("service", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit], "AND" => ["userid" => $freelancerid, "active" => 1, "delete_remove" => 0]]);

			if($query->count()) {



			$x = 1;

			$serviceList = '';

			foreach($query->results() as $row) {

			$serviceList = '';				



			foreach ($arr as $key => $value) {

			$skills_each .=  '<label class="label label-success">'. $value .'</label> &nbsp;'; 

		}





		$q3 = DB::getInstance()->get("category", "*", ["catid" => $row->catid, "LIMIT" => 1]);

		if ($q3->count()) {

		foreach($q3->results() as $r3) {

		$category_name = $r3->name;

	}			

}





$blurb = truncateHtml($row->description, 400);



//Start new Admin object

$admin = new Admin();

//Start new Client object

$client = new Client();

//Start new Freelancer object

$freelancer = new Freelancer(); 



if ($admin->isLoggedIn()) { 

} elseif($freelancer->isLoggedIn()) {



} elseif($client->isLoggedIn()) {

$senn .='	 

<a href="Client/invite.php?id='. escape($row->userid) .'" class="kafe-btn kafe-btn-mint-small">

	<i class="fa fa-align-left"></i>' . $lang['send'] . ' ' . $lang['job'] . ' ' . $lang['invitation'] . '</a>

	';

} else {

$senn .='	 

<a href="login.php" class="kafe-btn kafe-btn-mint-small">

	<i class="fa fa-align-left"></i>' . $lang['send'] . ' ' . $lang['job'] . ' ' . $lang['invitation'] . '</a>

	';

}

echo $serviceList .= '		 

<div class="job">	



	<div class="row top-sec">

		<div class="col-lg-12">



			<div class="col-lg-12 col-xs-12"> 

				<h4><a href="freelancer.php?a=services&id='. escape($row->userid) .'&sid='. escape($row->serviceid) .'">'. escape($row->title) .'</a></h4>

			</div><!-- /.col-lg-12 -->



		</div><!-- /.col-lg-12 -->

	</div><!-- /.row -->



	<div class="row mid-sec">			 

		<div class="col-lg-12">			 

			<div class="col-lg-12">

				<hr class="small-hr">

				'. $blurb .'

				'. $skills_each .'

			</div><!-- /.col-lg-12 -->

		</div><!-- /.col-lg-12 -->

	</div><!-- /.row -->



	<div class="row bottom-sec">

		<div class="col-lg-12">



			<div class="col-lg-12">

				<hr class="small-hr">

			</div><!-- /.col-lg-12 --> 



			<div class="col-lg-3">

				<h5> '. $lang['rate_hour'] .' </h5>

				<p>$'. escape($row->rate) .'</p>

			</div><!-- /.col-lg-4 -->

			<div class="col-lg-3">

				<h5> ' . $lang['category'] . ' </h5>

				<p>'. escape($category_name) .'</p>

			</div>

			<div class="col-lg-3">

				<h5>'. $lang['ratings'] .' ('. escape($re) .')</h5>

				<p><i class="fa fa-star"></i>

					<i class="fa fa-star"></i>

					<i class="fa fa-star"></i>

					<i class="fa fa-star"></i>

					<i class="fa fa-star"></i></p>

				</div><!-- /.col-lg-4 -->

				<div class="col-lg-3">

					'.$senn.'

				</div><!-- /.col-lg-4 -->



			</div><!-- /.col-lg-12 -->

		</div><!-- /.row -->



	</div><!-- /.job -->

	';

	$x++;		



}



unset($senn);	

unset($serviceList);	 

unset($skills);

}else {

echo $serviceList = '<p>'.$lang['no_content_found'].'</p>';

}



//print

echo Pagination($total,$limit,$page,'?a=services&id='.$freelancerid.'&');

?>		





</div><!-- /.col-lg-12 -->

</div><!-- /.col-lg-8 -->       	 



<?php elseif (Input::get('a') == 'services' && Input::get('sid')) : ?>		





	<div class="col-lg-8 white-2">

		<div class="row">

			<div class="col-lg-12 jobpost">



				<?php

				$query = DB::getInstance()->get("service", "*", ["ORDER" => "date_added DESC", "AND" => ["serviceid" => Input::get('sid'), "userid" => $freelancerid, "active" => 1, "delete_remove" => 0]]);

				if($query->count()) {



				$serviceList = '';

				$x = 1;



				foreach ($arr as $key => $value) {

				$skills_each .=  '<label class="label label-success">'. $value .'</label> &nbsp;'; 

			}



			foreach($query->results() as $row) {

			$serviceList = '';				



			$q3 = DB::getInstance()->get("category", "*", ["catid" => $row->catid, "LIMIT" => 1]);

			if ($q3->count()) {

			foreach($q3->results() as $r3) {

			$category_name = $r3->name;

		}			

	}		



	echo $serviceList .= '		 

	<h3>'. escape($row->title) .'</h3>

	<p><strong>'. $lang['category'] .' :- </strong> '. escape($category_name) .'</p><br/>

	<p><strong>'. $lang['rate_hour'] .' :- </strong> '. escape($row->rate) .'</p><br/>

	<h4>'. $lang['description'] .'</h4>

	'. $row->description .'

	<br/>

	<h4>'. $lang['skills'] .'</h4>

	'. $skills_each .'

	';



	unset($serviceList);	 

	unset($skills);

	$x++;		



}

}else {

echo $serviceList = '<p>'.$lang['no_content_found'].'</p>';

}

?>			   	



</div><!-- ./col-lg-12-->

</div><!-- ./row-->	  

</div><!-- ./col-lg-8--> 		 	   		 	 	







<?php elseif (Input::get('a') == 'jobs') : ?>		 

	<div class="col-lg-8 white-2 jobslist">

		<?php		





		$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);

		$limit = $job_limit;

		$startpoint = ($page * $limit) - $limit;	  



		$q1 = DB::getInstance()->get("job", "*", ["freelancerid" => $freelancerid]);

		$total = $q1->count();





		$query = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit],

		"AND" => [

		"freelancerid" => $freelancerid,

		"active" => 1,

		"delete_remove" => 0

		]]);

		if($query->count()) {



		$jobList = '';

		$x = 1;	





		foreach($query->results() as $row) {

		$jobList = '';



		$q1 = DB::getInstance()->get("client", "*", ["clientid" => $row->clientid]);

		if ($q1->count()) {

		foreach ($q1->results() as $r1) {

		$name1 = $r1->name;	

		$username1 = $r1->username;	

		$imagelocation = $r1->imagelocation;	

	}

}	



//Getting Proposals

$q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $row->jobid]);

if ($q2->count() === 0) {

$job_proposals = 0;	

} else {

$job_proposals = $q2->count();

}			



$blurb = truncateHtml($row->description, 400);		

if ($row->accepted === '1' ) {

if ($row->completed === '1') {

$senp .='

<p>' . $lang['completed'] . '</p>

';	
} else {

$senp .='

<p>' . $lang['in_complete'] . '</p>

';	
}

} else {

$senp .='

<p>' . $lang['waiting'] . ' ' . $lang['freelancer'] . ' ' . $lang['to'] . ' ' . $lang['accept'] . '</p>

';	

}





echo $jobList .= '

<div class="job">	



	<div class="row top-sec">

		<div class="col-lg-12">

			<div class="col-lg-2 col-xs-12">

				<a href="#">

					<img class="img-responsive" src="Client/'. escape($imagelocation) .'" alt="">

				</a>

			</div><!-- /.col-lg-2 -->

			<div class="col-lg-10 col-xs-12"> 

				<h4><a href="jobpost.php?title='. escape($row->slug) .'">'. escape($row->title) .'</a></h4>

				<h5 style="display:none;"><a href="client.php?a=overview&id='. escape($row->clientid) .'" 

					style="text-decoration: none !important; color: #05CB95 !important;">

				'. escape($name1) .'</a> <small>@'. escape($username1) .'</small></h5>

			</div><!-- /.col-lg-10 -->



		</div><!-- /.col-lg-12 -->

	</div><!-- /.row -->



	<div class="row mid-sec">			 

		<div class="col-lg-12">			 

			<div class="col-lg-12">

				<hr class="small-hr">

				'. $blurb .'

			</div><!-- /.col-lg-12 -->

		</div><!-- /.col-lg-12 -->

	</div><!-- /.row -->



	<div class="row bottom-sec">

		<div class="col-lg-12">



			<div class="col-lg-12">

				<hr class="small-hr">

			</div> 



			<div class="col-lg-2">

				<h5>' . $lang['posted'] . ' </h5>

				<p>'. ago(strtotime($row->date_added)) .'</p>

			</div>

			<div class="col-lg-2">

				<h5>' . $lang['location'] . '</h5>

				<p><i class="fa fa-map-marker"></i> '. escape($row->country) .'</p>

			</div>

			<div class="col-lg-2">

				<h5> ' . $lang['budget'] . '</h5>

				<p>$'. escape($row->budget) .'</p>

			</div>

			<div class="col-lg-2">

				<h5>' . $lang['applicants'] . '</h5>

				<p>'. escape($job_proposals) .'</p>

			</div>

			<div class="col-lg-4">

				<h5>' . $lang['job'] . ' ' . $lang['status'] . '</h5>

				'.$senp.'

			</div>



		</div><!-- /.col-lg-12 -->

	</div><!-- /.row -->



</div><!-- /.job -->

';



unset($jobList); 

unset($senp);		

$x++;		 

}

}else {

echo $jobList = '<p>'.$lang['no_content_found'].'</p>';

}



//print

echo Pagination($total,$limit,$page,'?a=jobs&id='.$clientid.'&');

?>



</div><!-- /.col-lg-8 -->



<?php elseif (Input::get('a') == 'reviews') : ?>		 

	<div class="col-lg-8 white-2 jobslist">	

		<div id="star-container">

			<?php

			$q = DB::getInstance()->get("job", "*", ["AND" => ["freelancerid" => Input::get('id'), "completed" => 1]]);

			if ($q->count()) {

			foreach ($q->results() as $r) {



			$q1 = DB::getInstance()->get("client", "*", ["clientid" => $r->clientid]);

			if ($q1->count()) {

			foreach ($q1->results() as $r1) {

			$name1 = $r1->name;	

			$username1 = $r1->username;	

			$imagelocation = $r1->imagelocation;	

		}

	}	



	$jl = [

	'1'=>'1',

	'2'=>'2',

	'3'=>'3',

	'4'=>'4',

	'5'=>'5',

	'6'=>'6'

	];



	foreach ($jl as $key => $value) {





	$query = DB::getInstance()->get("ratings", "*", ["AND" => ["jobid" => $r->jobid, 

	"freelancerid" => Input::get('id'), 

	"star_type" => $value]]);

	if ($query->count()) {

	foreach($query->results() as $row) {



	$star = $row->star;

	$star_type = $value;						  



	if($star_type === '1'):

	$titl .='&nbsp;&nbsp; <span class="rate">'.$lang['skills'].'</span><br/>';   

	elseif($star_type === '2'):

	$titl .='&nbsp;&nbsp; <span class="rate">'.$lang['quality'].' '.$lang['of'].' '.$lang['work'].'</span> <br/>'; 

	elseif($star_type === '3'):

	$titl .='&nbsp;&nbsp; <span class="rate">'.$lang['availability'].'</span> <br/>'; 

	elseif($star_type === '4'):

	$titl .='&nbsp;&nbsp; <span class="rate">'.$lang['adherence'].' '.$lang['to'].' '.$lang['schedule'].'</span> <br/>'; 

	elseif($star_type === '5'):

	$titl .='&nbsp;&nbsp; <span class="rate">'.$lang['communication'].'</span> <br/>'; 

	elseif($star_type === '6'):

	$titl .='&nbsp;&nbsp; <span class="rate">'.$lang['cooperation'].'</span> <br/>'; 

	endif;



	$arrs[] = ratings($star).$titl;



	$titl;

}

}							



unset($titl); 

$x++;

}						 	







?>

<? ob_start(); ?>



<?php



$query = DB::getInstance()->get("ratings", "*", ["AND" => ["jobid" => $r->jobid]]);

if ($query->count()) :

?>



<div class="job">	



	<div class="row top-sec">

		<div class="col-lg-12">

			<div class="col-lg-2 col-xs-12" style="display: none;">

				<a href="client.php?a=overview&id=<?php echo escape($r->clientid); ?>">

					<img class="img-responsive" src="Client/<?php echo escape($imagelocation) ?>" alt="">

				</a>

			</div><!-- /.col-lg-2 -->

			<div class="col-lg-10 col-xs-12"> 

				<h4><a href="jobpost.php?title=<?php echo escape($r->slug); ?>"><?php echo escape($r->title) ?></a></h4>

				<h5 style="display: none;"><a href="client.php?a=overview&id=<?php echo escape($r->clientid); ?>" 

					style="text-decoration: none !important; color: #05CB95 !important;">

					<?php echo escape($name1) ?></a> <small>@<?php echo escape($username1) ?></small></h5>

				</div><!-- /.col-lg-10 -->



			</div><!-- /.col-lg-12 -->

		</div><!-- /.row -->



		<div class="row mid-sec">			 

			<div class="col-lg-12">			 

				<div class="col-lg-12">

					<hr class="small-hr">

					<div class="col-lg-9">

						<?php



						foreach ($arrs as $value) {

						echo $value.'<br/>';

					}

					unset($arrs);

					echo '<h3>'.$lang['message'].'</h3>';

					$query = DB::getInstance()->get("ratings", "*", ["AND" => ["jobid" => $r->jobid, 

					"freelancerid" => Input::get('id'), 

					"star_type" => 7]]); 

					if ($query->count()) {

					foreach($query->results() as $row) {

					$message = $row->message;

					echo '<p>'.$message.'</p>';

				}

			}  					                                                                  

			?>

		</div>

		<div class="col-lg-3">



			<?php



			$success = DB::getInstance()->sum("ratings", "star", ["AND" => ["star_type[!]" => 7,

			"jobid" => $r->jobid,

			"freelancerid" => Input::get('id')]]);

			foreach($success->results()[0] as $suc) {

			$suc_new = $suc;

		}



		$percentage = $suc_new/30 * 100;

		$percentage = round($percentage, 1);



		echo '<h3>'. $lang['job'] .' '.$lang['success'] .' '. $lang['score'].'</h3>';

		echo '<input class="knob" data-width="75" data-linecap="round" value="'. $percentage .'" style="position:relative !important; margin: 0px !important;  padding: 0px !important; overflow-x: 0;"/>';					 



		?>

	</div>

</div><!-- /.col-lg-12 -->

</div><!-- /.col-lg-12 -->

</div><!-- /.row -->



<div class="row bottom-sec">

	<div class="col-lg-12">



		<div class="col-lg-12">

			<hr class="small-hr">

		</div> 





	</div><!-- /.col-lg-12 -->

</div><!-- /.row -->



</div><!-- /.job -->



<?php endif; ?>		 



<? echo ob_get_clean(); ?>	



<?php 

}

}else {

echo $jobList = '<p>'.$lang['no_content_found'].'</p>';

}	 ?>							

</div>        		 	

</div><!-- /.col-lg-8 -->		 	

<?php endif; ?>         

</div><!-- /.row -->



</div><!-- /.container --> 

</section><!-- End section-->	 



<!-- Include footer.php. Contains footer content. -->	

<?php include 'includes/template/footer.php'; ?>	



<!-- ==============================================

PROJECT PREVIEW MODAL (Do not alter this markup)

=============================================== -->

<div id="project-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<div class="container">

					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

					<h1 id="hdr-title" class="text-center"><?php echo $portfolio_title; ?></h1>

					<div class="row">

						<div class="col-md-8 col-md-offset-2 text-center">

							<div class="image-wrapper">

								<img class="img-responsive" src="Freelancer/<?php echo $portfolio_imagelocation; ?>" alt="">

							</div>

							<!--./image-wrapper -->

						</div><!--./col-md-8 -->

					</div><!--./row -->

				</div><!--./container -->

			</div><!--./modal-header -->

			<div class="modal-body">

				<div class="container">

					<div class="row">

						<div id="project-sidebar" class="col-md-3">

							<h3><?php echo $portfolio_title; ?></h3>

							<p><i class="fa fa-calendar"></i><?php echo $portfolio_date; ?></p>

							<p><i class="fa fa-user"></i><?php echo $portfolio_client; ?></p>

							<p><i class="fa fa-globe"></i> <a href="http://<?php echo $portfolio_website; ?>" target="_blank"><?php echo $portfolio_website; ?></a></p>

						</div>

						<div id="project-content" class="col-md-9">

							<?php echo $portfolio_desc; ?>

							<p><a class="kafe-btn kafe-btn-mint-small" href="http://<?php echo $portfolio_website; ?>" target="_blank">Visit Website <i class="fa fa-arrow-right"></i></a></p>

						</div>

					</div>

				</div>

			</div><!-- End modal-body -->

		</div><!-- End modal-content -->

	</div><!-- End modal-dialog -->

</div><!-- End modal -->



<!-- ==============================================

Scripts

=============================================== -->
<script async src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


<!-- jQuery 2.1.4 -->

<script src="assets/js/jQuery-2.1.4.min.js"></script>

<!-- Bootstrap 3.3.6 JS -->

<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script>
function paynow(){
    $(".stripe-button-el").trigger("click");
}
</script>


<script src="assets/js/jquery.knob.js"></script>

<script src="assets/js/knob.js"></script>

<!-- Waypoints JS -->

<script src="assets/js/waypoints.min.js" type="text/javascript"></script>

<!-- Kafe JS -->

<script src="assets/js/kafe.js" type="text/javascript"></script>



</body>

</html>

