<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teachers extends CI_Controller {
 	
	//Add exam
	public function createExam(){
		$email = $this->session->userdata('email');
		$courseCode = $this->input->post('course_code');
		$date = $this->input->post('examinationDate');
		$desc = $this->input->post('exam_desc');
		$total = $this->input->post('no_of_items');
		$scoreTotal = $this->input->post('total_score');
		$category = $this->input->post('category');
		$totalItems = $this->input->post('totalItems');
		$difficulty = $this->input->post('difficulty');
		$duration = $this->input->post('duration');
		
		$this->load->model('exam_model');
		$this->exam_model->createExam($desc, $date, $total, $scoreTotal, $duration, $category, $totalItems, $difficulty, $courseCode, $email);
		
		redirect('/home/home_page');
	}
	
	//Edit exam
	public function editExam($exam_no){
	
		$email = $this->session->userdata('email');
		$courseCode = $this->input->post('course_code');
		$date = $this->input->post('examinationDate');
		$desc = $this->input->post('exam_desc');
		$total = $this->input->post('no_of_items');
		$category = $this->input->post('category');
		$totalItems = $this->input->post('totalItems');
		$difficulty = $this->input->post('difficulty');
		
		$this->load->model('exam_model');
		$this->exam_model->updateExam($desc, $date, $total, $category, $totalItems, $difficulty, $courseCode, $email, $exam_no);
		
		redirect('/home/home_page');
	}
	
	//Bank questions according to type
	public function bankQuestion(){
			$type = $this->uri->segment(3);
			$email = $this->session->userdata('email');
			
			if($type == 1){ //if multiple choice
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$answer = $this->input->post('answer');
				$choice = $this->input->post('choice');
				$points = $this->input->post('points');

				$this->load->model('exam_model');
				$this->exam_model->addMCQ($email,$category,$type,$questionProper,$points,$choice,$answer);
			}
			
			else if($type == 3){ //if matching type
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$answer = $this->input->post('answer');
				$choice = $this->input->post('choice');
				$points = $this->input->post('points');

				$this->load->model('exam_model');
				$this->exam_model->addMatching($email,$category,$type,$questionProper,$points,$choice,$answer);
			}
			
			else if($type == 4 || $type == 5){ //for FnB and Identification
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$answer = $this->input->post('answer');
				$points = $this->input->post('points');
				$cons1 = $this->input->post('consideration1');
				$cons2 = $this->input->post('consideration2');
				$consAns = $this->input->post('considerations');
				
				$this->load->model('exam_model');
				$this->exam_model->addQuestion1($email,$category,$type,$questionProper,$points,$answer,$cons1, $cons2, $consAns);
			}

			else{
				$category = $this->input->post('category');
				$questionProper = $this->input->post('questionProper');
				$answer = $this->input->post('answer');
				$points = $this->input->post('points');
				
				$this->load->model('exam_model');
				$this->exam_model->addQuestion2($email,$category,$type,$questionProper,$points,$answer);
			}
			
			redirect('/home/home_page');
	}
	
}
