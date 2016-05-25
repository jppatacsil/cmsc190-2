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
  //Function to dynamically add and remove category fields
  $(document).ready(function() {
      var wrapper = $(".input_fields_wrap"); //Fields wrapper
      var add_button = $(".add_field_button"); //Add button ID
      
      var x = 1; //initial category count
      $(add_button).click(function(e){ //on add input button click
          e.preventDefault();
          $(wrapper).append('<div><br><select required="true" class="col-lg-12 category_fields'+x+'" name="category[]"></select><br><input type="number" onchange="findTotal()" min="1" name="totalItems[]" class="col-lg-12" placeholder="Total Items"><br><select name="difficulty[]" onchange="computeScore()" class="col-lg-12"><option value="1">EASY</option><option value="2">AVERAGE</option><option value="3">DIFFICULT</option></select><br><a href="#" class="remove_field btn btn-danger btn-xs btn-block">Remove</a></div>'); //add input box
          fillCategory(x); //fill the category list
          x++; //category increment
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).parent('div').remove(); x--;
          findTotal(); //Count new total number of items
      })
  });

  //Fill the dynamically entered fields
  function fillCategory(classNum){
    var length = $('#categoryList > option').length; //Get number of categories in the categoryList
    var categoryMenu = $(".category_fields"+classNum);
    var list = document.getElementById("categoryList");
    var value;
    var text;
    var i = 0;
    while(i != length){ //Fill the category with the options
      value = list.options[i].value;
      text = list.options[i].text;
      $(categoryMenu).append('<option value="' + value + '">' + text + '</option>');
      i++;
    } 
  }
  
  //Get total number of items
  function findTotal(){
    var arr = document.getElementsByName('totalItems[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
            tot += parseInt(arr[i].value);
    }
    document.getElementById('no_of_items').value = tot;

    computeScore(); //Get total score

  }

  //Get total score
  function computeScore(){
    var arr1 = document.getElementsByName('totalItems[]');
    var arr2 = document.getElementsByName('difficulty[]');
    var scoreTot=0;
    for(var i=0; i<arr1.length; i++){
      scoreTot += (parseInt(arr1[i].value) * parseInt(arr2[i].value));
    }

    document.getElementById('total_score').value = scoreTot;
  }

  //For the bootstrap alert
  $(document).ready(function() {
    $("#alertSuccess").hide();

    $("#saveExam").click(function() {
      $("#alertSuccess").show();
        });
  });
  
  </script>

  </head>

  <body>
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-file-text-o"></i>Create Exam</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>Home</a></li>
            <li><i class="icon_document_alt"></i>Forms</li>
            <li><i class="fa fa-file-text-o"></i>Create Exam</li>
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
                  <form id="examForm" action="<?php echo base_url()."index.php/teachers/createExam/"?>" method="post" class="form-horizontal">
                      <!-- Course Code -->
                      <!-- Select Basic -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="courseCode">Course code</label>
                        <div class="col-md-4">
                         <select id="course_code" name="course_code" class="form-control" required>
                            <?php 
                              foreach($classes as $row)
                              { 
                                  echo '<option value="'.$row->course_code.'">
                                  '.$row->course_code.' '.$row->section.'
                                  </option>';
                              }
                            ?>
                         </select>
                        </div>
                      </div>

                      <!-- Date of Exam -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="exam_date">Examination Date</label>
                        <div class="col-md-4">
                        <input type="date" name="examinationDate" required>
                      </div>
                      </div>

                      <!-- Description -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" placeholder="Exam Description" for="exam_desc">Description</label>
                        <div class="col-md-4">                     
                         <textarea class="form-control" id="exam_desc" name="exam_desc" required>1st Exam, 2nd Exam, etc.</textarea>
                        </div>
                      </div>
               
               <div class="form-group">
                <label class="col-md-4 control-label" for="exam_duration">Exam Duration (in minutes)</label>
                <div class="col-md-4">
                  <input type="number" name="duration" min="5" step="5" required>
                </div>
              </div>
                             
              <div class="form-group">
                <label class="col-md-4 control-label" for="category">Coverage</label>
                  <div id="categoryInput" class="col-md-4 input_fields_wrap">
                    <select required="true" class="col-lg-12" name="category[]" id="categoryList">
                      <?php 
                        foreach($categories as $row)
                        { 
                          echo '<option value="'.$row->category.'">
                          '.$row->category.'
                          </option>';
                        }
                      ?>
                    </select>
                    <br><input type="number" class="col-lg-12" onchange="findTotal()" min="1" name="totalItems[]" placeholder="Total Items">
                    <br>
                    <select name="difficulty[]" onchange="computeScore()" class="col-lg-12" required>
                      <option value="1">EASY</option>
                      <option value="2">AVERAGE</option>
                      <option value="3">DIFFICULT</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                  <input type="button" class="btn btn-success btn-sm add_field_button" value="Add another category" required>
                  <!-- onClick="addCategory('categoryInput');" -->
                  </div>
              </div>

                      <!-- Total number of Items -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="no_of_items">Total number of items</label>
                        <div class="col-md-4">                     
                         <input type="number" name="no_of_items" id="no_of_items" min="1" readonly required>
                        </div>
                      </div>

                      <!-- Total score -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="total_score">Total Score</label>
                        <div class="col-md-4">                     
                         <input type="number" name="total_score" id="total_score" readonly required>
                        </div>
                      </div>              
                          
                        <!-- SAVE THE EXAM TEMPLATE -->
                            <div class="form-group">  
                              <td><center><button id="saveExam" type="submit" class="btn btn-primary btn-lg">
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
