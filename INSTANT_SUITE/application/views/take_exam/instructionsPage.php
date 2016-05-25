<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>INSTANT SUITE: Instructions Page</title>

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

    #instructionPanel{
        position:absolute;
        top: 50%;
        left: 25%;
        width:80em;
        height:35em;
        margin-top: -9em; /*set to a negative number 1/2 of your height*/
        margin-left: -15em; /*set to a negative number 1/2 of your width*/
        border: 1px solid #ccc;
        background-color: #D2B48C;
        opacity: 0.75;
    }

    #instructionPanel h1{
        text-indent: 50px;
        color: white;
        font-style: bold;
        text-align: center;
    }

    .instructions{
        text-indent: 50px;
        color: white;
        font-size: large;
        text-align: center;
    }

    .reminderHeader{
        text-align: justify;
    }

    #reminders {
         text-indent: 50px;
         text-align: left;
    }

    #keyInput{
        text-align: center;
    }

    body {
        font-family: "Georgia";
    }

    p {
        font-size: 1.875em; /* 30px/16=1.875em */
    }


</style>

  <body class="login-img3-body">

        <!--THE HEADER DIV-->
        <div id="header">
            <center><img src="<?php echo base_url(); ?>img/instant.png" height="150" width="400"></center>
        </div>

        <div id="instructionPanel">
            <h1>Please carefully read the following text.</h1>
            <p class="instructions">
            INSTANT is the first automated paperless examination system in UPLB. 
            Through INSTANT, exam results will be available to you right after taking the exam. 
            By taking this automated exam, your examiner was able to save:
            </p>
            <p class="instructions">
            4 pages x 120 students = approximate 480 sheets of paper = approximately 6% of a tree
            </p>
            <p class="instructions reminderHeader">
            Some reminders:<br>
            </p>
            <p class="instructions reminderHeader">1. Eyes and thoughts to yourself! Always look straight ahead, not to your left or right, not upward or downward. You can only speak to your examiner during the exam.</p>
            <p class="instructions reminderHeader">2. Put gadgets including watches in your bags. The time is displayed in the upper right part of the screen.​</p>
            <p class="instructions reminderHeader">3. No switching of applications. Leaving the examination window is considered cheating.</p>
            <p class="instructions reminderHeader">4. If you are caught cheating, you will get a grade of 5.0 in an INSTANT!</p>
            <p class="instructions reminderHeader">5. If you have questions, call the attention of your examiner.</p>
            <p class="instructions reminderHeader">Good luck!</p>
            <center>
                <a href="#keyModal" data-toggle="modal" class="btn btn-success btn-lg">
                  Start Exam
                </a>
            </center>
        </div>

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="keyModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h4 class="modal-title">Exam Key</h4>
                    </div>
                        <div class="modal-body">
                        <form autocomplete="off" class="form-horizontal" role="form" action="<?php echo base_url()."index.php/take_exam/examPage/"?>" method="post">
                        <div class="form-group">
                            <input type="text" required id="keyInput" class="form-control col-lg-12" name="examKey" placeholder="Enter key for exam here">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Take Exam</button>
                        </form>
                    </div>
                </div>
            </div>
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
