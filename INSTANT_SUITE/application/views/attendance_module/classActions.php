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

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url(); ?>css/bootstrap-theme.css" rel="stylesheet">
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
  <!-- container section start -->


          <section class="wrapper">
          <div class="row">
                <div class="col-lg-12">
                    <!--<h3 class="page-header"><i class="fa fa-table"></i><?php echo $subject; ?></h3>-->
                    <?php  foreach($class as $row): ?>
                        <h3 class="page-header"><i class="fa fa-table"></i><?php echo $row->course_code, "-", $row->section;?></h3>            
                    <?php endforeach ?> 
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="fa fa-table"></i>Table</li>
                        <li><i class="fa fa-th-list"></i>Exam List</li>
                    </ol>
                </div>
            </div>
              <!-- page start-->
             
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Examinations
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_book"></i> Subject</th>
                                 <th><i class="icon_menu"></i> Description</th>
                                 <th><i class="icon_question_alt2"></i> No. of Questions</th>
                                 <th><i class="icon_calendar"></i> Date of Exam</th>
                                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
                              <tr>
                                 <td>CMSC 11</td>
                                 <td>1ST Long Exam</td>
                                 <td>50/50</td>
                                 <td>02/15/2016</td>
                                 
                                 <td>
                                  <div class="btn-group">
                                        <a class="btn btn-success" href="#editExamModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                        <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>
                              <tr>
                                 <td>CMSC 161</td>
                                 <td>1ST Long Exam</td>
                                 <td>100/100</td>
                                 <td>03/10/2016</td>
                                
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-success" href="#editExamModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>
                              <tr>
                                 <td>CMSC 142</td>
                                 <td>1ST Long Exam</td>
                                 <td>80/80</td>
                                 <td>03/15/2016</td>
                               
                                 <td>
                                  <div class="btn-group">
                                       <a class="btn btn-success" href="#editExamModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>
                              <tr>
                                 <td>CMSC 123</td>
                                 <td>1st Long Exam</td>
                                 <td>100/100</td>
                                 <td>03/07/2016</td>
                                
                                 <td>
                                  <div class="btn-group">
                                        <a class="btn btn-success" href="#editExamModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>
                              <tr>
                                 <td>CMSC 132</td>
                                 <td>1ST Long Exam</td>
                                 <td>70/70</td>
                                 <td>03/08/2016</td>
                                
                                 <td>
                                  <div class="btn-group">
                                        <a class="btn btn-success" href="#editExamModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                        <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                              </tr>                  
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>

    <!-- MODAL ADD EXAM -->

     <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editExamModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">Questions</h4>
                    </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <section class="panel">
                                <header class="panel-heading">
                                    Questions
                                </header>
                                
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                             <th>#</th>
                                             <th>Question</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>DBMS means Database Management System</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Who is the father of computer science?</td>
                                        </tr>
                                    </tbody>
                                        </table>
                                     </section>
                                  </div>
                            
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                   <a href="teacher_create_question.html"> <button type="submit" class="btn btn-primary">Add Question</button> </a>
                                    <button type="submit" href="<?php echo site_url('teachers/teacherActions/1')?>"  class="btn btn-primary" >Save Exam</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--END MODAL ADD EXAM-->

              <!-- page end-->
          </section>
     
  </body>
</html>
