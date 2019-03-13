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
      
        <div class="panel-heading"><strong>Upload File</strong></div>
        <div class="panel-body">

          <!-- Standar Form -->
          <div class="panel panel-success">
          <h4>Select excel file from your computer</h4>
          <form id="upload_form" action="upload_payroll.php" method="post" enctype="multipart/form-data" >
            <div class="form-inline">
              <div class="form-group">
                  <input type="text" name="month">
                <input type="file" name="excel_payroll" id="file">
              </div>
              <button name="import_payroll" type="submit" class="btn btn-sm btn-primary" onclick="uploadFile()" value="Upload File">Upload file</button>
            
            </div>
           </form>

           
          </div>


         
        </div>
      
    </div> 
 

   

  <?php include 'helpers/footer.php'; ?>