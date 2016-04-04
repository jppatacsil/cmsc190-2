<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class exam_model extends CI_Model{

		public function __construct(){
        	parent::__construct();
    	}
		
		
		/*************************_FUNCTIONS FOR EXAM CREATION AND QUESTIONS_**************************/
				
		//Bank the exam in the table
		public function createExam($desc, $date, $total, $courseCode, $email){
		
		$empNo = $this->db->query("SELECT emp_no from teacher WHERE email_address = '$email';")->row()->emp_no;
		$courseID = $this->db->query("SELECT course_id from subject WHERE course_code = '$courseCode';")->row()->course_id;
		
		$examDetails = array(
				'exam_desc' => $desc,
				'exam_date' => $date,
				'total_items' => $total,
				'emp_no' => $empNo,
				'course_id' => $courseID,
			);

			$query = $this->db->insert('exam', $examDetails);

		}
		
		//Bank the question according to type
		public function addQuestion($type, $questionProper, $points, $answer){
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'weight' => $points,
			'answer' => $answer,
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		}
		
		public function addMCQ($type,$questionProper,$points,$choice1,$choice2,$choice3,$choice4,$answer){
		
		$questionDetails = array(
			'type' => $type,
			'question' => $questionProper,
			'weight' => $points,
			'answer' => $answer,
			);
			
		$query = $this->db->insert('questions',$questionDetails);
		
		$question_id = $this->db->query("SELECT question_id from questions WHERE question = '$questionProper';")->row()->question_id;
		
		$choicesDetails = array(
			'question_id' => $question_id,
			'choice1' => $choice1,
			'choice2' => $choice2,
			'choice3' => $choice3,
			'choice4' => $choice4,
		);
		
		$query = $this->db->insert('choices',$choicesDetails);
		
		}
}