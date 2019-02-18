<?php 
    $_HeaderTitle = 'Generate Payroll'; 
?> 

<?php include 'helpers/header.php'; ?>
    
    
    <p><!-- Main content -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" re="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ Include the above in your HEAD tag ---------->


<div class="container">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Upload File</strong></div>
        <div class="panel-body">

          <!-- Standar Form -->
          <h4>Select excel file from your computer</h4>
          <form id="upload_form" action="action.php" method="post" enctype="multipart/form-data" >
            <div class="form-inline">
              <div class="form-group">
                  <input type="text" name="month">
                <input type="file" name="file" id="file">
              </div>
              <button name="submit" type="submit" class="btn btn-sm btn-primary" onclick="uploadFile()" value="Upload File">Upload file</button>

            </div><br>

             <!-- <div id="bararea">
                  <div id="bar"></div>
              </div>

              <div id="percent"></div>
              <div id="status"></div>

        </div> -->
               <!--<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
               <h3 id="status"></h3>
               <p id="loaded_n_total"></p>
           </form>

           <!-- Drop Zone -->
          </div>

          <!-- Upload Finished -->
          <div class="js-upload-finished">
            <h3>Processed files</h3>
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>Payslip August 1-15-2018</a>
              <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>Payslip August 16-31-2018</a>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /container -->

    <p><!-- /.content -->


    </p>

  <?php include 'helpers/footer.php'; ?>