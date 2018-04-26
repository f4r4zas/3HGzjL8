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



//Get Payments Settings Data

$q1 = DB::getInstance()->get("payments_settings", "*", ["id" => 1]);

if ($q1->count()) {

 foreach($q1->results() as $r1) {

 	$currency = $r1->currency;

 	$membershipid = $r1->membershipid;

 }			

}



//Getting Payement Id from Database

$query = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);

if ($query->count() === 1) {

  $q1 = DB::getInstance()->get("membership_freelancer", "*", ["membershipid" => $membershipid]);

} else {

  $q1 = DB::getInstance()->get("membership_agency", "*", ["membershipid" => $membershipid]);

}

if ($q1->count() === 1) {

 foreach($q1->results() as $r1) {

  $bids = $r1->bids;

 }

}



//Register Function

if (Input::exists()) {

 if(Token::check(Input::get('token'))){

 	 

    $errorHandler = new ErrorHandler;

	

	$validator = new Validator($errorHandler);

	

	$validation = $validator->check($_POST, [

	  'name' => [

		 'required' => true,

		 'minlength' => 2,

		 'maxlength' => 50

	   ],
       
       /*'terms' => [

		 'required' => true,

	   ],*/
       
       'postal_code' => [

		 'required' => true,

	   ],
       
       'administrative_area_level_1' => [

		 'required' => true,

	   ],
       
       
       'city' => [

		 'required' => true,

		 'minlength' => 2,

	   ],
       
       
       /*'lng' => [

		 'required' => true,

		 'minlength' => 2,

	   ],
       
       'lat' => [

		 'required' => true,

		 'minlength' => 2,

	   ],
       
       
       
       'country' => [

		 'required' => true,

		 'minlength' => 2,

	   ],*/
       
       'birthday' => [

		 'required' => true,

	   ],

	  'email' => [

	     'required' => true,

	     'email' => true,

	     'maxlength' => 100,

	     'minlength' => 2,

	     'unique' => 'freelancer',

	     'unique' => 'client'

	  ],			 

	  'username' => [

	     'required' => true,

	     'maxlength' => 20,

	     'minlength' => 3,

	     'unique' => 'freelancer',

	     'unique' => 'client'

	  ],
      
      'phone' => [

	     'required' => true,

	     //'maxlength' => 12,

	     //'minlength' => 9,

	    // 'digit' => true,

	  ],

	   'password' => [

	     'required' => true,

	     'minlength' => 6

	   ],

	   'confirmPassword' => [

	     'match' => 'password'

	   ]

	]);

	 	

	  if (!$validation->fails()) {



	      if (Input::get('user_type') === 'on') {

		

		  	  	$client = new Client();

		  

				$remember = (Input::get('remember') === 'on') ? true : false;

				$salt = Hash::salt(32);  

				$imagelocation = 'uploads/default.png';

				$clientid = uniqueid(); 

				try{

					

				  $client->create(array(

				   'clientid' => $clientid,

				   'username' => Input::get('username'),
                   
                   'phone' => Input::get('phone'),

				   'password' => Hash::make(Input::get('password'), $salt),

				   'salt' => $salt,

				   'name' => Input::get('name')." ".Input::get('lname'),

		           'email' => Input::get('email'),

				   'imagelocation' => $imagelocation,

		           'joined' => date('Y-m-d H:i:s'),

				   'active' => 0,

		           'user_type' => 1

				  ));	
                  
                  

				  

				if ($client) {
				    
                    $city = Input::get('city');
                  
                      if(!empty($city)){
                        $city = Input::get('city');
                        
                      } else {
                        $city =  Input::get('administrative_area_level_1');
                      }
				    
                    $profileid = uniqueid();	

    			   $profileInsert = DB::getInstance()->insert('profile', array(
    
    				   'profileid' => $profileid,
    
    				   'userid' => $clientid,
    
    				   'location' => Input::get('search_location'),
    
    				   'city' => Input::get('city'),
                       
                       'postal_code' => Input::get('postal_code'),
    
    				   'country' => Input::get('administrative_area_level_1'),
                       
                       'lat' => Input::get('lat'),
                       
                       'lng' => Input::get('lng'),
    
    				   'active' => 1,
    
    				   'delete_remove' => 0,
    
    				   'date_added' => date('Y-m-d H:i:s')
    
    			    ));



$to = Input::get('email');
$from = 'KeeHee <support@keehee.com>';
$formname = 'KeeHee';
$subject = "Account verification";
$message = '<p>We\'re happy to have you on-board! Please click on the "Verify Email" button below to verify your email address and we will get you started right away.<p>'; 
$button = '<p><a height = "40" width = "420" line-height="38" class="btn_link" style="background: #518ed2;padding:0 10px;border-radius:3px;display:inline-block; color: #fff;font-size: 16px;height: 40px;min-width: 100px; max-width: 420px; line-height: 38px;text-decoration: none;" href="http://keehee.com/index.php?verify='.urlencode(Input::get("email")).'&type=client">Verify Email</a></p>';
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
$headers .= "To: ".Input::get('email')."\r\n";
// More headers
$headers .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to,$subject,$body,$headers);



$to1 = "keehee@keehee.com";
$from1 = 'KeeHee <support@keehee.com>';
$formname1 = 'KeeHee';
$subject1 = "New Customer Signup";
$message1 = '<p>'.Input::get("name").' '.Input::get("lname").' ('.Input::get("email").') has signed-up on KeeHee.<p>'; 
$button1 = '';
$name1='Guest';



// Get full html:
if(!empty($button1)){
    $button_html1 = '<tr style="text-align:center;"><td colspan="3">'.$button1.'</td></tr>';
} else {
    $button_html1 = '';
}

$body1 = '<!DOCTYPE html>
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
		<tr><td colspan="3">'.$message1.'</td></tr>
		<tr><td colspan="3">Thanks!</td></tr>
		<tr><td colspan="3">Team KeeHee</td></tr>
		'.$button_html1.'
		<tr class="blue_border" style="border-bottom:8px solid #518ed2" height="" width="700"><td colspan="3"></td></tr>
		<tr class="footer_menu" align="center"><td colspan="3"><a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/terms.php">Terms of use</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/privacy.php">Privacy Policy</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/contact.php">Contact us</a></td></tr>
		<tr><td style="font-size:12px;color:#555;text-align:center;line-height:15px" colspan="3">You are receiving this email because <a href="mailto:'.$to.'">'.$to.'</a> is registered on KeeHee. If you have any questions or concerns, please visit our website and contact us.</td></tr>

		<tr style="text-align:center;background:#171717;color:#fff;font-size:12px;font-style:italic;"><td colspan="3">Copyright (c) 2018 <a style="color:#518ed2;" href="http://keehee.com">KeeHee</a> - USA</td></tr>
		</table>

		</body>
		</html>';



$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers1 .= "To: keehee@keehee.com\r\n";
// More headers
$headers1 .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to1,$subject1,$body1,$headers1);	


$error = '';

	     	$error .= '

		           <div class="alert alert-success fade in">

		            <a href="#" class="close" data-dismiss="alert">&times;</a>

		            <strong>You have successfully signed-up!</strong> Please verify your email <br/>

			       </div>

			       ';
                    

			     //$login = $client->login(Input::get('email'), Input::get('password'), $remember);

				 //Redirect::to('Client/');

			    }else {

			     $hasError = true;

			   }

					

				}catch(Exception $e){

				 die($e->getMessage());	

				}				      	
	          
	      } else {

			if($membershipid != ''){

		  	  	$freelancer = new Freelancer();

		  

				$remember = (Input::get('remember') === 'on') ? true : false;

				$salt = Hash::salt(32);  

				$imagelocation = 'uploads/default.png';

				$bgimage = 'uploads/bg/default.jpg';

				$freelancerid = uniqueid(); 

				try{

					

				  $freelancer->create(array(

				   'freelancerid' => $freelancerid,

				   'username' => Input::get('username'),
                   
                   'phone' => Input::get('phone'),

				   'password' => Hash::make(Input::get('password'), $salt),

				   'salt' => $salt,

				   'name' => Input::get('name')." ".Input::get('lname'),

		           'email' => Input::get('email'),

				   'imagelocation' => $imagelocation,

				   'bgimage' => $bgimage,
                   
                   'business' => Input::get('business'),

		           'membershipid' => $membershipid,

		           'membership_bids' => $bids,

		           'membership_date' => date('Y-m-d H:i:s'),

		           'joined' => date('Y-m-d H:i:s'),

				   'active' => 0,

		           'user_type' => 1

				  ));	

				  

				if ($freelancer) {
				    
                    $city = Input::get('city');
                  
                      if(!empty($city)){
                        $city = Input::get('city');
                        
                      } else {
                        $city =  Input::get('administrative_area_level_1');
                      }
				    
                    $profileid = uniqueid();	

    			   $profileInsert = DB::getInstance()->insert('profile', array(
    
    				   'profileid' => $profileid,
    
    				   'userid' => $freelancerid,
    
    				   'location' => Input::get('search_location'),
    
    				   'city' => Input::get('city'),
                       
                       'postal_code' => Input::get('postal_code'),
    
    				   'country' => Input::get('administrative_area_level_1'),
                       
                       'lat' => Input::get('lat'),
                       
                       'lng' => Input::get('lng'),
    
    				   'active' => 1,
    
    				   'delete_remove' => 0,
    
    				   'date_added' => date('Y-m-d H:i:s')
    
    			    ));


$to = Input::get('email');
$from = 'KeeHee <support@keehee.com>';
$formname = 'KeeHee';
$subject = "Account verification";
$message = '<p>We\'re happy to have you on-board! Please click on the "Verify Email" button below to verify your email address and we will get you started right away.<p>'; 
$button = '<p><a height = "40" width = "420" line-height="38" class="btn_link" style="background: #518ed2;padding:0 10px;border-radius:3px;display:inline-block; color: #fff;font-size: 16px;height: 40px;min-width: 100px; max-width: 420px; line-height: 38px;text-decoration: none;" href="http://keehee.com/index.php?verify='.urlencode(Input::get("email")).'&type='.$_GET["type"].'">Verify Email</a></p>';
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
		<tr><td style="font-size:12px;color:#555;text-align:center;line-height:15px" colspan="3">You are receiving this email because <a href="mailto:'.$to.'">'.$to.'</a> is registered on KeeHee. If you have any questions or concerns, please visit our website and contact us</td></tr>

		<tr style="text-align:center;background:#171717;color:#fff;font-size:12px;font-style:italic;"><td colspan="3">Copyright (c) 2018 <a style="color:#518ed2;" href="http://keehee.com">KeeHee</a> - USA</td></tr>
		</table>

		</body>
		</html>';



$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "To: ".Input::get('email')."\r\n";
// More headers
$headers .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to,$subject,$body,$headers);


$to1 = "keehee@keehee.com";
$from1 = 'KeeHee <support@keehee.com>';
$formname1 = 'KeeHee';
$subject1 = "New Service Provider Signup";
$message1 = '<p>'.Input::get("name").' '.Input::get("lname").' ('.Input::get("email").') has signed-up on KeeHee.<p>'; 
$button1 = '';
$name1='Guest';



// Get full html:
if(!empty($button1)){
    $button_html1 = '<tr style="text-align:center;"><td colspan="3">'.$button1.'</td></tr>';
} else {
    $button_html1 = '';
}

$body1 = '<!DOCTYPE html>
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
		<tr><td colspan="3">'.$message1.'</td></tr>
		<tr><td colspan="3">Thanks!</td></tr>
		<tr><td colspan="3">Team KeeHee</td></tr>
		'.$button_html1.'
		<tr class="blue_border" style="border-bottom:8px solid #518ed2" height="" width="700"><td colspan="3"></td></tr>
		<tr class="footer_menu" align="center"><td colspan="3"><a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/terms.php">Terms of use</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/privacy.php">Privacy Policy</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/contact.php">Contact us</a></td></tr>
		<tr><td style="font-size:12px;color:#555;text-align:center;line-height:15px" colspan="3">You are receiving this email because <a href="mailto:'.$to.'">'.$to.'</a> is registered on KeeHee. If you have any questions or concerns, please visit our website and contact us.</td></tr>

		<tr style="text-align:center;background:#171717;color:#fff;font-size:12px;font-style:italic;"><td colspan="3">Copyright (c) 2018 <a style="color:#518ed2;" href="http://keehee.com">KeeHee</a> - USA</td></tr>
		</table>

		</body>
		</html>';



$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers1 .= "To: keehee@keehee.com\r\n";
// More headers
$headers1 .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to1,$subject1,$body1,$headers1);

			     //$login = $freelancer->login(Input::get('email'), Input::get('password'), $remember);

				 //Redirect::to('Freelancer/');
                 
                 $error = '';

	     	$error .= '

		           <div class="alert alert-success fade in">

		            <a href="#" class="close" data-dismiss="alert">&times;</a>

		            <strong>You have successfully signed-up!</strong> Please verify your email <br/>

			       </div>

			       ';


			    }else {

			     $hasError = true;

			   }

					

				}catch(Exception $e){

				 die($e->getMessage());	

				}	
	          } else {

				  $memError = true;

				}
	      }
       

		

	  } else {
	   
       $hasError = true;

	     $error = '';

	     foreach ($validation->errors()->all() as $err) {

	     	$str = implode(" ",$err);

	     	$error .= '

		           <div class="alert alert-danger fade in">

		            <a href="#" class="close" data-dismiss="alert">&times;</a>

		            <strong>Error!</strong> '.$str.'<br/>

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
li.active {
    background: #fff !important;
}

li a{
    color: #fff;
}

li.active a {
    color: #000;
    font-weight: bold;
}

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

  height: 55vh;

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

 							<img src="assets/img/logo-1.png" alt="KeeHee">

	       	<?php if($use_icon === '1'): ?>

	       		<!--<i class="fa <?php echo $site_icon; ?>"></i>-->

	       	<?php endif; ?>  <?php //echo escape($title); ?></h1>

		 <div id="typed-strings">

		  <!--<span><?php //echo escape($tagline); ?></span>-->

		 </div>

		 <p id="typed"></p>

        </div><!-- /.row -->

       </div><!-- /.content -->

	  </div><!-- /.container -->

     </header><!-- /header -->

	 
<ul class="nav nav-tabs" style="margin: 0 auto; max-width: 445px; display: none;">
    <li style="background: #b62228;" <?php echo (!isset($_GET['type']))?'class="active"':''?>><a href="register.php">As Customer</a></li>
    <li style="background: #226d36;" <?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'class="active"':''?>><a href="register.php?type=individual">As Professional Individual</a></li>
    <li style="background: #f27026;" <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'class="active"':''?>><a href="register.php?type=business">As Business</a></li>
  </ul>
     <!-- ==============================================

     Banner Login Section

     =============================================== -->

	 <section class="banner-login" style="background: <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'#9c0e22;':''?><?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'#44115b;':''?><?php echo (!isset($_GET['type']))?'':''?>;">

	  <div class="container">

	  		  	

	   <div class="row">

	   

	    <main class="main main-signup col-lg-12">

	     <div class="col-lg-6 col-lg-offset-3 text-center">

	     	

        <?php if(isset($memError)) { //If errors are found ?>

        <div class="alert alert-danger fade in">

         <a href="#" class="close" data-dismiss="alert">&times;</a>

         <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['mem_error']; ?>

	    </div>

        <?php } ?>

	     	

        <?php /*if(isset($hasError)) { //If errors are found ?>

        <div class="alert alert-danger fade in">

         <a href="#" class="close" data-dismiss="alert">&times;</a>

         <strong><?php echo $lang['hasError']; ?></strong> <?php echo $lang['login_error']; ?>

	    </div>

        <?php }*/ ?>

        

        <?php if (isset($error)) {

			echo $error;

		} ?>

	     	

		  <div class="form-sign">

		   <form method="post">

		    <div class="form-head">

			 <h3 style="font-weight: bold;">Sign-up As <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Business':''?><?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'Professional individual':''?><?php echo (!isset($_GET['type']))?'Customer':''?></h3>
             
             <p style="color: #fff !important; margin-top: 15px;">
             <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Are you ready to save time and money for your local business? KeeHee is here to help!  Simply complete the form below and we will match you with customers that need your help! Stay focused on what you do best - providing; providing excellent customer service to extraordinary customers! Just KeeHee it today! ':''?><?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'Are you a professional individual or job candidate that is ready to earn some money?   KeeHee is here to help!  Simply complete the form below and we will match you for temporary employment with customers who need your help!   Let KeeHee help you earn money today! ':''?><?php echo (!isset($_GET['type']))?'Ready to get started on finding the help you need for the your next project or service? KeeHee is here to help!  Simply complete the form below and we will match you with a provider that won\'t exceed your budget!  Let KeeHee help you Save money today!':''?>
             </p>

			</div><!-- /.form-head -->

			<!--<div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                  <h3>HOME</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <h3>Menu 1</h3>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <h3>Menu 2</h3>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                <div id="menu3" class="tab-pane fade">
                  <h3>Menu 3</h3>
                  <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
              </div>-->

            <div class="form-body">



            <!-- List group -->

            <ul class="list-group" style="display:none;">

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

			  <div class="form-controls freelancer_type" style="display: none;">
                <select name="business" class="field">
                    <option <?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'selected':''?><?php //echo (Input::get('business') == 0)?'selected':''; ?> value="0">Professional individual</option>
                    <option <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'selected':''?><?php //echo (Input::get('business') == 1)?'selected':''; ?> value="1">Business</option>
                </select>
			   <!--<input type="text" name="business" class="field" value="<?php echo escape(Input::get('name')); ?>"  placeholder="<?php echo $lang['full_name']; ?>">-->

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->
             

             <div class="form-row">

			  <div class="form-controls">

			   <input type="text" name="name" autocomplete="off" class="field" value="<?php  if(isset($hasError)) { echo escape(Input::get('name')); } ?>"  placeholder="<?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Business Name':'First Name'?>">

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->
             
             
             
             <div class="form-row" <?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'style="display:none;"':''?>>

			  <div class="form-controls">

			   <input type="text" name="lname" autocomplete="off" class="field" value="<?php if(isset($hasError)) { echo escape(Input::get('lname')); } ?>"  placeholder="<?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Owner\'s Last Name':'Last Name'?>">

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->			

			

             <div class="form-row">

			  <div class="form-controls">

			   <input type="text" name="email" class="field" value="<?php if(isset($hasError)) { echo escape(Input::get('email')); } ?>"  placeholder="<?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Business Email':$lang['email']?>">

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->



		     <div class="form-row">

		      <div class="form-controls">

			   <input type="text" name="username" class="field" autocomplete="off" value="<?php if(isset($hasError)) { echo escape(Input::get('username')); } ?>" placeholder="<?php echo $lang['username']; ?>">

			  </div><!-- /.form-controls -->

		     </div><!-- /.form-row -->
             
             
             
             <div class="form-row">

		      <div class="form-controls">

			   <input type="text" id="phone" name="phone" autocomplete="off" class="field" value="<?php if(isset($hasError)) { echo escape(Input::get('phone')); } ?>" placeholder="<?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Business Phone Number':$lang['phone']?>">

			  </div><!-- /.form-controls -->

		     </div><!-- /.form-row -->
             
             <div class="form-row">

		      <div class="form-controls">
              
              <?php
                	  // Sets the top option to be the current year. (IE. the option that is chosen by default).
                	  $currently_selected = date('Y'); 
                	  // Year to start available options at
                	  $earliest_year = 1940; 
                	  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                	  $latest_year = date('Y', strtotime('-18 years')); 
                
                	  echo '<select name="birthday" class="field">';
                      
                      echo '<option value="">';
                      echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Owner\'s Birth Year':'Birth Year';
                      echo '</option>';
                	  // Loops over each int[year] from current year, back to the $earliest_year [1950]
                	  foreach ( range( $latest_year, $earliest_year ) as $i ) { ?>
                		
                        <option <?php if(isset($hasError) && escape(Input::get('birthday')) == $i) { echo "selected"; } ?> value="<?php echo $i;?>"><?php echo $i ;?></option>
                		
                	  <?php }
                	  echo '</select>';
                	  ?>

			   <!--<input type="date" name="birthday" class="field" value="<?php echo escape(Input::get('birthday')); ?>" placeholder="<?php echo 'Birthday'; ?>">-->

			  </div><!-- /.form-controls -->

		     </div><!-- /.form-row -->

			 

             <div class="form-row">

			  <div class="form-controls">

			   <input type="password" name="password" class="field" placeholder="<?php echo $lang['password']; ?>">

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->



			 <div class="form-row">

			  <div class="form-controls">

			   <input type="password" name="confirmPassword" class="field" placeholder="<?php echo $lang['confirm_password']; ?>">

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->

		   
           
            <div class="form-row">

			  <div class="form-controls">
              
                <input name="search_location" value="" id="search_location" type="text" placeholder="<?php echo (!isset($_GET['type']))?'Zip code, City, State':''?><?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'Zip code, City, State':''?><?php echo (isset($_GET['type']) && $_GET['type'] == 'business')?'Address, City, State':''?>" class="field"  autocomplete="off" runat="server">
                <!--<input type="hidden" name="address" id="address" value=""/>-->
                <input type="hidden" name="city" id="locality" value=""/>
                <input type="hidden" name="administrative_area_level_1" id="administrative_area_level_1" value=""/>
                <input type="hidden" name="country" id="country" value=""/>
                <input type="hidden" name="postal_code" id="postal_code" value=""/>
                <input type="hidden" name="lat" id="lat" value=""/>
                <input type="hidden" name="lng" id="lng" value=""/>

			  </div><!-- /.form-controls -->

             </div><!-- /.form-row -->
             
             
             <div class="form-row">

			  <div class="form-controls" style="color: #fff;">
             <input type="checkbox" name="terms" id="coupon_question" required=""/>
                      By signing up you agree to KeeHee's <a style="color: #e9701c;" target="_blank" href="terms.php">Term of use</a> and <a style="color: #e9701c;" target="_blank" href="privacy.php">Privacy Policy</a>
             </div>
             </div>
             
             
             

			 </div><!-- /.form-body -->

	

			 <div class="form-foot">

			  <div class="form-actions">

               <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />

			   <input value="Sign-up" class="form-btn" type="submit" style="background: #e9701c;">

			  </div><!-- /.form-actions -->
              
              
              <div class="form-head">

			  <span style="color: #fff;">Already have an account?</span> <a style="color: #e9701c;" href="login1.php" class="more-link">Login</a>

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
     
     
     
     <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDBrWVwNiX1IWMrVv17r_E6MHirOym2LG0" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
});
</script>

