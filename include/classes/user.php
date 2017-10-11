<?php

class User{
	private $username;
	private $userType;
	private $id;
	private $email;
	private $avatar;
	private $signupDate;
	private $team;


	public function __construct($username, $userType, $id, $email, $avatar, $signupDate, $team){
		$this->username = $username;
		$this->userType = $userType;
		$this->id = $id;
		$this->email = $email;
		$this->avatar = $avatar;
		$this->signupDate = $signupDate;
		$this->team = $team;
	}

	// Medlemsfunktioner
	public function Set_name($username){
		$this->username = $username;
	}
	public function Set_type($userType){
		$this->userType = $userType;
	}
	public function Set_id($id){
		$this->id = $id;
	}
	public function Set_email($email){
		$this->email = $email;
	}
	public function Set_avatar($avatar){
		$this->avatar = $avatar;
	}
	public function Set_signupDate($signupDate){
		$this->signupDate = $signupDate;
	}
	public function Set_team($team){
		$this->team = $team;
	}
	

	public function Get_name(){
		return $this->username;
	}
	public function Get_type(){
		return $this->userType;
	}
	public function Get_id(){
		return $this->id;
	}
	public function Get_email(){
		return $this->email;
	}
	public function Get_avatar(){
		return $this->avatar;
	}
	public function Get_signupDate(){
		return $this->signupDate;
	}
	public function Get_team(){
		return $this->team;
	}

}
?>