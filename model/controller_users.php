<?php
//Require config config file
include_once ('config.php');

    function secure($string){
		$sec = htmlentities($string);
		return $sec;
	}
    function user_exist($username, $email, $table){
		//Require Databse config file
		require 'config.php';

		//Sanitize function variables
		$table = secure($table);

		//Check if email exist
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username = ? || email = ?");
		$stmt->bind_param("ss", $username,$email);
		if($stmt->execute()){
			$result = $stmt->get_result();

			if ($result->num_rows >0) {
				return true;
			}else{
				return false;
			}
		}else{
			die($mysqli->error);
		}
	}
	function deleteF($del, $table){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM ".$table." WHERE id='$del' LIMIT 1");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function deleteInc($del){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM criminal_records WHERE record_id='$del' LIMIT 1");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function deleteAlt($del){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM alerts WHERE alert_id='$del' LIMIT 1");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function getAdmin(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE role = 'security'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function fetchrecord($table){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table."");
		$stmt->execute();
		$result = $stmt->get_result();
 
		return $result;
	}
	
	function getUsr($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['username'];
	}
	function getUsrInfo($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getchkAdminUsr($username){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = '$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		$role = $data['role'];
		if($role=='admin'){
			return 1;
		}
		else if($role=='officer'){
			return 2;
		}
		else{
			return 3;
		}
	}
//    function getAdminUsrz($username,$email){
// 		//Require Databse config file
// 		require 'config.php';
        
// 		//fetch all user
// 		$stmt = $mysqli->prepare("SELECT * FROM staff where username = '$username' || email = '$email'");
// 		$stmt->execute();
// 		$result = $stmt->get_result();
// 		return $result;
// 	}

	function getUsrz($username,$email){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getUsrz_exist($username,$email){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}

	
	/////verify if profile pics exist
	//verify completed field
	function verify_pics($user_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT passp FROM fileuploads where user_id = '$user_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		if(mysqli_num_rows($result) > 0){
			return true;
		}else{
			return false;
		}
	}
	////fetch profile pics
	function getPp($user_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM fileuploads where user_id = '$user_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['passp'];
	}
	
	function add_user_($username,$email,$password_hash,$role){
		//Require Databse config file
		require 'config.php';
		//add user
		$stmt = $mysqli->prepare("INSERT INTO users(username, email, password_hash, role) VALUES(?,?,?,?)");
		$stmt->bind_param("ssss",$username,$email,$password_hash,$role);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_crime($name,$crime_type,$crime_date,$description,$officer_id){
		//Require Databse config file
		require 'config.php';
		//add user
		$stmt = $mysqli->prepare("INSERT INTO criminal_records(name,crime_type,crime_date,description,officer_id) VALUES(?,?,?,?,?)");
		$stmt->bind_param("ssssi",$name,$crime_type,$crime_date,$description,$officer_id);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}

////fetch user info via user_id
function fetch_userinfo($userr_id){
	//Require Databse config file
	require 'config.php';
	//fetch all user
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE user_id='$userr_id'");
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
}
///user functions
function fetch($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." ORDER BY user_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_alerts(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM alerts WHERE status = '0' ORDER BY alert_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_alerts_(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM alerts ORDER BY alert_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_crime($record_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM criminal_records WHERE record_id = '$record_id' ORDER BY record_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_crimes(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM criminal_records ORDER BY record_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_closed_case(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM criminal_records WHERE status = 'closed' ORDER BY record_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_open_case(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM criminal_records WHERE status != 'closed' ORDER BY record_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_users_all(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM users WHERE role != 'security' ORDER BY user_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_u_crime($record_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM criminal_records WHERE record_id = '$record_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
 function fetch_data($table){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table."");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function add_user_file($user_id,$passp,$bc,$nationalid,$origin){
		//Require Databse config file
		require 'config.php';

		//add files
		$stmt = $mysqli->prepare("INSERT INTO fileuploads(user_id,passp,bc,nationalid,origin) VALUES(?,?,?,?,?)");
		$stmt->bind_param("issss",$user_id,$passp,$bc,$nationalid,$origin);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_alert($security_id,$message,$priority,$status){
		//Require Databse config file
		require 'config.php';

		//add alerts
		$stmt = $mysqli->prepare("INSERT INTO alerts(security_id,message,priority,status) VALUES(?,?,?,?)");
		$stmt->bind_param("isii",$security_id,$message,$priority,$status);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_report($reporter_id,$incident_type,$description,$status){
		//Require Databse config file
		require 'config.php';

		//add alerts
		$stmt = $mysqli->prepare("INSERT INTO incidents(reporter_id,incident_type,description,status) VALUES(?,?,?,?)");
		$stmt->bind_param("isss",$reporter_id,$incident_type,$description,$status);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}

//update completion of information
function update_case($status,$cls){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE criminal_records SET status = ? WHERE record_id = ?");
		if($stmt===false){
			trigger_error($mysqli->error, E_USER_ERROR);
		}
		$stmt->bind_param("si",$status,$cls);
        if($stmt->execute()){
            return true;
        }else{
            trigger_error($mysqli->error, E_USER_ERROR);
        }
		$result = $stmt->get_result();
		return $result;
}
function update_alert($status,$alert_id){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE alerts SET status = ? WHERE alert_id = ?");
		if($stmt===false){
			trigger_error($mysqli->error, E_USER_ERROR);
		}
		$stmt->bind_param("si",$status,$alert_id);
        if($stmt->execute()){
            return true;
        }else{
            trigger_error($mysqli->error, E_USER_ERROR);
        }
		$result = $stmt->get_result();
		return $result;
}

   function fetch_usr($table,$username){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE username='$username'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function updateStat($pid,$table,$status){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE ".$table." SET status = '$status' WHERE id = '$pid'");
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		$result = $stmt->get_result();
		return $result;
	}

?>