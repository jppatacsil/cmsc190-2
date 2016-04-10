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
          <section class="wrapper">
          <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="fa fa-table"></i>Table</li>
                        <li><i class="fa fa-th-list"></i>Edit Exam</li>
                    </ol>
                </div>
            </div>
              <!-- page start-->
             
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Exam Details
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr> <!--HEADINGS-->
											<th>Referencing Exam</th>
											<th>Description</th>
											<th>Date</th>
											<th>Number of Questions</th>
                                 <th>Question ID</th>
                                 <th>Type</th>
                                 <th>Question </th>
                                 <th>Corresponding Points</th>
                                 <th>Answer</th>
                                 <th><i class="icon_cogs"></i></th>
                              </tr>
										
										<tr>
											<td>MSUNIVERSE 101</td>
											<td>ANG SUBJECT PARA SA MSUNIVERSE</td>
											<td>4/4/2016</td>
											<td>100</td>
											<td>1</td>
											<td>Identification</td>
											<td>Sino ang Ms. Universe 2016?</td>
											<td>10</td>
											<td>Pia Wurtzbach</td>
											 <td>
                                  <div class="btn-group">
                                        <a class="btn btn-success" href="#editQuestionModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a><a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
										</tr>   
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>
				   <!-- EDIT QUESTION START -->
				  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editQuestionModal" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Edit Question</h4>
                                          </div>
                                          <div class="modal-body">
                                              <form class="form-horizontal" role="form">
                                                <div class="form-group">
																	<label class="col-md-4 control-label" for="examsubject">Exam Description</label>
																	<div class="col-md-4"> 
																	<textarea required="true" class="form-control" rows="5" name="exam_desc"></textarea>
																	</div>
																</div>
																
																<div class="form-group">
                                                      <label class="col-md-4 control-label" for="exam_date">Exam Date</label>
																		<div class="col-md-4">
																		<input type="date" name="exam_date">
																		</div>
                                                </div>
																
																<div class="form-group">
																	<label class="col-md-4 control-label" for="no_of_items">Total number of items</label>
																	<div class="col-md-4">                     
																	 <input type="number" name="no_of_items" min="1">
																	</div>
																 </div> 
																 
																 <div class="form-group">
																	<label class="col-md-4 control-label" for="questionProper">Question</label>
																	<div class="col-md-4"> 
																	<textarea required="true" class="form-control" rows="5" name="questionProper"></textarea>
																	</div>
																</div>
																
																<div class="form-group">
                                                      <label class="col-md-4 control-label" for="inputPoints">Corresponding Point</label>
                                                      <div class="col-md-4">
																			<input required="true" type="number" min="1" class="form-control" id="inputPoints" name="points">
                                                      </div>
                                                   </div>
                                                                    
                                                   <div class="form-group">    
                                                      <label class="col-md-4 control-label" for="inputPoints">Correct Answer</label>
                                                     <div class="col-md-4">
                                                      <input required="true" type="input" class="form-control" id="correctAnswer" name="answer">
                                                      </div>
                                                   </div>

																<div class="form-group">  
																	<td><center><button type="submit" class="btn btn-success btn-lg">
																	  Save Edit
																	</button></td></center>
																</div>
                                              </form>

                                          </div>

                                      </div>
                                  </div>
					</div>
				  <!-- EDIT QUESTION END -->
				  
          </section>


			 <!-- container section end -->
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
