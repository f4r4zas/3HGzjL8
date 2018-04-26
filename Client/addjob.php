<?php 

//Check if init.php exists

if(!file_exists('../core/init.php')){

	header('Location: ../install/');        

    exit;

}else{

 require_once '../core/init.php';	

}



//Start new Client object

$client = new Client();



//Check if Client is logged in

if (!$client->isLoggedIn()) {

  Redirect::to('../index.php');	

}

$profile_query = DB::getInstance()->get("profile", "*", ["userid" => $client->data()->clientid, "LIMIT" => 1]);

		if ($profile_query->count() < 1) {
		  Redirect::to('overview.php?a=profile');	
		}

/*echo "<pre>";
print_r();
echo "</pre>";*/
//Add Category Function

if (Input::exists()) {

 if(Token::check(Input::get('token'))){

 	

	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'title' => [

		 'required' => true,

		 'minlength' => 2,

		 'maxlength' => 200

	  ],

	  /*'country' => [

	     'required' => true

	   ],*/

	  'category' => [

	     'required' => true

	   ],

	  /*'job_type' => [

	     'required' => true

	   ],*/

	  'budget' => [

	     'required' => true,

	     'float_digit' => true,

		 'minlength' => 1,

		 'maxlength' => 200

	   ],

	  'start_date' => [

	     'required' => true

	   ],

	  'end_date' => [

	     'required' => true

	   ],

	  'skills_name[]' => [

	     'required' => true,

	     'minlength' => 2

	  ],

	  'description' => [

	     'required' => true

	   ]

	]);

		 

    if (!$validation->fails()) {

    	  	 

			try{

			   $jobid = uniqueid();	

			   $skills = Input::get('skills_name');

               $choice1=implode(',',$skills);

			   $slug = seoUrl(Input::get('title'));	

			   $jobInsert = DB::getInstance()->insert('job', array(

				   'description' => Input::get('description'),

				   'jobid' => $jobid,

				   'clientid' => $client->data()->clientid,

				   'catid' => Input::get('category'),

				   'title' => Input::get('title'),

				   'slug' => $slug,

				   'country' => $profile_query->results()[0]->city.', '.$profile_query->results()[0]->postal_code.', '.$profile_query->results()[0]->country,

				   'job_type' => 'Fixed Price',//Input::get('job_type'),

				   'budget' => Input::get('budget'),
                   
                   'images' => Input::get('images'),
                   
                   'before_image' => Input::get('before_image'),
                   
                   'after_image' => Input::get('after_image'),
                   
                   'video' => Input::get('video'),

				   'start_date' => Input::get('start_date'),

				   'end_date' => Input::get('end_date'),

				   'skills' => $choice1,

				   'active' => 0,

				   'delete_remove' => 0,

				   'public' => 0,

				   'invite' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

$to = "keehee@keehee.com";
$from = 'KeeHee <support@keehee.com>';
$formname = 'KeeHee';
$subject = "New Service Ad Posted";
$message = '<p>'.Input::get("title").' is posted on KeeHee, please review and approve or reject.<p>'; 
$button = '';
$name='Guest';



// Get full html:
if(!empty($button)){
    $button_html = '<tr style="text-align:center;"><td colspan="3">'.$button.'</td></tr>';
} else {
    $button_html = '';
}

$body = '<!DOCTYPE html>
		<html>
		<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="font/font.css">
        
        <!--[if gte mso 9]>
            <style type="text/css">
            .footer_menu a {
              color: #000;font-size: 14px;text-decoration: none;  
            }
            .blue_border {
                border-bottom:8px solid #518ed2;
            }
            .btn_link {
                background: #518ed2;border-radius:3px;display:inline;color: #fff;font-size: 16px;padding: 10px 60px;text-decoration: none;
            }
            .btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}
            </style>
        <![endif]-->
        
        <!--[if gte mso 10]>
            <style type="text/css">
            .footer_menu a {
              color: #000;font-size: 14px;text-decoration: none;  
            }
            .blue_border {
                border-bottom:8px solid #518ed2;
            }
            .btn_link {
                background: #518ed2;border-radius:3px;display:inline;color: #fff;font-size: 16px;padding: 10px 60px;text-decoration: none;
            }
            .btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}
            </style>
        <![endif]-->
        
        <!--[if gte mso 11]>
            <style type="text/css">
            .footer_menu a {
              color: #000;font-size: 14px;text-decoration: none;  
            }
            .blue_border {
                border-bottom:8px solid #518ed2;
            }
            .btn_link {
                background: #518ed2;border-radius:3px;display:inline;color: #fff;font-size: 16px;padding: 10px 60px;text-decoration: none;
            }
            .btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}
            </style>
        <![endif]-->
        
        <!--[if gte mso 12]>
            <style type="text/css">
            .footer_menu a {
              color: #000;font-size: 14px;text-decoration: none;  
            }
            .blue_border {
                border-bottom:8px solid #518ed2;
            }
            .btn_link {
                background: #518ed2;border-radius:3px;display:inline;color: #fff;font-size: 16px;padding: 10px 60px;text-decoration: none;
            }
            .btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}
            </style>
        <![endif]-->
        
        <!--[if gte mso 14]>
            <style type="text/css">
            .footer_menu a {
              color: #000;font-size: 14px;text-decoration: none;  
            }
            .blue_border {
                border-bottom:8px solid #518ed2;
            }
            .btn_link {
                background: #518ed2;border-radius:3px;display:inline;color: #fff;font-size: 16px;padding: 10px 60px;text-decoration: none;
            }
            .btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}
            </style>
        <![endif]-->
        
        <!--[if gte mso 15]>
            <style type="text/css">
            .footer_menu a {
              color: #000;font-size: 14px;text-decoration: none;  
            }
            .blue_border {
                border-bottom:8px solid #518ed2;
            }
            .btn_link {
                background: #518ed2;border-radius:3px;display:inline;color: #fff;font-size: 16px;padding: 10px 60px;text-decoration: none;
            }
            .btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}
            </style>
        <![endif]-->
        <style>.btn_link > a{color:white;} .btn_link{display:block; margin:auto; width:84px}</style>
		
		<title>Email Template</title>
		
		</head>
		<body style="padding:0;margin:0;font-family:\'sans-serif\' , Verdana, Geneva">
		<table cellpadding="10" cellspacing="0" width="700" style=" margin: 0 auto;border-top: 3px solid #555555;border-collapse: collapse;overflow:hidden;">
		<tr class="table-head blue_border" style="border-bottom: 8px solid #518ed2;text-align: center;">
		<td style="width:30%;"></td><td style="width:40%;"><a href="http://keehee.com"><img style="width:300px;" src="http://keehee.com/assets/img/logo-1.png" alt="" /></a></td><td style="width:30%;"></td></tr>
		<tr><td colspan="3">'.$message.'</td></tr>
		<tr><td colspan="3">Thanks!</td></tr>
		<tr><td colspan="3">Team KeeHee</td></tr>
		'.$button_html.'
		<tr class="blue_border" style="border-bottom:8px solid #518ed2" height="" width="700"><td colspan="3"></td></tr>
		<tr class="footer_menu" align="center"><td colspan="3"><a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/terms.php">Terms of use</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/privacy.php">Privacy Policy</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/contact.php">Contact us</a></td></tr>
		<tr><td style="font-size:12px;color:#555;text-align:center;line-height:15px" colspan="3">You are receiving this email because <a href="mailto:'.$to.'">'.$to.'</a> is registered on KeeHee. If you have any questions or concerns, please visit our website and contact us.</td></tr>

		<tr style="text-align:center;background:#171717;color:#fff;font-size:12px;font-style:italic;"><td colspan="3">Copyright (c) 2018 <a style="color:#518ed2;" href="http://keehee.com">KeeHee</a> - USA</td></tr>
		</table>

		</body>
		</html>';