<script type="text/javascript">

$("#someSwitchOptionDefault").change(function(){
    if($(this).is(':checked')){
        $(".freelancer_type").hide();
    } else {
        $(".freelancer_type").show();
    }
});


var componentForm = {
        //street_number: 'short_name',
        //route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };
		var IsplaceChangesearch_location = false;
		//var IsplaceChangesearch_location2 = false;
		//var IsplaceChangesearch_location3 = false;
         function initialize() {

          input = document.getElementById('search_location');

          var options = {
            <?php echo (!isset($_GET['type']))?'types: ["(regions)"],':''?>
            <?php echo (isset($_GET['type']) && $_GET['type'] == 'individual')?'types: ["(regions)"],':''?>
            componentRestrictions: {country: 'us'}
          };
          var autocomplete = new google.maps.places.Autocomplete(input,options);
          // console.log(autocomplete);
          google.maps.event.addListener(autocomplete, 'place_changed', function(){
              var place = autocomplete.getPlace();
			  IsplaceChangesearch_location = true;
              //console.log(place);
              //document.getElementById('place').value = place.formatted_address;
              //document.getElementById('city').value = place.address_components;
              document.getElementById('lat').value = place.geometry.location.lat();
              document.getElementById('lng').value = place.geometry.location.lng();
              
              for (var i = 0; i < place.address_components.length; i++) {
                  var addressType = place.address_components[i].types[0];
                  if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                  }
              }
          });

		   $("#search_location").keydown(function () {
				IsplaceChangesearch_location = false;
			});





          /*input2 = document.getElementById('search_location2');
          var options2 = {
            componentRestrictions: {country: 'us'}
          };
          var autocomplete2 = new google.maps.places.Autocomplete(input2,options2);
          // console.log(autocomplete2);
          google.maps.event.addListener(autocomplete2, 'place_changed', function(){
              var place2 = autocomplete2.getPlace();
			  IsplaceChangesearch_location2 = true;
              document.getElementById('place').value = place2.formatted_address;
              document.getElementById('cityLat').value = place2.geometry.location.lat();
              document.getElementById('cityLng').value = place2.geometry.location.lng();
          });


		  $("#search_location2").keydown(function () {
				IsplaceChangesearch_location2 = false;
			});*/





          /*input3 = document.getElementById('search_location3');
          var options3 = {
            types: ['(cities)'],
            componentRestrictions: {country: 'us'}
          };
          // var input = document.getElementById('search_location2');
          var autocomplete3 = new google.maps.places.Autocomplete(input3,options3);
          // console.log(autocomplete3);
          google.maps.event.addListener(autocomplete3, 'place_changed', function(){
              var place3 = autocomplete3.getPlace();
			  IsplaceChangesearch_location3 = true;
			   // console.log(autocomplete3);
              //document.getElementById('place').value = place3.formatted_address;
              document.getElementById('lat').value = place3.geometry.location.lat();
              document.getElementById('lng').value = place3.geometry.location.lng();
          });

			$("#search_location3").keydown(function () {
				IsplaceChangesearch_location3 = false;
			});*/





        }
        google.maps.event.addDomListener(window, 'load', initialize);

		 $("form").submit(function () {
			// alert("sdsdsa");

			if (IsplaceChangesearch_location == false) {
                $("#search_location").val('');
				 // $('#search_location3').siblings('.lbl').html("You must provide a valid location.");
            }else {
                // alert($("#search_location3").val());
            }
			/*if (IsplaceChangesearch_location2 == false) {
                $("#search_location2").val('');
				 // $('#search_location3').siblings('.lbl').html("You must provide a valid location.");
            }else {
                // alert($("#search_location3").val());
            }


			 if (IsplaceChangesearch_location3 == false) {
                $("#search_location3").val('');
				 // $('#search_location3').siblings('.lbl').html("You must provide a valid location.");
            }else {
                // alert($("#search_location3").val());
            }*/

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
    </script>



</body>

</html>