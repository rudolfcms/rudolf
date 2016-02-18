<?php

namespace Rudolf\Auth;

class Auth {
	public function __construct($pdo, $prefix) {
		$this->pdo = $pdo;
		$this->prefix = $prefix;
		$this->config = include CONFIG_ROOT . '/' . 'auth.php';

		$this->session = new Session($pdo, $prefix, $this->config);
	}

	/**
	 * Login user
	 * 
	 * @param string $email
	 * @param string $password
	 * 
	 * @return int
	 * 			 1 - logged in!
	 * 			44 - email not valid
	 * 			45 - password not valid
	 * 			46 - user not exist
	 * 			47 - email or password incorect
	 * 			48 - account is inactive
	 * 			49 - unnamed error
	 */
	public function login($email, $password) {

		#validation
		if(false === $this->validateEmail($email)) {
			return 44;
		} elseif(false === $this->validatePassword($password)) {
			return 45;
		}

		#get user data by email
		$userData = $this->getUserDataByEmail($email);
		if(false === $userData) {
			return 46;
		}

		#check password
		if(!password_verify($password, $userData['password'])) {
			return 47;
		}

		#check is user active
		if(false === $userData['active']) {
			return 48;
		}

		#create session
		if(false === $this->session->createSession($userData)) {
			return 49;
		}

		return 1;
	}

	public function logout() {
		return $this->session->destroySession();
	}

	/**
	 * 
	 * @return bool
	 */
	public function check() {
		return $this->session->checkSession();
	}

	/**
	 * Get password hash
	 * 
	 * @param string $password
	 * 
	 * @return string
	 */
	public function getPasswordHash($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

	/**
	 * Get user data by email
	 * 
	 * @param string $email
	 * 
	 * @return array
	 */
	public function getUserDataByEmail($email) {
		$stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}users WHERE email = :email");
		$stmt->bindValue(':email', $email, \PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if(empty($results[0])) {
			return false;
		}

		return $results[0];
	}

	/**
	 * Validate email
	 * 
	 * @param string $email
	 * 
	 * @return bool
	 */
	public function validateEmail($email) {
		return true;
	}

	/**
	 * Validate password
	 * 
	 * @param string $password
	 * 
	 * @return bool
	 */
	public function validatePassword($password) {
		return true;
	}
}
