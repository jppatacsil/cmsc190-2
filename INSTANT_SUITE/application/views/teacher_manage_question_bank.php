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
                      <section class="panel">
                          <header class="panel-heading">
                              Questions
                          </header>
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr> <!--HEADINGS-->
                                 <th> #</th>
                                 <th></i> Subject</th>
                                 <th> Category</th>
                                 <th></i>Type</th>
                                 <th>Question </th>
                                 <th></i>Corresponding Points</th>
                                 <th>Answer</th>
                                  <th><i class="icon_cogs"></i></th>
                              </tr>
                              <tr>
                                 <td>1</td>
                                 <td>CMSC 127</td>
                                 <td>Introduction</td>
                                 <td>TRUE OR FALSE</td>
                                 <td>DBMS mans Databse Management System</td>
                                 <td>1</td>
                                 <td>TRUE</td>
                                 <td>
                                  <div class="btn-group">
                                       <a class="btn btn-success" href="#editQuestionModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                 <td>2</td>
                                 <td>CMSC 11</td>
                                 <td>HISTORY </td>
                                 <td>IDENTIFICATION</td>
                                 <td>Who is the father of Computer Science</td>
                                 <td>1</td>
                                 <td>Allan Turing</td>
                                 <td>
                                  <div class="btn-group">
                                
                                      <a class="btn btn-success" href="#editQuestionModal" data-toggle="modal"><i class="icon_pencil-edit"></i></a>
                                      <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                  </div>
                                  </td>
                                </tr>                     
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>

              <!--_MODAL EDIT EXAM -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editQuestionModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">EDIT Question</h4>
                </div>
                
                <div class="modal-body">
                    <form class="form-horizontal" role="form" id="form2">
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
                            <center><td>
                                <button type="submit" href="<?php echo site_url('teachers/teacherActions/1')?> " class="btn btn-primary btn-lg">Save Question</button>
                            </td></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
                              
                <!--END MODAL -->
              <!-- page end-->
          </section>



  </body>
</html>
