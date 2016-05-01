<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class checker_model extends CI_Model{

		public function __construct(){
        	parent::__construct();
    	}

    	//Function to retrieveMCQ
    	public function retrieveMCQ(){
    		$query = $this->db->query("SELECT * from questions inner join choices on (questions.question_id = choices.question_id) WHERE type = 1;");
    		return $query->result();
    	}

    	//Function to retrieveTF
    	public function retrieveTF(){
    		$query = $this->db->query("SELECT * from questions WHERE type = 2;");
    		return $query->result();
    	}

    	//Function to retrieveMatching
    	public function retrieveMatching(){
    		$query = $this->db->query("SELECT * from questions WHERE type = 3 AND category = 'Data Types';");
    		return $query->result();
    	}

    	public function retrieveMatchingChoices(){
    		$query = $this->db->query("SELECT * from choices WHERE question_id = 102;");
    		return $query->result();
    	}

        public function retrieveFnB(){
            $query = $this->db->query("SELECT * from questions WHERE type = 4;");
            return $query->result();
        }

        public function retrieveIdentification(){
            $query = $this->db->query("SELECT * from questions WHERE type = 5;");
            return $query->result();
        }

    	public function saveAnswer($type, $exam_no, $stud_no, $question_id, $student_answer, $score){

            $student_answer = strtolower($student_answer); //for convention

    		if($type != 3){
		    	$answerDetails = array(
					'exam_no' => $exam_no,
					'student_no' => $stud_no,
					'question_id' => $question_id,
					'answer' => $student_answer,
					);
					
				$query = $this->db->insert('answers',$answerDetails);
				$this->automateChecking($question_id, $student_answer, $score);

                //Check if question has considerations
                $consType = $this->db->query("SELECT consideration from questions WHERE question_id = '$question_id';")->row()->consideration;
                $initScore = $this->db->query("SELECT score from answers WHERE question_id = '$question_id' AND answer = '$student_answer';")->row()->score;

                if($consType != NULL && $initScore == 0){ //If there is considerations and initial score is 0
                    $this->considerChecking($question_id, $student_answer, $score); //Recheck answer
                }

			}else{

				$totalQuestions = count($question_id); //Count the number of questions
		
				for($i=0;$i<$totalQuestions;$i++){ //Insert all matching questions and answers
				$answerDetails = array(
					'exam_no' => $exam_no,
					'student_no' => $stud_no,
					'question_id' => $question_id[$i],
					'answer' => $student_answer[$i],
					);
					
				$query = $this->db->insert('answers',$answerDetails);
				$this->automateChecking($question_id[$i], $student_answer[$i], $score);
				}

			}
    	}

        //Automatically check the student's answer
    	public function automateChecking($question_id, $student_answer, $score){

    		$correctAns = $this->db->query("SELECT answer from questions WHERE question_id = '$question_id';")->row()->answer;

    		if($student_answer == $correctAns){ //If correct answer, then update the score field in the answers table
    			$this->db->query("UPDATE answers SET score = '$score' WHERE question_id = '$question_id' AND answer = '$student_answer';");
    		}
    		else{
    			$this->db->query("UPDATE answers SET score = 0 WHERE question_id = '$question_id' AND answer = '$student_answer';");
    		}
    	}

        //If there is a consideration
        public function considerChecking($question_id, $student_answer, $score){

            //Read the personal dictionary consideredAnswers.txt
            $myfile = fopen("consideredAnswers.txt", "r") or die("Unable to open file!");

            if($myfile){ //Get all considered answers
                $consAns = explode(PHP_EOL, fread($myfile, filesize("consideredAnswers.txt")));
            }
            fclose($myfile);

            //Check whether student's answer is within the considered answers list
            for($i=0;$i<count($consAns);$i++){
                if($student_answer == $consAns[$i]){
                    $this->db->query("UPDATE answers SET score = '$score' WHERE question_id = '$question_id' AND answer = '$student_answer';");
                    break; //Exit from loop
                }
            }
            
        }

}