$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "To: keehee@keehee.com\r\n";
// More headers
$headers .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to,$subject,$body,$headers);					

			  if (count($jobInsert) > 0) {


				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

<html lang="en-US" class="no-js">

	

    <!-- Include header.php. Contains header content. -->

    <?php include ('template/header.php'); ?> 

    <!-- Bootstrap Datetimepicker CSS -->

    <link href="../assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Select CSS-->

    <link  href="../assets/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

	<!-- date picker css ------>
	
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
<script>
  UPLOADCARE_LOCALE = "en";
  UPLOADCARE_TABS = "file url facebook gdrive gphotos dropbox instagram";
  UPLOADCARE_PUBLIC_KEY = "f199d7c4921d887bc9e3";
</script>
<script charset="utf-8" src="//ucarecdn.com/libs/widget/3.2.2/uploadcare.full.min.js"></script>

<style>
.uploadcare--dialog__container {
    width: calc(60% - 60px) !important;
}
.bootstrap-select.form-control:not([class*="col-"]) {
    width: 100% !important;
}
.input-group.date.form_datetime_start {
	width: 100%;
}
.input-group.date.form_datetime_end {
	width: 100%;
}
</style>


 <body class="skin-green sidebar-mini">

     

     <!-- ==============================================

     Wrapper Section

     =============================================== -->

	 <div class="wrapper">

	 	

        <!-- Include navigation.php. Contains navigation content. -->

	 	<?php include ('template/navigation.php'); ?> 

        <!-- Include sidenav.php. Contains sidebar content. -->

	 	<?php include ('template/sidenav.php'); ?> 

	 	

	 	  <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1><?php echo $lang['service']; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active">Create a service ad<?php //echo $lang['add']; ?> <?php //echo $lang['job']; ?></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">	

		    <!-- Include currency.php. Contains header content. -->

		    <?php include ('template/currency.php'); ?>   	

		 <div class="row">	

		 	

		 <div class="col-lg-12">	

         <?php if(isset($hasError)) { //If errors are found ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>

		   </div>

	      <?php } ?>

	

		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong>Successful!</strong> <strong> Your ad has been submitted for review and upon approval it will be published. You will be notified once your ad goes live or need editing.<?php //echo $lang['saved_success']; ?></strong>

		   </div>

		  <?php } ?>

		 	

		  <?php if (isset($error)) {

			  echo $error;

		  } ?>

	        

		  

          </div>

           

		 <div class="col-lg-12">

		 

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title">Create a service ad<?php //echo $lang['add']; ?> <?php //echo $lang['job']; ?></h3>

                </div>

                <div class="box-body">

                 <form role="form" method="post" id="addform"> 

                  

                  <div class="form-group">	

				    <label>Service <?php echo $lang['title']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                    <input type="text" name="title" class="form-control" placeholder="Service <?php echo $lang['title']; ?>" value="<?php echo escape(Input::get('title')); ?>"/>

                   </div>

                  </div>



                  <div class="form-group col-md-6">	

				    <label>Service <?php echo $lang['category']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>

					<select id="selectcat" name="category" class="form-control">

					 <?php

					  $query = DB::getInstance()->get("category", "*", ["AND" => ["active" => 1, "delete_remove" => 0]]);

						if ($query->count()) {

						   $categoryname = '';

						   $x = 1;

							 foreach ($query->results() as $row) {
							     
                                 if(Input::get('category') == $row->catid){
                                    $elected = "selected";
                                 } else {
                                    $elected = "";
                                 }

							  echo $categoryname .= '<option '.$elected.' value = "' . $row->catid . '">' . $row->name . '</option>';

							  unset($categoryname); 

							  $x++;

						     }

						}

					 ?>	

					</select>

                   </div>

                  </div>
                  
                  
                  <div class="form-group col-md-6">	
                  <?php //print_r($_POST['skills_name']);?>
                  
                  <?php //print_r($_POST['skills_name[]']);?>

				    <label>Sub category<?php //echo $lang['skills']; ?> <?php //echo 'required'; ?></label>

				   <div class="input-group">

					<span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>

				   <select class="selectpicker form-control" name="skills_name[]" type="text" title="Choose one of the following..." data-live-search="true" data-width="30%" data-selected-text-format="count > 3" multiple="multiple">

					 <?php
                     
                     if(isset($_POST['category'])){
                        $catquery = DB::getInstance()->get("category", "*", ["catid" => $_POST['category']]);
                        $catresult = $catquery->results();
                        $catid = $catresult[0]->id;
                     } else {
                        $catid = 1;
                     }
                     
					$query = DB::getInstance()->get("skills", "*", ["catid" => $catid,"ORDER" => "name ASC"]);

					if ($query->count()) {

					 foreach($query->results() as $row) {

					 	$names[] = $row->name;

					 }			

					}	

					

					foreach($names as $key=>$name){
					   
                       if(in_array($name,$_POST['skills_name'])){
                        $elected = "selected";
                       } else {
                        $elected = "";
                       }

					   echo $skills .= '<option '.$elected.' value = "'.$name.'" data-tokens="'.$name.'" >'.$name.'</option>';

					  unset($skills);

					  unset($name);

					}	

							

					 ?>	

					</select>

				   </div>

				  </div>

                  

                  <!--<div class="form-group">	

				    <label><?php echo $lang['job']; ?> <?php echo $lang['type']; ?></label>

					<div class="radio">

					  <label><input type="radio" name="job_type" checked="checked" value="Fixed Price"><?php echo $lang['fixed_price']; ?></label>

					</div>								    

                  </div> -->

                  

                   
                  
                  
                      
                       
                       
                       <div class="form-group col-md-6">
                          <label><span style="font-size: 11px;">We encourage you to stay within you budget limit but be courteous, realistic and fair when you decide on your affordable budget limit.</span></label>
                          <br />	
        
        				    <label><?php echo $lang['budget']; ?> limit</label>
        
                           <div class="input-group">
        
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
        
                            <input type="text" name="budget" class="form-control" placeholder="<?php echo $lang['budget']; ?> limit" value="<?php echo escape(Input::get('budget')); ?>"/>
        
                           </div>

                    </div> 


                       
                  
                  
                     

                <div class="form-group col-md-6">
                    <label for="dtp_input1">Service needed by</label><br />
                
				  <div class="form-group col-md-6" id="form_datetime_start1">
                  
                  
                  

                   <label for="dtp_input1">Start date</label>

                    <div class="input-group date form_datetime_start" data-date-container='#form_datetime_start1' data-date-format="MM dd yyyy" data-link-field="dtp_input1">

                    <input name="start_date" class="form-control" type="text" value="<?php echo escape(Input::get('start_date')); ?>" id="datepicker1122" readonly>
