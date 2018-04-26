<?php



/**
 * 
 */
class Validator{
	

	protected $_db;

	protected $errorHandler;

	protected $items;

	protected $rules = ['float_digit', 'minage', 'required', 'minlength', 'maxlength', 'email', 'alnum', 'alpha', 'digit', 'match', 'unique'];

	

	public $messages = [

	   'required' => 'The :field field is required',

	   'minlength' => 'The :field field must be a minimum of :satisfier length',

	   'maxlength' => 'The :field field must be a maximum of :satisfier length',

	   'email' => 'That is not a valid email address',

	   'alnum' => 'The :field field must be alphanumeric',

	   'alpha' => 'The :field field must be alphabetic only',

	   'digit' => 'The :field field must be digits only',
       
       'float_digit' => 'The :field field must be numbers only',

	   'match' => 'The :field field must be match the :satisfier field',
       
       'minage' => 'Age must be greater than :satisfier',

	   'unique' => 'The :field is already taken'

	];

	
	public function __construct(ErrorHandler $errorHandler) 

	{

		$this->_db = DB::getInstance();

		$this->errorHandler = $errorHandler;
	}

	

	public function check($items, $rules)
	{

		$this->items = $items;

		
	  foreach ($items as $item => $value) {
		  if (in_array($item, array_keys($rules))) 

		  {
			$this->validate([

			   'field' => $item,

			   'value' => $value,

			   'rules' => $rules[$item]  

			]);  
		  }
	  }	

	  return $this;
	}

	

	public function fails()

	{

	  return $this->errorHandler->hasErrors();	

	}

	

	public function errors()
	{
	  return $this->errorHandler;	
	}

	

	protected function validate($item)
	{
	   $field = $item['field'];

	   foreach ($item['rules'] as $rule => $satisfier) 

	   {
		 if (in_array($rule, $this->rules)) 

		 {
		   if (!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfier])) 

		   {
			 $this->errorHandler->addError(

			  str_replace([':field',':satisfier'], [$field, $satisfier], $this->messages[$rule]), 

			  $field

			  );  
		   }
		 }   
	   }	


	}

	

	protected function required($field, $value, $satisfier)
	{
	  return !empty(trim($value));	
	}

	

	protected function minlength($field, $value, $satisfier)

	{

	  return mb_strlen($value) >= $satisfier;	

	}
    
    
    protected function minage($field, $value, $satisfier)

	{
	   //$birthday = $value;
	   
       // $birthday can be UNIX_TIMESTAMP or just a string-date.
        /*if(is_string($value)) {
            $birthday = strtotime($value);
        }*/
        
        $birthday = strtotime('+18 years', $value);
    
        // check
        // 31536000 is the number of seconds in a 365 days year.
        //return (time() - $birthday) < (18 * 31536000);
        return time() < $birthday;
          /*{
            return false;
        }*/
    
        //return true;

	  //return mb_strlen($value) >= $satisfier;	

	}

	

	protected function maxlength($field, $value, $satisfier)

	{

	  return mb_strlen($value) <= $satisfier;	

	}

	

	protected function email($field, $value, $satisfier)

	{

	  return filter_var($value, FILTER_VALIDATE_EMAIL);	

	}

	

	protected function alnum($field, $value, $satisfier)

	{

	  return ctype_alnum($value);	

	}

	

	protected function alpha($field, $value, $satisfier)

	{

	  return ctype_alpha($value);	

	}

	

	protected function digit($field, $value, $satisfier)

	{

	  return ctype_digit($value);	

	}
    
    protected function float_digit($field, $value, $satisfier)

	{
	   if (strpos($value,'.') !== false) {
	       $val = explode('.',$value);
	       return ctype_digit($val[0]); 
	   } else {
	      return ctype_digit($value); 
	   }

	  	

	}

	

	protected function match($field, $value, $satisfier)

	{

	  return $value === $this->items[$satisfier];	

	}

	

	protected function unique($field, $value, $satisfier)

	{

	  return $this->_db->has($field, $value, $satisfier);	

	  //return $this->_db->get($satisfier, "*", [$field => $value]);

	  //return $this->_db->exists($satisfier, [$field => $value]) ? true : false;	

	}
}






?>