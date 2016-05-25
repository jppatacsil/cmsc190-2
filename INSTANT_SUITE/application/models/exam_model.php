<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class exam_model extends CI_Model{

		public function __construct(){
        	parent::__construct();
    	}
		
		/*************************_FUNCTIONS FOR EXAM CREATION AND QUESTIONS_**************************/
				
		//Bank the exam in the table
		public function createExam($desc, $date, $total, $scoreTotal, $duration, $category, $totalItems, $difficulty, $courseCode, $email){
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		$courseID = $this->db->query("SELECT course_id from subject WHERE course_code = '$courseCode';")->row()->course_id;
		
		//Insert to exam
		$examDetails = array(
				'exam_desc' => $desc,
				'exam_date' => $date,
				'total_items' => $total,
				'total_score' => $scoreTotal,
				'duration' => $duration,
				'emp_no' => $empNo,
				'course_id' => $courseID,
			);
			
			$query = $this->db->insert('exam', $examDetails);
			$exam_no = $this->db->insert_id(); //Get the last inserted exam_no

		//Insert to template
		for($i=0;$i<count($category);$i++){
			$templateDetails = array(
				'exam_no' => $exam_no,
				'category' => $category[$i],
				'no_of_item' => $totalItems[$i],
				'difficulty' => $difficulty[$i],
			);
			
			$query = $this->db->insert('template',$templateDetails);
		}

		}
		
		//Bank the questions fill-in-the-blank and identification
		public function addQuestion1($email, $category, $type, $questionProper, $points, $answer, $cons1, $cons2, $consAns){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		
		//Check the considerations to be considered
		if($cons1 == 1 || $cons2 == 2){
			$consideration = 1; //Question considers other answers
		}else{
			$consideration = 0;
		}

		$answer = strtolower($answer);

		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			'consideration' => $consideration, 
			);

		//Check if question already exists before inserting
		$existing = $this->db->query("SELECT type, question, answer, credit, category, emp_no, consideration 
			FROM questions 
			WHERE type = '$type'
			AND question = '$questionProper'
			AND answer = '$answer'
			AND credit = '$points'
			AND category = '$category'
			AND emp_no = '$empNo'
			AND consideration = '$consideration'
			;");

			if ($existing->num_rows() > 0) //If already existing
			{
			   $exists = true;
			}
			else{
				$exists = false;
			}
			
			if($exists == false){ //Insert if not yet existing
				$query = $this->db->insert('questions',$questionDetails);
			}else{
				return $exists;
			}

			if($consideration != 0){
			$question_id = $this->db->insert_id(); //Get the last inserted exam_no
			$totalConsiderations = count($consAns); //Count the number of considered answers

			$txtfile = $_SERVER['DOCUMENT_ROOT']."INSTANT_SUITE/consideredAnswers/".$question_id."considerations.txt";

			//Save the answers to a personal dictionary textfile based on the question_id
			$myfile = fopen($txtfile, "a") or die("Unable to open file!");
			for($i=0;$i<$totalConsiderations;$i++){
				$txt = strtolower($consAns[$i]);
				fwrite($myfile, PHP_EOL.$txt);
			}
			fclose($myfile);
		}
		
		}

		//Bank the tf
		public function addQuestion2($email, $category, $type, $questionProper, $points, $answer){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;

		$answer = strtolower($answer);
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			);

		//Check if question already exists before inserting
		$existing = $this->db->query("SELECT type, question, answer, credit, category, emp_no 
			FROM questions 
			WHERE type='$type'
			AND question='$questionProper'
			AND answer = '$answer'
			AND credit = '$points'
			AND category = '$category'
			AND emp_no = '$empNo'
			;");

			if ($existing->num_rows() > 0) //If already existing
			{
			   $exists = true;
			}
			else{
				$exists = false;
			}

		if($exists == false){
			$query = $this->db->insert('questions',$questionDetails);
		}else{
			return $exists;
		}

		}
		
		//Function to add multiple choice questions
		public function addMCQ($email,$category,$type,$questionProper,$points,$choice,$answer){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		$answer = strtolower($answer);

		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			);
			
			//Check if question already exists before inserting
			$existing = $this->db->query("SELECT type, question, answer, credit, category, emp_no 
				FROM questions 
				WHERE type='$type'
				AND question='$questionProper'
				AND answer = '$answer'
				AND credit = '$points'
				AND category = '$category'
				AND emp_no = '$empNo'
				;");

				if ($existing->num_rows() > 0) //If already existing
				{
				   $exists = true;
				}
				else{
					$exists = false;
				}

			if($exists == false){ //If not yet existing
				$query = $this->db->insert('questions',$questionDetails);
			}else{
				return $exists;
			}
		
		$question_id = $this->db->query("SELECT question_id from questions WHERE question = '$questionProper';")->row()->question_id;
		
		//Traverse the array of choices to store
			foreach($choice as $choices => $choices_value) {
			$choicesDetails = array(
				'question_id' => $question_id,
				'choice' => strtolower($choices_value),
			);
			$query = $this->db->insert('choices',$choicesDetails);
			}
		}
		
		//Function to add matching type questions
		public function addMatching($email,$category,$type,$questionProper,$points,$choice,$answer){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		$totalQuestions = count($questionProper); //Count the number of questions
		
		for($i=0;$i<$totalQuestions;$i++){ //Insert all matching questions and answers
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper[$i],
			'answer' => strtolower($answer[$i]),
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			);
			
			$this->db->insert('questions',$questionDetails);
			$question_id = $this->db->query("SELECT question_id FROM questions WHERE question = '$questionProper[0]';")->row()->question_id;
			$currQuestion = $questionProper[$i];
			$this->db->query("UPDATE questions SET matching_id='$question_id' WHERE question = '$currQuestion';");
		}
		
		//Traverse the array of choices to store
			foreach($choice as $choices => $choices_value) {
			$choicesDetails = array(
				'question_id' => $question_id,
				'choice' => strtolower($choices_value),
			);
			$query = $this->db->insert('choices',$choicesDetails);
			}
		
		}
		
		//Function to load exam
		public function loadExams($email){
		
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
			
			$query = $this->db->query("select * from subject inner join exam on (subject.course_id = exam.course_id) where exam.emp_no = '$empNo'");
			if ($query->num_rows() > 0)
			{
			   return $query->result();
			}
			else{
				return false;
			}
		}
		
		//Function to load the categories of questions present in the database
		public function loadCategories($email){
		
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
			
			$query = $this->db->query("SELECT DISTINCT category from questions WHERE emp_no = '$empNo';");
			
			if($query->num_rows() > 0){
				return $query->result();
			}
			else{
				return false;
			}
		}
		
		//Function to delete exam
		public function deleteExam($exam_no){
			$this->db->where('exam_no', $exam_no);
			$this->db->delete('exam');
		}
		
		//Function to edit exam
		public function editExam($exam_no){
			$query = $this->db->query("select * from exam inner join subject on (exam.course_id = subject.course_id) where exam_no = '$exam_no'");
			return $query->result();
		}
		
		//Bank the exam in the table
		public function updateExam($desc, $date, $total, $category, $totalItems, $difficulty, $courseCode, $email, $exam_no, $scoreTotal, $duration){
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		
			//Insert to exam
			$query = $this->db->query("update exam set exam_desc='$desc' , exam_date='$date', total_items='$total', duration='$duration', total_score='$scoreTotal' where exam_no = '$exam_no'");

			//Insert to template
			$query = $this->db->query("delete from template where exam_no = '$exam_no'");
			for($i=0;$i<count($category);$i++){
				if($totalItems[$i] != 0){
				$templateDetails = array(
					'exam_no' => $exam_no,
					'category' => $category[$i],
					'no_of_item' => $totalItems[$i],
					'difficulty' => $difficulty[$i],
				);
				
				$query = $this->db->insert('template',$templateDetails);
				}
			}
		}
		
		//Function to get category
		public function getCategory($exam_no){
			$query = $this->db->query("select * from template where exam_no = '$exam_no'");
			return $query->result();
		}
		
		//Function to load questions
		public function loadQuestions($email){
			
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
			
			$query = $this->db->query("select * from questions where emp_no = '$empNo'");
			return $query->result();
		}
		
		//Function to filter questions
		public function filterQuestions($email, $type, $category, $difficulty){
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
			if($type != 0)$filterType = "and type=$type";
			else $filterType ="";
			if($category != 'ALL')$filterCategory = "and category='$category'";
			else $filterCategory ="";
			if($difficulty != 0)$filterDifficulty = "and credit=$difficulty";
			else $filterDifficulty ="";
			$query = $this->db->query("select * from questions where emp_no = '$empNo' $filterType $filterCategory $filterDifficulty");
			return $query->result();
		}
		
		//Function to delete question
		public function deleteQuestion($question_id){
			$this->db->where('question_id', $question_id);
			$this->db->delete('questions');
		}
		
		public function editQuestion($question_id){
			$query = $this->db->query("select * from questions where question_id = '$question_id'");
			return $query->result();
		}

		/*******************************__FUNCTIONS FOR TAKE EXAM__*********************************/

		public function saveExamSet($examKey, $exam_no, $student_no){

			$query = $this->db->query("select * from template WHERE exam_no = '$exam_no';"); //get the exam template
			$i = 0;//counter
			foreach ($query->result() as $row) //fetch the result of the template query
			{
				//Get questions based from the template
			    $randQuestions = $this->getQuestions($row->category, $row->no_of_item, $row->difficulty);

			    foreach($randQuestions as $row2){ //fetch the questions that were randomly chosen to fill exam set
					$question_id = $row2->question_id;
					if($i == 0){
						$stat = "t";
					}else{
						$stat = "f";
					}
			    	$examSetDetails = array( //the exam set details
					'exam_key' => $examKey,
					'exam_no' => $exam_no,
					'student_no' => $student_no,
					'question_id' => $question_id,
					'score' => 0,
					'active_item' => $stat,
					);

					$this->db->insert('exam_set', $examSetDetails); //save copy of exam set of student	
					$i = $i + 1;
			    }  
			}

			//Get the examSet of student with respective examKey
			$query = $this->db->query("select * from exam_set inner join questions on exam_set.question_id = questions.question_id WHERE exam_set.exam_key = '$examKey' ORDER BY exam_set.exam_set_id;");

			return $query->result();
		}

		/***************************************************************************************/
		//GETTER FUNCTIONS FOR FETCHING DATA

		public function getKey($examKey){ //Get the exam key entered by student
			$query = $this->db->query("select exam_key from keys WHERE exam_key = '$examKey';");

			if($query->num_rows() > 0){
				return $query->result();
			}
			else{
				return false;
			}
		}

		public function getExaminee($student_no){ //Get the examinee details
			$query = $this->db->query("select * from student WHERE student_no = '$student_no';");
			return $query->result();
		}

		public function getExamNo($examKey){ //Get the exam no referenced from the keys
			$query = $this->db->query("select exam_no from keys WHERE exam_key = '$examKey';");
			return $query->result();
		}

		public function getExamDetails($exam_no){ //Get the exam details
			$query = $this->db->query("select * from exam WHERE exam_no = '$exam_no';");
			return $query->result();
		}

		public function getQuestions($category, $totalItems, $difficulty){ //Get random questions based on template
			$query = $this->db->query("select question_id from questions WHERE category = '$category' AND credit = '$difficulty' ORDER BY RANDOM() LIMIT $totalItems;");
			return $query->result();
		}

		public function getChoices($examKey){ //Get choices from the generated MCQ and Matching questions in the exam_set
			$query = $this->db->query("SELECT *
			FROM choices
			LEFT JOIN exam_set ON (exam_set.question_id = choices.question_id)
			WHERE exam_set.exam_key = '$examKey'
			ORDER BY RANDOM();");

			return $query->result();
		}

		public function getMatching($examKey){ //Get all the matching type questions
			$query = $this->db->query("SELECT *
			FROM questions
			INNER JOIN exam_set ON (questions.question_id = exam_set.question_id)
			WHERE exam_set.exam_key = '$examKey' AND questions.type = 3
			ORDER BY questions.question_id;");

			return $query->result();
		}

		public function getTimeLeft($examKey){ //Get all the matching type questions
			$query = $this->db->query("select * from logs where exam_key='$examKey'");

			return $query->result();
		}
		
		public function checkIfUsed($examKey){ //check if the exam_key has already been activated
			$query = $this->db->query("select * from exam_set where exam_key = '$examKey';");
			
			if($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

		public function checkResults($examKey){ //check if there is already a result
			$query = $this->db->query("SELECT DISTINCT total_score from results WHERE exam_key = '$examKey';");
			if($query->num_rows() > 0){
				return $query->row()->total_score;
			}else{
				return false;
			}
		}

		public function next_item($examKey, $next_item, $timeleft){
			$this->db->query("update logs set time_left='$timeleft' where exam_key='$examKey'");
			$this->db->query("update exam_set set active_item='f' where exam_key='$examKey'");
			$this->db->query("update exam_set set active_item='t' where exam_key='$examKey' and question_id='$next_item'");
		}

		public function reloadExamSet($examKey){ //if exam_key is already existent in exam_set, just reload the exam
			$query = $this->db->query("SELECT * from exam_set 
					inner join questions on (exam_set.question_id = questions.question_id) 
					WHERE exam_set.exam_key = '$examKey'
					ORDER BY exam_set.exam_set_id;");
					
			return $query->result();
		}

		public function reloadExamDetails($examKey){
			$query = $this->db->query("SELECT distinct exam_no, student_no from exam_set WHERE exam_key = '$examKey';");

			return $query->result();
		}
}