<!--
                    <span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>

					<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
-->
                    </div>

				   <input type="hidden" id="dtp_input1" value="" /><br/>

		           <input name="mirror_field_start" type="hidden" id="mirror_field_start" class="form-control" readonly />

		           <input name="mirror_field_start_date" type="hidden" id="mirror_field_start_date" class="form-control" readonly />

                  </div> 

                  

				  <div class="form-group col-md-6">

                   <label for="dtp_input1"><?php echo $lang['end']; ?> <?php echo $lang['date']; ?></label>

                    <div class="input-group date form_datetime_end" data-date-format="MM dd yyyy" data-link-field="dtp_input1">

                    <input name="end_date" class="form-control" type="text" value="<?php echo escape(Input::get('end_date')); ?>" id="datepicker112233" readonly>
<!--
                    <span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>

					<span class="input-group-addon"><i class="glyphicon glyphicon-th" id="datepicker112233"></i></span>
-->
                    </div>

				   <input type="hidden" id="dtp_input1" value="" /><br/>

		           <input name="mirror_field_start" type="hidden" id="mirror_field_start" class="form-control" readonly />

		           <input name="mirror_field_start_date" type="hidden" id="mirror_field_start_date" class="form-control" readonly />

                  </div> 
                  
                  </div>

                  



				      

				  <br/>
                  
                  <div class="form-group col-md-6">
                  <label><span style="font-size: 11px;">Adding before and after photos to your ad to give visual imagery to the service provider which attract interst to your ad</span></label>
                  <br />
                    <label for="dtp_input1">Add image to your ad</label>
                    <br />
                    
                    <div class="form-group" style="overflow: hidden; text-align: center;">	
                  
                    <div class="col-md-6">

				    <label>Before and after image(s) <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="before_image" value="<?php echo escape(Input::get('before_image')); ?>"
                       data-images-only="true"
                       data-multiple="true"
                       data-multiple-max="10"
                       data-crop="4:3"
                       data-clearable="true" />
                    </div>
                    
                    <div class="col-md-6" style="display: none;">

				    <label>After image <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="after_image" value="<?php echo escape(Input::get('after_image')); ?>"
                       data-images-only="true"
                       data-multiple="true"
                       data-multiple-max="5"
                       data-crop="4:3"
                       data-clearable="true" />
                    </div>

                  </div>
                </div>      
                  
                  <div class="form-group" style="display: none;">	

				    <label>Upload image <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="images" value="<?php echo escape(Input::get('images')); ?>"
                       data-images-only="true"
                       data-multiple="false"
                       data-crop=""
                       data-clearable="true" />

                  </div>
                    
                  
                  
                  
                                      

                  
                  
                  <div class="form-group col-md-6">
                  <label><span style="font-size: 11px;">You may upload a video describing the desired service to help the service providers understand your service need better</span></label>
                  <br />
                  <label>Upload video <span style="font-size: 11px;">(optional)</span></label>
                    <input type="file" name="video" id="file1" value="<?php echo escape(Input::get('video')); ?>"><br>
                      <input type="button" value="Upload File" onclick="uploadFile()"/>
                      <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
                      <h3 id="status"></h3>
                      <p id="loaded_n_total" style="display: none;"></p>
                  </div>
                  
                  <div class="clearfix"></div>
                  
                  <div class="form-group travel_type col-md-6">	
    
    				    <label>Whos' traveling to who?</label>
    
                       <div class="input-group">
                       
                       <select name="travel_type" class="form-control">
                        <option <?php echo ($_POST['travel_type'] == 1)?'selected':'' ?> value="1">Service provider travel to customer</option>
                        <option <?php echo ($_POST['travel_type'] == 2)?'selected':'' ?> value="2">Customer travel to service provider</option>
                       </select>
                        <!--<div class="col-md-6">
                       <label><input type="radio" name="travel_type" checked/><?php echo "Service provider travel to customer"; ?></label>
                       </div>
                       
                        <div class="col-md-6">
    
                        <label><input type="radio" name="travel_type"/><?php echo "Travel to service provider"; ?></label>-->
                        
                        </div>
    
                       </div>
                  
                  <div class="form-group travel_in_miles col-md-6" <?php echo ($_POST['travel_type'] == 1 || !isset($_POST['travel_type']))?'style="display: none;"':'' ?> >	
    
    				    <label>What's the distance ratio for your service? (in miles)</label>
    
                       <div class="input-group">
    
                        <span class="input-group-addon"><i class="fa fa-car"></i></span>
                        
                        <select name="travel" class="form-control">
                        <option <?php echo ($_POST['travel'] == 5)?'selected':'' ?> value="5">5 miles</option>
                        <option <?php echo ($_POST['travel'] == 10)?'selected':'' ?> value="10">10 miles</option>
                        <option <?php echo ($_POST['travel'] == 15)?'selected':'' ?> value="15">15 miles</option>
                        <option <?php echo ($_POST['travel'] == 20)?'selected':'' ?> value="20">20 miles</option>
                        <option <?php echo ($_POST['travel'] == 25)?'selected':'' ?> value="25">25 miles or more</option>
                       </select>
    
                        <!--<input type="number" name="travel" class="form-control" min="0" placeholder="<?php echo "Travel"; ?>" value="<?php echo escape(Input::get('travel')); ?>"/>-->
                            
                       </div>
    
                </div>
                  

                  <div class="form-group col-md-12">	
                  <label><span style="font-size: 11px;">Adding a detail description for your desired service will make it easy for service provider to understand your need and might encourage them to provide your service</span></label>
                  <br />

				    <label>Service description</label>

                      <textarea name="description" maxlength="500" rows="5" class="form-control" placeholder="Enter detail description of the service you need"><?php echo escape(Input::get('description')); ?></textarea>

                  </div>

                  

                  <div class="form-group" style="display: none;">	

				    <label><?php echo $lang['make']; ?> <?php echo $lang['job']; ?> <?php echo $lang['public']; ?></label>

				    <div class="checkbox">

					  <label><input type="hidden" name="make_public" value="0"></label>

					  <label><input type="checkbox" checked="checked" name="make_public" value="1"><?php echo $lang['make_public']; ?></label>

					</div>								    

                  </div> 

                           

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="data" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

		 

		</div><!-- /.col -->

		

        

			 

	    </div><!-- /.row -->		  		  

	   </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

	 

      <!-- Include footer.php. Contains footer content. -->	

	  <?php include 'template/footer.php'; ?>	

	 	

     </div><!-- /.wrapper -->   



	

	<!-- ==============================================

	 Scripts

	 =============================================== -->

	 

    <!-- jQuery 2.1.4 -->

    <script src="../assets/js/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap 3.3.6 JS -->

    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- AdminLTE App -->

    <script src="../assets/js/app.min.js" type="text/javascript"></script>

	
 
 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
    <!-- Datetime Picker -->

    <script src="../assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <script type="text/javascript">
    
    
    
   $( function() {
   
    
    $( "#datepicker1122" ).datepicker({ dateFormat: 'MM d 20y',minDate:0 });
    
  } );
 $( function() {
    $( "#datepicker112233" ).datepicker({ dateFormat: 'MM d 20y',minDate:0 });
    
  } );

   function _(el){
    	return document.getElementById(el);
    }
    function uploadFile(){
    	var file = _("file1").files[0];
    	// alert(file.name+" | "+file.size+" | "+file.type);
    	var formdata = new FormData();
    	formdata.append("file1", file);
    	var ajax = new XMLHttpRequest();
    	ajax.upload.addEventListener("progress", progressHandler, false);
    	ajax.addEventListener("load", completeHandler, false);
    	ajax.addEventListener("error", errorHandler, false);
    	ajax.addEventListener("abort", abortHandler, false);
    	ajax.open("POST", "file_upload_parser.php");
    	ajax.send(formdata);
    }
    function progressHandler(event){
    	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
    	var percent = (event.loaded / event.total) * 100;
    	_("progressBar").value = Math.round(percent);
    	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
    }
    function completeHandler(event){
    	_("status").innerHTML = event.target.responseText;
    	_("progressBar").value = 0;
    }
    function errorHandler(event){
    	_("status").innerHTML = "Upload Failed";
    }
    function abortHandler(event){
    	_("status").innerHTML = "Upload Aborted";
    }
    
    
    $(document).ready(function($) {
    $('[role=uploadcare-uploader]').each(function(){
        var input = $(this);
            var widget = uploadcare.Widget(input);
        	widget.onUploadComplete(function(info) {
        	   
               console.log(info);
                //var xyz = $(this).val();
                //if(xyz){
                    //$(input).siblings(".uploadcare--widget_status_loaded").after('<img class="viewimg" style="width:50%" src="'+info.cdnUrl+'">');
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
    
    
    $(".travel_type select").change(function(){
        $(".travel_in_miles").toggle();
        var $listSort = $(".travel_in_miles select");
        if ($listSort.attr('required')) {
            $listSort.removeAttr('required');
        } else {
            $listSort.attr('required', "required");
        }
        
    });
    
    $("#selectcat").change(function(){
        var formData = new FormData();
        formData.append('catid',$(this).val());
        
        $.ajax({
        url: 'select_skills.php',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        // dataType: "JSON",
        beforeSend: function( xhr ) {

        },
        success: function (data) {
            $("select.selectpicker").html(data).selectpicker('refresh');
 
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(textStatus);
          console.log(errorThrown);

            //alert('Error adding / update data');
        }            
        });
    });
    
/*
     $('.form_datetime_start').datetimepicker({

        //language:  'fr',
        
        container:'#form_datetime_start1',
        
        inline: true,

        weekStart: 1,

        todayBtn:  1,

		autoclose: 1,

		todayHighlight: 1,

		startView: 2,

		forceParse: 0,

        showMeridian: 1, 

        startDate: new Date(),

        pickTime: false, 

        minView: 2,      

        pickerPosition: "bottom-left",

        linkField: "mirror_field_start",

        linkFormat: "hh:ii",

        linkFieldd: "mirror_field_start_date",

        linkFormatt: "MM dd yyyy"

    });

     $('.form_datetime_end').datetimepicker({

        //language:  'fr',
        
        inline: true,

        weekStart: 1,

        todayBtn:  1,

		autoclose: 1,

		todayHighlight: 1,

		startView: 2,

		forceParse: 0,

        showMeridian: 1, 

        startDate: new Date(),

        pickTime: false, 

        minView: 2,      

        pickerPosition: "bottom-left",

        linkField: "mirror_field_start",

        linkFormat: "hh:ii",

        linkFieldd: "mirror_field_start_date",

        linkFormatt: "MM dd yyyy"

    });
*/
   </script>

    <!-- Summernote WYSIWYG-->

    <script src="../assets/js/summernote.min.js" type="text/javascript"></script>    

    <script>

    $(document).ready(function() {
        
        setTimeout(function(){
             $('.bootstrap-select li a').click(function(){
                $('[data-toggle="dropdown"]').parent().removeClass('open');
                
              });
        },1000);

     $('#summernote').summernote({

		  height: 300,                 // set editor height

		

		  minHeight: null,             // set minimum height of editor

		  maxHeight: null,             // set maximum height of editor

		

		  focus: false,                 // set focus to editable area after initializing summernote

		});    

    });

    </script>

    <!-- Bootstrap Select JS-->

    <script src="../assets/js/bootstrap-select.js"></script>

</body>

</html>

