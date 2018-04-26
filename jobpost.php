<?php

//Check if init.php exists

if(!file_exists('core/frontinit.php')){

	header('Location: install/');        

    exit;

}else{

 require_once 'core/frontinit.php';	

}



//Getting Job Data

$title = Input::get('title');

$query = DB::getInstance()->get("job", "*", ["slug" => $title, "LIMIT" => 1]);

if ($query->count() === 1) {

 foreach($query->results() as $row) {
    
    if($row->travel > 0){
     $whotowho = "Customer can travel ".$row->travel."miles to service provider";
  }else{
     $whotowho = "Service provider will travel to customer";
  }

  $jobid = $row->jobid;
  
  $country_location = $row->country;

  $title_job = $row->title;

  $clientid = $row->clientid;

  $catid = $row->catid;

  $budget = $row->budget;

  $job_type = $row->job_type;

  $start_date = $row->start_date;

  $end_date = $row->end_date;

  $description_job = $row->description;

  $skills = $row->skills;

  $arr=explode(',',$skills);

  $date_added = ago(strtotime($row->date_added));

  $completed = $row->completed;

  $accepted = $row->accepted;
  
  //$whotowho = $row->travel;
  
  $image = $row->images;
  
  $after_image = $row->after_image;
  
  $before_image = $row->before_image;
  
  $video = $row->video;

 }

} else {

  Redirect::to('jobs.php');

}



//Getting Category Name

$query = DB::getInstance()->get("category", "*", ["catid" => $catid, "LIMIT" => 1]);

if ($query->count() === 1) {

 foreach($query->results() as $row) {

  $cat_name = $row->name;

 }

}else {
  $cat_name = "Undefined"; 	
}



//Getting Client

$q1 = DB::getInstance()->get("client", "*", ["clientid" => $clientid]);

if ($q1->count()) {

	 foreach ($q1->results() as $r1) {

	  $name1 = $r1->name;	

	  $username1 = $r1->username;	

	  $imagelocation = $r1->imagelocation;	

	  $bgimage = $r1->bgimage;	

     }

}



//Getting Proposals

$q2 = DB::getInstance()->get("proposal", "*", ["jobid" => $jobid]);

 if ($q2->count() === 0) {

  $job_proposals = 0;	
 } else {

  $job_proposals = $q2->count();
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
.jobpost .col-lg-8.white {
    margin-top: 0px;
    margin-bottom: 10px;
}

.question {
    margin-left: 0px;
    font-size: 14px;
    width: 22px;
}
.descrip1.tooltip {
    left: 34%;
    overflow-y: scroll;
}
/*#slideshow { 
    margin: 50px auto; 
    position: relative; 
    width: 240px;  
}*/

#slideshow {
    margin: 15px auto;
    position: relative;
    width: 240px;
    min-height: 300px;
    overflow: hidden;
}

div#slideshow img {
    padding: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.4);
}

#slideshow > div { 
    position: absolute; 
    top: 10px; 
    left: 10px; 
    right: 10px; 
    bottom: 10px; 
}
.descrip{
display: none;
}
.showdescrip:hover + div{
display: block;}
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}

</style>

  

     <!-- Include navigation.php. Contains navigation content. -->

 	 <?php include ('includes/template/navigation.php'); ?> 	 

	 

     <!-- ==============================================

	 Header

	 =============================================== -->	 

	 <header class="header-jobpost" style="


