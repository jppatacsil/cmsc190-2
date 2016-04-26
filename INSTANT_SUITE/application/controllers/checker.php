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

		redirect('/home/home_page');
	}

}