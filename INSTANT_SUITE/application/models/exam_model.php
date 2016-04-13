<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class exam_model extends CI_Model{

		public function __construct(){
        	parent::__construct();
    	}
		
		/*************************_FUNCTIONS FOR EXAM CREATION AND QUESTIONS_**************************/
				
		//Bank the exam in the table
		public function createExam($desc, $date, $total, $category, $totalItems, $difficulty, $courseCode, $email){
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		$courseID = $this->db->query("SELECT course_id from subject WHERE course_code = '$courseCode';")->row()->course_id;
		
		//Insert to exam
		$examDetails = array(
				'exam_desc' => $desc,
				'exam_date' => $date,
				'total_items' => $total,
				'emp_no' => $empNo,
				'course_id' => $courseID,
			);
			
			$query = $this->db->insert('exam', $examDetails);
			$exam_no = $this->db->query("SELECT exam_no from exam WHERE exam_desc = '$desc';")->row()->exam_no;

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
		public function addQuestion($email, $category, $type, $questionProper, $points, $answer){
		
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
			
		$query = $this->db->insert('questions',$questionDetails);
		
		}
		
		$question_id = $this->db->query("SELECT question_id from questions WHERE question = '$questionProper["$i"]';")->row()->question_id;
		
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
				$templateDetails = array(
					'exam_no' => $exam_no,
					'category' => $category[$i],
					'no_of_item' => $totalItems[$i],
					'difficulty' => $difficulty[$i],
				);
				
			$query = $this->db->insert('template',$templateDetails);
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
}