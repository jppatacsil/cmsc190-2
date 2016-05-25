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
	 
	<script language="javascript">

  var ansNum = 0;
	
//For inserting new category in the list
  function insertCategory(){
      if($("#newCategory").val() != ""){ //If the newCategory input is not empty, then append new category to options
        
        //Check if category exists already
        if($("#categoryList option[value="+$("#newCategory").val()+"]").length > 0){
          alert("CATEGORY ALREADY EXISTS!");
          document.getElementById('newCategory').value = "";
          return;
        }

        //Append to top of the list       
        var list = document.getElementById("categoryList");
        var option = document.createElement("option");
        option.value = document.getElementById('newCategory').value;
        option.text = document.getElementById('newCategory').value;
        list.add(option, list[0]);

        //Select the newly entered category
        var newList = document.getElementById("categoryList").children[0];
        newList.setAttribute("selected", "selected");
        document.getElementById('newCategory').value = "";

        alert("Category inserted to list!");

      }else {alert("No category inserted!");}
  }

    //If spelling errors was checked
  function tick1(divName){
    if(document.getElementById('spelling').checked == true){
      var counter = prompt("How many spelling errors would you consider?", "1");
      if (counter != null) {
        addSpell(divName,counter);
      }else{
        alert("You entered a null value. Unchecking the box.");
      }
      
    }
    else{
      var y = 0;
      while(y != ansNum){
        removeSpell(y+1);
        y++;
      }
      alert("Generated textfield/s are removed.");
    }
  }

  //If synonymous answers was checked
  function tick2(divName){
    if(document.getElementById('synonyms').checked == true){
      var counter = prompt("How many answers would you consider?", "1");
      if (counter != null) {
        addSyn(divName,counter);
      }else{
        alert("You entered a null value. Unchecking the box.");
      }
      
    }
    else{
      var y = 0;
      while(y != ansNum){
        removeSyn(y+1);
        y++;
      }
      alert("Generated textfield/s are removed.");
    }
  }

  //For dynamic adding of spelling answers
  function addSpell(divName,counter){
      var num = parseInt(counter);
      var x = 0;
      while(x != num){
         var newdiv = document.createElement('div');
         newdiv.innerHTML = 
         "<input type='text' id=spellAns" + (x+1) +" class='col-md-8' placeholder='Considered Spelling Error' name='considerations[]'> " +
         " <a href='#' id=removeBtn1" + (x+1) +" class='remove_field btn btn-danger btn-xs' onclick=removeSpell(" + (x+1) + ")>Remove</a>";
         
         document.getElementById(divName).appendChild(newdiv);
         x++;
      }
      ansNum = x;
  }

  //For dynamic adding of synonymous answers
  function addSyn(divName,counter){
      var num = parseInt(counter);
      var x = 0;
      while(x != num){
         var newdiv = document.createElement('div');
         newdiv.innerHTML = 
         "<input type='text' id=synAns" + (x+1) +" class='col-md-8' placeholder='Synonymous answer' name='considerations[]'>" +
         " <a href='#' id=removeBtn2" + (x+1) +" class='remove_field btn btn-danger btn-xs' onclick=removeSyn(" + (x+1) + ")>Remove</a>";
         
         document.getElementById(divName).appendChild(newdiv);
         x++;
      }
      ansNum = x;
  }

  //For deleting added textfields
  function removeSpell(num){
    $("#spellAns"+num).remove();
    $("#removeBtn1"+num).remove();
  }

  function removeSyn(num){
    $("#synAns"+num).remove();
    $("#removeBtn2"+num).remove();
  }
	
	</script>

  </head>
  <body>

          <section class="wrapper">
          <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file-text-o"></i>Construct Questions</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php echo site_url('teachers/teacherActions/2')?>">Home</a></li>
                        <li><i class="icon_document_alt"></i>Add Question</li>
                        <li><i class="fa fa-file-text-o"></i>Fill-in-the-blanks</li>
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
                              <form class="form-horizontal" action="<?php echo base_url()."index.php/teachers/bankQuestion/". 4 ?>" method="post" role="form" id="form2">
                                    <!-- Category -->    
												<div class="form-group">
													<label class="col-md-3 control-label" for="category">Category</label>
													<div class="col-md-4">
													<select required="true" class="col-lg-12" name="category" id="categoryList" required>
													<?php 
														foreach($categories as $row)
														{ 
														echo '<option value="'.$row->category.'">
																'.$row->category.'
																</option>';
														}
													?>
													</select>
													<input class="col-lg-12" type="text" value="" placeholder="New category" id="newCategory">
													</div>
													<input class="btn btn-success btn-sm col-lg-4" type="button" id="addCategory" onclick="insertCategory()" value="Insert category"/></center>
												</div>

												<div class="form-group">
													<label class="col-md-2 control-label" for="inputQuestion">QUESTION</label>	
													<div class="col-lg-10">
													<textarea required="true" class="form-control" rows="5" cols="30" id="questionProper" name="questionProper" required></textarea>
													</div>
												</div>
                                           
												<div class="form-group">    
													<label class="col-md-3 control-label" for="inputPoints">Correct Answer</label>
													<div class="col-lg-9">
													<input required="true" type="input" class="form-control" id="correctAnswer" name="answer" required>
													</div>
												</div>

                        <div class="form-group">
                          <label class="col-md-3 control-label" for="considerations">Considerations</label>
                          <div id="considerationInput" class="col-md-9">
                            <input id="spelling" type="checkbox" name="consideration1" value="1" onchange="tick1('considerationInput')"> Minor Spelling Errors<br>
                            <input id="synonyms" type="checkbox" name="consideration2" value="2" onchange="tick2('considerationInput')"> Synonymous Answers<br>
                          </div>
                        </div>
												
												<div class="form-group">
													<label class="col-md-3 control-label" for="inputPoints">Credit</label>
													<div class="col-md-3">
													<input required="true" type="number" min="1" class="form-control" id="inputPoints" name="points" required>
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


  <!-- container section end -->
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
