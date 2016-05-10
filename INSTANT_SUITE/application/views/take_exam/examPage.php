<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>INSTANT SUITE: Examination Page</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url(); ?>css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url(); ?>css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<script>

   //Function for setting the mins remaining
   function countdown(mins, secs){
        var duration = document.getElementById("duration");
        duration.innerHTML = mins+" m "+secs+" s";
                
        if(secs < 1){
            if(mins == 0){
                alert("EXAM HAS ENDED!");
                document.examPaper.submit(); //Submit the exam
            }
            else{
                secs = 59;
                mins--;
            }
        }
        else secs--;
                
        var timer = setTimeout('countdown('+mins+', '+secs+')', 1000);
   }

</script>

<style>

    #header{
        height: 150px;
        background-color: black;
        opacity: 0.75;
    }

    #mainPanel {
        position:absolute;
        top: 30%;
        left: 15%;
        height: 100%;
        width: 75%;
        background-color: #D2B48C;
        border-radius: 5px;
        padding: 20px;
        opacity: 0.75;
    }

    #itemsPane {
        position:absolute;
        top: 85%;
    }

    #endExam {
        position:absolute;
        top: 85%;
        left: 60%;
    }

    body {
        font-family: "Georgia";
    }

    p {
        font-size: 1.875em; /* 30px/16=1.875em */
    }

    pre {
    display: block;
    opacity: 0.75;
    font-family: Georgia;
    font-size: 24px;
    margin: 1em 0;
} 

