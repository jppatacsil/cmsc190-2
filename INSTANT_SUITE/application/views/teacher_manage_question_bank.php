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
		function filterType(){
			var type = document.getElementById("type");
			type = type.options[type.selectedIndex].value;
			
			document.location.href = "<?php echo base_url(); ?>index.php/home/filterType/" + type + "/";
			
			var questionBank = document.getElementById("questionBank");
		}
	</script>
  </head>

  <body>
          <section class="wrapper">
          <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                        <li><i class="fa fa-table"></i>Table</li>
                        <li><i class="fa fa-th-list"></i>Manage Question Bank</li>
                    </ol>
                </div>
            </div>
              <!-- page start-->
			<div class="row">
				<div class="col-lg-12">
					<select id="type" onchange="filterType()">
						<option value="0">ALL</option>
						<option value="1">MULTIPLE CHOICE</option>
						<option value="2">TRUE OR FALSE</option>
						<option value="3">MATCHING TYPE</option>
						<option value="4">FILL IN THE BLANKS</option>
						<option value="5">IDENTIFICATION</option>
						<option value="6">ESSAY</option>
						<option value="7">PROGRAMMING</option>
					</select>
					<select id="category">
						<option value="1">DBMS</option>
						<option value="2">INTERNET</option>
						<option value="3" selected>ALL</option>
					</select>
					<select id="difficulty">
						<option value="1">EASY</option>
						<option value="2">AVERAGE</option>
						<option value="3">DIFFICULT</option>
						<option value="4" selected>ALL</option>
					</select>
				  </div>
				</div>
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Questions
                          </header>
                          
                          <table class="table table-striped table-advance table-hover" id = "questionBank">
						   <tbody>
                              <tr> <!--HEADINGS-->
                                 <!--<th></i>Question ID</th>-->
                                 <th>Type</th>
                                 <th>Category </th>
								 <th>Corresponding Points</th>
								 <th>Question </th>
                                 <th>Answer</th>
											<!--<th>Referencing Exam</th>-->
                                 <th><i class="icon_cogs"></i></th>
                              </tr>
										<?php
										
										foreach($questions as $row){
                              echo '<tr>';
                              //echo '<td>'.$row->question_id.'</td>';
                              echo '<td>';
								switch($row->type){
									case 1: echo 'Multiple Choice';break;
									case 2: echo 'True or False';break;
									case 3: echo 'Matching Type';break;
									case 4: echo 'Fill in the Blanks';break;
									case 5: echo 'Identification';break;
									case 6: echo 'Essay';break;
									case 7: echo 'Programming';break;
								}
								
							  '</td>';
								echo '<td>'.$row->category.'</td>';
								echo '<td>'.$row->credit.'</td>';
								echo '<td>'.$row->question.'</td>';
								echo '<td>'.$row->answer.'</td>';
										//echo '<td>'.$row->course_code.' '.$row->section.' - ' .$row->exam_desc.'</td>';
										echo
                                 '<td>
                                  <div class="btn-group">
                                        <a class="btn btn-success" onclick = "editQuestion('.$row->question_id.')"><i class="icon_pencil-edit"></i></a>
										<a class="btn btn-danger" onclick = "deleteQuestion('.$row->question_id.')"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>';
										echo	'</tr>';
										} ?>                   
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>
          </section>



  </body>
  <script>
		function editQuestion($question_id){
			///document.location.href = "<?php echo base_url(); ?>index.php/home/loadEditExam/" + $exam_no + "/";
			 $("#main-content").load("loadEditQuestion/"+$question_id).hide(500).fadeIn();
		}
		
		function deleteQuestion($question_id){
			if (confirm("Delete this Question?") == true) {
				document.location.href = "http://localhost/INSTANT_SUITE/index.php/home/deleteQuestion/" + $question_id + "/";
				alert("Question Deleted!");
			} else {
				alert("Question is Unharmed");
			}
		}
</script>
</html>
