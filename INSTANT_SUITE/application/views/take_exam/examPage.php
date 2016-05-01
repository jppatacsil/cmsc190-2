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
        top: 25%;
        left: 15%;
        width: 1000px;
        height: 450px;
        background-color: #D2B48C;
        border-radius: 5px;
        padding: 20px;
        opacity: 0.75;
    }

    #itemsPane {
        position:absolute;
        top: 75%;
    }

    #endExam {
        position:absolute;
        top: 75%;
        left: 60%;
    }


</style>

  <body class="login-img3-body">

    <!--THE HEADER DIV-->
    <div id="header">
        <div class="col-lg-12">
            <div class="col-md-8">
                <img src="<?php echo base_url()."/img/instant.png"?>" height="150" width="800">
            </div>

            <div class="col-md-4">
                      <!-- <h1>1908-00001: ACCOUNT,<br>TESTING A</h1> -->
            <?php
                foreach($examinee as $row) 
                echo '<h1 style="color: white">'.$row->student_no.': '.$row->lastName.',<br>'.$row->firstName; 
            ?>
            </div>
        </div>
    </div>

    <!--THE QUESTION DIV-->
    <div id="mainPanel">
        <form method="POST">

            <!--Constant Values-->
            <input type="hidden" name="exam_no" value="47">
            <input type="hidden" name="stud_no" value="2012-12345">

            <?php
                foreach($questionDetails as $details){
                    $category = $details->category;
                    $type = $details->type;
                    $question = $details->question;
                    $question_id = $details->question_id;
                    $credit = $details->credit;
                }
            ?>

            <?php if( $type == 1){ //FOR MCQ
                echo '<div class="form-group">
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
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%; top: 200px;">
                    <center><input required="true" type="text" class="form-control" name="student_answer"></center>
                </div>
                </center></div>';
            }else if($type == 6){ //For essay
                echo '<div class="form-group">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%; top: 200px;">
                    <center><textarea required="true" class="form-control col-lg-12" name="student_answer"></textarea></center>
                </div>
                </center></div>';
            }else if($type == 7){ //For programming
                echo '<div class="form-group">
                <center>
                <h1 style="color: white">'.$question.'</h1>
                <div class="col-lg-6" style="left: 25%; top: 200px;">
                    <center><textarea required="true" class="form-control col-lg-12" name="student_answer"></textarea></center>
                </div>
                </center></div>';
            }
            ?>

            <div id="navPane" class="text-center">
                <div id="itemsPane" class="col-md-6">
                    <ul class="pagination">
                    <?php
                     echo '<li><a href="#">«</a></li>';
                     foreach($items as $i){
                        $i->sum;
                     }
                     for($j=0;$j<($i->sum);$j++){
                        echo '<li><a href="#">'.($j+1).'</a></li>';
                     }
                     echo '<li><a href="#">»</a></li>';
                    ?>
                    </ul>
                </div>
                <div id="endExam" class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-lg">End Exam<br>(There is a confirmation)</button>
                </div>
            </div>
         </form>
    </div>

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
