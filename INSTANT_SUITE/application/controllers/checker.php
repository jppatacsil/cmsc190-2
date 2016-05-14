<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class checker extends CI_Controller {

	//Function to submit answer of student
	public function submitAnswer(){

		//DETERMINE THE TYPE OF QUESTION TO BE SUBMITTED FIRST
		$type = $this->uri->segment(6);

		//IF NOT MATCHING TYPE
		if($type != 3){

		$question_id = $this->uri->segment(3);
		$student_answer = $this->uri->segment(4);
		$exam_key = $this->uri->segment(5);
		$score = $this->uri->segment(7);
		$student_no = $this->uri->segment(8);
		$exam_desc = $this->uri->segment(9);
		$firstName = $this->uri->segment(10);
		$lastName = $this->uri->segment(11);
		$total_score = $this->uri->segment(12);
		$next_item = $this->uri->segment(13);
		$timeleft = $this->uri->segment(14);

			if($student_answer != "%20"){ //If user has answer, then check for spaces
				if (strpos($student_answer, '%20') != false){ //If the substring %20 is found, which means that the parameter has some spaces then replace that substring
					$student_answer = str_replace("%20"," ",$student_answer);
				}
			}

			if(strpos($firstName, '%20') != false){ //If first name has spaces
				$firstName = str_replace("%20"," ",$firstName);
			}
	 
			if(strpos($lastName, '%20') != false){ //If last name has spaces
				$lastName = str_replace("%20"," ",$lastName);
			}

			if(strpos($exam_desc, '%20') != false){ //If description has spaces
				$exam_desc = str_replace("%20", " ", $exam_desc);
			}
		    
			$this->load->model('checker_model');
			$this->checker_model->saveAnswer($exam_key, $student_no, $question_id, $type, $student_answer, $score);

			}

		//IF MATCHING TYPE
		else{
			$question_id = $this->uri->segment(3);
			$student_answer = $this->uri->segment(4);
			$exam_key = $this->uri->segment(5);
			$score = $this->uri->segment(7);
			$student_no = $this->uri->segment(8);
			$exam_desc = $this->uri->segment(9);
			$firstName = $this->uri->segment(10);
			$lastName = $this->uri->segment(11);
			$total_score = $this->uri->segment(12);
			$next_item = $this->uri->segment(13);
			$timeleft = $this->uri->segment(14);

			$questions = explode("_",$question_id);
			$answers = explode("_",$student_answer);

			for($i=0;$i<4;$i++){
				if(strpos($answers[$i], '%20') != false) $answers[$i] = str_replace("%20"," ",$answers[$i]);
			}

			if(strpos($firstName, '%20') != false){ //If first name has spaces
				$firstName = str_replace("%20"," ",$firstName);
			}
	 
			if(strpos($lastName, '%20') != false){ //If last name has spaces
				$lastName = str_replace("%20"," ",$lastName);
			}

			if(strpos($exam_desc, '%20') != false){ //If description has spaces
				$exam_desc = str_replace("%20", " ", $exam_desc);
			}

			$this->load->model('checker_model');

			for($i=0;$i<4;$i++){
				$this->checker_model->saveAnswer($exam_key, $student_no, $questions[$i], $type, $answers[$i], $score);
			}

			//echo '<script type="text/javascript">alert("MATCHING SUCCESSFULLY SAVED!");</script>';
		}

		/*************************RELOAD THE EXAM PAGE AGAIN****************************/
		$this->load->model('exam_model');
		$this->exam_model->next_item($exam_key, $next_item, $timeleft);
		
		$data['items'] = $this->exam_model->reloadExamSet($exam_key); //Reload exam items

		$examDetails = $this->exam_model->reloadExamDetails($exam_key); //Reload the details

		foreach($examDetails as $row){ //Fetch the exam_no and student_no from details
			$exam_no = $row->exam_no;
			$student_no = $row->student_no;
		}

		//Reload other necessary informations
			$data['timeleft'] = $this->exam_model->getTimeLeft($exam_key);
			$data['matching'] = $this->exam_model->getMatching($exam_key); //get the matching type questions based from exam_key
			$data['choices'] = $this->exam_model->getchoices($exam_key);	//get the choices for the generated MCQ and Matching questions
			$data['examinee'] = $this->exam_model->getExaminee($student_no);
			$data['exam'] = $this->exam_model->getExamDetails($exam_no);

			$this->load->view('take_exam/examPage', $data); //Reload the exam page again
	}

	//Function to get results of exam
	public function showResults($exam_key, $student_no, $exam_desc, $firstName, $lastName, $total_score){

		//If form came from submit then get POST values
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
		    $exam_key = $this->input->post('exam_key');
			$exam_desc = $this->input->post('exam_desc');
			$student_no = $this->input->post('student_no');
			$firstName = $this->input->post('firstName');
			$lastName = $this->input->post('lastName');
			$total_score = $this->input->post('total_score');
		 }

		$this->load->model('checker_model');
		$computedScore = $this->checker_model->computeTotalScore($exam_key, $student_no);

		$data = array(
			'exam_desc' => $exam_desc,
			'student_no' => $student_no,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'total_score' => $total_score,
			'computedScore' => $computedScore,
			);

        //Save to results table
        $this->checker_model->saveResult($exam_key, $student_no, $computedScore);
		$this->load->view('take_exam/resultsPage', $data);
	}

}