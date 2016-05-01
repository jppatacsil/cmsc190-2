<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class exam_model extends CI_Model{

		public function __construct(){
        	parent::__construct();
    	}
		
		/*************************_FUNCTIONS FOR EXAM CREATION AND QUESTIONS_**************************/
				
		//Bank the exam in the table
		public function createExam($desc, $date, $total, $duration, $category, $totalItems, $difficulty, $courseCode, $email){
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		$courseID = $this->db->query("SELECT course_id from subject WHERE course_code = '$courseCode';")->row()->course_id;
		
		//Insert to exam
		$examDetails = array(
				'exam_desc' => $desc,
				'exam_date' => $date,
				'total_items' => $total,
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
		
		//Bank the question according to type
		public function addQuestion1($email, $category, $type, $questionProper, $points, $answer, $cons1, $cons2, $consAns){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		
		//Check the considerations to be considered
		if($cons1 == 1 && $cons2 == 2){
			$consideration = 3; //Both spelling and synonyms
		}
		else if($cons1 == 1){
			$consideration = 1; //Spelling errors only
		}
		else{
			$consideration = 2; //Synonyms only
		}

		$totalConsiderations = count($consAns); //Count the number of considered answers

		//Save the answers to a personal dictionary textfile
		$myfile = fopen("consideredAnswers.txt", "a") or die("Unable to open file!");
		for($i=0;$i<$totalConsiderations;$i++){
			$txt = strtolower($consAns[$i]);
			fwrite($myfile, PHP_EOL.$txt);
		}
		fclose($myfile);

		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => strtolower($answer),
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			'consideration' => $consideration, 
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		}

		//Bank the question according to type
		public function addQuestion2($email, $category, $type, $questionProper, $points, $answer){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		}
		
		//Function to add multiple choice questions
		public function addMCQ($email,$category,$type,$questionProper,$points,$choice,$answer){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
			'emp_no' => $empNo,
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		$question_id = $this->db->query("SELECT question_id from questions WHERE question = '$questionProper';")->row()->question_id;
		
		//Traverse the array of choices to store
			foreach($choice as $choices => $choices_value) {
			$choicesDetails = array(
				'question_id' => $question_id,
				'choice' => $choices_value,
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
			'answer' => $answer[$i],
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
				'choice' => $choices_value,
			);
			$query = $this->db->insert('choices',$choicesDetails);
			}
		
		}
		
		//Function to load exam
		public function loadExams($email){
		
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
			
			$query = $this->db->query("select subject.course_code, subject.section, exam.exam_no, exam.exam_desc, exam_date, exam.total_items, subject.section from subject inner join exam on (subject.course_id = exam.course_id) where exam.emp_no = '$empNo'");
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
		public function updateExam($desc, $date, $total, $category, $totalItems, $difficulty, $courseCode, $email, $exam_no){
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		
			//Insert to exam
			$query = $this->db->query("update exam set exam_desc='$desc' , exam_date='$date', total_items='$total' where exam_no = '$exam_no'");

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
			
			/*$query = $this->db->query("select questions.question_id, questions.type, questions.question, questions.answer, questions.weight, subject.course_code, subject.section, exam.exam_desc from subject inner join exam on (subject.course_id = exam.course_id) inner join questions on (exam.exam_no = questions.exam_no) where exam.emp_no = '$empNo'");*/
			$query = $this->db->query("select * from questions where emp_no = '$empNo'");
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

		public function getExaminee(){
			$query = $this->db->query("select * from student;");
			return $query->result();
		}

		public function getItems(){
			$query = $this->db->query("select SUM(no_of_item) from template where key = 'CMSC11-asd1212345';");
			return $query->result();
		}

}