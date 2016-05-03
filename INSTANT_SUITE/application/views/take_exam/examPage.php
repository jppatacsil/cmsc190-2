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
        height: 90%;
        width: 75%;
        background-color: #D2B48C;
        border-radius: 5px;
        padding: 20px;
        opacity: 0.75;
    }

    #itemsPane {
        position:absolute;
        top: 80%;
    }

    #endExam {
        position:absolute;
        top: 85%;
        left: 60%;
    }

    #item1 { /*Set the first item as active*/
        background-color: #4CAF50;
        color: white;
    }

</style>

<script>


</script>

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

                $index = 0;
                foreach($template as $j){ //the template
                    $category[$index] = $j->category;
                    $no_of_items[$index] = $j->no_of_item;
                    $difficulty[$index] = $j->difficulty;
                    $index++;
                }

            ?>

    <!--THE HEADER DIV-->
    <div id="header">
        <div class="col-lg-12">
            <div class="col-md-2">
                <img src="<?php echo base_url()."/img/instant-square.png"?>" height="150" width="200">
            </div>

            <div class="col-md-2">
                <?php
                    echo '<h1 style="color: white">'.$exam_desc;
                ?>
            </div>

            <div class="col-md-4">
                <?php
                    echo '<h1 id="duration" style="color: white">TIME REMAINING:<br>'.$duration.' mins';
                ?>
            </div>

            <div class="col-md-4">
                <?php
                    echo '<h1 style="color: white">'.$student_no.': '.$lastName.',<br>'.$firstName; 
                ?>
            </div>
        </div>
    </div>

    <!--THE QUESTION DIV-->
    <section id="mainPanel">
        <form method="POST" action="<?php echo base_url()."index.php/checker/showResults/"?>">

            <!--The hidden values necessary for passing data-->
            <input type="hidden" name="exam_no" value="<?php echo $exam_no; ?>">
            <input type="hidden" name="exam_desc" value="<?php echo $exam_desc; ?>">
            <input type="hidden" name="student_no" value="<?php echo $student_no; ?>">
            <input type="hidden" name="firstName" value="<?php echo $firstName; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
            <input type="hidden" name="total_score" value="<?php echo $total_score; ?>"> 
            <input type="hidden" name="computedScore" value="7"> <!--CONSTANT VALUE YET-->

            <?php //Print template
                for($counter=0;$counter<count($template);$counter++){
                    echo 'Category: '.$category[$counter].'<br>';
                    echo 'No of items: '.$no_of_items[$counter].'<br>';
                    echo 'Difficulty: '.$difficulty[$counter].'<br>';
                }
            ?>

            <?php
                /*
                foreach($questionDetails as $details){
                    $category = $details->category;
                    $type = $details->type;
                    $question = $details->question;
                    $question_id = $details->question_id;
                    $credit = $details->credit;
                }
                */
            ?>

            <?php
            /*
            if( $type == 1){ //FOR MCQ
                echo '<div class="form-group">
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <select class="form-control col-lg-12" name="student_answer">';
                        foreach($questionDetails as $choices){
                            echo '<option value="'.$choices->choice.'">
                                '.$choices->choice.'
                            </option>';
                        }
                echo '</select>
                </center>
                </div>';
            }else if($type == 2){ //FOR TnF
                echo '<div class="form-group">
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <input type="hidden" name="score" value="'.$credit.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <select class="form-control col-lg-12" name="student_answer">
                    <option value="TRUE">TRUE</option>
                    <option value="FALSE">FALSE</option>
                </select>
                </center>
                </div>';
            }else if($type == 3){ //For Matching Type
                echo '<div class="form-group">
                        <input type="hidden" name="score" value="'.$credit.'">
                        <center><h1 style="color: white">Match column A with column B</h1></center>
                    <div class="col-md-6">
                        <center><h2 style="color: white">COLUMN A</h2></center>';
                                        foreach($questionDetails as $q){
                                          echo '<input type="text" class="form-control" value="'.$q->question.'" readonly>';
                                        }
                                    echo '</div>
                                    <div class="col-md-6">
                                    <center><h2 style="color: white">COLUMN B</h2></center>';
                                        $length = count($questionDetails);
                                        for($i=0;$i<$length;$i++){
                                          echo '<select class="form-control col-md-6" name="student_answer[]">';
                                          foreach($choicesDetails as $c){
                                          echo '<option value="'.$c->choice.'">'.$c->choice.'
                                                </option>';
                                          }
                                          echo '</select>';
                                        }
                echo '</div>
                </div>';
            }else if($type == 4 || $type == 5){ //For FnB or Identification
                echo '<div class="form-group">
                <input type="hidden" name="score" value="'.$credit.'">
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%; top: 200px;">
                    <center><input required="true" type="text" class="form-control" name="student_answer"></center>
                </div>
                </center></div>';
            }else if($type == 6){ //For essay
                echo '<div class="form-group">
                <input type="hidden" name="score" value="'.$credit.'">
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%; top: 200px;">
                    <center><textarea required="true" class="form-control col-lg-12" name="student_answer"></textarea></center>
                </div>
                </center></div>';
            }else if($type == 7){ //For programming
                echo '<div class="form-group">
                <input type="hidden" name="score" value="'.$credit.'">
                <input type="hidden" name="question_id" value="'.$question_id.'">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%; top: 200px;">
                    <center><textarea required="true" class="form-control col-lg-12" name="student_answer"></textarea></center>
                </div>
                </center></div>';
            }
            */
            ?>

            <!--THE NAVIGATION PANE -->
            <div id="navPane" class="text-center">
                <div id="itemsPane" class="col-md-6">
                    <ul class="pagination">
                    <?php
                     echo '<li><a id="prev" href="#">«</a></li>';
                     for($j=0;$j<$total_items;$j++){
                        echo '<li><a id="item'.($j+1).'"  href="#">'.($j+1).'</a></li>';
                     }
                     echo '<li><a id="next" href="#">»</a></li>';
                    ?>
                    </ul>
                </div>
                <div id="endExam" class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-lg">End Exam<br>(There is a confirmation)</button>
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

  </body>
</html>
