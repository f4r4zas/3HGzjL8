<?php



//Check if init.php exists

if(!file_exists('../../core/binit.php')){

	header('Location: ../../install/');        

    exit;

}else{

 require_once '../../core/binit.php';	

}





require_once 'config.php';



//Get Payments Settings Data

$q2 = DB::getInstance()->get("currency", "*", ["id" => $currency]);

if ($q2->count()) {

 foreach($q2->results() as $r2) {

 	$currency_code = $r2->currency_code;

 }			

}



//Getting Payement Id from Database

$id = Input::get('id');

$q2 = DB::getInstance()->get("sponsors", "*", ["id" => Input::get('id')]);
$q2_result = $q2->results();

$amount = getMoneyAsCents($q2_result[0]->package);						

						



if (isset($_POST['stripeToken'])) {

	

	$token = $_POST['stripeToken'];

	

	try {

		

	 Stripe_Charge::create([

	  "amount" => $amount,

	  "currency" => $currency_code,

	  "card" => $token,

	  "description" => $q2_result[0]->email

	  ]);	

	 

	   //Insert
       
       
       $Update = DB::getInstance()->update('sponsors',[

		   'status' => 1

		],[

		    'id' => $id

		  ]);

	  /* $Insert = DB::getInstance()->insert('sponsors', array(

		   'membershipid' => $id,

		   'freelancerid' => $client->data()->clientid,

		   'paymentid' => 4,

		   'hash' => 4,

		   'payment' => $budget,

		   'complete' => 1,

		   'transaction_type' => 4,

		   'date_added' => date('Y-m-d H:i:s')

	    ));*/	

	  
$to = urldecode(Input::get('email'));
$from = 'KeeHee <support@keehee.com>';
$formname = 'KeeHee';
$subject = "Thanks for being a sponsor.";
$message = '<p>You\'ve just submitted your payment to become a KeeHee sponsor, great choice! Your ad is on a review and upon approval it will appear in the KeeHee user\'s profiles and customers ads of the categories you selected.<br /><br />Here are your purchase details:<br />Name: '.urldecode(Input::get('name')).'<br />Email: '.urldecode(Input::get('email')).'<br />Phone: '.urldecode(Input::get('ph')).'<br />Selected Categories: '.urldecode(Input::get('cats')).'<br />Package: '.urldecode(Input::get('pkg')).'<p>'; 
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
        
        <tr><td colspan="3"><br /><b>Discover more things you can do on KeeHee:</b><br />
1. Are you a customer wanting to save money on services? KeeHee platform is design for you. Sign-up today and start posting ads for the services you need without exceeding your budget limits.<br /><br />
2. Don\'t need a service but want to earn extra income? KeeHee is perfect for local businesses and professional individuals who want to earn extra income. <a href="http://keehee.com/signup.php">Sign-up</a> today and "Just KeeHee It" by requesting to provide service on customer\'s ads.</td></tr>
		<tr><td colspan="3">Thanks!</td></tr>
		<tr><td colspan="3">Team KeeHee</td></tr>
		'.$button_html.'
		<tr class="blue_border" style="border-bottom:8px solid #518ed2" height="" width="700"><td colspan="3"></td></tr>
		<tr class="footer_menu" align="center"><td colspan="3"><a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/terms.php">Terms of use</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/privacy.php">Privacy Policy</a>&nbsp;&nbsp;&nbsp;<a style="color: #000;font-size: 14px;text-decoration: none;"  href="http://keehee.com/contact.php">Contact us</a></td></tr>
		

		<tr style="text-align:center;background:#171717;color:#fff;font-size:12px;font-style:italic;"><td colspan="3">Copyright (c) 2018 <a style="color:#518ed2;" href="http://keehee.com">KeeHee</a> - USA</td></tr>
		</table>

		</body>
		</html>';



$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "To: ".urldecode(Input::get('email'))."\r\n";
// More headers
$headers .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to,$subject,$body,$headers);



$to1 = "keehee@keehee.com";
$from1 = 'KeeHee <support@keehee.com>';
$formname1 = 'KeeHee';
$subject1 = "New Sponsor";
$message1 = '<p>'.urldecode(Input::get('name')).' ('.urldecode(Input::get('email')).') has added an sponsor ad on KeeHee.<p>'; 
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
		

	} catch(Stripe_CardError $e) {

	 //Do something with the error here	

		

	}

	

	Redirect::to('../../sponsor.php?success=yes');

	exit();

	

}



?>