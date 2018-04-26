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
$profile_query_results = $profile_query->results();
//Getting Job Data

$jobid = Input::get('id');

$query = DB::getInstance()->get("job", "*", ["jobid" => $jobid, "LIMIT" => 1]);

if ($query->count() === 1) {

 foreach($query->results() as $row) {

  $jobid = $row->jobid;

  $catid = $row->catid;

  $job_title = $row->title;

  $country = $row->country;
  
  $images = $row->images;
                   
  $before_image = $row->before_image;
                   
  $after_image = $row->after_image;
                   
  $video = $row->video;

  $job_type = $row->job_type;

  $job_budget = $row->budget;

  $job_description = $row->description;

  $job_start_date = $row->start_date;

  $job_end_date = $row->end_date;

  $public = $row->public;

  $skills = $row->skills;

  $arr=explode(',',$skills);

 }

} else {

  Redirect::to('joblist.php');

}	



//Edit Category Data

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



	  'category' => [

	     'required' => true

	   ],



	  'budget' => [

	     'required' => true,

	     'digit' => true,

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

		

		//Update Job

		$skills = Input::get('skills_name');

        $choice1=implode(',',$skills);

		$slug = seoUrl(Input::get('title'));	

		$jobUpdate = DB::getInstance()->update('job',[

		   'description' => Input::get('description'),

		   'catid' => Input::get('category'),

		   'title' => Input::get('title'),

		   'slug' => $slug,

		   'country' => $profile_query_results[0]->city.', '.$profile_query_results[0]->postal_code.', '.$profile_query_results[0]->country,

		   'job_type' => 'Fixed Price',

		   'budget' => Input::get('budget'),

		   'start_date' => Input::get('start_date'),

		   'end_date' => Input::get('end_date'),

		   'skills' => $choice1,

		   'public' => Input::get('make_public')

		],[

		    'jobid' => $jobid

		  ]);

		

	   if (count($jobUpdate) > 0) {

			$updatedError = true;

		} else {

			$hasError = true;

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

    <!-- Theme style -->

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

          <h1><?php echo $lang['job']; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active"><?php echo $lang['edit']; ?> <?php echo $lang['job']; ?></li>

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

	

		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['updated_success']; ?></strong>

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

                  <h3 class="box-title"><?php echo $lang['edit']; ?> <?php echo $lang['job']; ?> <?php echo $lang['details']; ?></h3>

                </div>

                <div class="box-body">

                 <form role="form" method="post" id="editform"> 

                  

                  <div class="form-group">	

				    <label><?php echo $lang['title']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                    <input type="text" name="title" class="form-control" value="<?php

                         if (isset($_POST['details'])) {

							 echo escape(Input::get('title')); 

						  } else {

						  echo escape($job_title); 

						  }

					  ?>"/>

                   </div>

                  </div>



                  

                                    

                  <div class="form-group">	

				    <label><?php echo $lang['category']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>

					<select name="category" type="text" class="form-control">

					 <?php

					  $query = DB::getInstance()->get("category", "*", ["AND" => ["active" => 1, "delete_remove" => 0]]);

						if ($query->count()) {

						   $categoryname = '';

						   $x = 1;

							 foreach ($query->results() as $row) {



	                         if (isset($_POST['details'])) {

	                         	$selected = (Input::get('category') === $catid) ? ' selected="selected"' : '';

							  } else {

							  	$selected = ($row->catid === $catid) ? ' selected="selected"' : '';

							  }

							  

							  echo $categoryname .= '<option value = "' . $row->catid . '" '.$selected.'>' . $row->name . '</option>';

							  unset($categoryname); 

							  $x++;

						     }

						}

					 ?>	

					</select>

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	
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
					   
                       if(in_array($name,$arr)){
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
                  
                  

                  

                  

                  <div class="form-group">	
                  <label><span style="font-size: 11px;">We encourage you to stay within you budget limit but be courteous, realistic and fair when you decide on your affordable budget limit.</span></label>
                  <br />

				    <label><?php echo $lang['budget']; ?> limit</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                    <input type="text" name="budget" class="form-control" value="<?php

                         if (isset($_POST['details'])) {

							 echo escape(Input::get('budget')); 

						  } else {

						  echo escape($job_budget); 

						  }

					  ?>"/>

                   </div>

                  </div>
                  
                  
                  <div class="form-group travel_type">	

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
                   
                   
                   <div class="form-group travel_in_miles" <?php echo ($_POST['travel_type'] == 1 || !isset($_POST['travel_type']))?'style="display: none;"':'' ?> >	

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


                    <div class="form-group">
                        <label for="dtp_input1">Service needed by</label>
                    </div>
				  <div class="form-group">

                   <label for="dtp_input1"><?php echo $lang['start']; ?> <?php echo $lang['date']; ?></label>

                    <div class="input-group date form_datetime_start" data-date-format="dd MM yyyy" data-link-field="dtp_input1">

                    <input name="start_date" class="form-control" id="datepicker1122" type="text" value="<?php

                         if (isset($_POST['details'])) {

							 echo escape(Input::get('start_date')); 

						  } else {

						  echo escape($job_start_date); 

						  }

					  ?>" readonly>

                    <span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>

					<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

                    </div>

				   <input type="hidden" id="dtp_input1" value="" /><br/>

		           <input name="mirror_field_start" type="hidden" id="mirror_field_start" class="form-control" readonly />

		           <input name="mirror_field_start_date" type="hidden" id="mirror_field_start_date" class="form-control" readonly />

                  </div>       

                  

				  <div class="form-group">

                   <label for="dtp_input1"><?php echo $lang['estimated']; ?> <?php echo $lang['end']; ?> <?php echo $lang['date']; ?></label>

                    <div class="input-group date form_datetime_start" data-date-format="dd MM yyyy" data-link-field="dtp_input1">

                    <input name="end_date" id="datepicker112233" class="form-control" type="text" value="<?php

                         if (isset($_POST['details'])) {

							 echo escape(Input::get('end_date')); 

						  } else {

						  echo escape($job_end_date); 

						  }

					  ?>" readonly>

                    <span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>

					<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

                    </div>

				   <input type="hidden" id="dtp_input1" value="" /><br/>

		           <input name="mirror_field_start" type="hidden" id="mirror_field_start" class="form-control" readonly />

		           <input name="mirror_field_start_date" type="hidden" id="mirror_field_start_date" class="form-control" readonly />

                  </div> 

                  

                  
                    <br/>
                  
                  <div class="form-group">
                  <label><span style="font-size: 11px;">Adding before and after photos to your ad to give visual imagery to the service provider which attract interst to your ad</span></label>
                  <br />
                    <label for="dtp_input1">Add image to your ad</label>
                </div>      
                  
                  <div class="form-group" style="display: none;">	

				    <label>Upload image <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="images" value="<?php echo escape(Input::get('images')); ?>"
                       data-images-only="true"
                       data-multiple="false"
                       data-crop=""
                       data-clearable="true" />

                  </div>
                  
                  <br/>  
                  
                  
                  <div class="form-group" style="overflow: hidden; text-align: center;">	
                  
                    <div class="col-md-6">

				    <label>Before and after image(s) <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="before_image" value="<?php echo $before_image; ?>"
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
                                      

                  
                  
                  <div class="form-group">
                  <label><span style="font-size: 11px;">You may upload a video describing the desired service to help the service providers understand your service need better</span></label>
                  <br />
                  <label>Upload video <span style="font-size: 11px;">(optional)</span></label>
                    <input type="file" name="video" id="file1" value="<?php echo escape(Input::get('video')); ?>"><br>
                      <input type="button" value="Upload File" onclick="uploadFile()"/>
                      <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
                      <h3 id="status"></h3>
                      <p id="loaded_n_total" style="display: none;"></p>
                  </div>
				                        

                  

                  <div class="form-group">	

				    <label><span style="font-size: 11px;">Adding a detail description for your desired service will make it easy for service provider to understand your need and might encourage them to provide your service</span></label>
                  <br />

				    <label>Service description</label>

                      <textarea type="text" maxlength="500" name="description" class="form-control"><?php

                         if (isset($_POST['details'])) {

							 echo escape(Input::get('description')); 

						  } else {

						  echo escape($job_description); 

						  }

					  ?></textarea>

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

                    <button type="submit" name="details" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

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

    <!-- Datetime Picker -->

    <script src="../assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <script type="text/javascript">

     $('.form_datetime_start').datetimepicker({

        //language:  'fr',

        showToday: false,                 

        useCurrent: false,

        weekStart: 1,

        todayBtn:  1,

		autoclose: 1,

		todayHighlight: 1,

		startView: 2,

		forceParse: 0,

        showMeridian: 1, 

        pickTime: false, 

        minView: 2,      

        pickerPosition: "bottom-left",

        linkField: "mirror_field_start",

        linkFormat: "hh:ii",

        linkFieldd: "mirror_field_start_date",

        linkFormatt: "dd MM yyyy"

    });

     $('.form_datetime_end').datetimepicker({

        //language:  'fr',

        weekStart: 1,

        todayBtn:  1,

		autoclose: 1,

		todayHighlight: 1,

		startView: 2,

		forceParse: 0,

        showMeridian: 1, 

        pickTime: false, 

        minView: 2,      

        pickerPosition: "bottom-left",

        linkField: "mirror_field_start",

        linkFormat: "hh:ii",

        linkFieldd: "mirror_field_start_date",

        linkFormatt: "dd MM yyyy"

    });

   </script>

    <!-- Summernote WYSIWYG-->

    <script src="../assets/js/summernote.min.js" type="text/javascript"></script>    

    <script>

    $(document).ready(function() {

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

