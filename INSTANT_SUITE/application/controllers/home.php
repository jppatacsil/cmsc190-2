<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct(){
            parent::__construct();
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	//Load the homepage
	public function index()
	{
		$this->load->view('index');
	}
	
	//Load the login_page
	public function login_page(){
		$this->load->view('login');
	}
	
	//Load the signup page
	public function signUp_page(){
		$this->load->view('signup');
	}

	public function home_page(){

			if($this->session->userdata('is_logged_in')){ //if user is logged in, user is able to access home page

				if($this->displayClasses()!=false){
					$data['classes'] = $this->displayClasses();
					$this->load->view('home_page', $data);
					return true;
				}
				else{
					$data['classes'] = false;
					$this->load->view('home_page', $data);
					return false;
				}
				
				
			}
			else{ //if user tries to manually access the home page through url but is not logged in, he is taken to the restricted page
				$this->load->view('restricted');
				return true;
			}
		
	}

	public function validate_entry_login(){
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run()){
			$this->login('email_address', 'password');
		}
		else{
			echo "validation failed";
		}

	}

	public function login($email, $password){ //called when the user logs in

		$this->load->library('form_validation');
		$this->form_validation->set_rules($email, 'Email', 'required|trim');
		$this->form_validation->set_rules($password, 'Password', 'required|trim');

		if($this->form_validation->run()){ //if form is validated correctly
			
			$this->load->helper('array');
			$email_address = $this->input->post($email);
			$pword = md5($this->input->post($password));
			$this->load->model('instant_model');
			$fields=$this->instant_model->loadData($email_address, $pword);
			

			
			if($fields==false){
				//redirect('/home/index');
				echo "wrong credentials";
			}
			
			else{
				$data = array( //the session data
					'email' => $email_address,
					'is_logged_in' => 1,
					'firstName' => $fields->firstName,
					'lastName' => $fields->lastName,
					
				);
				$this->session->set_userdata($data); //session is given the session data
				redirect('/home/home_page');
			}
			
		
			//echo "worked";
		}
		
		else{ // if login is unssuccessful (incomplete fields, etc) he is taken back to the login page
			//$this->load->view('welcome');
			echo "didnt log in";
		//	redirect('index.php/main/login_page');
		}
		
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/home/index');
		//$this->index();
	}


	public function signup_validation(){ //function called when user signs up
		$this->load->model('instant_model');
		$key = md5(uniqid());
		if($this->instant_model->add_user()){
			//$this->load->view('home');
			//echo "added";
			$this->login('email_address_signup', 'password_signup');
		}
		else{
			echo "not added";
		}
	}

	public function displayClasses(){ //loads the classes of a user by using his email
		$this->load->model('instant_model');
		$email = $this->session->userdata('email');
		if($this->instant_model->loadClasses($email)){
			$query=$this->instant_model->loadClasses($email);
			return $query;
		}
		else{
			return false;
		}
	}
	
	public function displayExams(){
	$this->load->model('exam_model');
		$email = $this->session->userdata('email');
		if($this->exam_model->loadExams($email)){
			$query=$this->exam_model->loadExams($email);
			return $query;
		}
		else{
			return false;
		}
	}
	
	//Function to display categories
	public function displayCategories(){
		$this->load->model('exam_model');
			$email = $this->session->userdata('email');
			if($this->exam_model->loadCategories($email)){
				$query=$this->exam_model->loadCategories($email);
				return $query;
			}
			else{
				return false;
			}
	}
	
	public function deleteExam($exam_no){
		$this->load->model('exam_model');
		$this->exam_model->deleteExam($exam_no);
		redirect('/home/home_page');
	}
	
	public function editExam($exam_no){
		$this->load->model('exam_model');
		$query = $this->exam_model->editExam($exam_no);
		return $query;
	}
	
	public function getCategory($exam_no){
		$this->load->model('exam_model');
		$query = $this->exam_model->getCategory($exam_no);
		return $query;
	}
	
	public function displayQuestions(){
	$this->load->model('exam_model');
	$email = $this->session->userdata('email');
	if($this->exam_model->loadQuestions($email)){
			$query=$this->exam_model->loadQuestions($email);
			return $query;
		}
		else{
			return false;
		}
	}
	
	public function filterQuestions($type, $category, $difficulty){
		$this->load->model('exam_model');
		$email = $this->session->userdata('email');
		if($this->exam_model->filterQuestions($email, $type, $category, $difficulty)){
				$query=$this->exam_model->filterQuestions($email, $type, $category, $difficulty);
				return $query;
			}
		else{
			return false;
		}
	}
	
	public function deleteQuestion($question_id){
		$this->load->model('exam_model');
		$this->exam_model->deleteQuestion($question_id);
		redirect('/home/home_page');
	}

	public function loadProfile(){ //loads the classes of a user by using his email
		$this->load->view('teacher_profile');
	}

	public function loadCreateExam(){
		$data['classes'] = $this->displayClasses();
		$data['categories'] = $this->displayCategories();
		$this->load->view('teacher_create_exam', $data);
	}

	public function loadManageExam(){
		$data['exams'] = $this->displayExams();	
		$this->load->view('teacher_manage_exam', $data);
	}

	public function loadEditExam($exam_no){
		$data['exams'] = $this->editExam($exam_no);	
		$data['category'] = $this->getCategory($exam_no);
		$data['categories'] = $this->displayCategories();
		$this->load->view('teacher_edit_exam', $data);
	}
	
	public function loadQuestionBank(){
		$data['questions'] = $this->displayQuestions();
		$data['categories'] = $this->displayCategories();
		$data['type'] = "ALL";
		$data['category'] = "ALL";
		$data['difficulty'] = "ALL";
		$this->load->view('teacher_manage_question_bank', $data);
	}
	
	public function filterQuestionBank($type, $category, $difficulty){
		$data['questions'] = $this->filterQuestions($type, $category, $difficulty);
		$data['categories'] = $this->displayCategories();
		$data['type'] = $type;
		$data['category'] = $category;
		$data['difficulty'] = $difficulty;
		$this->load->view('teacher_manage_question_bank', $data);
	}

	public function loadCreateClass(){
		$this->load->view('teacher_create_class');
	}

	public function loadMainSideBar(){
		$this->load->view('mainSideBar');
	}

	public function loadAddQuestionSidebar(){
		$this->load->view('addQuestionSidebar');
	}

	public function loadClassSideBar(){
		$data['classes'] = $this->displayClasses();
		$this->load->view('classSideBar', $data);
	}

	public function createClass(){

		$email = $this->session->userdata('email');
		$courseCode = $this->input->post('courseNo');
		$courseTitle = $this->input->post('courseTitle');
		$section = $this->input->post('section');
		$classCode = '';

		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$classCode = '';
				for ($i = 0; $i < 5; $i++) {
					$classCode .= $characters[rand(0, $charactersLength - 1)];
		}

		echo $email;
		echo $courseCode;
		echo $courseTitle;
		echo $section;
		echo $classCode;

		$this->load->model('instant_model');
		$this->instant_model->create_class($email, $courseCode, $courseTitle, $section, $classCode);
		
		redirect('/home/home_page');
		//$data['classes'] = $this->displayClasses();
		//return $data;
	}

	public function loadClassActions(){
		//this works courseCode in classSideBar
		/*$course = $this->input->post('courseCode');

		$this->session->set_userdata('subject', $course);
		$data['subject'] = $this->session->userdata('subject');
		$this->load->view('attendance_module/classActions', $data);*/

		$classCode = $this->input->post('courseCode');
		$this->load->model('instant_model');
		$data['class']=$this->instant_model->loadClass($classCode);
		$this->load->view('attendance_module/classActions', $data);

	}

	/******************************************ADD QUESTIONS SIDEBAR***************************************/
	public function addMultipleChoice(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_mcq', $data);
	}

	public function addTrueOrFalse(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_tf',$data);
	}

	public function addMatching(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_matching',$data);
	}
	public function addIdentification(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_ident', $data);
	}

	public function addFillInTheBlanks(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_fnb', $data);
	}

	public function addEssay(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_essay', $data);
	}
	public function addProgramming(){
		$data['categories'] = $this->displayCategories();
		$this->load->view('add_question_programming', $data);
	}



}
