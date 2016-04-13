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
	 
	<script>	
	var counter = 1;
	function addCategory(divName){
				 var newdiv = document.createElement('div');
				 newdiv.innerHTML = 
					"Category " + (counter + 1) + 
					" <br><input type='text' name='category[]'> Total Items<br><input type='number' min='1' name='totalItems[]'> Difficulty<br><select name='difficulty[]'> " +
					" <option value='1'>EASY</option>" +
					" <option value='2'>AVERAGE</option>" +
					" <option value='3'>DIFFICULT</option></select>";
				 document.getElementById(divName).appendChild(newdiv);
				 counter++;
	}
	</script>

  </head>
  <body>
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-file-text-o"></i>Edit Exam</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>Home</a></li>
            <li><i class="icon_document_alt"></i>Forms</li>
            <li><i class="fa fa-file-text-o"></i>Edit Exam</li>
          </ol>
        </div>
      </div>
              <!-- EXAM TEMPLATE FORM -->
              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Exam template
                          </header>
                    <div class="panel-body">
                  <?php 
							foreach($exams as $row){
								$examNo = $row->exam_no;
							}
						?>
                  <form id="examForm" method="post" action="<?php echo base_url()."index.php/teachers/editExam/".$examNo."/"?>" class="form-horizontal">
                      <!-- Course Code -->
                      <!-- Select Basic -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="courseCode">Course code</label>
                        <div class="col-md-4">
						<?php 
							foreach($exams as $row){
								$courseCode = $row->course_code;
								$section = $row->section;
								$examDate = $row->exam_date;
								$examDesc = $row->exam_desc;
								$totalItems = $row->total_items;
								$exam_no = $row->exam_no;
							}
						?>
                         <input type="text" name="course_code" readonly="true" value="<?php echo $courseCode.' '.$section; ?>">
                        </div>
                      </div>

                      <!-- Date of Exam -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="exam_date">Examination Date</label>
                        <div class="col-md-4">
                        <input type="date" name="examinationDate" value="<?php echo $examDate; ?>">
                      </div>
                      </div>

                      <!-- Description -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" placeholder="Exam Description" for="exam_desc">Description</label>
                        <div class="col-md-4">                     
                         <textarea class="form-control" id="exam_desc" name="exam_desc"><?php echo $examDesc; ?></textarea>
                        </div>
                      </div>
                             
                      <!-- Total number of Items -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="no_of_items">Total number of items</label>
                        <div class="col-md-4">                     
                         <input type="number" name="no_of_items" min="1" value="<?php echo $totalItems; ?>">
                        </div>
                      </div>

							<div class="form-group">
							<!-- table table-striped table-advance table-hover -->
								<table class="col-md-4">
								<div class="col-md-4">
								   <tbody>
									<center>
									  <tr>
										 <th><i class="icon_book"></i> Category</th>
										 <th><i class="icon_question_alt2"></i> No. of Items </th>
										 <th><i class="icon_cogs"></i> Difficulty</th>
									  </tr>
									<?php
									foreach($category as $row){
										echo '<tr>';
										echo '<td><input type="text" name="category" readonly value="'.$row->category.'"></td>';
										echo '<td><input type="number" min="1" name="totalItems[]" value ="'.$row->no_of_item.'"></td>';
										echo '<td>
											<select name="difficulty[]">
											<option value="1">EASY</option>
											<option value="2">AVERAGE</option>
											<option value="3">DIFFICULT</option>
										</select>
										</td>';
										echo '</tr>';
									} ?>
									</center>
								   </tbody>
									</div>
                        </table>
							</div>							 
                          
                        <!-- SAVE THE EXAM TEMPLATE -->
                            <div class="form-group">  
                              <td><center><button type="submit" class="btn btn-primary btn-lg" >
                                Save Exam
                              </button></td></center>
                            </div>
                          </div>
                           </div> 
                               </form>
                            </div>
                    </section>
                      
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

  </body>
</html>
