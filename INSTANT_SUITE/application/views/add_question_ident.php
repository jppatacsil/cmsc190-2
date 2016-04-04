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
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i>Construct Questions</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo site_url('teachers/teacherActions/2')?>">Home</a></li>
                        <li><i class="icon_document_alt"></i>Add Question</li>
                        <li><i class="fa fa-file-text-o"></i>Identification</li>
                    </ol>
                </div>
            </div>
              <!-- Basic Forms & Horizontal Forms-->
              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Construct Question
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal" action="<?php echo base_url()."index.php/teachers/bankQuestion/". 5 ?>" method="post" role="form" id="form2">
                                            <!-- Category -->
                                                  <div class="form-group">
                                                      <label class="col-md-4 control-label" for="inputQuestion">QUESTION</label>                                                  
                                                                         <textarea required="true" class="form-control" rows="5" id="questionProper" name="questionProper"></textarea>
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
                                                                        <td><center><button type="submit" class="btn btn-primary btn-lg">
                                                                        Save Question
                                                                        </button></td></center>
                                                                    </div>
                              </form>
                          </div>
                      </section>
                      
              <!-- page end-->
          </section>

	 
  </body>

      <!-- javascripts -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <!-- nicescroll -->
    <script src="<?php echo base_url();?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery.nicescroll.js" type="text/javascript"></script>

    <!-- jquery ui -->
    <script src="<?php echo base_url();?>js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--custom checkbox & radio-->
    <script type="<?php echo base_url();?>text/javascript" src="js/ga.js"></script>
    <!--custom switch-->
    <script src="<?php echo base_url();?>js/bootstrap-switch.js"></script>
    <!--custom tagsinput-->
    <script src="<?php echo base_url();?>js/jquery.tagsinput.js"></script>
    
    <!-- colorpicker -->
   
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo base_url();?>js/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-wysiwyg.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-wysiwyg-custom.js "></script>
    <!-- ck editor -->
    <script type="<?php echo base_url();?>text/javascript" src="assets/ckeditor/ckeditor.js "></script>
    <!-- custom form component script for this page-->
    <script src="<?php echo base_url();?>js/form-component.js "></script>
    <!-- custome script for all page -->
    <script src="<?php echo base_url();?>js/scripts.js"></script>
     <script src="<?php echo base_url();?>//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</html>
