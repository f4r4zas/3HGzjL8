<?php

//Check if init.php exists

if(!file_exists('core/frontinit.php')){

	header('Location: install/');        

    exit;

}else{

 require_once 'core/frontinit.php';	

}


$mq1 = DB::getInstance()->get("job", "*", ["ORDER" => "catid ASC"]);
//print_r($mq1->results());
foreach($mq1->results() as $row){
    //echo time()."=";
   //print_r(strtotime($row->end_date)); 
   //echo '<br />';
   if(strtotime($row->end_date) < time()){
        $jobUpdate = DB::getInstance()->update('job',[
               "active" => 0,
               "public" => 0,

			],[

			    'jobid' => $row->jobid

			  ]);
   }
}

$fetched_jobs = array();

?>

<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->

<html lang="en"> 

<!--<![endif]-->

	

    <!-- Include header.php. Contains header content. -->

    <?php include ('includes/template/header.php'); ?> 

<style>



.list-group-item {
    padding: 10px 5px;
}


.badge {
    padding: 3px 5px;
    font-size: 10px;
}

section .job_meta span {
    font-size: 31px !important;
}

.job_meta {
    width: 47%;
}

.job_title {
    width: 45%;
}
</style>

<body class="greybg">

	

     <!-- Include navigation.php. Contains navigation content. -->

 	 <?php include ('includes/template/navigation.php'); ?> 	 

	 

     <!-- ==============================================

	 Header

	 =============================================== -->	 

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

		 <div class="col-lg-3 col-md-3 mybt col-sm-6 col-xs-12">

		  <a href="Client/addjob.php" class="kafe-btn mybt2  kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> <?php echo $lang['post']; ?> <?php echo $lang['a']; ?> <?php echo $lang['job']; ?>, <?php echo $lang['it\'s']; ?> <?php echo $lang['free']; ?> !

		  </a>

		 </div><!-- /.col-lg-3 -->

		<?php } else { ?>

		 <div class="col-lg-3 col-md-3 mybt col-sm-6 col-xs-12">

		  <a href="login.php" class="kafe-btn mybt2  kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> <?php echo $lang['post']; ?> <?php echo $lang['a']; ?> <?php echo $lang['job']; ?>, <?php echo $lang['it\'s']; ?> <?php echo $lang['free']; ?> !

		  </a>

		 </div><!-- /.col-lg-3 -->

		 <?php } ?>	


	 

     <!-- ==============================================

	 Jobs Section

	 =============================================== -->


	 <!-- =============================================== -->

     <section class="jobslist jobs">

	  <div class="container-fluid">

	   <div class="row">

	   

	    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

		

		 <div class="list">

		  <div class="list-group">

		  

           <span class="list-group-item active cat-top">

	       	<?php if($use_icon === '1'): ?>

	       		<em class="fa fa-fw <?php echo $site_icon; ?> text-white"></em>

	       	<?php endif; ?> 

            &nbsp;&nbsp;&nbsp;<?php echo $lang['categories']; ?>

            <span class="badge">



			  <?php

	          $query = DB::getInstance()->get("category", "*", ["ORDER" => "item_order ASC"]);

			 if($query->count()) {

			 	
                $fas = 0;
			    $x = 1;

				foreach($query->results() as $row) {

				

		       $q1 = DB::getInstance()->get("job", "*", ["AND"=>["catid" => $row->catid,"delete_remove" => 0,"active" => 1,"public" => 1]]);  

			   $count[] = $q1->count();

				

					
                $fas++;
				 $x++;		

				

			   }

			}else {

			 //echo $List = '<p style="padding:10px; margin-top:30px;">'.$lang['no_content_found'].'</p>';
             echo $List = '<p style="padding:10px; margin-top:30px;">Sorry, there are currently no active services in your search area at this time. Services often go fast, please check back frequently for new posted services.<br /><br />
             <a href="Client/addjob.php" style="background: rgb(76, 42, 87); max-width:50%; margin: 0 auto; display: block;" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> Need to post a service?

		  </a>
          <br /><br />
          <img style="margin: 0 auto; display: block;" src="https://i.gifer.com/JVwt.gif"/>
             </p>';

			}

			

			echo array_sum($count);

	       ?>+</span>

		   </span>



			  <?php

	          $query = DB::getInstance()->get("category", "*", ["ORDER" => "item_order ASC"]);

			 if($query->count()) {

			 	
                $fas = 0;    
			    $x = 1;

				foreach($query->results() as $row) {

			    $List = '';

				

		       $q1 = DB::getInstance()->get("job", "*", ["AND"=>["catid" => $row->catid,"public" => 1,"active" => 1,"delete_remove" => 0]]);  

			   $count = $q1->count();

				

			    echo $List .= '

			           <a href="searchcat.php?searchterm='. escape($row->name) .'" class="list-group-item cat-list">

			            <em class="fa fa-fw '. $row->icon .' text-muted"></em>&nbsp;&nbsp;&nbsp;'. escape($row->name) .'

			            <span class="badge text-red-bg">'. escape($count) .'</span>

					   </a>

						 ';

					

	             unset($List);	 
                $fas++;
				 $x++;		

				

			   }

			}else {

			 echo $List = '<p style="padding:10px; margin-top:30px;">Sorry, there are currently no active services in your search area at this time. Services often go fast, please check back frequently for new posted services.<br /><br />
             <a href="Client/addjob.php" style="background: rgb(76, 42, 87); max-width:50%; margin: 0 auto; display: block;" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> Need to post a service?

		  </a><br /><br /><img style="margin: 0 auto; display: block;" src="https://i.gifer.com/JVwt.gif"/></p>';

			}

	       ?>		   

		   

          </div><!-- /.list-group -->

		 </div><!-- /.list --> 

		

		 		

		</div><!-- /.col-lg-4 -->

	    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12 white">	

		

		 <form action="search.php" method="get" class="list-search revealOnScroll" data-animation="fadeInDown" data-timeout="200">

		  <button><i class="fa fa-search"></i></button>

		  <input type="text" class="form-control" name="searchterm" placeholder="<?php echo $lang['job']; ?> <?php echo $lang['title']; ?>, <?php echo $lang['keywords']; ?> <?php echo $lang['or']; ?> <?php echo $lang['company']; ?> <?php echo $lang['name']; ?>" value=""/>   

		  <div class="clearfix"></div>

		 </form>

		 

