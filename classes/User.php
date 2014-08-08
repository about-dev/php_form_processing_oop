<?php
class User{
	// user entity properties: mapped to a DB table (`users` table, for our example)
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $username;
	private $password;
	private $address;

	/*
		$params = array(
						'id'		=>0,
						'first_name'=>'Name',
						.....................
						)
	*/
	public function __construct(array $params = array()){
		if(empty($params) || !is_array($params)){
			throw new Exception("Invalid data!");
		}

		foreach($params as $key=>$value){
			$property 	= strpos($key, '_')?substr($key, 0, strpos($key, '_')).ucfirst(substr($key, strpos($key, '_')+1)):$key;
			$method 	= 'set'.$property;
			if(property_exists($this, $property) && method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}

	// getter methods: specific getter methods
	public function getId(){
		return $this->id;
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function getLastName(){
		return $this->lastName;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getAddress(){
		return $this->address;
	}

	// setter methods: specific setter methods
	public function setId($id = 0){
		$this->id = $id;
	}

	public function setFirstName($firstName = ''){
		$this->firstName = $firstName;
	}

	public function setLastName($lastName = ''){
		$this->lastName = $lastName;
	}

	public function setEmail($email = ''){
		$this->email = $email;
	}

	public function setUsername($username = ''){
		$this->username = $username;
	}

	public function setPassword($password = ''){
		$this->password = $password;
	}

	public function setAddress($address = ''){
		$this->address = $address;
	}

	// general getter method
	public function __get($name){
		if(!empty($name) && in_array($name, get_class_vars($this))){
			return $this->$name;
		}

		return false;
	}

	// general setter method
	public function __set($name, $value){
		if(!empty($name) && in_array($name, get_class_vars($this))){
			$this->$name = $value;
		}
	}

	public function getData(){
		return array(
					'id'		=>$this->id,
					'first_name'=>$this->firstName,
					'last_name'	=>$this->lastName,
					'username'	=>$this->username,
					'password'	=>$this->password,
					'email'		=>$this->email,
					'address'	=>$this->address,
					);
	}
}