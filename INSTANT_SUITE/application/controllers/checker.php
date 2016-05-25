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

			if(strpos($student_answer, '_') != false){
				$student_answer = str_replace("_",".",$student_answer);
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
			$quantity = $this->uri->segment(15);

			$questions = explode("_",$question_id);
			$answers = explode("_",$student_answer);

			for($i=0;$i<$quantity;$i++){
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

			for($i=0;$i<$quantity;$i++){
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
			$data['unanswered'] = $unanswered = $this->exam_model->getUnansweredItems($examKey);

			$this->load->view('take_exam/examPage', $data); //Reload the exam page again
	}

	//Function to get results of exam
	public function showResults(){

		$exam_key = $this->input->post('exam_key');
		$exam_desc = $this->input->post('exam_desc');
		$student_no = $this->input->post('student_no');
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$total_score = $this->input->post('total_score');
		$confirmation = $this->input->post('confirmation');

		echo '<script type="text/javascript">alert("Your confirmation is: '.$confirmation.'");</script>';

		if($confirmation == 0){ //Reload page again
			echo '<script>alert("RELOAD EXAM!");</script>';
			$this->load->model('exam_model');		
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
			$data['unanswered'] = $unanswered = $this->exam_model->getUnansweredItems($exam_key);

			$this->load->view('take_exam/examPage', $data); //Reload the exam page again

		}else{ //Save exam result
			echo '<script>alert("SUBMIT EXAM!");</script>';
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

			$this->checker_model->saveResult($exam_key, $student_no, $computedScore);
			$this->load->view('take_exam/resultsPage', $data);
		}

		

		//Prompt unanswered items
		

		/*$unanswered = $this->checker_model->getUnansweredItems($exam_key);
		if($unanswered == false){
	        //Save to results table if all items have already been answered
	        $this->checker_model->saveResult($exam_key, $student_no, $computedScore);
			$this->load->view('take_exam/resultsPage', $data);
		}else{ //Prompt the unanswered item numbers

			//String variables to get the items with and without answers
			$Ans = "";
			$NoAns = "";
			$itemNo = 1;
			foreach($unanswered as $item){ //Get all the answers of the student
				$Ans .= $itemNo."_";
				if($item->stud_answer == null){
					$NoAns .= $itemNo."_";
				}
				$itemNo++;
			}

			echo '<script type="text/javascript">
				alert("You have not answered items: '.$NoAns.'."); 
				var retVal = confirm("Are you REALLY sure you want to end exam?");
				</script>';

					echo '$confirmVal = <script>retVal</script>';

					echo '<script type="text/javascript">alert("'.$confirmVal.'");</script>';					

				//Check which option was chosen
					if($confirmVal == false){*/
					/*************************RELOAD THE EXAM PAGE AGAIN****************************/
					/*
					echo '<script>alert("RELOAD EXAM!");</script>';
					$this->load->model('exam_model');		
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
						$data['unanswered'] = $unanswered = $this->exam_model->getUnansweredItems($examKey);

						$this->load->view('take_exam/examPage', $data); //Reload the exam page again
						
					}else{
						echo '<script>alert("SUBMIT EXAM!");</script>';
						$this->load->model('checker_model');
						$this->checker_model->saveResult($exam_key, $student_no, $computedScore);
						$this->load->view('take_exam/resultsPage', $data);
					}*/
		//}
	}

}