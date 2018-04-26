<?php
 require_once '../core/init.php';
$cat_query = DB::getInstance()->get("category", "*", ["catid" => $_POST['catid'], "LIMIT" => 1]);

    if ($cat_query->count() < 1) {
	  	//$skills = '<option value = "'.$name.'" data-tokens="'.$name.'" >'.$name.'</option>';
	} else {

    	$query = DB::getInstance()->get("skills", "*", ["catid" => $cat_query->results()[0]->id,"ORDER" => "name ASC"]);
    
    	if ($query->count()) {
    
    	 foreach($query->results() as $row) {
    
    	 	$names[] = $row->name;
    
    	 }			
    
    	}	
    
    	$skills = "";
    
    	foreach($names as $key=>$name){
    
    	   $skills .= '<option value = "'.$name.'" data-tokens="'.$name.'" >'.$name.'</option>';
    
    	  //unset($skills);
    
    	  unset($name);
    
    	}
        
        echo $skills; 	
    
    }

			

	 ?>