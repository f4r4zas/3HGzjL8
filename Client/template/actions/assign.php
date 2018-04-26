<?php



 // connect to the database

 require_once '../../../core/backinit.php';

 

 // check if the 'serial' variable is set in URL, and check that it is valid

 if (Input::get('id') && is_numeric(Input::get('id')))

 {

	 // get id value

	 $id = Input::get('id');

     $q1 = DB::getInstance()->get("proposal", "*", ["AND"=> ["proposalid" => $id]]);
     
     //print_r($q1);

	 if($q1->count() === 1) {

	  foreach($q1->results() as $r1) {

		  $jobid = $r1->jobid;

		  $freelancerid = $r1->freelancerid;

	  }	 	

	 }	 

	 
     
     $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $redeem = "";
    for ($i = 0; $i < 10; $i++) {
        $redeem .= $chars[mt_rand(0, strlen($chars)-1)];
    }

	//Update Job

	$jobUpdate = DB::getInstance()->update('job',[

	   'freelancerid' => $freelancerid,
       
       'redeem' => $redeem,

	   'accepted' => 1,

	   'public' => 0

	],[

	    'jobid' => $jobid

	  ]);

	//Update Proposal

	$Update = DB::getInstance()->update('proposal',[

	   'accepted' => 1

	],[

	    'proposalid' => $id

	  ]);
      
      
$q = DB::getInstance()->get("job", "*", ["AND"=> ["jobid" => $jobid]]);	

//print_r($q);

 //$q1 = DB::getInstance()->get("proposal", "*", ["AND"=> ["id" => $id]]);

	 if($q->count() === 1) {

	  foreach($q->results() as $r1) {
	   $name = $r1->title;

    	 $description = $r1->description;
    
    	 $budget = $r1->budget;
    
    	 $start_date = $r1->start_date;
    
    	 $end_date = $r1->end_date;
    
    	 //$jobid = $jobid;
    
    	 //$freelancerid = $freelancerid;
       
      $Insert = DB::getInstance()->insert('milestone', array(

		   'description' => $description,

		   'jobid' => $jobid,

		   'clientid' => $r1->clientid,

		   'freelancerid' => $freelancerid,

		   'name' => $name,

		   'budget' => $budget,

		   'start_date' => $start_date,

		   'end_date' => $end_date,

		   'funded' => 1,

		   'active' => 1,

		   'delete_remove' => 0,

		   'date_added' => date('Y-m-d H:i:s')

	    ));	
}


$q11 = DB::getInstance()->get("client", "*", ["AND"=> ["clientid" => $r1->clientid]]);
     
     //print_r($q1);

	 

$client_results = $q11->results();

$to1 = $client_results[0]->email;
$from1 = 'KeeHee <support@keehee.com>';
$formname1 = 'KeeHee';
$subject1 = "Service provider hired";
$message1 = '<p>You just deposit amount of $'.$budget.', and hired a service provider on KeeHee.<p>'; 
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
$headers1 .= "To: ".$client_results[0]->email."\r\n";
// More headers
$headers1 .= 'From: <no-reply@keehee.com>' . "\r\n";

mail($to1,$subject1,$body1,$headers1);
}
		  	 

	 // redirect back to the view page

	header("Location: ../../proposallist.php");

 }else

 // if id isn't set, or isn't valid, redirect back to view page

 {

 header("Location: ../../proposallist.php");

 }

 

?>