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


	public function teacherActions($action){
		
		switch($action){
			
			case 1: //Load the create exam page
				$this->load->view('teacher_create_exam');
				break;
				
			case 2: //Load the profile
				$this->load->view('teacher_profile');
				break;
			
			case 3: //Load the manage exam page
				$this->load->view('teacher_manage_exam');
				break;
				
			case 4: //Load the manage question page
				$this->load->view('teacher_manage_question_bank');
				break;
				
			case 5: //Load the view account page
				$this->load->view('teacher_view_account');
				break;
				
			case 6: //Load the view exam page
				$this->load->view('teacher_view_exam');
				break;
				
			case 7: //Load the logs
				$this->load->view('viewLogs');
				break;
		}
	}
	
	//Add exam
	public function createExam(){
	
		$email = $this->session->userdata('email');
		$courseCode = $this->input->post('course_code');
		$date = $this->input->post('examinationDate');
		$desc = $this->input->post('exam_desc');
		$total = $this->input->post('no_of_items');
		
		$this->load->model('exam_model');
		$this->exam_model->createExam($desc, $date, $total, $courseCode, $email);
		
		redirect('/home/home_page');
	}
	
	//Bank questions according to type
	public function bankQuestion(){
			$type = $this->uri->segment(3);
			
			if($type != 1){
				$questionProper = $this->input->post('questionProper');
				$points = $this->input->post('points');
				$answer = $this->input->post('answer');
				
				$this->load->model('exam_model');
				$this->exam_model->addQuestion($type,$questionProper,$points,$answer);
			}
			
			else{
			
				$questionProper = $this->input->post('questionProper');
				$points = $this->input->post('points');
				$choice1 = $this->input->post("choice1");
				$choice2 = $this->input->post("choice2");
				$choice3 = $this->input->post("choice3");
				$choice4 = $this->input->post("choice4");
				$answer = $this->input->post('answer');
				
				$this->load->model('exam_model');
				$this->exam_model->addMCQ($type,$questionProper,$points,$choice1,$choice2,$choice3,$choice4,$answer);
			
			}
			
			redirect('/home/home_page');
	}
	
}