background: #eee;
  
  color: #fff;


  width: 100%;

  ">

      <div class="container" >

	   <div class="content">

	    <div class="row">

		 <div class="col-lg-4 col-lg-offset-8 col-md-4 col-md-offset-8 col-sm-6 col-xs-12 animations fade-left d2">



		 <?php /*

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 

		 if ($admin->isLoggedIn()) { ?>

		<?php } elseif($client->isLoggedIn()) { ?>

		<?php } elseif($freelancer->isLoggedIn()) { ?>

		  <a href="Freelancer/addproposal.php?id=<?php echo $jobid; ?>" class="kafe-btn kafe-btn-mint-post full-width">

		  	<i class="fa fa-star"></i> Provide service<?php //echo $lang['send']; ?> <?php //echo $lang['proposal']; ?>

		  </a>		

		<?php } else { ?>

		  <a href="login.php" class="kafe-btn kafe-btn-mint-post full-width">

		  	<i class="fa fa-star"></i> Provide service<?php //echo $lang['send']; ?> <?php //echo $lang['proposal']; ?>

		  </a>		

		 <?php }*/ ?>		 

		 </div><!-- /.col-lg-3 -->

		 

        </div><!-- /.row -->

       </div><!-- /.content -->

	  </div><!-- /.container -->

     </header><!-- /header -->

	 

     <!-- ==============================================

	 Job Post Section

	 =============================================== -->

     <section class="jobpost">

	  <div class="container">

	   <div class="row">

	    <div class="col-lg-8 white">

		 

		 <div id="myModal" class="modal">
			<span class="close">&times;</span>
			<img class="modal-content" id="img01">
			<div id="caption"></div>
			</div>

		 <div class=" post-top-sec">
         
         
         
         <?php if(!empty($image)):?>
             <div class="row">
        		<div class="col-md-4 tumbimg">	
        		  <img id="myImg" src="<?php echo $image?>" style="width:250px; height:200px;"/>
        		</div>
                <div class="col-md-8">
                    <h6><a href="jobs.html"><?php echo $lang['categories']; ?> / <?php echo $cat_name; ?></a></h6>
                    
                    <div class="col-lg-4 col-lg-offset-8 col-md-4 col-md-offset-8 col-sm-6 col-xs-12 animations fade-left d2">



		 <?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 

		 if ($admin->isLoggedIn()) { ?>

		<?php } elseif($client->isLoggedIn()) { ?>

		<?php } elseif($freelancer->isLoggedIn()) { ?>

		  <a style="background: #0a672a;" href="Freelancer/addproposal.php?id=<?php echo $jobid; ?>" class="kafe-btn kafe-btn-mint-post full-width">

		  	<i class="fa fa-star"></i> Provide service<?php //echo $lang['send']; ?> <?php //echo $lang['proposal']; ?>

		  </a>		

		<?php } else { ?>

		  <a style="background: #0a672a;" href="login1.php" class="kafe-btn kafe-btn-mint-post full-width">

		  	<i class="fa fa-star"></i> Provide service<?php //echo $lang['send']; ?> <?php //echo $lang['proposal']; ?>

		  </a>		

		 <?php } ?>		 

		 </div><!-- /.col-lg-3 -->
        <h5><?php echo $lang['skills']; ?> <?php echo 'required'; ?></h5>
        
                   <?php
        
                    foreach ($arr as $key => $value) {
        
                      echo '<label class="label label-success">'. $value .'</label> &nbsp;'; 
        
                    }
        
        		   ?>
                   <h4><?php echo $title_job; ?></h4>
                   
                   <div class="clear"></div>
                   <div class="post-bottom-sec"> 
                   <br />

            		  <h5 class="showdescrip pull-left"><?php echo $lang['job']; ?> <?php echo $lang['description']; ?></h5> 
            		<span class="question link">?</span>
            		  
            		<?php echo "<div class='descrip1 tooltip'>" ?>
                      <?php echo $description_job; ?>
            			<?php echo "</div>" ?>
            		
            	
            
            		
            
            		 </div>
                   
        		  
                   
                   
                   
                </div>
             </div>
        <?php else:?>
                <div class="row">
 
        		  <div class="col-lg-12">
        
        		   <h6><a href="jobs.html"><?php echo $lang['categories']; ?> / <?php echo $cat_name; ?></a></h6>
                   <div class="col-lg-4 col-lg-offset-8 col-md-4 col-md-offset-8 col-sm-6 col-xs-12 animations fade-left d2">



		 <?php

		 //Start new Admin object

		 $admin = new Admin();

		 //Start new Client object

		 $client = new Client();

		 //Start new Freelancer object

		 $freelancer = new Freelancer(); 

		 

		 if ($admin->isLoggedIn()) { ?>

		<?php } elseif($client->isLoggedIn()) { ?>

		<?php } elseif($freelancer->isLoggedIn()) { ?>

		  <a style="background: #0a672a;" href="Freelancer/addproposal.php?id=<?php echo $jobid; ?>" class="kafe-btn kafe-btn-mint-post full-width">

		  	<i class="fa fa-star"></i> Provide service<?php //echo $lang['send']; ?> <?php //echo $lang['proposal']; ?>

		  </a>		

		<?php } else { ?>

		  <a style="background: #0a672a;" href="login1.php" class="kafe-btn kafe-btn-mint-post full-width">

		  	<i class="fa fa-star"></i> Provide service<?php //echo $lang['send']; ?> <?php //echo $lang['proposal']; ?>

		  </a>		

		 <?php } ?>		 

		 </div><!-- /.col-lg-3 -->
                   <h5>Service need:</h5>
        
                   <?php
        
                    foreach ($arr as $key => $value) {
        
                      echo '<label class="label label-success">'. $value .'</label> &nbsp;'; 
        
                    }
        
        		   ?>
        
                   <h4><?php echo $title_job; ?></h4>
                   
                   <div class="post-bottom-sec"> 
                   <br />

            		  <h5 class="showdescrip pull-left"><?php echo $lang['job']; ?> <?php echo $lang['description']; ?></h5> 
            		<span class="question link">?</span>
            		  
            		<?php echo "<div class='descrip1 tooltip'>" ?>
                      <?php echo $description_job; ?>
            			<?php echo "</div>" ?>
            		
            	
            
            		
            
            		 </div>
        
                   <hr class="small-hr">
                   
                   <div class="clear"></div>
                   <?php if(!empty($before_image)):?>
                   <iframe
                  src="<?php echo $before_image;?>gallery/-/nav/thumbs/-/fit/cover/-/loop/true/-/allowfullscreen/native/-/thumbwidth/100/"
                  width="100%"
                  height="450"
                  allowfullscreen="true"
                  frameborder="0">
                </iframe>
                <?php endif;?>

        		  
        
        		  </div>		
        
        		 </div> 
        <?php endif;?>
        
        <div class="col-md-12">
		 
		<!--<div class="col-md-8">-->
		
		 <div class="col-md-4">

		   <h5> Who's traveling where? </h5>

		   <p><?php echo $whotowho; ?></p>

		  </div><!-- /.col-lg-3 -->
		
		  <div class="col-md-4">

		   <h5> <?php echo $lang['location']; ?> </h5>
           
           <?php
           $profileq1 = DB::getInstance()->get("profile", "*", ["userid" => $clientid]);

