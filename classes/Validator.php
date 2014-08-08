<?php
class Validator{
	protected $isValid 		= true;			// used to test the validity of data
	protected $errorMessages= array();		// used to collect error messages
	protected $data			= array();		// used to locally store data

	public function __construct(array $params = array()){
		if(empty($params) || !is_array($params)){
			throw new Exception("Invalid data!");
		}

		$this->data = $params;
	}

	/*
		- checks data
		- returns: nothing
		- sets the isValid property according to the validation
		- collect error messages into the errorMessages property according to the validation
	*/
	public function validate(){
	    if(empty($this->data['first_name'])){
	        $this->errorMessages['first_name'] = 'Please insert first name!';
	    }else{
	        $firstName = filter_var($this->data['first_name'], FILTER_SANITIZE_STRING);
	        if(strlen($firstName) < 4){
	            $this->errorMessages['first_name'] = 'Your first name must be at least 4 characters!';
	        }
	    }

	    // email validation
	    if(empty($this->data['email'])){
	        $this->errorMessages['email'] = 'Please insert your email address!';
	    }else{
	        $email = filter_var($this->data['email'], FILTER_SANITIZE_EMAIL);
	        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	            $this->errorMessages['email'] = 'Please insert a valid email address!';
	        }
	    }

	    // username validation
	    if(empty($this->data['username'])){
	        $this->errorMessages['username'] = 'Please insert your username!';
	    }else{
	    	if(strlen($this->data['username']) < 10){
	    		$this->errorMessages['username'] = 'Your username must have at least 10 characters!';
	    	}
	    }

	    // password validation
	    if(empty($this->data['password'])){
	        $this->errorMessages['password'] = 'Please insert your password!';
	    }else{
	        if($this->data['password'] != $this->data['confirm_password']){
	            $this->errorMessages['password'] = 'Your passwords must match!';
	        }
	    }

	    // address validation
	    if(empty($this->data['address'])){
	        $this->errorMessages['address'] = 'Please insert your address!';
	    }

	    if(!empty($this->errorMessages)){
	    	$this->isValid = false;
	    }
	}

	// getter methods
	public function getIsValid(){
		return $this->isValid;
	}

	public function getErrors(){
		return $this->errorMessages;
	}
}