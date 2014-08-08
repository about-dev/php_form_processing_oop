<?php
/*
	- uses mysqli extension from PHP
*/
class Db{
	/*
		$config = array(
						'host'		=> '...',
						'user'		=> '...',
						'password'	=> '...',
						'db_name'	=> '...',
						)
	*/
	protected $config = array();
	protected $conn = null;

	public function __construct(array $config = array()){
		if(empty($config) || !is_array($config)){
			throw new Exception("Invalid db config data!");
		}

		$this->config = $config;
	}

	public function connect(){
		if(empty($this->config['host']) || empty($this->config['user']) || empty($this->config['db_name'])){
			throw new Exception("Missing db config data!");
		}

		$this->conn = new mysqli($this->config['host'], $this->config['user'], $this->config['password'], $this->config['db_name']);

		if($this->conn->connect_error){
			throw new Exception("Database connection couldn't be established!");
		}
	}

	public function save($object){
		if(!is_object($object)){
			throw new Exception("Invalid user save data!");
		}

		$sql = '';
		if(!$object->getId()){
			// insert
			$sql .= "INSERT INTO users SET ";
		}else{
			// update
			$sql .= "UPDATE users SET ";
		}

		foreach($object->getData() as $k=>$v){
			if($k != 'id'){
				if($k == 'password'){
					$v = md5($v);
				}
				$sql .= $k.'="'.$this->conn->real_escape_string($v).'", ';
			}
		}

		$sql = rtrim($sql, ', ');

		if($object->getId()){
			// update
			$sql .= " WHERE id=".$object->getId();
		}

		return $this->conn->query($sql);
	}

	public function select(){

	}

	public function delete(){

	}

	public function disconnect(){
		if(!empty($this->conn) && is_object($this->conn)){
			$this->conn->close();
		}
	}

	public function getConnection(){
		if(empty($this->conn)){
			throw new Exception("The connection couldn't be established!");
		}

		return $this->conn;
	}
}