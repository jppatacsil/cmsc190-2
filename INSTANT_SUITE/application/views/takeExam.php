<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>INSTANT SUITE</title>

   <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url(); ?>css/bootstrap-theme.css"rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url(); ?>css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles -->
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>

  <body>
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa fa-bars"></i>Check Answers</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
            <li><i class="fa fa-bars"></i>Check</li>
            <li><i class="fa fa-square-o"></i>Check Answers</li>
          </ol>
        </div>
      </div>
              <!-- page start-->
              <!-- Basic Forms & Horizontal Forms-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Answer Question
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal" action="<?php echo base_url()."index.php/checker/submitAnswer/"?>" method="post" role="form" id="form2">
                              <!-- Category -->
                              <?php
                                foreach($questionDetails as $details){
                                  $category = $details->category;
                                  $question = $details->question;
                                  $question_id = $details->question_id;
                                  $credit = $details->credit;
                                }
                              ?>
                                <div class="form-group">
                                  <label class="col-md-3 control-label" for="category">Category</label>
                                  <div class="col-md-4">
                                    <input type="text" class="form-control" value="<?php echo $category; ?>" readonly>
                                    <input type="hidden" name="exam_no" value="44">
                                    <input type="hidden" name="stud_no" value="201212345">
                                  </div>
                                </div>
                                      
                                <!--FOR MCQ AND TF
                                <div class="form-group">
                                  <label class="col-md-2 control-label" for="question">QUESTION</label>  
                                  <div class="col-lg-10">
                                  <textarea required="true" class="form-control" rows="5" cols="30" name="questionProper" readonly><?php echo $question; ?></textarea>
                                  <input type="hidden" name="question_id" value="<?php //echo $question_id; ?>">
                                  </div>
                                </div>
                                                                              
                                <div class="form-group">    
                                  <label class="col-md-3 control-label" for="student_answer">Your Answer</label>
                                  <div id="choiceInput" class="col-md-6">
                                    <select class="col-lg-12 form-control" name="student_answer">
                                      <?php
                                      /*
                                        foreach($questionDetails as $choices){
                                          echo '<option value="'.$choices->choice.'">
                                               '.$choices->choice.'
                                               </option>';
                                        }
                                      */
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                -->

                                 <!--FOR MATCHING
                                 <div class="form-group">
                                    <label class="col-md-2 control-label" for="matchingQnA">Column A and Column B</label>
                                    <div class="col-md-1">
                                    <?php
                                    /*
                                      foreach($questionDetails as $num){
                                        echo '<input type="num" name="question_id[]" class="form-control" value="'.$num->question_id.'" readonly>';
                                      }
                                    */
                                    ?>
                                    </div>
                                    <div class="col-md-4">
                                      <?php
                                      /*
                                        foreach($questionDetails as $q){
                                          echo '<input type="text" class="form-control" value="'.$q->question.'" readonly>';
                                        }
                                      */
                                      ?>
                                    </div>
                                    <div class="col-md-4">
                                      <?php
                                      /*
                                        $length = count($questionDetails);
                                        for($i=0;$i<$length;$i++){
                                          echo '<select class="form-control col-md-6" name="student_answer[]">';
                                          foreach($choicesDetails as $c){
                                          echo '<option value="'.$c->choice.'">'.$c->choice.'
                                                </option>';
                                          }
                                          echo '</select>';
                                        }
                                        */
                                      ?>
                                    </div>
                                 </div>
                                 -->

                                 <!--FOR FnB and Identification-->
                                <div class="form-group">
                                  <label class="col-md-2 control-label" for="question">QUESTION</label>  
                                  <div class="col-lg-10">
                                  <textarea required="true" class="form-control" rows="5" cols="30" name="questionProper" readonly><?php echo $question; ?></textarea>
                                  <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
                                  </div>
                                </div>

                                <div class="form-group">    
                                  <label class="col-md-3 control-label" for="student_answer">Your Answer</label>
                                  <div class="col-lg-9">
                                  <input required="true" type="input" class="form-control" name="student_answer">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-2 control-label" for="score">Corresponding Point</label>
                                  <div class="col-md-3">
                                  <input required="true" type="number" min="1" max="3" class="form-control" name="score" value="<?php echo $credit; ?>" readonly>
                                  </div>
                                </div>
                                                                            
                                <div class="form-group">    
                                  <td><center>
                                  <button type="submit" class="btn btn-primary btn-lg">
                                  Submit Answer
                                  </button>
                                  </td></center>
                                </div>
                              </form>
                          </div>
                  </section>
              <!-- page end-->
          </section>
  </body>
</html>
