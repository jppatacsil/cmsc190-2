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
        height: 100%;
        width: 75%;
        background-color: #D2B48C;
        border-radius: 5px;
        padding: 20px;
        opacity: 0.75;
    }

    .panel-body{
        background-color: white;
    }

</style>

<body class="login-img3-body">

    <!--GET THE EXAM TEMPLATE-->
        <?php
        $i = 0;
        foreach($template as $details){
            $category[$i] = $details->category;
            $no_of_item[$i] = $details->no_of_item;
            $difficulty[$i] = $details->difficulty;
            $type[$i] = $details->type;
            $i++; //Increment
        }

        foreach($mcqDetails as $mcq){
            $question1 = $mcq->question;
            $question_id1 = $mcq->question_id;
            $credit1 = $mcq->credit;
        }

        foreach($tfDetails as $tf){
            $question2 = $tf->question;
            $question_id2 = $tf->question_id;
            $credit2 = $tf->credit;
        }        

        ?>

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
                echo '<h1 style="color: white">'.$row->student_no.': '.$row->lastName.',<br>'.$row->firstName.'</h1>'; 
            ?>
            </div>
        </div>
    </div>


    <input type="hidden" name="exam_no" value="49">
    <input type="hidden" name="stud_no" value="201212345">
    <!-- The main examination form -->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
            <header class="panel-heading">
                <?php
                    foreach($exam as $examRow){
                        echo '<h1>'.$examRow->exam_desc.'<h1>';
                    }
                ?>
            </header>

            <div class="panel-body">
                <form class="form-horizontal" action="<?php echo base_url()."index.php/teachers/bankQuestion/". 1 ?>" method="post" role="form" id="form2">
                    
                    <!-- MULTIPLE-CHOICE -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="category"><h2>Category</h2></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" style="font-size: 24px;" value="<?php echo $category[0]; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                                  <label class="col-md-2 control-label" for="question"><h3>QUESTION</h3></label>  
                                  <div class="col-lg-10">
                                  <textarea required="true" class="form-control" rows="5" cols="30" name="questionProper" readonly><?php echo $question1; ?></textarea>
                                  <input type="hidden" name="question_id" value="<?php echo $question_id1; ?>">
                                  </div>
                                </div>
                                                                              
                                <div class="form-group">    
                                  <label class="col-md-3 control-label" for="student_answer"><h4>Your Answer</h4></label>
                                  <div id="choiceInput" class="col-md-6">
                                    <select class="col-lg-12 form-control" style="font-size: 18px" name="student_answer">
                                      <?php
                                        foreach($mcqDetails as $choices){
                                          echo '<option value="'.$choices->choice.'">
                                               '.$choices->choice.'
                                               </option>';
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </div>

                    <!-- TRUE OR FALSE -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="category"><h2>Category</h2></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" style="font-size: 24px;" value="<?php echo $category[1]; ?>" readonly>
                        </div>
                    </div>

                                        <div class="form-group">
                                  <label class="col-md-2 control-label" for="question"><h3>QUESTION</h3></label>  
                                  <div class="col-lg-10">
                                  <textarea required="true" class="form-control" rows="5" cols="30" name="questionProper" readonly><?php echo $question2; ?></textarea>
                                  <input type="hidden" name="question_id" value="<?php echo $question_id2; ?>">
                                  </div>
                                </div>
                                                                              
                                <div class="form-group">    
                                  <label class="col-md-3 control-label" for="student_answer"><h4>Your Answer</h4></label>
                                  <div id="choiceInput" class="col-md-6">
                                    <select class="col-lg-12 form-control" style="font-size: 18px" name="student_answer">
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                  </div>
                                </div>

                    <!-- MATCHING TYPE -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="category"><h2>Category</h2></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" style="font-size: 24px;" value="<?php echo $category[2]; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                                    <label class="col-md-2 control-label" for="matchingQnA"><h3>Column A and Column B</h3></label>
                                    <div class="col-md-1">
                                    <?php
                                      foreach($matchingDetails as $num){
                                        echo '<input type="num" name="question_id[]" class="form-control" value="'.$num->question_id.'" readonly>';
                                      }
                                    ?>
                                    </div>
                                    <div class="col-md-4">
                                      <?php
                                        foreach($matchingDetails as $q){
                                          echo '<input type="text" class="form-control" value="'.$q->question.'" readonly>';
                                        }
                                      ?>
                                    </div>
                                    <div class="col-md-4">
                                      <?php
                                        $length = count($matchingDetails);
                                        for($i=0;$i<$length;$i++){
                                          echo '<select class="form-control col-md-6" name="student_answer[]">';
                                          foreach($choicesDetails as $c){
                                          echo '<option value="'.$c->choice.'">'.$c->choice.'
                                                </option>';
                                          }
                                          echo '</select>';
                                        }
                                      ?>
                                    </div>
                                 </div>


                    <!-- Fill-in-the-blanks -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="category"><h2>Category</h2></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" style="font-size: 24px;" value="<?php echo $category[3]; ?>" readonly>
                        </div>
                    </div>
                                                          
                                                
                </form>
            </div>
            </section>

</body>

</html>