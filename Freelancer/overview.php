<?php

//Check if init.php exists

if(!file_exists('../core/init.php')){

	header('Location: ../install/');        

    exit;

}else{

 require_once '../core/init.php';	

}



//Start new Freelancer object

$freelancer = new Freelancer();



//Check if Freelancer is logged in

if (!$freelancer->isLoggedIn()) {

  Redirect::to('../index.php');	

}



//Get Freelancer's Data

$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);
$query_result = $query->results();
$query1 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);
$query1_result = $query1->results();

if ($query->count()) {

 foreach($query_result as $row) {

 	$nid = $row->id;

 	$location = $row->postal_code;

 	$city = $row->city;

 	$country = $row->country;

 	$rate = $row->rate;

 	$phone = $row->phone;

 	$website = $row->website;
    
    $freelancer_type = $query1_result[0]->business;
    
    $google = $row->google;
    
    $facebook = $row->facebook;
    
    $linkedin = $row->linkedin;
    
    $twitter = $row->twitter;

 	$about = $row->about;

 	$education_profile = $row->education;

 	$work_profile = $row->work;

 	$awards_profile = $row->awards;

 }			

}	



//Edit Profile Data
/* echo "<pre>";
print_r($_POST);
echo "</pre>";*/


if(isset($_POST['form_profile'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'location' => [

	     'required' => true,

	     'maxlength' => 200,

	     'minlength' => 2

	  ],

	  'city' => [

	     'required' => true,

	     'maxlength' => 200,

	     'minlength' => 2

	  ],
      
      'postal_code' => [

	     'required' => true,

	     'maxlength' => 10,

	     'minlength' => 2

	  ],

	  'country' => [

	     'required' => true,

	     'maxlength' => 200,

	     'minlength' => 2

	  ],

	  'rate' => [

	     'maxlength' => 200,

	     'minlength' => 2

	  ],

	  'website' => [

	     'maxlength' => 200,

	     'minlength' => 2

	  ]	

	]);

		 

    if (!$validation->fails()) {

		

		$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			//Update Profile

			$profileUpdate = DB::getInstance()->update('profile',[

			   'postal_code' => Input::get('location'),

			   'city' => Input::get('city'),
               
               //'postal_code' => Input::get('postal_code'),

			   'country' => Input::get('country'),

			   //'rate' => Input::get('rate'),

			   'website' => Input::get('website'),
               'facebook' => Input::get('facebook'),
               'google' => Input::get('google'),
               'linkedin' => Input::get('linkedin'),
                   
               'twitter' => Input::get('twitter'),

			],[

			    'userid' => $freelancer->data()->freelancerid

			  ]);

			

		   if (count($profileUpdate) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

							

		} else {

			

			try{

			   $profileid = uniqueid();	

			   $profileInsert = DB::getInstance()->insert('profile', array(

				   'profileid' => $profileid,

				   'userid' => $freelancer->data()->freelancerid,

				   'postal_code' => Input::get('location'),

				   'city' => Input::get('city'),

				   'country' => Input::get('country'),
                   //'postal_code' => Input::get('postal_code'),

				   //'rate' => Input::get('rate'),

				   'website' => Input::get('website'),
                   
                   'facebook' => Input::get('facebook'),
                    'google' => Input::get('google'),
                   
                   'linkedin' => Input::get('linkedin'),
                   
                   'twitter' => Input::get('twitter'),

				   'active' => 1,

				   'delete_remove' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($profileInsert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

}



//Edit About Data

if(isset($_POST['form_about'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'about_desc' => [

	     'required' => true,

	     'minlength' => 2

	  ]

	]);

		 

    if (!$validation->fails()) {

		

		$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			//Update About

			$aboutUpdate = DB::getInstance()->update('profile',[

			   'about' => Input::get('about_desc')

			],[

			    'userid' => $freelancer->data()->freelancerid

			  ]);

			

		   if (count($aboutUpdate) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

							

		} else {
			

			try{

			   $profileid = uniqueid();	

			   $profileInsert = DB::getInstance()->insert('profile', array(

				   'profileid' => $profileid,

				   'userid' => $freelancer->data()->freelancerid,

				   'about' => Input::get('about_desc'),

				   'active' => 1,

				   'delete_remove' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($profileInsert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

}



//Edit Education Data

if(isset($_POST['form_education'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'education_desc' => [

	     'required' => true,

	     'minlength' => 2

	  ]

	]);

		 

    if (!$validation->fails()) {

		

		$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			//Update Education

			$educationUpdate = DB::getInstance()->update('profile',[

			   'education' => Input::get('education_desc')

			],[

			    'userid' => $freelancer->data()->freelancerid

			  ]);

			

		   if (count($educationUpdate) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

							

		} else {

			

			try{

			   $profileid = uniqueid();	

			   $profileInsert = DB::getInstance()->insert('profile', array(

				   'profileid' => $profileid,

				   'userid' => $freelancer->data()->freelancerid,

				   'education' => Input::get('education_desc'),

				   'active' => 1,

				   'delete_remove' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($profileInsert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

}



//Edit Work Data

if(isset($_POST['form_work'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'work_desc' => [

	     'required' => true,

	     'minlength' => 2

	  ]

	]);

		 

    if (!$validation->fails()) {

		

		$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			//Update Work

			$workUpdate = DB::getInstance()->update('profile',[

			   'work' => Input::get('work_desc')

			],[

			    'userid' => $freelancer->data()->freelancerid

			  ]);

			

		   if (count($workUpdate) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

							

		} else {

			

			try{

			   $profileid = uniqueid();	

			   $profileInsert = DB::getInstance()->insert('profile', array(

				   'profileid' => $profileid,

				   'userid' => $freelancer->data()->freelancerid,

				   'work' => Input::get('work_desc'),

				   'active' => 1,

				   'delete_remove' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($profileInsert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

}



//Edit Awards Data

if(isset($_POST['form_awards'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'awards_desc' => [

	     'required' => true,

	     'minlength' => 2

	  ]

	]);

		 

    if (!$validation->fails()) {

		

		$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			//Update Awards

			$awardsUpdate = DB::getInstance()->update('profile',[

			   'awards' => Input::get('awards_desc')

			],[

			    'userid' => $freelancer->data()->freelancerid

			  ]);

			

		   if (count($awardsUpdate) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

							

		} else {

			

			try{

			   $profileid = uniqueid();	

			   $profileInsert = DB::getInstance()->insert('profile', array(

				   'profileid' => $profileid,

				   'userid' => $freelancer->data()->freelancerid,

				   'awards' => Input::get('awards_desc'),

				   'active' => 1,

				   'delete_remove' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($profileInsert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

}



//Edit Skills

if(isset($_POST['form_skills'])){

if (Input::exists()) {

 if(Token::check(Input::get('token'))){



	$errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'skills_name[]' => [

	     'required' => true,

	     'minlength' => 2

	  ]

	]);

		 

    if (!$validation->fails()) {

		

		$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			//Update Skills

			$skills = Input::get('skills_name');

            $choice1=implode(',',$skills);

			$skillsUpdate = DB::getInstance()->update('profile',[

			   'skills' => $choice1

			],[

			    'userid' => $freelancer->data()->freelancerid

			  ]);

			

		   if (count($skillsUpdate) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

							

		} else {

			

			try{

			   $profileid = uniqueid();	

			$skills = Input::get('skills_name');

            $choice1=implode(',',$skills);

			   $profileInsert = DB::getInstance()->insert('profile', array(

				   'profileid' => $profileid,

				   'userid' => $freelancer->data()->freelancerid,

				   'skills' => $choice1,

				   'active' => 1,

				   'delete_remove' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($profileInsert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			  

			}catch(Exception $e){

			 die($e->getMessage());	

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

}



?>

<!DOCTYPE html>

<html lang="en-US" class="no-js">

	

    <!-- Include header.php. Contains header content. -->

    <?php include ('template/header.php'); ?> 

    <!-- Bootstrap Select CSS-->

    <link  href="../assets/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

<style>
.box {
    background: transparent;
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

          <h1><?php echo 'Profile'; ?><small><?php echo $lang['section']; ?></small></h1>

          <ol class="breadcrumb">

            <li><a href="index.php"><i class="fa fa-dashboard"></i> <?php echo $lang['home']; ?></a></li>

            <li class="active"><?php echo 'Profile'; ?></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">	 	

		    <!-- Include currency.php. Contains header content. -->

		    <?php include ('template/currency.php'); ?>  

		 <div class="row">	

		 	

		 <div class="col-lg-12">

		  <?php if (isset($error)) {

			  echo $error;

		  } ?>

	

		  <?php if(isset($updatedError) && $updatedError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['updated_success']; ?></strong>

		   </div>

		  <?php } ?>



	      <?php if(isset($hasError)) { //If errors are found ?>

	       <div class="alert alert-danger fade in">

	        <a href="#" class="close" data-dismiss="alert">&times;</a>

	        <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['has_Error']; ?>

		   </div>

	      <?php } ?>

	

		  <?php if(isset($noError) && $noError == true) { //If email is sent ?>

		   <div class="alert alert-success fade in">

		   <a href="#" class="close" data-dismiss="alert">&times;</a>

		   <strong><?php echo $lang['noError']; ?></strong> <?php echo $lang['saved_success']; ?></strong>.

		   </div>

		  <?php } ?>		 	

		  

          </div>	

           

          <div class="col-lg-4">

          	<?php $profile = (Input::get('a') == 'profile') ? ' active' : ''; ?>

          	<?php $selected = (Input::get('a') == 'about') ? ' active' : ''; ?>

          	<?php $education = (Input::get('a') == 'education') ? ' active' : ''; ?>

          	<?php $work = (Input::get('a') == 'work') ? ' active' : ''; ?>

          	<?php $awards = (Input::get('a') == 'awards') ? ' active' : ''; ?>

          	<?php $skills = (Input::get('a') == 'skills') ? ' active' : ''; ?>

	         <div class="list-group">

	         <a href="overview.php?a=profile" class="list-group-item<?php echo $profile; ?>">

	          <em class="fa fa-fw fa-info text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['profile']; ?>

			 </a>

	         <a href="overview.php?a=about" class="list-group-item<?php echo $selected; ?>">

	          <em class="fa fa-fw fa-user-md text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['about']; ?>

			 </a>
             
             <?php if($freelancer_type == 0):?>

	         <a href="overview.php?a=education" class="list-group-item<?php echo $education; ?>">

	          <em class="fa fa-fw fa-text-width text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['education']; ?>

			 </a>

	         <a href="overview.php?a=work" class="list-group-item<?php echo $work; ?>">

	          <em class="fa fa-fw  fa-tasks text-white"></em>&nbsp;&nbsp;&nbsp;Experience

			 </a>

	         <a href="overview.php?a=awards" class="list-group-item<?php echo $awards; ?>">

	          <em class="fa fa-fw fa-trophy text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo $lang['awards']; ?>

			 </a>
             
             <?php endif;?>

	         <a href="overview.php?a=skills" class="list-group-item<?php echo $skills; ?>">

	          <em class="fa fa-fw fa-cogs text-white"></em>&nbsp;&nbsp;&nbsp;<?php echo 'Service Categories'; ?>

			 </a>

			 

	         </div>

          </div>

          

		 <div class="col-lg-8">

		 <?php if (Input::get('a') == 'profile') : ?>

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['edit']; ?> <?php echo $lang['profile']; ?></h3>

                </div>

                <div class="box-body">
                
                <div class="show_data">
                
                <div class="box-footer" style="float: right; margin-top: -49px;">

                    <button type="button" class="btn btn-primary edit_button">Edit</button>

                  </div>
                  <div class="clearfix"></div>
                    
                    

                  <div class="form-group" style="float: left;">	

				    <label><?php echo $lang['city']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-info"></i></span>

                    <?php
						  echo escape($city); 

					  ?>

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	

				    <label>Zipcode</label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-info"></i></span>

                    <?php
 
						  echo escape($location); 

					  ?>

                   </div>

                  </div>

                  <div class="form-group">	

				    <label>State</label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-flag"></i></span>

                    <?php
						  echo escape($country); 

					  ?>

                   </div>

                  </div>


                  <div class="form-group" style="display: none;">	

				    <label><?php echo $lang['website']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-globe"></i></span>

                    <?php

						  echo escape($website); 

					  ?>

                   </div>

                  </div>
                  
                  <div class="form-group">	

				    <label>Other links of where customers can find you for refferences</label>


                  </div>
                  
                  
                  <div class="form-group">	

				    <label><?php echo 'Facebook'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-facebook"></i></span>

                    <?php
						  echo escape($facebook); 


					  ?>

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	

				    <label><?php echo 'Google+'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-google-plus"></i></span>

                    <?php
						  echo escape($google); 

					  ?>

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	

				    <label><?php echo 'Linkedin'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-linkedin"></i></span>

                    <?php
						  echo escape($linkedin); 

					  ?>

                   </div>

                  </div>
                  
                  <div class="form-group">	

				    <label><?php echo 'Twitter'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon" style="float: left;"><i class="fa fa-twitter"></i></span>

                    <?php 

						  echo escape($twitter); 

					  ?>

                   </div>

                  </div>
                  
                  
                  
                  
                  
                  
                  
                  

                                   

                  
                
                </div>

                 <form role="form" method="post" id="addstudentform" class="show_form" style="display: none;"> 

                  <div class="form-group">	

				    <label>Zipcode</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                    <input type="text" name="location" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('location')); 

						  } else {

						  echo escape($location); 

						  }

					  ?>"/>

                   </div>

                  </div>

                  <div class="form-group">	

				    <label><?php echo $lang['city']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                    <input type="text" name="city" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('city')); 

						  } else {

						  echo escape($city); 

						  }

					  ?>"/>

                   </div>

                  </div>

                  <div class="form-group" style="display: none;">	

				    <label>State</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-flag"></i></span>

                    <input type="text" name="country" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('country')); 

						  } else {

						  echo escape($country); 

						  }

					  ?>">

                   </div>

                  </div>

                  <div class="form-group" style="display: none;">	

				    <label><?php echo $lang['rate']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-money"></i></span>

                    <input type="text" name="rate" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('rate')); 

						  } else {

						  echo escape($rate); 

						  }

					  ?>">

                   </div>

                  </div>

                  <div class="form-group" style="display: none;">	

				    <label><?php echo $lang['website']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" name="website" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('website')); 

						  } else {

						  echo escape($website); 

						  }

					  ?>">

                   </div>

                  </div>
                  
                  <div class="form-group">	

				    <label><?php echo 'Facebook'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-facebook"></i></span>

                    <input type="text" name="facebook" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('facebook')); 

						  } else {

						  echo escape($facebook); 

						  }

					  ?>">

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	

				    <label><?php echo 'Google+'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>

                    <input type="text" name="google" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('google')); 

						  } else {

						  echo escape($google); 

						  }

					  ?>">

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	

				    <label><?php echo 'Linkedin'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>

                    <input type="text" name="linkedin" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('linkedin')); 

						  } else {

						  echo escape($linkedin); 

						  }

					  ?>">

                   </div>

                  </div>
                  
                  <div class="form-group">	

				    <label><?php echo 'Twitter'; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-twitter"></i></span>

                    <input type="text" name="twitter" class="form-control" value="<?php

                         if (isset($_POST['form_profile'])) {

							 echo escape(Input::get('twitter')); 

						  } else {

						  echo escape($twitter); 

						  }

					  ?>">

                   </div>

                  </div>
                  
                  
                  
                  <div class="form-group">	

                   <div class="input-group">

                        <a href="#" class="clickto">Add more links</a>

                   </div>

                  </div>
                  
                  <div class="form-group to_append">	


                  </div>
                  
                  
                  
                  <div class="form-group to_clone" style="display: none;">	

                   <div class="input-group" style="width: 100%;">

                    <input type="text" name="other_link[]" class="form-control" value="">

                   </div>

                  </div>

                                   

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="form_profile" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

              		 	

		 <?php elseif (Input::get('a') == 'about') : ?>

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['edit']; ?> <?php echo $lang['about']; ?> <?php echo $lang['details']; ?></h3>

                </div>

                <div class="box-body">
                
                <div class="show_data">
                <div class="box-footer" style="float: right; margin-top: -49px;">

                    <button type="button" class="btn btn-primary edit_button">Edit</button>

                  </div>
                
                    <div class="form-group">	

				    <label><?php echo $lang['about']; ?> <?php echo $lang['description']; ?></label>
                    
                    <label style="font-weight: normal;">To gain customer's trust and confidence about you we highly recommend that you give some description about you and services you provide<br />e.g:"Mission statement"</label>

                      	<?php
						  echo escape($about); 
					  ?>

                  </div>

                                   

                  
                    
                </div>

                 <form role="form" method="post" id="editform" class="show_form" style="display: none;">              

                  

                  <div class="form-group">	

				    <label><?php echo $lang['about']; ?> <?php echo $lang['description']; ?></label>

                      <textarea type="text" maxlength="500" name="about_desc" class="form-control">

                      	<?php

                         if (isset($_POST['form_about'])) {

							 echo escape(Input::get('about_desc')); 

						  } else {

						  echo escape($about); 

						  }

					  ?></textarea>

                  </div>

                                   

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="form_about" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

		 <?php elseif (Input::get('a') == 'education') : ?>

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['edit']; ?> <?php echo $lang['education']; ?> <?php echo $lang['details']; ?></h3>

                </div>

                <div class="box-body">
                
                <div class="show_data">
                <div class="box-footer" style="float: right;">

                    <button type="button" class="btn btn-primary edit_button">Edit</button>

                  </div>
                
                    <div class="form-group">	

				    <label><?php echo $lang['education']; ?> <?php echo $lang['description']; ?></label>
                    
                    <label style="font-weight: normal;">Please provide your education background, it enhance ability of getting hired by customers</label>

                      	<?php
						  echo escape($education_profile);
					  ?>

                  </div>

                                   

                  
                    
                </div>

                 <form role="form" method="post" id="editform" class="show_form" style="display: none;">              

                  

                  <div class="form-group">	

				    <label><?php echo $lang['education']; ?> <?php echo $lang['description']; ?></label>

                      <textarea type="text" maxlength="500" name="education_desc" class="form-control">

                      	<?php

                         if (isset($_POST['form_education'])) {

							 echo escape(Input::get('education_desc')); 

						  } else {

						  echo escape($education_profile); 

						  }

					  ?></textarea>

                  </div>

                                   

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="form_education" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->
		

		 <?php elseif (Input::get('a') == 'work') : ?>	 

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['edit']; ?> Experience <?php echo $lang['details']; ?></h3>

                </div>

                <div class="box-body">
                
                <div class="show_data">
                <div class="box-footer" style="float: right;">

                    <button type="button" class="btn btn-primary edit_button">Edit</button>

                  </div>
                
                    <div class="form-group">	

				    <label>Experience <?php echo $lang['description']; ?></label>

                      	<?php
						  echo escape($work_profile); 
					  ?>

                  </div>

                                   

                  
                    
                </div>

                 <form role="form" method="post" id="editform" class="show_form" style="display: none;">              

                  

                  <div class="form-group">	

				    <label>Experience <?php echo $lang['description']; ?></label>

                      <textarea type="text" maxlength="500" name="work_desc" class="form-control">

                      	<?php

                         if (isset($_POST['form_work'])) {

							 echo escape(Input::get('work_desc')); 

						  } else {

						  echo escape($work_profile); 

						  }

					  ?></textarea>

                  </div>

                                   

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="form_work" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->

              

 		 <?php elseif (Input::get('a') == 'awards') : ?>

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['edit']; ?> <?php echo $lang['awards']; ?> <?php echo $lang['details']; ?></h3>

                </div>

                <div class="box-body">
                
                <div class="show_data">
                <div class="box-footer" style="float: right;">

                    <button type="button" class="btn btn-primary edit_button">Edit</button>

                  </div>
                
                    <div class="form-group">	

				    <label><?php echo $lang['awards']; ?> <?php echo $lang['and']; ?> <?php echo $lang['achievements']; ?></label>

                      	<?php
						  echo escape($awards_profile); 
					  ?>

                  </div>

                                   

                  
                    
                </div>

                 <form role="form" method="post" id="editform" class="show_form" style="display: none;">              

                  

                  <div class="form-group">	

				    <label><?php echo $lang['awards']; ?> <?php echo $lang['and']; ?> <?php echo $lang['achievements']; ?></label>

                      <textarea type="text" maxlength="500" name="awards_desc" class="form-control">

                      	<?php

                         if (isset($_POST['form_awards'])) {

							 echo escape(Input::get('awards_desc')); 

						  } else {

						  echo escape($awards_profile); 

						  }

					  ?></textarea>

                  </div>

                                   

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="form_awards" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form> 

                </div><!-- /.box-body -->

              </div><!-- /.box -->     

              

 		 <?php elseif (Input::get('a') == 'skills') : ?>

 		 	

 		 	

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['edit']; ?> Service Categories <?php echo $lang['details']; ?></h3>

                </div>

                <div class="box-body">
                
                <div class="show_data">
                <div class="box-footer" style="float: right;">

                    <button type="button" class="btn btn-primary edit_button">Edit</button>

                  </div>
                
                    <div class="form-group">	

				    <label>Skillset</label>

                      	<?php

					 

					$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

					if ($query->count()) {

					 foreach($query->results() as $row) {

					 	echo $row->skills;

					    

					 }			

					}?>

                  </div>

                                   

                  
                    
                </div>

                 <form role="form" method="post" id="editform" class="show_form" style="display: none;">  

                 	

				  <div class="form-group">	

				   <div class="input-group">

					<span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>

				   <select class="selectpicker form-control" name="skills_name[]" type="text" title="Choose one of the following..." data-live-search="true" data-width="30%" data-selected-text-format="count > 3" multiple="multiple">

					 <?php

					 

					$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

					if ($query->count()) {

					 foreach($query->results() as $row) {

					 	$skills = $row->skills;

					    $arr=explode(',',$skills);

					 }			

					}

					

					$query = DB::getInstance()->get("skills", "*", ["ORDER" => "name ASC"]);

					if ($query->count()) {

					 foreach($query->results() as $row) {

					 	$names[] = $row->name;

					 }			

					}	

					

					foreach($names as $key=>$name){

						if(in_array($name,$arr)){

					   echo $skills .= '<option value = "'.$name.'" data-tokens="'.$name.'" selected="selected">'.$name.'</option>';

					  unset($skills);

						}else{

					   echo $skills .= '<option value = "'.$name.'" data-tokens="'.$name.'" >'.$name.'</option>';

					  unset($skills);

					  }

					  unset($name);

					}	

							

					 ?>	

					</select>

				   </div>

				  </div>				                 	            

                                   

                  <div class="box-footer">

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

                    <button type="submit" name="form_skills" class="btn btn-primary full-width"><?php echo $lang['submit']; ?></button>

                  </div>

                 </form>                  

                </div><!-- /.box-body -->

              </div><!-- /.box -->    

                             

              

		 <!-- Input addon -->

              <div class="box box-info">

                <div class="box-header">

                  <h3 class="box-title"><?php echo $lang['your']; ?> <?php echo $lang['skills']; ?></h3>

                </div>

                <div class="box-body">

                 

                 <?php

					$query = DB::getInstance()->get("profile", "*", ["userid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

					if ($query->count()) {

					 foreach($query->results() as $row) {

					 	$skills = $row->skills;

					    $arr=explode(',',$skills);

					 }			

					}



                 foreach ($arr as $key => $value) {

                     echo '<label class="label label-success">'. $value .'</label> &nbsp;'; 

                 }

				?>	                 

                </div><!-- /.box-body -->

              </div><!-- /.box -->                                   

			 
		 <?php endif; ?>

		 

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

    <!-- Summernote WYSIWYG-->

    <script src="../assets/js/summernote.min.js" type="text/javascript"></script>    

    <script>

    $(document).ready(function() {
        
        $(".edit_button").click(function(){
            $(".show_data").toggle();
            $(".show_form").toggle();
        });
        
        $(".clickto").click(function(e){
            e.preventDefault();
            
            if($(".to_append").find(".to_clone").length >= 5){
            alert("You can add maximum 5 links");    
            }else{
           var clone = $(".to_clone").clone();
           clone.removeAttr("style");
           $(".to_append").append(clone);
           } 
        });
        

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

