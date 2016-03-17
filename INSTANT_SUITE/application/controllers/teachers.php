<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class teachers extends CI_Controller {
 
	//Load the teacher profile
	public function index()
	{
		$this->load->view('teacher_profile');
	}
	
	//Load the login_page
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
	
	//Load the login_page
	public function addQuestion($action){
		
		switch($action){
			
			case 1: //Multiple choice
				$this->load->view('add_question_mcq');
				break;
				
			case 2: //True or false
				$this->load->view('add_question_tf');
				break;
			
			case 3: //Matching type
				$this->load->view('add_question_matching');
				break;
				
			case 4: //Identification
				$this->load->view('add_question_ident');
				break;
				
			case 5: //Fill-in-the-blanks
				$this->load->view('add_question_fnb');
				break;
				
			case 6: //Essay
				$this->load->view('add_question_essay');
				break;
				
			case 7: //Programming
				$this->load->view('add_question_programming');
				break;
		}
	}
}
