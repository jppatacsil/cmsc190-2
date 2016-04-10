<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teachers extends CI_Controller {
 
	//Load the teacher profile
	public function index()
	{
		$this->load->view('teacher_profile');
	}
	
	//Load the login_page
	public function addMultipleChoice(){
		$this->load->view('add_question_mcq');

	}
	
	//Add exam
	public function createExam(){
	
		$email = $this->session->userdata('email');
		$courseCode = $this->input->post('course_code');
		$date = $this->input->post('examinationDate');
		$desc = $this->input->post('exam_desc');
		$total = $this->input->post('no_of_items');
		$category = $this->input->post('category');
		$totalItems = $this->input->post('totalItems');
		$difficulty = $this->input->post('difficulty');
		
		$this->load->model('exam_model');
		$this->exam_model->createExam($desc, $date, $total, $category, $totalItems, $difficulty, $courseCode, $email);
		
		redirect('/home/home_page');
	}
	
	//Bank questions according to type
	public function bankQuestion(){
			$type = $this->uri->segment(3);
			
			if($type == 1){
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$points = $this->input->post('points');
				$choice = $this->input->post("choice");
				$answer = $this->input->post('answer');
				
				$this->load->model('exam_model');
				$this->exam_model->addMCQ($category,$type,$questionProper,$points,$choice,$answer);
			}
			
			else if($type == 3){
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$points = $this->input->post('points');
				$choice = $this->input->post("choice");
				$answer = $this->input->post('answer');
				
				$this->load->model('exam_model');
				$this->exam_model->addMatching($category,$type,$questionProper,$points,$choice,$answer);
			}
			
			else{
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$points = $this->input->post('points');
				$answer = $this->input->post('answer');
				
				$this->load->model('exam_model');
				$this->exam_model->addQuestion($category,$type,$questionProper,$points,$answer);
			}
			
			redirect('/home/home_page');
	}
	
	//View the edit exam page
	public function loadEditExam(){
		$this->load->view('teacher_edit_exam');
	}
	
}
