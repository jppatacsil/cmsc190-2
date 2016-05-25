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
        height: 90%;
        width: 75%;
        background-color: #D2B48C;
        border-radius: 5px;
        padding: 20px;
        opacity: 0.75;
    }

    #scorePercent {
        position: absolute;
        top: 60%;
    }

    body {
        font-family: "Georgia";
    }

    p {
        font-size: 1.875em; /* 30px/16=1.875em */
    }

</style>

  <body class="login-img3-body">

    <?php //Get the results details


    ?>

    <!--THE HEADER DIV-->
    <div id="header">
        <div class="col-lg-12">
            <div class="col-md-2">
                <img src="<?php echo base_url()."/img/instant-square.png"?>" height="150" width="200">
            </div>

            <div class="col-md-6">
                <?php
                    echo '<h1 style="color: white">Results of your '.$exam_desc.'</h1>';
                ?>
            </div>

            <div class="col-md-4">
                <?php
                    echo '<h1 style="color: white">'.$student_no.': '.$lastName.',<br>'.$firstName.'</h1>'; 
                ?>
            </div>
        </div>
    </div>

    <!--THE RESULTS DIV-->
    <section id="mainPanel">

        <h2 style="color: white;">Your raw score is: </h1><br><br>

        <h1 style="color: white; font-size: 72px; font-style: comic-sans; text-align: center;"><?php echo $computedScore.'/'.$total_score; ?></h1>

        <?php //Compute for percentage
           $scorePercent = ($computedScore/$total_score)*100;
           $scorePercent = round($scorePercent,2);
        ?>

        <h2 id="scorePercent" style="color: white; text-align: center;">That's right. Your score percentage is <?php echo $scorePercent.'%';?>. You may now close this window.</h2>

    </section>

  </body>

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

</html>
