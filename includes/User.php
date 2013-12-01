<?php
/*
 * 2011 Oct 28
 * CSCC40 - Tutorial Scheduling System
 *
 * User Data Model
 *
 * @author Kobe Sun
 *
 */

class User {

	private $uid = -1;
	private $pwd = "";
	private $sid = 000000000;
	private $email = "";
	private $lname = "";
	private $fname = "";
	private $middle_name = "";
	private $age = -1;
	private $description = "";
	private $telephone = "";
	private $pic = "";
	private $last_login ="";
	private $is_activated = 0;
	private $is_admin = -1;
	private $u_type = 1;

	public function __construct($param) {
		$this->buildAttrs($param);
	}

	public function buildAttrs($param) {
		if (isset($param["uid"])) {
			$this->uid = $param["uid"];
		}
		if (isset($param["pwd"])) {
			$this->pwd = $param["pwd"];
		}
		if (isset($param["sid"])) {
			$this->sid = $param["sid"];
		}
		if (isset($param["email"])) {
			$this->email = $param["email"];
		}
		if (isset($param["lname"])) {
			$this->lname = $param["lname"];
		}
		if (isset($param["fname"])) {
			$this->fname = $param["fname"];
		}
		if (isset($param["age"])) {
			$this->age = $param["age"];
		}
		if (isset($param["description"])) {
			$this->description = $param["description"];
		}
		if (isset($param["tel"])) {
			$this->telephone = $param["tel"];
		}
		if (isset($param["pic"])) {
			$this->pic = $param["pic"];
		}
		if (isset($param["is_activated"])) {
			$this->is_activated = $param["is_activated"];
		}
		if (isset($param["last_login"])) {
			$this->last_login = $param["last_login"];
		}
		//Tom update start
		if (isset($param["middle_name"])) {
			$this->middle_name = $param["middle_name"];
		}
		if (isset($param["u_type"])) {
			$this->u_type = $param["u_type"];
		}
		//Tom update end
		return true;
	}

	
	/**
	 * 
	 * Pass in some criteria to search for a user, return the user instance
	 * @param array $criteria
	 * @param string $operator
	 */
	public static function searchBy($criteria, $operator="=") {
		// Get user information
		$db = Database::obtain();
		$user_query = "SELECT * FROM `users` WHERE ";

		foreach ($criteria as $k => $v) {
			if(strtolower($v)=='null') $user_query.= "`$k` = NULL";
			elseif(strtolower($v)=='now()') $user_query.= "`$k` = NOW()";
			else $user_query.= "`$k`='".$v."'";
			$user_query .= " AND ";

		}
		$user_query = rtrim($user_query, " AND ");
		$user = $db->query_first($user_query);
		return $user ? new User($user) : false;
	}

	
	/**
	 * 
	 * Add this user to database
	 */
	public function addUser() {

		$userData = array (
			"last_login"=>date('Y-m-d'),
			"sid" => $this->sid,
			"fname" => $this->fname,
			"lname" => $this->lname,
			"email" => $this->email,
			"phone" => $this->telephone,
			"pwd" => $this->pwd,
			"middle_name" => $this ->middle_name,
			"is_activated" => $this->is_activated,
			"u_type" => 1
		);
		if (Database::obtain()->insert("users", $userData)) {
			$ret_user = User::searchBy($userData);
			if ($ret_user) $this->uid = $ret_user->getUid();
		}
		return $this->uid;
	}

	
	/**
	 * 
	 * update this user in the database
	 * @param array $new_attrs
	 */
	public function updateUser($new_attrs) {
		return Database::obtain()->update("users", $new_attrs, "uid=$this->uid");
	}

	/**
	 * 
	 * Change the activate value in the database
	 */
	public function activate() {
		$this->updateUser(array("is_activated" => 1));
	}
	

	/**
	 * 
	 * Check whether the user is is_activated ...
	 */
	public function isActivated() {
		return $this->is_activated == 1;
	}

	
	/**
	 * 
	 * Check whether the user is administrator ...
	 */
	public function isAdmin() {
		if ($this->is_admin == -1) {
			$db = Database::obtain();
			$admin_query = "SELECT * FROM `admin` WHERE `uid`='".$db->escape($this->uid)."'";
			$this->is_admin = Database::obtain()->query_first($admin_query) ? 1 : 0;
		}
		return $this->is_admin;
	}
	
	
	/**
	 * 
	 * Check whether the user exists in an users array
	 * @param array $userArr
	 */
	public function userExists(array $userArr) {
		foreach ($userArr as $user) {
			if ($user->getUid() == $this->uid) {
				return true;
			}
		}
		return false;
	}
	
	
	public static function getUser($uid) {
		return User::searchBy(array("uid" => $uid));
	}
	public function getUid() { return $this->uid; }
	public function getPwd() { return $this->pwd; }
	public function getSid() { return $this->sid; }
	public function getEmail() { return $this->email; }
	public function getLname() { return $this->lname; }
	public function getFname() { return $this->fname; }
	public function getAge() { return $this->age; }
	public function getDescription() { return $this->description; }
	public function getTelephone() { return $this->telephone; }
	public function getActivated() { return $this->is_activated; }
	public function getPic() { return $this->pic; }
	public function getMiddle_name() { return $this->middle_name; }
	public function getLast_login() { return $this->last_login; }
	public function getu_type() { return $this->u_type; }
	
	public function setUid($x) { $this->uid = $x; }
	public function setPwd($x) { $this->pwd = $x; }
	public function setSid($x) { $this->sid = $x; }
	public function setEmail($x) { $this->email = $x; }
	public function setLname($x) { $this->lname = $x; }
	public function setFname($x) { $this->fname = $x; }
	public function setAge($x) { $this->age = $x; }
	public function setDescription($x) { $this->description = $x; }
	public function setTelephone($x) { $this->telephone = $x; }
	public function setPic($x) { $this->pic = $x; }
	public function setActivated($x) { $this->is_activated = $x; }
	public function setMiddlename($x) { $this->middle_name = $x; }
	public function setu_type($x) { $this->u_type = $x; }
}

?>