<?php

		  $limit = 8;

          $query = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC", 

                                                        "AND" => [

                                                                  "featured" => 1, 

                                                                  "active" => 1,
                                                                  
                                                                  "public" => 1, 

                                                                  "delete_remove" => 0

                                                                 ]]);

		  if($query->count()) {

		 	

		    $jobList = '';
            $fas= 0;
		    $x = 1;	

			

			

			foreach($query->results() as $row) {
			 
             if(!in_array($row->jobid,$fetched_jobs)):

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

									

			$blurb = truncateHtml($row->description, 100);		

				

			 //Start new Admin object

			 $admin = new Admin();

			 //Start new Client object

			 $client = new Client();

			 //Start new Freelancer object

			 $freelancer = new Freelancer(); 

			 

			 if ($admin->isLoggedIn()) { 

	         } elseif($client->isLoggedIn()) {

	         } elseif($freelancer->isLoggedIn()) {

	          $sen ='	 

					 <a href="Freelancer/addproposal.php?id='. escape($row->jobid) .'" class="kafe-btn kafe-btn-mint-small" style="background: #366230;">

					  <i class="fa fa-align-left"></i> Provide Service

					 </a>

			 ';

			} else {

	          $sen ='	 

					 <a href="login1.php" class="kafe-btn kafe-btn-mint-small" style="background: #366230;">

					  <i class="fa fa-align-left"></i> Provide Service

					 </a>

			 ';
             
             
             

			 }
             
             
             if(!empty($row->images)){
                $job_img = $row->images;
                
             }elseif(!empty($row->before_image)){
                $job_img = $row->before_image.'nth/0/';
                
             }else{
                $job_img = "http://via.placeholder.com/400x300?text=Demo%20Image";
             }			

			  if($row->travel > 0){
			     $whotowho = "Customer can travel ".$row->travel."miles to service provider";
			  }else{
			     $whotowho = "Service provider will travel to customer";
			  }
              
              
              $now = time();
              $your_date = strtotime($row->end_date);
              $datediff = $now - $your_date;
            
              $date_dif = round($datediff / (60 * 60 * 24));
              
              if( $date_dif >= -1){
                //echo $date_dif;
                
                $exp_red = "color:red;";
              } else {
                $exp_red = "";
              }

		    $jobList .= '
            
                <div class="col-md-6">
					<div class="job_b" style="border: 1px solid #ccc; padding: 13px;">
						<div class="job_thumb">
							<a href="jobpost.php?title='. escape($row->slug) .'"><img style="height: 300px;" src="'.$job_img.'" alt="Demo Image"></a>
						</div>
						<div class="job_title" style="padding: 20px 0 0px;">
							<a href="jobpost.php?title='. escape($row->slug) .'">'. substr(escape($row->title),0,15) .'...</a>
                            
                            <div class="job_status" style="display: block; float: left; font-size: 12px; font-weight: bold;">
    							<i class="fa fa-map-marker"></i> '. escape($row->country) .'
    						</div>
						</div>
						<div class="job_meta">
							<span class="price" style="color: #366230 !important; background:transparent !important;">
                            <span style="font-size: 15px !important; color: #366230 !important; background:transparent !important;">Budget limit:</span>
								 $'. number_format(escape($row->budget), 2, '.', '') .'
							</span>
						</div>
							<div class="clear"></div>
						<div class="job_meta2">
							<span class="v_seprator"></span>
							<span class="job_created_date" style="float:left; font-weight:bold;">
								<i class="fa fa-calendar"></i>Service needed by:<br />'. $row->start_date .' - '. $row->end_date .'
							</span>
                            <span class="job_created_date" style="float: right; font-weight:bold;">
								<i class="fa fa-clock-o"></i>Expire:<br /><span style="font-weight:normal;'.$exp_red.'" id="job_end_date'.$row->id.'">'. $row->end_date .'</span>
							</span>
                            
                            <script>
var countDownDate'.$row->id.' = new Date("'. $row->end_date .', 00:00:00").getTime();

// Update the count down every 1 second
var x'.$row->id.' = setInterval(function() {

    // Get todays date and time
    var now'.$row->id.' = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance'.$row->id.' = countDownDate'.$row->id.' - now'.$row->id.';
    
    // Time calculations for days, hours, minutes and seconds
    var days'.$row->id.' = Math.floor(distance'.$row->id.' / (1000 * 60 * 60 * 24));
    var hours'.$row->id.' = Math.floor((distance'.$row->id.' % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes'.$row->id.' = Math.floor((distance'.$row->id.' % (1000 * 60 * 60)) / (1000 * 60));
    var seconds'.$row->id.' = Math.floor((distance'.$row->id.' % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("job_end_date'.$row->id.'").innerHTML = days'.$row->id.' + "d " + hours'.$row->id.' + "h "
    + minutes'.$row->id.' + "m " + seconds'.$row->id.' + "s ";
    
    // If the count down is over, write some text 
    if (distance'.$row->id.' < 0) {
        clearInterval(x'.$row->id.');
        document.getElementById("job_end_date'.$row->id.'").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
						</div>
						<div class="job_status">
							<i class="fa fa-car"></i> '. $whotowho .'
						</div>
                        
                        
						<div class="job_excerpt">
							<i class="fa fa-commenting"></i>'. $blurb .'
						</div>
                        '. $sen .'
					</div>
				</div>
                
                
                

				 

					 ';

			if (($x % 2) == 0){
			 $jobList .= '<div style="clear:both;"></div>';
			}
            
            echo $jobList; 	

             //unset($jobList); 

             //unset($sen);		
            $fas++;
			 $x++;
             
             $fetched_jobs[] = $row->jobid;
             
             endif;	 

		   }

		}



?>		 

		  

		  <?php		

		  



		    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);

		    $limit = $job_limit;

		    $startpoint = ($page * $limit) - $limit;	  

			  

            $q1 = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC", 

                                                        "AND" => [

                                                                  "active" => 1,
                                                                  
                                                                  "public" => 1, 

                                                                  "delete_remove" => 0

                                                                 ]]);

		    $total = $q1->count();

		  

		  

          $query = DB::getInstance()->get("job", "*", ["ORDER" => "date_added DESC", "LIMIT" => [$startpoint, $limit],

													   "OR" => [

															"AND #first" => [

																"invite" => 0,

																"public" => 1,

																"accepted" => 0,

																"active" => 1,

																"delete_remove" => 0

															],

															"AND #second" => [

																"invite" => 1,

																"public" => 1,

																"accepted" => 0,

																"active" => 1,

																"delete_remove" => 0

															]

														]]);

		  if($query->count()) {

		 	

		    $jobList = '';
            $fas=0;
		    $x = 1;	

			

			

			foreach($query->results() as $row) {
			 
             if(!in_array($row->jobid,$fetched_jobs)):

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

									

			$blurb = substr($row->description,0,60).'<a href="jobpost.php?title='. escape($row->slug) .'">...</a>';//truncateHtml($row->description, 50);
            
            if(!empty($row->video)){
            
            $videos = '<span class="abc"><a href="#myModal" data-video='.$row->video.' class="" data-toggle="modal">
							<i data-video='.$row->video.' class="fa fa-play"></i>
							</a></span>';
            }else {
            $videos = '';    
            }		

				

			 //Start new Admin object

			 $admin = new Admin();

			 //Start new Client object

			 $client = new Client();

			 //Start new Freelancer object

			 $freelancer = new Freelancer(); 

			 

			 if ($admin->isLoggedIn()) { 

	         } elseif($client->isLoggedIn()) {

	         } elseif($freelancer->isLoggedIn()) {

	          $sen ='	 

					 <a href="Freelancer/addproposal.php?id='. escape($row->jobid) .'" style="background: #366230; display: inline-block;" class="kafe-btn kafe-btn-mint-small">

					  <i class="fa fa-align-left" style="margin-top:3px;"></i> Provide Service

					 </a>

			 ';

			} else {

	          $sen ='	 

					 <a href="login1.php" style="background: #366230; display: inline-block;" class="kafe-btn kafe-btn-mint-small">
                        
					  <i class="fa fa-align-left" style="margin-top:3px;"></i> Provide Service

					 </a>

			 ';

			 }			

			 if(!empty($row->images)){
                $job_img = $row->images;
                
             }elseif(!empty($row->before_image)){
                $job_img = $row->before_image.'nth/0/';
                
             }else{
                $job_img = "http://via.placeholder.com/400x300?text=Demo%20Image";
             }
             
             if($row->travel > 0){
			     $whotowho = "Customer can travel ".$row->travel."miles to service provider";
			  }else{
			     $whotowho = "Service provider will travel to customer";
			  }	 
              
              
              $now = time();
              $your_date = strtotime($row->end_date);
              $datediff = $now - $your_date;
            
              $date_dif = round($datediff / (60 * 60 * 24));
              
              if( $date_dif >= -1){
                //echo $date_dif;
                $exp_red = "color:red;";
              } else {
                $exp_red = "";
              }
              
              $q11 = DB::getInstance()->get("profile", "*", ["userid" => $row->clientid]);

                $customer_profile = $q11->results();

		    $jobList .= '
            
            
            <div class="col-md-6">
					<div class="job_b" style="border: 1px solid #ccc; padding: 13px;">
						<div class="job_thumb">
							<a href="jobpost.php?title='. escape($row->slug) .'"><img style="height: 300px;" src="'.$job_img.'" alt="Demo Image"></a>
						</div>
						<div class="job_title" style="padding: 20px 0 0px;">
							<a href="jobpost.php?title='. escape($row->slug) .'">'. substr(escape($row->title),0,15) .'...</a>
							'.$videos.'
                            
                            <div class="job_status" style="display: block; float: left; font-size: 12px; font-weight: bold;">
							<i class="fa fa-map-marker" style="margin-top: 3px;"></i> '. escape($customer_profile[0]->city) .','. escape($customer_profile[0]->postal_code) .'
						</div>
						</div>
						<div class="job_meta">
                        <span style="font-size: 15px !important; color: #366230 !important; background:transparent !important;">Budget limit:</span>
							<span class="price" style="color: #366230 !important; background:transparent !important;">
								 $'. number_format(escape($row->budget), 2, '.', '') .'
							</span>
						</div>
                        
                        
						<div class="clear"></div>
							
						<div class="job_meta2">
							<span class="v_seprator"></span>
							<span class="job_created_date" style="float:left; font-weight:bold;">
								<i class="fa fa-calendar"></i>Service needed by:<br /><span style="font-weight:normal;">'. $row->start_date .' - '. $row->end_date .'</span>
							</span>
                            <span class="job_created_date" style="float: right; font-weight:bold;">
								<i class="fa fa-clock-o"></i> Expires:<br /><span style="font-weight:normal;'.$exp_red.'" id="job_end_date'.$row->id.'">'. $row->end_date .'</span>
							</span>
                            
                            <script>
var countDownDate'.$row->id.' = new Date("'. $row->end_date .', 00:00:00").getTime();

// Update the count down every 1 second
var x'.$row->id.' = setInterval(function() {

    // Get todays date and time
    var now'.$row->id.' = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance'.$row->id.' = countDownDate'.$row->id.' - now'.$row->id.';
    
    // Time calculations for days, hours, minutes and seconds
    var days'.$row->id.' = Math.floor(distance'.$row->id.' / (1000 * 60 * 60 * 24));
    var hours'.$row->id.' = Math.floor((distance'.$row->id.' % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes'.$row->id.' = Math.floor((distance'.$row->id.' % (1000 * 60 * 60)) / (1000 * 60));
    var seconds'.$row->id.' = Math.floor((distance'.$row->id.' % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("job_end_date'.$row->id.'").innerHTML = days'.$row->id.' + "d " + hours'.$row->id.' + "h "
    + minutes'.$row->id.' + "m " + seconds'.$row->id.' + "s ";
    
    // If the count down is over, write some text 
    if (distance'.$row->id.' < 0) {
        clearInterval(x'.$row->id.');
        document.getElementById("job_end_date'.$row->id.'").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
						</div>
						
                        <div class="job_status" style="font-weight:bold;">
							<i class="fa fa-car" style="font-size: 14px;"></i> '. $whotowho .'
						</div>
						<div class="job_excerpt" style="width: 252px; display: inline-block; vertical-align: top;">
							<i class="fa fa-commenting" style="font-size: 14px; color:red; margin-top: 0px;"></i> '. $blurb .'
						</div>
                        '. $sen .'
					</div>
				</div>

				 

					 ';

			if (($x % 2) == 0){
			  $jobList .= '<div style="clear:both;"></div>';
			}
            
            echo $jobList;	

             //unset($jobList); 
            //unset($videos);
             //unset($sen);		
            $fas++;
			 $x++;		 
             $fetched_jobs[] = $row->jobid;
             endif;

		   }

		}else {

		 echo $jobList = '<p style="padding:10px; margin-top:30px;">Sorry, there are currently no active services in your search area at this time. Services often go fast, please check back frequently for new posted services.<br /><br />
             <a href="Client/addjob.php" style="background: rgb(76, 42, 87); max-width:50%; margin: 0 auto; display: block;" class="kafe-btn kafe-btn-mint full-width revealOnScroll" data-animation="bounceIn" data-timeout="400">

		  	<i class="fa fa-tags"></i> Need to post a service?

		  </a><br /><br />
          <img style="margin: 0 auto; display: block;" src="https://i.gifer.com/JVwt.gif"/>
          </p>';

		}



		//print

		echo Pagination($total,$limit,$page);

        ?>



		 

	    </div><!-- /.col-lg-8 -->

	   </div><!-- /.row -->

	  </div><!-- /.container-fluid -->
<div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Video</h4>
                </div>
                <div class="modal-body">
				<video width="100%" height="315" controls>
				<source src="https://ucarecdn.com/ccee11fe-dae5-4b1b-86d1-343f4db92094/" type="video/mp4">
				Your browser does not support the video tag.
				</video>
                </div>
            </div>
        </div>
    </div>
	    
    
    
    
     </section><!-- /section -->  	 

	  

      <!-- Include footer.php. Contains footer content. -->	

	  <?php include 'includes/template/footer.php'; ?>	

	 

     <!-- ==============================================

	 Scripts

	 =============================================== -->

	 

     <!-- jQuery 2.1.4 -->

     <script src="assets/js/jQuery-2.1.4.min.js"></script>

     <!-- Bootstrap 3.3.6 JS -->

     <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
     
     
     
     <script>
	$(document).ready(function() {
$('.modal-link').click(function(e) {
e.preventDefault();
$('.modal-background').fadeIn();
});
$('.close-modal').click(function(e) {
e.preventDefault();
$('.modal-background').fadeOut();
});
});
	
	</script>
    
<script type="text/javascript">
$(document).ready(function(){
    /* Get iframe src attribute value i.e. YouTube video url
    and store it in a variable */
    var url = $("#myModal source").attr('src');
    
    /* Assign empty url value to the iframe src attribute when
    modal hide, which stop the video playing */
    $("#myModal").on('hide.bs.modal', function(){
        console.log("hide");
        
        var video = $('#myModal video')[0];
        video.src = '';
        video.load();
        //video.play();
        //$("#myModal source").attr('src', '');
    });
    
    /* Assign the initially stored url back to the iframe src
    attribute when modal is displayed again */
    /*$("#myModal").on('show.bs.modal', function(){
        console.log("show");
        
        var video = $('#myModal video')[0];
        video.src = url;
        video.load();
        video.play();
        //$("#myModal source").attr('src', url);
    });*/
    
    $(".abc i, .abc a").click(function(){
        var videos = $(this).attr('data-video');
        //$("#myModal source").attr('src', video);
        //console.log(videos);
        var video = $('#myModal video')[0];
        video.src = videos;
        video.load();
        video.play();
    });
    
    
});



</script>

     <!-- Waypoints JS -->

     <script src="assets/js/waypoints.min.js" type="text/javascript"></script>

     <!-- Kafe JS -->

     <script src="assets/js/kafe.js" type="text/javascript"></script>



</body>

</html>

<?php // print_r($fetched_jobs);?>

