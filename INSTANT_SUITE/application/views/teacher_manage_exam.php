<!DOCTYPE html>
<?php 
$this->load->helper('url'); ?>
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
                    <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
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
                              Exams List
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_book"></i> Subject</th>
                                 <th><i class="icon_"></i> Description</th>
                                 <th><i class="icon_calendar"></i> Date of Exam</th>
                                 <th><i class="icon_time"></i> Duration</th>
                                 <th><i class="icon_question_alt2"></i> No. of Questions </th>
                                 <th><i class="icon_"></i> Total Score</th>
								                 <th><i class="icon_cogs"></i> Action</th>
                              </tr>
										<?php
										if($exams != NULL){
										foreach($exams as $row){
                              echo '<tr>';
                              echo '<td>'.$row->course_code.' '.$row->section.'</td>';
                              echo '<td>'.$row->exam_desc.'</td>';
                              echo '<td>'.$row->exam_date.'</td>';
                              echo '<td>'.$row->duration.'</td>';
                              echo '<td>'.$row->total_items.'</td>';
							                echo '<td>'.$row->total_score.'</td>';
										          echo
                                 '<td>
                                  <div class="btn-group">
                                        <a class="btn btn-success" onclick = "editExam('.$row->exam_no.')"><i class="icon_pencil-edit"></i></a>
											                  <a class="btn btn-danger" onclick = "deleteExam('.$row->exam_no.')"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>';
										          echo	'</tr>';
											}						
										}
										?>
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>
    <!--END MODAL ADD EXAM-->

              <!-- page end-->
          </section>
  </body>
  
  <script language="javascript">

		function editExam($exam_no){
			///document.location.href = "<?php echo base_url(); ?>index.php/home/loadEditExam/" + $exam_no + "/";
			 $("#main-content").load("loadEditExam/"+$exam_no).hide(500).fadeIn();
		}
		
		function deleteExam($exam_no){
			if (confirm("Delete this Exam?") == true) {
				document.location.href = "<?php echo base_url(); ?>index.php/home/deleteExam/" + $exam_no + "/";
				alert("Exam Deleted!");
			} else {
				alert("Exam is Unharmed");
			}
		}
		
	</script>
</html>
