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
	function mat_exist($matric, $table){
		//Require Databse config file
		require 'config.php';

		//Sanitize function variables
		$table = secure($table);

		//Check if email exist
		$stmt = $mysqli->prepare("SELECT * FROM ".$table." WHERE matric_no = ?");
		$stmt->bind_param("s", $matric);
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
		$stmt = $mysqli->prepare("DELETE FROM scoresheet WHERE id='$del' LIMIT 1");
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
	function delCom($delc){
		require 'config.php';
		$stmt = $mysqli->prepare("DELETE FROM complaints WHERE complaints_id='$delc' LIMIT 1");
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
		$stmt = $mysqli->prepare("SELECT * FROM lecturer where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['username'];
	}
	function getUsrAdm($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['username'];
	}
	function getLectName($lecturer_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM lecturer where lecturer_id = '$lecturer_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['fullname'];
	}
	function getUsrInfo($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM lecturer where email = '$em' || username = '$em'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getOutstanding($matric_no){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM scoresheet where matric_no = '$matric_no' && (test + exam) < 40 ORDER BY id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getUsrInfoAdm($em){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin where email = '$em' || username = '$em'");
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
		$stmt = $mysqli->prepare("SELECT * FROM lecturer where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getUsrzAdm($username,$email){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM admin where username = '$username' || email = '$email'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getMat($matric){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM students where matric_no = '$matric'");
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
	////fetch complaints
	function getCom($matric_no){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM complaints where matric_no = '$matric_no' ORDER BY complaints_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getComl($lecturer_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM complaints where lecturer_id = '$lecturer_id' ORDER BY complaints_id DESC");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getComCid($complaints_id){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM complaints where complaints_id = '$complaints_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
	function getComStat(){
		//Require Databse config file
		require 'config.php';
        
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM complaints where status = 'pending'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
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
	function add_course($title,$code,$type,$unit){
		//Require Databse config file
		require 'config.php';
		//add user
		$stmt = $mysqli->prepare("INSERT INTO course(title,code,type,unit) VALUES(?,?,?,?)");
		$stmt->bind_param("sssi",$title,$code,$type,$unit);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		$result = $stmt->get_result();
		return $result;
	}
function add_com($lecturer_id, $matric_no, $message,$status){
		//Require Databse config file
		require 'config.php';
		//add user
		$stmt = $mysqli->prepare("INSERT INTO complaints(lecturer_id, matric_no, message,status) VALUES(?,?,?,?)");
		$stmt->bind_param("isss",$lecturer_id, $matric_no, $message, $status);
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
function fetch_lecturer($lecturer_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM lecturer WHERE lecturer_id = '$lecturer_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_lecturer_($lecturer_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM lecturer WHERE lecturer_id = '$lecturer_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['fullname'];
	}
function fetch_result($result_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM scoresheet WHERE result_id = '$result_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_std_result($matric_no){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM scoresheet WHERE matric_no = '$matric_no' ORDER BY session, semester, level");
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			// Initialize array to store results by session and semester
			$groupedResults = [];
			$cgpa = 0;
			$count = 0;
			// Process each row
			while ($row = $result->fetch_assoc()) {
				// Group by session and semester
				$groupedResults[$row['session']][$row['semester']][] = $row;
			}
		
			// Loop through each session and semester to generate tables
			foreach ($groupedResults as $session => $semesters) {
				foreach ($semesters as $semester => $results) {
					echo "<h4>Session: $session | Semester: $semester</h4>";
					echo "<table border='1' class='table table-hoverable'>
							<tr style='background-color: #0F96F9;'>
								<th style='color: white;'>Course</th>
								<th style='color: white;'>Level</th>
								<th style='color: white;'>Exam</th>
								<th style='color: white;'>Test</th>
								<th style='color: white;'>Total</th>
								<th style='color: white;'>Grade</th>
							</tr>";
		
					$totalPoints = 0;
					$totalUnits = count($results); // assuming each course has 1 unit; adjust accordingly
		
					foreach ($results as $result) {
						$course = $result['course_code']; 
						$level = $result['level']; 
						$exam = $result['exam'];
						$test = $result['test'];
						$total = $exam + $test;
						if ($total >= 70) {
							$grade =  'A';
							$points =  '5';
						} elseif ($total >= 60) {
							$grade =  'B';
							$points =  '4';
						} elseif ($total >= 50) {
							$grade =  'C';
							$points =  '3';
						} elseif ($total >= 45) {
							$grade =  'D';
							$points =  '2';
						} elseif ($total >= 40) {
							$grade =  'E';
							$points =  '1';
						} else {
							$grade = 'F';
							$points =  '0';
						}
						// Sum points
						$totalPoints += $points;
		
						// Display each result
						echo "
						<tr>
								<td>$course</td>
								<td>$level</td>
								<td>$exam</td>
								<td>$test</td>
								<td>$total</td>
								<td>$grade</td>
							  </tr>";
					}
		
					// Calculate GPA
					$gpa = $totalPoints / $totalUnits;
					$count = $count + 1;
					$cgpa += $gpa;
					// Display GPA at the bottom of the table
					echo "
					<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><strong style='color: #0F96F9;'>GPA: 
							" . number_format($gpa, 2) . "</strong></td>
						  </tr>";
					echo "</table><br><br><p></p><p></p>";
				}
			}
			echo '<h4 style="color: #0F96F9;">Final CGPA: '.number_format($cgpa/$count, 2).'</h4>';
		} else {
			echo "No results found for MatricNo: $matric_no";
		}
	}
	function fetch_std_gp($matric_no){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM scoresheet WHERE matric_no = '$matric_no' ORDER BY session, semester, level");
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			// Initialize array to store results by session and semester
			$groupedResults = [];
			$cgpa = 0;
			$count = 0;
			// Process each row
			while ($row = $result->fetch_assoc()) {
				// Group by session and semester
				$groupedResults[$row['session']][$row['semester']][] = $row;
			}
		
			// Loop through each session and semester to generate tables
			foreach ($groupedResults as $session => $semesters) {
				foreach ($semesters as $semester => $results) {
					echo "<h4>Session: $session | Semester: $semester</h4>";
					echo "<table border='1' class='table table-hoverable'>
							";
		
					$totalPoints = 0;
					$totalUnits = count($results); // assuming each course has 1 unit; adjust accordingly
		
					foreach ($results as $result) {
						$course = $result['course_code']; 
						$level = $result['level']; 
						$exam = $result['exam'];
						$test = $result['test'];
						$total = $exam + $test;
						if ($total >= 70) {
							$grade =  'A';
							$points =  '5';
						} elseif ($total >= 60) {
							$grade =  'B';
							$points =  '4';
						} elseif ($total >= 50) {
							$grade =  'C';
							$points =  '3';
						} elseif ($total >= 45) {
							$grade =  'D';
							$points =  '2';
						} elseif ($total >= 40) {
							$grade =  'E';
							$points =  '1';
						} else {
							$grade = 'F';
							$points =  '0';
						}
						// Sum points
						$totalPoints += $points;
		
					}
		
					// Calculate GPA
					$gpa = $totalPoints / $totalUnits;
					$count = $count + 1;
					$cgpa += $gpa;
					// Display GPA at the bottom of the table
					echo "
					<tr>
							
							
							<td><strong style='color: #570861;'>GPA: 
							" . number_format($gpa, 2) . "</strong></td>
						  </tr>";
					echo "</table><br><p></p>";
				}
			}
			echo '<h4 style="color: #570861;">Final CGPA: '.number_format($cgpa/$count, 2).'</h4>';
		} else {
			echo "No results found for MatricNo: $matric_no";
		}
	}
function fetch_cgpa($matric_no){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM scoresheet WHERE matric_no = '$matric_no' ORDER BY session, semester, level");
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			// Initialize array to store results by session and semester
			$groupedResults = [];
			$cgpa = 0;
			$count = 0;
			// Process each row
			while ($row = $result->fetch_assoc()) {
				// Group by session and semester
				$groupedResults[$row['session']][$row['semester']][] = $row;
			}
		
			// Loop through each session and semester to generate tables
			foreach ($groupedResults as $session => $semesters) {
				foreach ($semesters as $semester => $results) {
					$totalPoints = 0;
					$totalUnits = count($results); // assuming each course has 1 unit; adjust accordingly
		
					foreach ($results as $result) {
						$course = $result['course_code']; 
						$level = $result['level']; 
						$exam = $result['exam'];
						$test = $result['test'];
						$total = $exam + $test;
						if ($total >= 70) {
							$grade =  'A';
							$points =  '5';
						} elseif ($total >= 60) {
							$grade =  'B';
							$points =  '4';
						} elseif ($total >= 50) {
							$grade =  'C';
							$points =  '3';
						} elseif ($total >= 45) {
							$grade =  'D';
							$points =  '2';
						} elseif ($total >= 40) {
							$grade =  'E';
							$points =  '1';
						} else {
							$grade = 'F';
							$points =  '0';
						}
						// Sum points
						$totalPoints += $points;
		
					}
		
					// Calculate GPA
					$gpa = $totalPoints / $totalUnits;
					$count = $count + 1;
					$cgpa += $gpa;
				}
			}
			echo number_format($cgpa/$count, 2);
		} else {
			echo "No results found for MatricNo: $matric_no";
		}
	}
function fetch_uresult($lecturer_id){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM scoresheet WHERE lecturer_id = '$lecturer_id'");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_course_code(){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM course");
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}
function fetch_course($course_code){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM course WHERE code = '$course_code'");
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		return $data['course_id'];
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
function fetch_u_data($matric_no){
		//Require Databse config file
		require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("SELECT * FROM students WHERE matric_no = '$matric_no'");
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
function add_result($matric_no, $semester, $session, $level, $test, $exam, $lecturer_id, $course_code){
		//Require Databse config file
		require 'config.php';

		//add alerts
		$stmt = $mysqli->prepare("INSERT INTO scoresheet(matric_no, semester, session, level, test, exam, lecturer_id, course_code) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssiiiis",$matric_no, $semester, $session, $level, $test, $exam, $lecturer_id, $course_code);
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
function update_res($matric_no, $semester, $session, $test, $exam, $result_id){
	//Require Databse config file
	require 'config.php';
	$stmt = $mysqli->prepare("UPDATE scoresheet SET matric_no = '$matric_no', semester = '$semester', session = '$session', test = '$test', exam = '$exam' WHERE id = '$result_id'");
	if($stmt->execute()){
		return true;
	}else{
		return false;
	}
	$result = $stmt->get_result();
	return $result;
}
function update_com($complaints_id, $feedback, $status){
	//Require Databse config file
	require 'config.php';
	$stmt = $mysqli->prepare("UPDATE complaints SET feedback = '$feedback', status = '$status' WHERE complaints_id = '$complaints_id'");
	if($stmt->execute()){
		return true;
	}else{
		return false;
	}
	$result = $stmt->get_result();
	return $result;
}
function update_prof($fullname, $email, $user_id){
	//Require Databse config file
	require 'config.php';
	$stmt = $mysqli->prepare("UPDATE lecturer SET fullname = '$fullname', email = '$email' WHERE lecturer_id = '$user_id'");
	if($stmt->execute()){
		return true;
	}else{
		return false;
	}
	$result = $stmt->get_result();
	return $result;
}
function update_prof_std($fullname, $email, $user_id){
	//Require Databse config file
	require 'config.php';
	$stmt = $mysqli->prepare("UPDATE students SET fullname = '$fullname', email = '$email' WHERE matric_no = '$user_id'");
	if($stmt->execute()){
		return true;
	}else{
		return false;
	}
	$result = $stmt->get_result();
	return $result;
}
function update_rec($status,$alert_id){
    require 'config.php';
		//fetch all user
		$stmt = $mysqli->prepare("UPDATE scoresheet SET status = ?, matric_no = ?, semester = ?, exam = ?, test = ? WHERE result_id = ?");
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