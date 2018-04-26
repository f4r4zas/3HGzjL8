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

				   'active' => 1,

				   'delete_remove' => 0,

				   'public' => Input::get('make_public'),

				   'invite' => 0,

				   'date_added' => date('Y-m-d H:i:s')

			    ));	

					

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

 

    <!-- Bootstrap Select CSS-->

    <link  href="../assets/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

<script>
  UPLOADCARE_LOCALE = "en";
  UPLOADCARE_TABS = "file url facebook gdrive gphotos dropbox instagram";
  UPLOADCARE_PUBLIC_KEY = "f199d7c4921d887bc9e3";
</script>

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

		   <strong><?php echo $lang['noError']; ?></strong> <strong> Your ad has been successfully submitted on review to be publish, once your is published or need to be edited you will be notified.<?php //echo $lang['saved_success']; ?></strong>

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

                    <input type="text" name="title" class="form-control" placeholder="<?php echo $lang['title']; ?>" value="<?php echo escape(Input::get('title')); ?>"/>

                   </div>

                  </div>

                  

                  <!--<div class="form-group">	

				    <label><?php echo $lang['country']; ?></label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

					<select name="country" class="form-control">

					    <option value="Remote">Remote</option>

					    <option value="Afghanistan">Afghanistan</option>

					    <option value="Albania">Albania</option>

					    <option value="Algeria">Algeria</option>

					    <option value="American Samoa">American Samoa</option>

					    <option value="Andorra">Andorra</option>

					    <option value="Angola">Angola</option>

					    <option value="Anguilla">Anguilla</option>

					    <option value="Antartica">Antarctica</option>

					    <option value="Antigua and Barbuda">Antigua and Barbuda</option>

					    <option value="Argentina">Argentina</option>

					    <option value="Armenia">Armenia</option>

					    <option value="Aruba">Aruba</option>

					    <option value="Australia">Australia</option>

					    <option value="Austria">Austria</option>

					    <option value="Azerbaijan">Azerbaijan</option>

					    <option value="Bahamas">Bahamas</option>

					    <option value="Bahrain">Bahrain</option>

					    <option value="Bangladesh">Bangladesh</option>

					    <option value="Barbados">Barbados</option>

					    <option value="Belarus">Belarus</option>

					    <option value="Belgium">Belgium</option>

					    <option value="Belize">Belize</option>

					    <option value="Benin">Benin</option>

					    <option value="Bermuda">Bermuda</option>

					    <option value="Bhutan">Bhutan</option>

					    <option value="Bolivia">Bolivia</option>

					    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>

					    <option value="Botswana">Botswana</option>

					    <option value="Bouvet Island">Bouvet Island</option>

					    <option value="Brazil">Brazil</option>

					    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>

					    <option value="Brunei Darussalam">Brunei Darussalam</option>

					    <option value="Bulgaria">Bulgaria</option>

					    <option value="Burkina Faso">Burkina Faso</option>

					    <option value="Burundi">Burundi</option>

					    <option value="Cambodia">Cambodia</option>

					    <option value="Cameroon">Cameroon</option>

					    <option value="Canada">Canada</option>

					    <option value="Cape Verde">Cape Verde</option>

					    <option value="Cayman Islands">Cayman Islands</option>

					    <option value="Central African Republic">Central African Republic</option>

					    <option value="Chad">Chad</option>

					    <option value="Chile">Chile</option>

					    <option value="China">China</option>

					    <option value="Christmas Island">Christmas Island</option>

					    <option value="Cocos Islands">Cocos (Keeling) Islands</option>

					    <option value="Colombia">Colombia</option>

					    <option value="Comoros">Comoros</option>

					    <option value="Congo">Congo</option>

					    <option value="Congo">Congo, the Democratic Republic of the</option>

					    <option value="Cook Islands">Cook Islands</option>

					    <option value="Costa Rica">Costa Rica</option>

					    <option value="Cota D'Ivoire">Cote d'Ivoire</option>

					    <option value="Croatia">Croatia (Hrvatska)</option>

					    <option value="Cuba">Cuba</option>

					    <option value="Cyprus">Cyprus</option>

					    <option value="Czech Republic">Czech Republic</option>

					    <option value="Denmark">Denmark</option>

					    <option value="Djibouti">Djibouti</option>

					    <option value="Dominica">Dominica</option>

					    <option value="Dominican Republic">Dominican Republic</option>

					    <option value="East Timor">East Timor</option>

					    <option value="Ecuador">Ecuador</option>

					    <option value="Egypt">Egypt</option>

					    <option value="El Salvador">El Salvador</option>

					    <option value="Equatorial Guinea">Equatorial Guinea</option>

					    <option value="Eritrea">Eritrea</option>

					    <option value="Estonia">Estonia</option>

					    <option value="Ethiopia">Ethiopia</option>

					    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>

					    <option value="Faroe Islands">Faroe Islands</option>

					    <option value="Fiji">Fiji</option>

					    <option value="Finland">Finland</option>

					    <option value="France">France</option>

					    <option value="France Metropolitan">France, Metropolitan</option>

					    <option value="French Guiana">French Guiana</option>

					    <option value="French Polynesia">French Polynesia</option>

					    <option value="French Southern Territories">French Southern Territories</option>

					    <option value="Gabon">Gabon</option>

					    <option value="Gambia">Gambia</option>

					    <option value="Georgia">Georgia</option>

					    <option value="Germany">Germany</option>

					    <option value="Ghana">Ghana</option>

					    <option value="Gibraltar">Gibraltar</option>

					    <option value="Greece">Greece</option>

					    <option value="Greenland">Greenland</option>

					    <option value="Grenada">Grenada</option>

					    <option value="Guadeloupe">Guadeloupe</option>

					    <option value="Guam">Guam</option>

					    <option value="Guatemala">Guatemala</option>

					    <option value="Guinea">Guinea</option>

					    <option value="Guinea-Bissau">Guinea-Bissau</option>

					    <option value="Guyana">Guyana</option>

					    <option value="Haiti">Haiti</option>

					    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>

					    <option value="Holy See">Holy See (Vatican City State)</option>

					    <option value="Honduras">Honduras</option>

					    <option value="Hong Kong">Hong Kong</option>

					    <option value="Hungary">Hungary</option>

					    <option value="Iceland">Iceland</option>

					    <option value="India">India</option>

					    <option value="Indonesia">Indonesia</option>

					    <option value="Iran">Iran (Islamic Republic of)</option>

					    <option value="Iraq">Iraq</option>

					    <option value="Ireland">Ireland</option>

					    <option value="Israel">Israel</option>

					    <option value="Italy">Italy</option>

					    <option value="Jamaica">Jamaica</option>

					    <option value="Japan">Japan</option>

					    <option value="Jordan">Jordan</option>

					    <option value="Kazakhstan">Kazakhstan</option>

					    <option value="Kenya">Kenya</option>

					    <option value="Kiribati">Kiribati</option>

					    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>

					    <option value="Korea">Korea, Republic of</option>

					    <option value="Kuwait">Kuwait</option>

					    <option value="Kyrgyzstan">Kyrgyzstan</option>

					    <option value="Lao">Lao People's Democratic Republic</option>

					    <option value="Latvia">Latvia</option>

					    <option value="Lebanon">Lebanon</option>

					    <option value="Lesotho">Lesotho</option>

					    <option value="Liberia">Liberia</option>

					    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>

					    <option value="Liechtenstein">Liechtenstein</option>

					    <option value="Lithuania">Lithuania</option>

					    <option value="Luxembourg">Luxembourg</option>

					    <option value="Macau">Macau</option>

					    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>

					    <option value="Madagascar">Madagascar</option>

					    <option value="Malawi">Malawi</option>

					    <option value="Malaysia">Malaysia</option>

					    <option value="Maldives">Maldives</option>

					    <option value="Mali">Mali</option>

					    <option value="Malta">Malta</option>

					    <option value="Marshall Islands">Marshall Islands</option>

					    <option value="Martinique">Martinique</option>

					    <option value="Mauritania">Mauritania</option>

					    <option value="Mauritius">Mauritius</option>

					    <option value="Mayotte">Mayotte</option>

					    <option value="Mexico">Mexico</option>

					    <option value="Micronesia">Micronesia, Federated States of</option>

					    <option value="Moldova">Moldova, Republic of</option>

					    <option value="Monaco">Monaco</option>

					    <option value="Mongolia">Mongolia</option>

					    <option value="Montserrat">Montserrat</option>

					    <option value="Morocco">Morocco</option>

					    <option value="Mozambique">Mozambique</option>

					    <option value="Myanmar">Myanmar</option>

					    <option value="Namibia">Namibia</option>

					    <option value="Nauru">Nauru</option>

					    <option value="Nepal">Nepal</option>

					    <option value="Netherlands">Netherlands</option>

					    <option value="Netherlands Antilles">Netherlands Antilles</option>

					    <option value="New Caledonia">New Caledonia</option>

					    <option value="New Zealand">New Zealand</option>

					    <option value="Nicaragua">Nicaragua</option>

					    <option value="Niger">Niger</option>

					    <option value="Nigeria">Nigeria</option>

					    <option value="Niue">Niue</option>

					    <option value="Norfolk Island">Norfolk Island</option>

					    <option value="Northern Mariana Islands">Northern Mariana Islands</option>

					    <option value="Norway">Norway</option>

					    <option value="Oman">Oman</option>

					    <option value="Pakistan">Pakistan</option>

					    <option value="Palau">Palau</option>

					    <option value="Panama">Panama</option>

					    <option value="Papua New Guinea">Papua New Guinea</option>

					    <option value="Paraguay">Paraguay</option>

					    <option value="Peru">Peru</option>

					    <option value="Philippines">Philippines</option>

					    <option value="Pitcairn">Pitcairn</option>

					    <option value="Poland">Poland</option>

					    <option value="Portugal">Portugal</option>

					    <option value="Puerto Rico">Puerto Rico</option>

					    <option value="Qatar">Qatar</option>

					    <option value="Reunion">Reunion</option>

					    <option value="Romania">Romania</option>

					    <option value="Russia">Russian Federation</option>

					    <option value="Rwanda">Rwanda</option>

					    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 

					    <option value="Saint LUCIA">Saint LUCIA</option>

					    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>

					    <option value="Samoa">Samoa</option>

					    <option value="San Marino">San Marino</option>

					    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 

					    <option value="Saudi Arabia">Saudi Arabia</option>

					    <option value="Senegal">Senegal</option>

					    <option value="Seychelles">Seychelles</option>

					    <option value="Sierra">Sierra Leone</option>

					    <option value="Singapore">Singapore</option>

					    <option value="Slovakia">Slovakia (Slovak Republic)</option>

					    <option value="Slovenia">Slovenia</option>

					    <option value="Solomon Islands">Solomon Islands</option>

					    <option value="Somalia">Somalia</option>

					    <option value="South Africa">South Africa</option>

					    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>

					    <option value="Span">Spain</option>

					    <option value="SriLanka">Sri Lanka</option>

					    <option value="St. Helena">St. Helena</option>

					    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>

					    <option value="Sudan">Sudan</option>

					    <option value="Suriname">Suriname</option>

					    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>

					    <option value="Swaziland">Swaziland</option>

					    <option value="Sweden">Sweden</option>

					    <option value="Switzerland">Switzerland</option>

					    <option value="Syria">Syrian Arab Republic</option>

					    <option value="Taiwan">Taiwan, Province of China</option>

					    <option value="Tajikistan">Tajikistan</option>

					    <option value="Tanzania">Tanzania, United Republic of</option>

					    <option value="Thailand">Thailand</option>

					    <option value="Togo">Togo</option>

					    <option value="Tokelau">Tokelau</option>

					    <option value="Tonga">Tonga</option>

					    <option value="Trinidad and Tobago">Trinidad and Tobago</option>

					    <option value="Tunisia">Tunisia</option>

					    <option value="Turkey">Turkey</option>

					    <option value="Turkmenistan">Turkmenistan</option>

					    <option value="Turks and Caicos">Turks and Caicos Islands</option>

					    <option value="Tuvalu">Tuvalu</option>

					    <option value="Uganda">Uganda</option>

					    <option value="Ukraine">Ukraine</option>

					    <option value="United Arab Emirates">United Arab Emirates</option>

					    <option value="United Kingdom">United Kingdom</option>

					    <option value="United States">United States</option>

					    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>

					    <option value="Uruguay">Uruguay</option>

					    <option value="Uzbekistan">Uzbekistan</option>

					    <option value="Vanuatu">Vanuatu</option>

					    <option value="Venezuela">Venezuela</option>

					    <option value="Vietnam">Viet Nam</option>

					    <option value="Virgin Islands (British)">Virgin Islands (British)</option>

					    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>

					    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>

					    <option value="Western Sahara">Western Sahara</option>

					    <option value="Yemen">Yemen</option>

					    <option value="Yugoslavia">Yugoslavia</option>

					    <option value="Zambia">Zambia</option>

					    <option value="Zimbabwe">Zimbabwe</option>

					</select>		

				   </div>			    

                  </div> -->

                  

                  <div class="form-group">	

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

							  echo $categoryname .= '<option value = "' . $row->catid . '">' . $row->name . '</option>';

							  unset($categoryname); 

							  $x++;

						     }

						}

					 ?>	

					</select>

                   </div>

                  </div>
                  
                  
                  <div class="form-group">	

				    <label>Sub category<?php //echo $lang['skills']; ?> <?php //echo 'required'; ?></label>

				   <div class="input-group">

					<span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>

				   <select class="selectpicker form-control" name="skills_name[]" type="text" title="Choose one of the following..." data-live-search="true" data-width="30%" data-selected-text-format="count > 3" multiple="multiple">

					 <?php
					$query = DB::getInstance()->get("skills", "*", ["catid" => 9,"ORDER" => "name ASC"]);

					if ($query->count()) {

					 foreach($query->results() as $row) {

					 	$names[] = $row->name;

					 }			

					}	

					

					foreach($names as $key=>$name){

					   echo $skills .= '<option value = "'.$name.'" data-tokens="'.$name.'" >'.$name.'</option>';

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

                  

                  <div class="form-group">
                  <label><span style="font-size: 11px;">We encourage you to stay within you budget limit but be courteous, realistic and fair when you decide on your affordable budget limit.</span></label>
                  <br />	

				    <label><?php echo $lang['budget']; ?> limit</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    
                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                    <input type="text" name="budget" class="form-control" placeholder="<?php echo $lang['budget']; ?>" value="<?php echo escape(Input::get('budget')); ?>"/>

                   </div>

                  </div> 
                  
                  
                  <div class="form-group travel_type">	

				    <label>Whos' traveling to who?</label>

                   <div class="input-group">
                   
                   <select name="travel_type" class="form-control">
                    <option value="1">Service provider travel to customer</option>
                    <option value="2">Customer travel to service provider</option>
                   </select>
                    <!--<div class="col-md-6">
                   <label><input type="radio" name="travel_type" checked/><?php echo "Service provider travel to customer"; ?></label>
                   </div>
                   
                    <div class="col-md-6">

                    <label><input type="radio" name="travel_type"/><?php echo "Travel to service provider"; ?></label>-->
                    
                    </div>

                   </div>

                  </div>  
                  
                  
                  <div class="form-group travel_in_miles" style="display: none;">	

				    <label>What's the distance ratio for your service? (in miles)</label>

                   <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                    
                    <select name="travel" class="form-control">
                    <option value="5">5 miles</option>
                    <option value="10">10 miles</option>
                    <option value="15">15 miles</option>
                    <option value="20">20 miles</option>
                    <option value="25">25 miles or more</option>
                   </select>

                    <!--<input type="number" name="travel" class="form-control" min="0" placeholder="<?php echo "Travel"; ?>" value="<?php echo escape(Input::get('travel')); ?>"/>-->
                        
                   </div>

                  </div>     

                <div class="form-group">
                    <label for="dtp_input1">Service needed by</label>
                </div>
				  <div class="form-group col-md-6">
                  
                  
                  

                   <label for="dtp_input1">Start date</label>

                    <div class="input-group date form_datetime_start" data-date-container='#form_datetime_start1' data-date-format="MM dd yyyy" data-link-field="dtp_input1">

                    <input name="start_date" class="form-control" type="text" value="" readonly id="datepicker1122">

                    <span class="input-group-addon"><i class="glyphicon glyphicon-remove"></i></span>

					<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>

                    </div>

				   <input type="hidden" id="dtp_input1" value="" /><br/>

		           <input name="mirror_field_start" type="hidden" id="mirror_field_start" class="form-control" readonly />

		           <input name="mirror_field_start_date" type="hidden" id="mirror_field_start_date" class="form-control" readonly />

                  </div> 

                  

				  <div class="form-group col-md-6">

                   <label for="dtp_input1"><?php echo $lang['end']; ?> <?php echo $lang['date']; ?></label>

                    <div class="input-group date form_datetime_end" data-date-format="MM dd yyyy" data-link-field="dtp_input1"  >

                    <input name="end_date" class="form-control" type="text" value="" readonly id="datepicker112233">

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

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="images"
                       data-images-only="true"
                       data-multiple="false"
                       data-crop=""
                       data-clearable="true" />

                  </div>
                  
                  <br/>  
                  
                  
                  <div class="form-group" style="overflow: hidden; text-align: center;">	
                  
                    <div class="col-md-6">

				    <label>Before image <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="before_image"
                       data-images-only="true"
                       data-multiple="false"
                       data-crop="4:3"
                       data-clearable="true" />
                    </div>
                    
                    <div class="col-md-6">

				    <label>After image <span style="font-size: 11px;">(optional)</span></label>

                      <input type="hidden" role="uploadcare-uploader" class="uploadcare" name="after_image"
                       data-images-only="true"
                       data-multiple="false"
                       data-crop="4:3"
                       data-clearable="true" />
                    </div>

                  </div>
                                      

                  
                  
                  <div class="form-group">
                  <label><span style="font-size: 11px;">You may upload a video describing the desired service to help the service providers understand your service need better</span></label>
                  <br />
                  <label>Upload video <span style="font-size: 11px;">(optional)</span></label>
                    <input type="file" name="video" id="file1"><br>
                      <input type="button" value="Upload File" onclick="uploadFile()"/>
                      <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
                      <h3 id="status"></h3>
                      <p id="loaded_n_total" style="display: none;"></p>
                  </div>
                  

                  <div class="form-group">	
                  <label><span style="font-size: 11px;">Adding a detail description for your desired service will make it easy for service provider to understand your need and might encourage them to provide your service</span></label>
                  <br />

				    <label>Service description</label>

                      <textarea type="text" id="summernote" name="description" class="form-control"></textarea>

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
	
	 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
  $( function() {
    $( "#datepicker1122" ).datepicker({ dateFormat: 'd MM y' });
    
  } );
   $( function() {
    $( "#datepicker112233" ).datepicker({ dateFormat: 'd MM y' });
    
  } );
  </script>
	

    <!-- Datetime Picker -->

    

    <script type="text/javascript">
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
                    $(input).siblings(".uploadcare--widget_status_loaded").after('<img class="viewimg" style="width:50%" src="'+info.cdnUrl+'">');
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

   </script>

    <!-- Summernote WYSIWYG-->

    <script src="../assets/js/summernote.min.js" type="text/javascript"></script>    

    <script>

    $(document).ready(function() {

	
	$( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'd MM y' });
    
  } );
	
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

