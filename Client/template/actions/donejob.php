<?php



 // connect to the database

 require_once '../../../core/backinit.php';

 

 // check if the 'serial' variable is set in URL, and check that it is valid

 if (Input::get('id') && is_numeric(Input::get('id')))

 {

	 // get id value

	 $id = Input::get('id');

	 

	 // update the entry

	$query = DB::getInstance()->update('job',[

	    'completed' => 1

	],[

	    'jobid' => $id

	  ]);	 
      
      

$q = DB::getInstance()->get("job", "*", ["AND"=> ["jobid" => $id]]);

$q_results = $q->results();


$freelancer = DB::getInstance()->get("freelancer", "*", ["AND"=> ["freelancerid" => $q_results[0]->freelancerid]]);

$freelancer_results = $freelancer->results();


$customer = DB::getInstance()->get("client", "*", ["AND"=> ["clientid" => $q_results[0]->clientid]]);

$customer_results = $customer->results();


$to = $customer_results[0]->email;
$subject = "Redeem voucher";

$message = "
<html>
<head>
<title>Redeem voucher</title>
</head>
<body>
<table width='500px'>
<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Service Title</th>
<td style='text-align: left; border-bottom: 1px solid;'>".$q_results[0]->title."</td>
</tr>

<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Amount</th>
<td style='text-align: left; border-bottom: 1px solid;'>$".$q_results[0]->budget."</td>
</tr>

<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Service Provider</th>
<td style='text-align: left; border-bottom: 1px solid;'>".$freelancer_results[0]->name."</td>
</tr>

<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Redeem voucher</th>
<td style='text-align: left; border-bottom: 1px solid;'>".$q_results[0]->redeem."</td>
</tr>


</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "To: keehee@techopialabs.com\r\n";
// More headers
$headers .= 'From: <keehee@techopialabs.com>' . "\r\n";

mail($to,$subject,$message,$headers);




$to1 = $freelancer_results[0]->email;
$subject1 = "Service Completed";

$message1 = "
<html>
<head>
<title>Service Completed</title>
</head>
<body>
<table width='500px'>
<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Service Title</th>
<td style='text-align: left; border-bottom: 1px solid;'>".$q_results[0]->title."</td>
</tr>

<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Customer</th>
<td style='text-align: left; border-bottom: 1px solid;'>".$customer_results[0]->name."</td>
</tr>

<tr>
<th style='text-align: left; border-bottom: 1px solid;'>Amount</th>
<td style='text-align: left; border-bottom: 1px solid;'>$".$q_results[0]->budget."</td>
</tr>


</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers1 .= "To: keehee@techopialabs.com\r\n";
// More headers
$headers1 .= 'From: <keehee@techopialabs.com>' . "\r\n";

mail($to1,$subject1,$message1,$headers1);

//$submitted = "yes";
		

	 // redirect back to the view page

	 header("Location: ../../jobboard.php?a=overview&id='.$id.'");

 }else

 // if id isn't set, or isn't valid, redirect back to view page

 {

 header("Location: ../../jobboard.php?a=overview&id='.$id.'");

 }

 

?>