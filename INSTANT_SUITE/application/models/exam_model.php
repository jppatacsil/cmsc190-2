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
		public function addQuestion($category, $type, $questionProper, $points, $answer){
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		}
		
		public function addMCQ($category,$type,$questionProper,$points,$choice,$answer){
		
		//Set the value of the answer according to correct choice
		if($answer == "A"){ $answer = $choice[0]; }
		else if($answer == "B"){ $answer = $choice[1]; }
		else if($answer == "C"){ $answer = $choice[2]; }
		else{ $answer = $choice[3]; }
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'answer' => $answer,
			'credit' => $points,
			'category' => $category,
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
		
		public function addMatching($category,$type,$questionProper,$points,$choice,$answer){
		
		$totalQuestions = count($questionProper); //Count the number of questions
		
		for($i=0;$i<$totalQuestions;$i++){ //Insert all matching questions and answers
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper[$i],
			'answer' => $answer[$i],
			'credit' => $points,
			'category' => $category,
			'matching_id' => $matching_id,
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		}
		
		$question_id = $this->db->query("SELECT question_id from questions WHERE question = '$questionProper[0]';")->row()->question_id;
		
		//Traverse the array of choices to store
			foreach($choice as $choices => $choices_value) {
			$choicesDetails = array(
				'question_id' => $question_id,
				'choice' => $choices_value,
				'matching_id' => $question_id,
			);
			$query = $this->db->insert('choices',$choicesDetails);
			}
		
		}
		
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
		
		public function loadQuestions($email){
			$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
			
			$query = $this->db->query("select questions.question_id, questions.type, questions.question, questions.answer, questions.weight, subject.course_code, subject.section, exam.exam_desc from subject inner join exam on (subject.course_id = exam.course_id) inner join questions on (exam.exam_no = questions.exam_no) where exam.emp_no = '$empNo'");
			return $query->result();
		}
}