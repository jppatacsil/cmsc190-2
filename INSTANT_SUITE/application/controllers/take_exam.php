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

	public function getExamineeInfo()
	{
		$this->load->model('exam_model');
		$query = $this->exam_model->getExaminee();
		return $query;
	}

	public function getTotalItems(){
		$this->load->model('exam_model');
		$query = $this->exam_model->getItems();
		return $query;
	}

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

	public function examPage(){
		$data['examinee'] = $this->getExamineeInfo();
		$data['items'] = $this->getTotalItems();
		//$data['questionDetails'] = $this->showMCQ();
		//$data['questionDetails'] = $this->showTF();
		$data['questionDetails'] = $this->showMatching();
		$data['choicesDetails'] = $this->getMatchingChoices();
		//$data['questionDetails'] = $this->showFnB();
		//$data['questionDetails'] = $this->showIdentification();
		$this->load->view('take_exam/examPage', $data);
	}

}
