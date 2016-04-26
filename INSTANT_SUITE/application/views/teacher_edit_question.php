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

    <!--main content start-->
    <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-file-text-o"></i>Construct Questions</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
						<li><i class="icon_document_alt"></i>Forms</li>
						<li><i class="fa fa-file-text-o"></i>Construct Questions</li>
					</ol>
				</div>
			</div>
              <!-- Basic Forms & Horizontal Forms-->
              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Edit Question
                          </header>
                          <div class="panel-body">
						  <?php 
							foreach($question as $row){
								$type = $row->type;
								$question = $row->question;
								$difficulty = $row->credit;
								$category = $row->category;
								$answer = $row->answer;
							}
							?>
                            
                <form class="form-horizontal" role="form" id="form2">
					<!-- Category -->
                    <div class="form-group">
                    <label class="col-md-4 control-label" for="inputCategory">Category</label>
                        <div class="col-md-4">
                        <input required="true" type="text" class="form-control" id="inputCategory" placeholder="Enter Category">
                        </div>
                    </div>
                                 
                    <div class="form-group">
                    <label class="col-md-4 control-label" for="inputType">Question Type</label>
                        <div class="col-md-4">
                        <select id="inputType" name="inputType" class="form-control">
                            <option value="1">Multiple Choice</option>
                            <option value="2">True or False</option>
                            <option value="3">Matching Type</option>
                            <option value="4">Fill-in-the-blanks</option>
                            <option value="5">Identification</option>
                            <option value="6">Essay</option>
                            <option value="7">Programming</option>
                        </select>
                        <textarea required="true" class="form-control" rows="5" cols="50" id="questionProper" name="questionProper"></textarea>
                        </div>
                    </div>
																	  
                    <div class="form-group">
                    <label class="col-md-4 control-label" for="inputPoints">Corresponding Point</label>
                        <div class="col-md-4">
                        <input required="true" type="number" min="1" class="form-control" id="inputPoints">
                        </div>
                    </div>
																	
                    <div class="form-group">	
                    <label class="col-md-4 control-label" for="inputPoints">Correct Answer</label>
                        <div class="col-md-4">
                        <input required="true" type="input" class="form-control" id="correctAnswer">
                        </div>
                    </div>
																	
                    <div class="form-group">	
                        <td><center><button type="submit" href="<?php echo site_url('teachers/teacherActions/1')?>" class="btn btn-primary btn-lg">
                        Save Question
                        </button></td></center>
                    </div>
                </form>
                </div>
        </section>           
              <!-- page end-->
    </section>
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="style/js/jquery.scrollTo.min.js"></script>
    <script src="style/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!-- jquery ui -->
    <script src="style/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom checkbox & radio-->
    <script type="text/javascript" src="js/ga.js"></script>
    <!--custom switch-->
    <script src="js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="js/jquery.tagsinput.js"></script>
    
    <!-- colorpicker -->
   
    <!-- bootstrap-wysiwyg -->
    <script src="js/jquery.hotkeys.js"></script>
    <script src="js/bootstrap-wysiwyg.js"></script>
    <script src="js/bootstrap-wysiwyg-custom.js"></script>
    <!-- ck editor -->
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
    <!-- custom form component script for this page-->
    <script src="<js/form-component.js"></script>
    <!-- custome script for all page -->
    <script src="<js/scripts.js"></script>
  

  </body>
</html>