$client_profile = $profileq1->results();?>

		   <p><i class="fa fa-map-marker"></i> <?php echo $client_profile[0]->postal_code.','.$client_profile[0]->city;?></p>

		  </div><!-- /.col-lg-3 -->

		  <div class="col-md-4">

		   <h5><?php echo $lang['budget']; ?> limit</h5>

		   <p style="font-size: 31px !important; font-weight: bold; color: #366230 !important; background:transparent !important;">$<?php echo number_format(escape($budget), 2, '.', ''); ?></p>

		  </div><!-- /.col-lg-3 -->
          
          <div class="clearfix"></div>
          
          
		<!--</div>-->
		  <!--<div class="col-lg-3">

		   <h5> <?php echo $lang['applicants']; ?> </h5>

		   <p><?php echo $job_proposals; ?></p>

		  </div>--><!-- /.col-lg-3 -->
          
          <div class="col-md-4">

		   <h5> <?php echo $lang['job']; ?> <?php echo $lang['status']; ?></h5>

		   <p><?php 

		         if($accepted === 1):

					  if($completed === '1'):	 

					   echo $lang['completed'];	

					  else:

					   echo $lang['on']; echo $lang['progress'];	  

					  endif;	   

				 else:

				 echo $lang['opened'];	 

				 endif;	  

		    ?></p>

		  </div><!-- /.col-lg-3 -->

		  

		  <!--<div class="col-lg-12">

           <hr class="small-hr">

		  </div>--> <!-- /.col-lg-12 -->

		 <!--</div>--><!-- /.row -->

		 

		 <!--<div class="row post-top-sec">-->

		  <div class="col-md-4">

		   <h5> Service needed by </h5>

		   <p><?php echo $start_date; ?> - <?php echo $end_date; ?></p>

		  </div><!-- /.col-lg-3 -->

		  <div class="col-md-4">

		   <h5> Service Expires</h5>

		   <p><?php echo $end_date; ?></p>

		  </div><!-- /.col-lg-3 -->

		  <!--<div class="col-lg-3">

		   <h5> <?php echo $lang['job']; ?> <?php echo $lang['type']; ?></h5>

		   <p><?php echo $job_type; ?></p>

		  </div>--><!-- /.col-lg-3 -->

		  

		  

		  <div class="col-lg-12">

           <hr class="small-hr">

		  </div> <!-- /.col-lg-12 -->

		 </div><!-- /.row -->
         </div>		 

		  

		 <!-- /.post-bottom-sec --> <br>

		 

		 <h4 style="display: none;"><?php echo $lang['proposals']; ?></h4>

		 	

		 <div id="comments-list" style="display: none;">	

          <?php echo getFeaturedProposals($jobid) ?>

          <?php echo getProposals(null, $jobid, $proposal_limit) ?>

		 </div>

		 

		</div><!-- /.col-lg-8 -->

		<div class="col-lg-4">
            <div class="row text-center">
                <h4 style="background: #345999; color: #fff; max-width: 67%; margin: 0 auto; padding: 10px;"><?php echo "Sponsors"; ?></h4>
                <?php $query = DB::getInstance()->get("sponsors", "*", ["ORDER" => "RAND()","LIMIT" => 3]);

                if ($query->count() > 0) { ?>
                <div id="slideshow">
                 <?php foreach($query->results() as $row) { ?>
                 <div>
                     <a href="<?php echo (!empty($row->link))?$row->link:'#';?>"><img style="width: 100%;" src="<?php echo $row->image;?>"></a>
                   </div>
                 <?php } ?>
                </div>
                <?php }else { ?>
                  <img src="http://www.easternplumaschamber.com/uploads/4/0/2/4/40244597/sponsor-icon_orig.png"/>
                <?php }?>
                
                   
                   
                
                
                
                
                
            </div>
        </div>

	    <div class="col-lg-4" style="display: none;">

		

		 <div class="panel user-client revealOnScroll" data-animation="slideInUp" data-timeout="200">

		  <div class="row text-center">

		   <a href="client.php?a=overview&id=<?php echo $clientid; ?>">

		    <img src="Client/<?php echo $bgimage; ?>" class="img-responsive panel-img" alt="">

            

			<div class="col-xs-12 user-avatar">

             <img src="Client/<?php echo $imagelocation; ?>" alt="Image" class="img-thumbnail img-responsive">

             <h4><?php echo $name1; ?></h4>

             <p>@<?php echo $username1; ?></p>

            </div><!-- /.col-xs-12 -->

		   </a>

          </div><!-- /.row -->

		  

		  <div class="list-group">

           <div class="list-group-item">&nbsp;&nbsp;&nbsp;<?php echo $lang['jobs']; ?> <?php echo $lang['posted']; ?>

            <span class="badge">

            <?php	

             $query = DB::getInstance()->get("job", "*", ["AND" => ["clientid" => $clientid, "invite" => 0]]);

             echo $query->count();

            ?>

	        </span>

		   </div><!-- /.list-group-item -->

           <div class="list-group-item">&nbsp;&nbsp;&nbsp;<?php echo $lang['jobs']; ?> <?php echo $lang['invites']; ?>

            <span class="badge">

            <?php	

             $query = DB::getInstance()->get("job", "*", ["AND" => ["clientid" => $clientid, "invite" => 1]]);

             echo $query->count();

            ?>

	        </span>

		   </div><!-- /.list-group-item -->

           <div class="list-group-item">&nbsp;&nbsp;&nbsp;<?php echo $lang['jobs']; ?> <?php echo $lang['completed']; ?>

            <span class="badge">

            <?php	

             $query = DB::getInstance()->get("job", "*", ["AND" => ["clientid" => $clientid, "completed" => 1]]);

             echo $query->count();

            ?>

	        </span>

		   </div><!-- /.list-group-item -->

           <div class="list-group-item">&nbsp;&nbsp;&nbsp;<?php echo $lang['job']; ?> <?php echo $lang['payments']; ?>

            <span class="badge">

        	<?php

		         echo $currency_symbol.'&nbsp;';

                    $query = DB::getInstance()->sum("transactions", "payment", ["AND" =>["freelancerid" => $clientid, "transaction_type" => 4]]);

					foreach($query->results()[0] as $row) {

						echo $row;

					}	?>

						</span>

		   </div><!-- /.list-group-item -->

           <div class="list-group-item">&nbsp;&nbsp;&nbsp;<?php echo $lang['ratings']; ?> 

	            (<?php	

	             $query = DB::getInstance()->get("ratings_client", "*", ["AND" => ["clientid" => $clientid]]);

	             $count = $query->count();

				 echo $re = $count/7;

	            ?>)

            <span class="badge">

		     <i class="fa fa-star"></i>

			 <i class="fa fa-star"></i>

			 <i class="fa fa-star"></i>

			 <i class="fa fa-star"></i>

			 <i class="fa fa-star"></i>

		    </span>

		   </div><!-- /.list-group-item -->

		  </div><!-- /.list-group -->

		 

		 </div><!-- /.list-group-item -->

	   <?php 

		 $ShareUrl = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

		 $Media = 'http://2.bp.blogspot.com/-nr1K0W-Zqi0/U_4lUoyvvVI/AAAAAAAABJE/F_C7i48sI58/s1600/new2.png';

		?>

			

		 <div class="list">

		  <div class="list-group">

           <span class="list-group-item active cat-top">

            <em class="fa fa-fw fa-coffee"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['share']; ?> <?php echo $lang['this']; ?> <?php echo $lang['job']; ?>

		   </span>

			<a class="list-group-item cat-list" onclick="shareinsocialmedia('https://www.facebook.com/sharer/sharer.php?u=<?php echo $ShareUrl;?>&title=<?php echo $title_job;?>')" href="">

			<em class="fa fa-fw fa-facebook"></em>&nbsp;&nbsp;&nbsp;Facebook

			</a>

			<a class="list-group-item cat-list" onclick="shareinsocialmedia('http://twitter.com/home?status=<?php echo $title_job; ?>+<?php echo $ShareUrl; ?>')" href="">

			<em class="fa fa-fw fa-twitter"></em>&nbsp;&nbsp;&nbsp;Twitter

			</a>

			<a class="list-group-item cat-list" onclick="shareinsocialmedia('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $ShareUrl; ?>&title=<?php echo $title_job; ?>')" href="">

			<em class="fa fa-fw fa-linkedin"></em>&nbsp;&nbsp;&nbsp;LinkedIn

			</a>						

          </div><!-- /.list-group -->

		 </div><!-- /.list --> 

		 

		</div><!-- /.col-lg-4 -->

		

	   </div><!-- /.row-->

	  </div><!-- /.container -->  	 

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

     <!-- Waypoints JS 

     <script src="assets/js/waypoints.min.js" type="text/javascript"></script>-->

     <!-- Kafe JS 

     <script src="assets/js/kafe.js" type="text/javascript"></script>-->

    <script type="text/javascript">
    $(document).ready(function(){
        $("#slideshow > div:gt(0)").hide();

        setInterval(function() { 
          $('#slideshow > div:first')
            .fadeOut(1000)
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('#slideshow');
        },  3000);
        
    });
    
    

	function loadProposals(id, jobid, limit) {

		$('#more_comments_'+id).html('<div class="preloader-retina preloader-center"></div>');

		$.ajax({

			type: "POST",

			url: "includes/template/requests/load_proposals.php",

			data: "id="+id+"&jobid="+jobid+"&limit="+limit, 

			cache: false,

			success: function(html) {

				// Remove the loader animation

				$('#more_comments_'+id).remove();

				

				// Append the new comment to the div id

				$('#comments-list').append(html);

			

			}

		});

	}	

	</script>  

	<script type="text/javascript" async >

	    function shareinsocialmedia(url){

	    window.open(url,'sharein','toolbar=0,status=0,width=648,height=395');

	    return true;

	    }

	</script>	 
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script> 
<script> 

$(document).ready(function()
 {
     // MAKE SURE YOUR SELECTOR MATCHES SOMETHING IN YOUR HTML!!!
     $('a').each(function() {
         $(this).qtip({
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('href') // Use href attribute as URL
                    })
                    .then(function(content) {
                        // Set the tooltip content upon successful retrieval
                        api.set('content.text', content);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to error
                        api.set('content.text', status + ': ' + error);
                    });
        
                    return 'Loading...'; // Set some initial text
                }
            },
            position: {
                viewport: $(window)
            },
            style: 'qtip-wiki'
         });
     });
 });


</script> 
<script> 

</script> 




</body>

</html>

