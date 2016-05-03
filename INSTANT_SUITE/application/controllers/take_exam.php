<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class take_exam extends CI_Controller {
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
		$this->load->view('take_exam/instructionsPage');
	}

	/*****************************************************/

	public function getExamInfo($examNo){ //The exam details
		$this->load->model('exam_model');
		$query = $this->exam_model->getExamDetails($examNo);
		return $query;
	}

	public function getExamTemplate($exam_no){ //The exam template
		$this->load->model('exam_model');
		$query = $this->exam_model->getTemplate($exam_no);
		return $query;
	}

	public function getExamineeInfo($student_no){ //The examinee information
		$this->load->model('exam_model');
		$query = $this->exam_model->getExaminee($student_no);
		return $query;
	}

	public function getTotalItems($exam_no){ //The total items
		$this->load->model('exam_model');
		$query = $this->exam_model->getItems($exam_no);
		return $query;
	}

	/*****************************************************/

	//Function to show multiple choice question in takeExam
	public function showMCQ(){
		$this->load->model('checker_model');
		$query = $this->checker_model->retrieveMCQ();	
		return $query;
	}

	//Function to show TF question in takeExam
	public function showTF(){
		$this->load->model('checker_model');
		$query = $this->checker_model->retrieveTF();	
		return $query;	
	}

	//Function to show Matching type questions in takeExam 
	public function showMatching(){
		$this->load->model('checker_model');
		$query = $this->checker_model->retrieveMatching();
		return $query;
	}

	//Get the choices from the matching type
	public function getMatchingChoices(){
		$this->load->model('checker_model');
		$query = $this->checker_model->retrieveMatchingChoices();
		return $query;
	}

	//Function to show Fill-in-the-blanks questions
	public function showFnB(){
		$this->load->model('checker_model');
		$query = $this->checker_model->retrieveFnB();
		return $query;
	}

	//Function to show identification questions
	public function showIdentification(){
		$this->load->model('checker_model');
		$query = $this->checker_model->retrieveIdentification();
		return $query;
	}

	/*****************************************************/

	public function examPage(){ //Function to load the exam page with the data

		$examKey = $this->input->post('examKey'); //Get the exam key
		$exam_no = $this->input->post('examNo'); //Get the exam no

		$student_no = substr($examKey,10); //parse the exam key and get the student number

		$data['examinee'] = $this->getExamineeInfo($student_no); 	//get the examinee info based from student_no
		$data['exam'] = $this->getExamInfo($exam_no); 				//get the exam based from exam_no
		$data['template'] = $this->getExamTemplate($exam_no); 		//get the template of the exam

		//$data['questionDetails'] = $this->showMCQ();
		//$data['questionDetails'] = $this->showTF();
		//$data['questionDetails'] = $this->showMatching();
		//$data['choicesDetails'] = $this->getMatchingChoices();
		//$data['questionDetails'] = $this->showFnB();
		//$data['questionDetails'] = $this->showIdentification();

		$this->load->view('take_exam/examPage', $data);
	}

}
