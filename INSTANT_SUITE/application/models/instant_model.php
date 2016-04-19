<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Instant_model extends CI_Model{

		public function __construct(){
        	parent::__construct();
    	}
	
		public function loadData($email_address, $password){ //for login_validation
			
			echo $email_address;
			echo $password;

			$query = $this->db->get_where('user', array('email_address' => $email_address));
			 $row = $query->row(); 
			 echo $row->email_address;
			 echo $row->password;

			if ($query->num_rows() > 0)
			{
				

				if((strcmp($password, $row->password)!=0)||(strcmp($email_address, $row->email_address)!=0)){

					echo "wrong password or email";
					return false;
				}
				else{
				   $row = $query->row(); 

				   //echo $row->email_address;
				   //echo $row->password;
				   return $row;
				}
			}
			else{
				//echo "false";
				return false;
			}

			
		}
		
		
		
		public function can_log_in(){
			$this->db->where('email_address', $this->input->post('email'));
			$this->db->where('password', ($this->input->post('password')));
			
			
			$query = $this->db->get('user');
			
			if($query->num_rows()==1){ //if it found a user
				return true;
			}
			else{
				return false;
			}
		}
		
				
		public function is_key_valid($key){ //checks if the key is valid when user confirms via email
			$this->db->where('key', $key);
			$query = $this->db->get('temp_users');
			
			if($query->num_rows()==1){
				return true;
			}else return false;
		}
		
		public function add_user(){ //adds the user to the permanent users db and deletes the data in the temp_users
			$userData = array(
				'lastName' => $this->input->post('lastName'),
				'firstName' => $this->input->post('firstName'),
				'middleName' => $this->input->post('middleName'),
				'email_address' => $this->input->post('email_address_signup'),
				'password' => md5($this->input->post('password_signup')),
				'type' => $this->input->post('type'),
			);

			$query = $this->db->insert('user', $userData);
			
			$teacherData = array(
				'emp_no' => $this->input->post('empNo'),
				'email_address' => $this->input->post('email_address_signup')
			);
			
			$query = $this->db->insert('teacher', $teacherData);
			
			return true;
			/*$this->db->where('key', $key);
			$temp_user = $this->db->get('temp_users');
			
			if($temp_user){
					$row = $temp_user->row();
					
					$data = array(
						'email' => $row->email,
						'password' => $row->password,
						'lastName' => $row->lastName,
						'firstName' => $row->firstName,
						'dept' => $row->dept,
						'college' => $row->college,
						'user_id' => $row->user_id,
						'key' => $key
					);
					
					$did_add_user = $this->db->insert('users', $data);
			}
			if($did_add_user){
				$this->db->where('key', $key);
				$this->db->delete('temp_users');
				return $data['email'];
			}return false;*/
			
		}
		
		public function edit_user($email, $data){ //updates the user details with the new data
			
			$this->db->where('email', $email);
			$query=$this->db->update('users', $data); 
			
			if($query){			
				return true;
			}
			else{
				return false;
			}
		}
		
		/*public function create_class($data){ //creates classes with the data
			$query = $this->db->insert('subject', $data);
			if($query){
				return true;
			}
			else{
				return false;
			}
		}*/

		public function create_class($email, $courseCode, $courseTitle, $section, $classCode){
			$classData = array(
				'email_address' => $email,
				'course_code' => $courseCode,
				'course_title' => $courseTitle,
				'section' => $section,
				'classCode' => $classCode
			);

			$query = $this->db->insert('subject', $classData);

			return true;

		}
		
		public function loadClasses($email){ //loads classes of the user
			
			//$query = $this->db->query("SELECT * FROM subject WHERE email_address='$email';");
			$query = $this->db->get_where('subject', array('email_address' => $email));
			if ($query->num_rows() > 0)
			{
			    
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		/*public function loadClass($id){ //loads a specific class
			$query = $this->db->query("SELECT * FROM classes WHERE id='$id';");
			
			if ($query->num_rows() > 0)
			{
			    
			   return $query->result();
			}
			else{
				return false;
			}
		}*/

		public function loadClass($classCode){ //loads a specific class
			//$query = $this->db->query("SELECT * FROM classes WHERE id='$id';");
			$query = $this->db->get_where('subject', array('classCode' => $classCode));
			if ($query->num_rows() > 0)
			{
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function deleteClass($class_id){ //deletes a class from the database
			$this->db->where('id', $class_id);
			$query = $this->db->delete('classes');
			
			if($query){
				return true;
			}
			else{
				return false;
			}
			
		}
		
		public function editClass($class_id, $data){ //edits class with the new data
			$this->db->where('id', $class_id);
			$query=$this->db->update('classes', $data); 
			
			if($query){			
				return true;
			}
			else{
				return false;
			}
		}
		
		public function removeFromList($class_id){ //removes class from user's list, not in database
			$newData = array(
				'email' => null
			);
			$this->db->where('id', $class_id);
			$query=$this->db->update('classes', $newData); 
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function addStudent($data){ //adds student on the database
			$query = $this->db->insert('students', $data);
			
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function loadStudents($id){ //loads list of students
			$query = $this->db->query("SELECT * FROM students WHERE class_id='$id' ORDER BY lastName ASC;");
			
			if ($query->num_rows() > 0)
			{
			    
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function getStudent($stdNo){ //gets the student
			$query = $this->db->query("SELECT * FROM students WHERE stdNo='$stdNo';");
			if ($query->num_rows() > 0)
			{
			    
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function saveSeatPlan($id){ //saves permanent
			$query = $this->db->insert('seatplan', $id);
			
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function createSeatPlan($seat_id, $class_id, $x, $y){ //part of ajax functionality, once the circle is clicked, its details are saved to the database
			$data = array(
				'class_id' => $class_id,
				'stdNo' => NULL,
				'circle_id' => $seat_id,
				'position_x' => $x,
				'position_y' => $y
			);
			
			$query = $this->db->insert('temp_seatplan', $data);
			
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function loadUnseatedStudents($id){ //gets students that are still unseated
			$query = $this->db->query("SELECT * FROM students WHERE class_id='$id' AND seated is NULL;");
			
			if ($query->num_rows() > 0)
			{
			    
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function saveStudentToSeat($seat_id, $stdNo, $tableName, $class_id){ //saves the student to the seat (arrange students)
			$this->db->where('stdNo', $stdNo);
			$this->db->where('class_id', $class_id);
			$seat = array( //the student is now seated
				'seated' => 1
			);
			$this->db->update('students', $seat);
		
			$this->db->where('circle_id', $seat_id);
			$this->db->where('class_id', $class_id);
			$data = array(
				'stdNo' => $stdNo //the student is seated according the id of the circle
			);
			
			//$this->db->update('temp_seatplan', $data);
			$this->db->update($tableName, $data);
		
		}
		
		public function getOccupiedSeats($id, $table){ //gets seats that are already occupied
			$query = $this->db->query("SELECT * FROM $table WHERE class_id = '$id';");
			
			if ($query->num_rows() > 0)
			{
			    
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function finalizeSeatPlan($class_id){ //seat plan is finalized
			$query = $this->db->query("INSERT INTO seatplan SELECT * FROM temp_seatplan WHERE class_id = '$class_id';");
			
			$this->db->where('class_id', $class_id);
			$this->db->delete('temp_seatplan');
			if($query){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function viewSeatPlan($class_id){ //view the final seat plan, including the arrangements of the students
			$query = $this->db->query("SELECT * FROM seatplan WHERE class_id = '$class_id';");
			
			if ($query->num_rows() > 0)
			{
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		public function deleteSeatPlan($class_id){ //deletes seat plan
			$this->db->where('class_id', $class_id);
			$this->db->delete('seatplan'); 
			
			$data = array(
               'seated' => NULL
            );

			$this->db->where('class_id', $class_id);
			$this->db->update('students', $data);
		}
		

		public function getMinimum($value, $table, $col, $class_id){ //gets minimum last name
		
			//$seat=$this->model_users->getMinimum('circle_id','seatplan','stdNo', $class_id);
			
			$query = $this->db->query("SELECT MIN($value) AS dataName FROM $table WHERE $col is NULL AND class_id='$class_id';");
			
			if ($query->num_rows() > 0)
			{
			    
			   return $query->row();
			}
			else{
				return false;
			}
		
		}
		
		public function assignStudentAlphabetically($lastName, $circle_id, $class_id){ //assigns student alphabetically
		
			$query = $this->db->query("SELECT * from students WHERE lastName = '$lastName' AND class_id='$class_id';");
			
			$this->saveStudentToSeat($circle_id, $query->row()->stdNo, 'seatplan', $class_id);
		}
		
		public function viewAbsences($stdNo){
		
			$query = $this->db->query("SELECT * from absences WHERE stdNo = '$stdNo';");
			if($query->num_rows() > 0){
				return $query->result();
			}
			else{
				return false;
			}
		}
}