</style>

  <body class="login-img3-body">

            <?php //Get the data passed to exam page

                foreach($examinee as $row){ //The examinee information
                    $student_no = $row->student_no;
                    $lastName = $row->lastName;
                    $firstName = $row->firstName;
                }

                foreach($exam as $row){ //the exam information
                    $exam_no = $row->exam_no;
                    $exam_desc = $row->exam_desc;
                    $duration = $row->duration;
                    $total_items = $row->total_items;
                    $total_score = $row->total_score;
                }

                foreach($items as $key){ //get the exam_key of the exam_set
                    $exam_key = $key->exam_key;
                }

            ?>

    <!--THE HEADER DIV-->
    <div id="header">
        <div class="col-lg-12">
            <div class="col-md-2">
                <img src="<?php echo base_url()."/img/instant-square.png"?>" height="150" width="200">
            </div>

            <div class="col-md-2">
                <?php //The exam description
                    echo '<h1 style="color: white">'.$exam_desc;
                ?>
            </div>

            <div class="col-md-4">
                <?php //The time remaining in minutes
                    echo '<h1 style="color: white">TIME REMAINING:<br>';
                    echo '<h1 id="duration" style="color: white">'.$duration.':00';
                    echo '<script type="text/javascript">countdown('.$duration.', 0);</script>';
                ?>
            </div>

            <div class="col-md-4">
                <?php //The student's number and name
                    echo '<h1 style="color: white">'.$student_no.': '.$lastName.',<br>'.$firstName; 
                ?>
            </div>
        </div>
    </div>

    <!--THE QUESTION DIV-->
    <section id="mainPanel" class="col-lg-10">
        <form  method="POST" id="examform" name="examPaper" action="<?php echo base_url()."index.php/checker/showResults/".$exam_key."/".$student_no."/".$exam_desc."/".$firstName."/".$lastName."/".$total_score."/"?>">

            <!--The hidden values necessary for passing data to results page-->
            <input type="hidden" id="exam_key" name="exam_key" value="<?php echo $exam_key; ?>">
            <input type="hidden" name="exam_no" value="<?php echo $exam_no; ?>">
            <input type="hidden" id="exam_desc" name="exam_desc" value="<?php echo $exam_desc; ?>">
            <input type="hidden" id="stud_no" name="student_no" value="<?php echo $student_no; ?>">
            <input type="hidden" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
            <input type="hidden" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
            <input type="hidden" id="total_score" name="total_score" value="<?php echo $total_score; ?>">

			<input type="hidden" id="oldItem" value=""> <!--Hidden value to update item-->
            <div class="form-group"> 
            <?php 
             foreach($items as $details){ //Get the question item details from the exam_set
                    $question_id = $details->question_id;
                    $type = $details->type;
                    $question = $details->question;
                    $correctAns = $details->answer;
                    $credit = $details->credit;
    				$category = $details->category;
	
            if( $type == 1){ //For MCQ
                echo '<div class="form-group" style="display:none;" id='.$question_id.'>
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" id="type'.$question_id.'" name="type" value="'.$type.'">
                <input type="hidden" id="score'.$question_id.'" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white"><script type="text/javascript">document.getElementById()</script>'.$question.'</h1>
                <select class="form-control col-lg-12" id="student_answer'.$question_id.'" name="student_answer">';
                        echo '<option style:"font-size: 24px" selected="true" value="" disabled="disabled">Select best answer</option>';
                        foreach($choices as $choice){
                            if($choice->question_id == $question_id){ //only print choices that is related to the question
                                echo '<option style:"font-size: 24px" value="'.$choice->choice.'">
                                    '.$choice->choice.'
                                </option>';
                            }
                        }
                echo '</select>
                </center>
                </div>';
            }else if($type == 2){ //For TnF
                echo '<div class="form-group" style="display:none;" id='.$question_id.'>
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" id="type'.$question_id.'" name="type" value="'.$type.'">
                <input type="hidden" id="score'.$question_id.'" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <select class="form-control col-lg-12" id="student_answer'.$question_id.'" name="student_answer">
                    <option style:"font-size: 24px" selected="true" value="" disabled="disabled">True or False?</option>
                    <option style:"font-size: 24px" value="TRUE">TRUE</option>
                    <option style:"font-size: 24px" value="FALSE">FALSE</option>
                </select>
                </center>
                </div>';
            }else if($type == 3){ //For Matching Type
                echo '<div class="form-group" style="display:none;" id='.$question_id.'>
                        <input type="hidden" id="type'.$question_id.'" name="type" value="'.$type.'">
                        <input type="hidden" id="score'.$question_id.'" name="score" value="'.$credit.'">
                        <center><h1 style="color: white">Match column A with column B</h1></center>
                    <div class="col-md-6">
                        <center><h2 style="color: white">COLUMN A</h2></center>';
                                        $quantity = 0; //Count how many questions in the category
                                        foreach($matching as $matches){
                                          if($matches->matching_id == $question_id){ //Get only the matching questions together with the category
                                            echo '<input type="hidden" name="question_id[]" value="'.$matches->question_id.'">'; //The question_id of the matching type question
                                            echo '<input type="text" style:"font-size: 24px" class="form-control" value="'.$matches->question.'" readonly>'; //The question proper
                                            $quantity++;
                                          }
                                        }
                                    echo '</div>
                                    <div class="col-md-6">
                                    <input type="hidden" id="quantity" value="'.$quantity.'">
                                    <center><h2 style="color: white">COLUMN B</h2></center>';
                                        for($i=0;$i<$quantity;$i++){
                                          echo '<select class="form-control col-md-6" id="student_answer'.($question_id+$i).'">';
                                          echo '<option  style:"font-size: 24px" selected="true" value="" disabled="disabled">Select matching answer</option>';
                                          foreach($choices as $c){
                                            if($c->question_id == $question_id){ //If question_id of choices is same with the matching_id
                                              echo '<option style:"font-size: 24px" value="'.$c->choice.'">'.$c->choice.'
                                                    </option>';
                                                }
                                          }
                                          echo '</select>';
                                        }
                echo '</div>
                </div>';
            }else if($type == 4 || $type == 5){ //For FnB or Identification
                echo '<div class="form-group" style="display:none;" id='.$question_id.'>
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" id="type'.$question_id.'" name="type" value="'.$type.'">
                <input type="hidden" id="score'.$question_id.'" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-12">
                    <center><input type="text" style:"font-size: 24px; color: white;" placeholder="Enter your answer here" id="student_answer'.$question_id.'" class="form-control" name="student_answer"></center>
                </div>
                </center></div>';
            }else if($type == 6){ //For essay
                echo '<div class="form-group" style="display:none;" id='.$question_id.'>
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" id="type'.$question_id.'" name="type" value="'.$type.'">
                <input type="hidden" id="score'.$question_id.'" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-12"">
                    <center><textarea class="form-control col-lg-12" id="student_answer'.$question_id.'" name="student_answer"></textarea></center>
                </div>
                </center></div>';
            }else if($type == 7){ //For programming
                echo '<div class="form-group" style="display:none;" id='.$question_id.'>
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" id="type'.$question_id.'" name="type" value="'.$type.'">
                <input type="hidden" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%;">
                    <center><textarea class="form-control col-lg-12" value="" name="student_answer"></textarea></center>
                </div>
                </center></div>';
                }
            }
            ?>
        </div>

            <!--THE NAVIGATION PANE -->
            <div id="navPane" class="text-center">
                <div id="itemsPane" class="col-md-8">
                    <ul class="pagination">
                    <?php
                     $counter = 1;
					 foreach($items as $item){
                        switch($item->type){
                            case 1: //MCQ
                                echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$counter.'</a></li>';
                                $counter++;
                                break;

                            case 2: //True or False
                                echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$counter.'</a></li>';
                                $counter++;
                                break;

                            case 3: //Matching Type
                                if($item->question_id == $item->matching_id){ //Else if matching type, then gather all the questions for the matching_id
                                    echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$item->question_id.'</a></li>';
                                    $counter++;
                                }                  
                                break;
                            case 4: //Fill-in-the-blanks
                                echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$counter.'</a></li>';
                                $counter++;
                                break;

                            case 5: //Identification
                                echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$counter.'</a></li>';
                                $counter++;
                                break;

                            case 6: //Essay
                                echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$counter.'</a></li>';
                                $counter++;
                                break;

                            case 7: //Programming
                                echo '<li><a id="question'.$counter.'" value="'.$item->question_id.'" onClick="showItem('.$item->question_id.')">'.$counter.'</a></li>';
                                $counter++;
                                break;
                        }
                     }
                    ?>
                    </ul>
                </div>

                <div id="endExam" class="col-md-6">
                    <button type="submit" name="submitbutton" onclick="return confirm('Are you sure you want to end exam?'); return SubmitForm();" class="btn btn-primary btn-lg">End Exam<br>(There is a confirmation)</button>
                </div>

            </div>

         </form>
    </section>

        <!-- javascripts -->
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>

    <!-- jquery ui -->
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom checkbox & radio-->
    <script type="<?php echo base_url(); ?>text/javascript" src="js/ga.js"></script>
    <!--custom switch-->
    <script src="<?php echo base_url(); ?>js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="<?php echo base_url(); ?>js/jquery.tagsinput.js"></script>
    
    <!-- colorpicker -->
   
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url(); ?>js/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-wysiwyg.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap-wysiwyg-custom.js"></script>
    <!-- ck editor -->
    <script type="<?php echo base_url(); ?>text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!-- custom form component script for this page-->
    <script src="<?php echo base_url(); ?>js/form-component.js"></script>
    <!-- custome script for all page -->
    <script src="<?php echo base_url(); ?>js/scripts.js"></script>

    <script>
    //JQUERY

    //Function for showing items dynamically
    function showItem($question_id){
       var e = document.getElementById($question_id);
       e.style.display = 'block';
       if(document.getElementById("oldItem").value != ""){
            if(document.getElementById("oldItem").value != $question_id){ //If not same item clicked, hide the div
                document.getElementById(document.getElementById("oldItem").value).style.display = 'none';

                //Check if user set an answer in previous
                if(document.getElementById("student_answer"+document.getElementById("oldItem").value).value != ""){
                //Pass the question_id, the student's answer, the exam_key, the type, the corresponding point, and stud_no
                    alert(document.getElementById("student_answer"+document.getElementById("oldItem").value).value);
                    alert(document.getElementById("type"+document.getElementById("oldItem").value).value);
                    if(document.getElementById("type"+document.getElementById("oldItem").value).value != 3){ //If the type is not matching
                        document.location.href = "<?php echo base_url(); ?>index.php/checker/submitAnswer/" + document.getElementById("oldItem").value + "/" + document.getElementById("student_answer"+document.getElementById("oldItem").value).value + "/" + document.getElementById("exam_key").value + "/" + document.getElementById("type"+document.getElementById("oldItem").value).value + "/" + document.getElementById("score"+document.getElementById("oldItem").value).value + "/" + document.getElementById("stud_no").value + "/" + document.getElementById("exam_desc").value + "/" + document.getElementById("firstName").value + "/" + document.getElementById("lastName").value + "/" + document.getElementById("total_score").value + "/";
                    }
                    else{ //If matching, do the submit quantity times

                        //The array of questions
                        var questions = document.getElementById("oldItem").value + "_" + (parseInt(document.getElementById("oldItem").value)+1) + "_" + (parseInt(document.getElementById("oldItem").value)+2) + "_" + (parseInt(document.getElementById("oldItem").value)+3);
                        
                        var answers = document.getElementById("student_answer"+(parseInt(document.getElementById("oldItem").value))).value + "_" + document.getElementById("student_answer"+(parseInt(document.getElementById("oldItem").value) + 1)).value + "_" + document.getElementById("student_answer"+(parseInt(document.getElementById("oldItem").value) + 2)).value + "_" + document.getElementById("student_answer"+(parseInt(document.getElementById("oldItem").value) + 3)).value;

                        alert("Question numbers: "+questions);
                        alert("Answers :"+answers);

                        //var i = 0;
                        document.location.href = "<?php echo base_url();?>index.php/checker/submitAnswer/"+questions+"/"+answers+"/"+ document.getElementById("exam_key").value + "/" + document.getElementById("type"+document.getElementById("oldItem").value).value + "/" + document.getElementById("score"+document.getElementById("oldItem").value).value + "/" + document.getElementById("stud_no").value + "/" + document.getElementById("exam_desc").value + "/" + document.getElementById("firstName").value + "/" + document.getElementById("lastName").value + "/" + document.getElementById("total_score").value + "/";

                        //for(i=0;i<parseInt(document.getElementById("quantity").value);i++){
                            //document.location.href = "<?php echo base_url(); ?>index.php/checker/submitAnswer/" + ( parseInt(document.getElementById("oldItem").value) + 1) + "/" + document.getElementById("student_answer"+(parseInt(document.getElementById("oldItem").value) + 1)).value + "/" + document.getElementById("exam_key").value + "/" + document.getElementById("type"+document.getElementById("oldItem").value).value + "/" + document.getElementById("score"+document.getElementById("oldItem").value).value + "/" + document.getElementById("stud_no").value + "/" + document.getElementById("exam_desc").value + "/" + document.getElementById("firstName").value + "/" + document.getElementById("lastName").value + "/" + document.getElementById("total_score").value + "/";
                            //document.location.href = "<?php echo base_url(); ?>index.php/checker/submitAnswer/" + ( parseInt(document.getElementById("oldItem").value) + i) + "/" + document.getElementById("student_answer"+(parseInt(document.getElementById("oldItem").value) + i)).value + "/" + document.getElementById("exam_key").value + "/" + document.getElementById("type"+document.getElementById("oldItem").value).value + "/" + document.getElementById("score"+document.getElementById("oldItem").value).value + "/" + document.getElementById("stud_no").value + "/" + document.getElementById("exam_desc").value + "/" + document.getElementById("firstName").value + "/" + document.getElementById("lastName").value + "/" + document.getElementById("total_score").value + "/";
                            
                        //} //end of loop
                    }//end of else   
                }//end of checking if previous item has been answered
            }//end of condition to check if not same item
       } //end of condition to check if item has question
       document.getElementById("oldItem").value = $question_id; //Show new question
   }

    </script>

  </body>
</html>
