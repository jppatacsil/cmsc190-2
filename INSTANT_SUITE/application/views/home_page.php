<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>INSTANT SUITE: Online Examination and Attendance Monitoring System</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css"rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url(); ?>css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url(); ?>css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles -->
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
     <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
 <style>
    fieldset {
      border: 0;
    }
    label {
      display: block;
      margin: 30px 0 0 0;
    }
    select {
      width: 200px;
    }
    .overflow {
      height: 200px;
    }
  </style>

  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <a href="#" class="logo">INSTANT <span class="lite">SUITE</span></a>
            <!--logo end-->

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle profile" aria-haspopup="true" aria-expanded="false">
                            <span class="username">
                            <?php  //displays user's credentials
                            echo $this->session->userdata('firstName');
                            echo " ";
                            echo $this->session->userdata('lastName');
                            ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout" id="profile-dropdown">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="<?php echo base_url()."index.php/home/home_page" ?>"><i class="icon_profile"></i> Home Page</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()."index.php/home/logout" ?>"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->

      <!--sidebar start-->
       <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">                
                  <li class="active">
                      <a class="profileLoader">
                          <i class="icon_profile"></i>
                          <span>My Profile</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="subjectLoader">
                          <i class="icon_document_alt"></i>
                          <span>Subjects</span>
                      </a>
                  </li> 
                  <li class="sub-menu">
                      <a class="createExamLoader">
                          <i class="icon_document_alt"></i>
                          <span>Create Exam</span>
                      </a>
                  </li> 
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="icon_document_alt"></i>
                          <span>Add Question</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                      <ul class="sub">
							 <!--
                        <li><a class="" href="<?php echo site_url('teachers/addQuestion/1'); ?>" >Multiple Choice </a></li>
								<li><a class="" href="<?php echo site_url('teachers/addQuestion/2'); ?>" >True or False</a></li>
								<li><a class="" href="<?php echo site_url('teachers/addQuestion/3'); ?>" >Matching Type</a></li>  <li><a class="" href="<?php echo site_url('teachers/addQuestion/4'); ?>" >Identification</a></li>
								<li><a class="" href="<?php echo site_url('teachers/addQuestion/5'); ?>" >Fill-in-the-blanks</a></li> <li><a class="" href="<?php echo site_url('teachers/addQuestion/6'); ?>" >Essay</a></li>  
								<li><a class="" href="<?php echo site_url('teachers/addQuestion/7'); ?>" >Programming</a></li>
							-->
                      </ul>
                  </li> 
                  <li class="sub-menu">
                      <a class="manageExamLoader">
                          <i class="icon_desktop"></i>
                          <span>Manage Exams</span>
                      </a>
                  </li>
                  <li  class="sub-menu">
                      <a class="questionBankLoader">
                          <i class="icon_genius"></i>
                          <span>Question Bank</span>
                      </a>
                  </li>
                  <li>                     
                      <a class="" href="chart-chartjs.html">
                          <i class="icon_piechart"></i>
                          <span>Attendance</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <div class="container" id="main-content">
          <!--ALL FUNCTIONALITIES WILL BE PUT HERE-->
          <div>
          <h1>Welcome, back</h1>
          </div>
      </div>
      <!--main content end-->
  </section>
  <!-- container section end -->


  </body>

    <!-- javascripts -->
     <!-- javascripts -->
    <script src="<?php echo base_url();?>js/jquery.js" ></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <!-- nicescroll -->
    <script src="<?php echo base_url();?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--custome script for all page-->
    <script src="<?php echo base_url();?>js/scripts.js"></script>
     <!-- jquery knob -->
    <script src="<?php echo base_url();?>assets/jquery-knob/js/jquery.knob.js"></script>-->

  <script>
      //knob
      $(".knob").knob();
  </script>

    <script language="javascript">

    $(document).ready(function(){
        //--------------------------------------------------------
        //initially profile is loaded when you arrive at home page
        $("#main-content").load("loadProfile");
         
        $("#sidebar").load("loadMainSideBar");
        //--------------------------------------------------------

        //manually activate dropdown 
        $('.dropdown-toggle').dropdown();
    });
    </script>



</html>
