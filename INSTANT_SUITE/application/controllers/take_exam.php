<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class take_exam extends CI_Controller {
	function __construct(){
            parent::__construct();
    }
	 
	//Load the homepage
	public function index()
	{
		$this->load->view('take_exam/instructionsPage');
	}

	/*****************************************************/

	public function examPage(){ //Function to load the exam page with the data

		$examKey = $this->input->post('examKey'); //Get the exam key

		//Check if exam key is in list of keys generated
		$this->load->model('exam_model');
		$foundkey = $this->exam_model->getKey($examKey);

		if($foundkey != null){ //If key is found

			if($this->exam_model->checkResults($examKey) != NULL ){ //If there is already a result for his/her exam
				//echo '<script type="text/javascript">alert("LOADING YOUR EXAM RESULTS!");</script>'; //Alert invalid key
				
				$student_no = substr($examKey,-7); //parse the exam key and get the student number
				$examno = $this->exam_model->getExamNo($examKey); //get exam no
				foreach($examno as $row){
					$exam_no = $row->exam_no;
				}

				$examDetails = $this->exam_model->getExamDetails($exam_no); //get exam details
				foreach($examDetails as $row){
					$exam_desc = $row->exam_desc;
					$total_score = $row->total_score;
				}

				$examinee = $this->exam_model->getExaminee($student_no); //get examinee details
				foreach($examinee as $row){
					$student_no = $row->student_no;
					$firstName = $row->firstName;
					$lastName = $row->lastName;
				}

				$computedScore = $this->exam_model->checkResults($examKey); //get the results of student

				$data = array(
					'exam_desc' => $exam_desc,
					'student_no' => $student_no,
					'firstName' => $firstName,
					'lastName' => $lastName,
					'total_score' => $total_score,
					'computedScore' => $computedScore,
					);

				$this->load->view('take_exam/resultsPage', $data); //Reload the results page

			}else{

			//Check if the exam_set is already filled then view page with existing data
			if($this->exam_model->checkIfUsed($examKey)==true){
				$data['items'] = $this->exam_model->reloadExamSet($examKey); //Reload exam items

				$examDetails = $this->exam_model->reloadExamDetails($examKey); //Reload the details

				foreach($examDetails as $row){ //Fetch the exam_no and student_no from details
					$exam_no = $row->exam_no;
					$student_no = $row->student_no;
				}

				//Reload other necessary informations
					$data['timeleft'] = $this->exam_model->getTimeLeft($examKey);
					$data['matching'] = $this->exam_model->getMatching($examKey); //get the matching type questions based from exam_key
					$data['choices'] = $this->exam_model->getchoices($examKey);	//get the choices for the generated MCQ and Matching questions
					$data['examinee'] = $this->exam_model->getExaminee($student_no);
					$data['exam'] = $this->exam_model->getExamDetails($exam_no);

				//echo '<script type="text/javascript">alert("RELOADING EXAM!");</script>'; //Alert invalid key
				$this->load->view('take_exam/examPage', $data); //Reload back to instructions page
			}

			else{

			$student_no = substr($examKey,-7); //parse the exam key and get the student number
			$examDetails = $this->exam_model->getExamNo($examKey);

			foreach($examDetails as $row){ //fetch exam no
				$exam_no = $row->exam_no;
			}

			$data['timeleft'] = $this->exam_model->getTimeLeft($examKey);
			$data['items'] = $this->exam_model->saveExamSet($examKey, $exam_no, $student_no); //save the exam set with the student's examKey and get the items
			$data['matching'] = $this->exam_model->getMatching($examKey); //get the matching type questions based from exam_key
			$data['choices'] = $this->exam_model->getchoices($examKey);	//get the choices for the generated MCQ and Matching questions
			$data['examinee'] = $this->exam_model->getExaminee($student_no); 	//get the examinee info based from student_no
			$data['exam'] = $this->exam_model->getExamDetails($exam_no); 				//get the exam based from exam_no

			$this->load->view('take_exam/examPage', $data);
			}

			}
		}
		else{ //If key is not found
			echo '<script type="text/javascript">alert("INVALID EXAM KEY!");</script>'; //Alert invalid key
			$this->load->view('take_exam/instructionsPage'); //Reload back to instructions page
		}
	}

}
