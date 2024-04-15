<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermaster_model extends CI_Model
{
	  public function save_usermaster($firstname,$lastname,$email,$mobile,$permission,$username,$password){

	
	 $sql = "INSERT INTO user(firstname,lastname,email,mobile,permission,username,password) 
	 values('$firstname','$lastname','$email','$mobile','$permission','$username','$password')"; 
		
		$result = $this->db->query($sql);
		//echo  "INSERT INTO user(firstname,email,permission) values('$firstname','$email','$permission')";
	
	}
	
	
	  public function search($username){
		  
	     
     // echo 

	 $sql = "select * from `user` where username = '$username'";

          $result = $this->db->query($sql);

         	 return $result->row();
		  
	  }
	  
	  
	  public function search_master($email){
		  
		 
		  //echo"<pre>";
		  //print_r($email);
		  //exit;
		  $sql = "select * from `user` where email = '$email'";

          $result = $this->db->query($sql);

         	 return $result->row();
		  
	  } 
		  
	
	public function usermaster_list(){

		$sql = "select * from `user`where status = 1 or status=2";

		$result = $this->db->query($sql);

		return $result->result();
	}





  public function edit_usermaster($id){

		$sql = "select * from `user` where 	user_id  = '$id'";

		$result = $this->db->query($sql);

		return $result->row();
	}
	
  public function usermaster_update($firstname,$lastname,$email,$mobile,$landline,$permission,$username,$password,$user_id){
		 
	 $sql = "update `user` SET  firstname = '$firstname' ,
	 lastname = '$lastname',email = '$email',mobile = '$mobile' , 
	 landline = '$landline',permission = '$permission' , username = '$username',
	 password = '$password' where user_id = '$user_id'";
		 
		 
		$result = $this->db->query($sql);
	
	}
	public function usermaster_update1($firstname,$lastname,$email,$mobile,$permission,$username,$user_id){
		 
	 $sql = "update `user` SET  firstname = '$firstname' ,
	 lastname = '$lastname',email = '$email',mobile = '$mobile' , permission = '$permission' , username = '$username'
	 where user_id = '$user_id'";
		 
		 
		$result = $this->db->query($sql);
	
	}

  public function delete_user($id){
		
 	$this->db->query("UPDATE  `user` SET status = 0 Where user_id='$id'");
  
}

   public function update_status($table,$values,$where)
	{
		$this->db->where($where); 
		
		$this->db->update($table,$values);
	}
	
}