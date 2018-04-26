<?php



//Check if init.php exists

if(!file_exists('../../core/binit.php')){

	header('Location: ../../install/');        

    exit;

}else{

 require_once '../../core/binit.php';	

}



//Start new Freelancer object

$freelancer = new Freelancer();



//Check if Freelancer is logged in

if (!$freelancer->isLoggedIn()) {

  Redirect::to('../index.php');	

}



require_once 'config.php';



//Get Payments Settings Data

$q2 = DB::getInstance()->get("currency", "*", ["id" => $currency]);

if ($q2->count()) {

 foreach($q2->results() as $r2) {

 	$currency_code = $r2->currency_code;

 }			

}










$q2 = DB::getInstance()->get("freelancer", "*", ["freelancerid" => $freelancer->data()->freelancerid, "LIMIT" => 1]);

if ($q2->count()) {

 foreach($q2->results() as $r2) {

  $freelancer_email = $r2->email;

 }

}						

						



if (isset($_POST['stripeToken'])) {
	

	$token = $_POST['stripeToken'];

	

	try {


    
    /*$recipient = Stripe_Recipient::create(array(
      "name" => $_POST['name'],
      "type" => "individual",
      "bank_account" => $_POST['stripeToken'],
      "email" => $_POST['email'])
    );
    
    
    print_r($recipient);*/
	


	 $freelancerid = $freelancer->data()->freelancerid;

		$query = DB::getInstance()->get("withdraw", "*", ["AND" => ["freelancerid" => $freelancerid], "LIMIT" => 1]);

		if ($query->count() === 1) {

			

			$Update = DB::getInstance()->update('withdraw',[
            
                'routing' => Input::get('routing'),
                
                'fullname' => Input::get('fullname'),

			    'account' => Input::get('account'),

			    'account_type' => Input::get('account_type'),

			    'type' => 2

		    ],[

		    'freelancerid' => $freelancerid

		    ]);

			

			if (count($Update) > 0) {

				$updatedError = true;

			} else {

				$hasError = true;

			}

			

		 } else {

		 	

			try{

			   $Insert = DB::getInstance()->insert('withdraw', array(

				   'freelancerid' => $freelancerid,

				   'routing' => Input::get('routing'),
                
                    'fullname' => Input::get('fullname'),
    
    			    'account' => Input::get('account'),
    
    			    'account_type' => Input::get('account_type'),

		           'type' => 2,

		           'date_added' => date('Y-m-d H:i:s')

			    ));	

					

			  if (count($Insert) > 0) {

				$noError = true;

			  } else {

				$hasError = true;

			  }

				  

			}catch(Exception $e){

			 die($e->getMessage());	

			} 			

			 

		 }

		

	} catch(Stripe_CardError $e) {

	 //Do something with the error here	

		

	}

	

	Redirect::to('../withdraw.php');

	exit();

	
}



?>