<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class checker extends CI_Controller {

	//Function to submit answer of student
	public function submitAnswer(){
		$type = $this->uri->segment(3);

		$exam_no = $this->input->post('exam_no');
		$stud_no = $this->input->post('stud_no');
		$question_id = $this->input->post('question_id');
		$student_answer = $this->input->post('student_answer');
		$score = $this->input->post('score');

		$this->load->model('checker_model');
		$this->checker_model->saveAnswer($type, $exam_no, $stud_no, $question_id, $student_answer, $score);

		redirect('/take_exam/examPage');
	}

	//Function to get results of exam
	public function showResults(){

		$exam_no = $this->input->post('exam_no');
		$exam_desc = $this->input->post('exam_desc');
		$student_no = $this->input->post('student_no');
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$total_score = $this->input->post('total_score');
		$computedScore = $this->input->post('computedScore');

		$data = array(
			'exam_desc' => $exam_desc,
			'student_no' => $student_no,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'total_score' => $total_score,
			'computedScore' => $computedScore,
			);

		$this->load->model('checker_model');
		$this->checker_model->saveResult($exam_no, $student_no, $computedScore);

		$this->load->view('take_exam/resultsPage', $data);
	}

}