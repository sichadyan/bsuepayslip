<?php 
    $_HeaderTitle = 'Contact Admin'; 
?> 

<?php include 'helpers/header.php'; 
 	  include 'helpers/crud.php'; 
#GET DEDUCTION INFO
$deduction_id = $_SESSION["isLogin"]['id'];
$deduction_info = _getAllDataByParam('deduction_info','user_id="' . $deduction_id . "\"");
$empdataList = array(); // empty array
if ($deduction_info != null && $deduction_info['count'] != 0){       
    $empdataList = $deduction_info['data'];
}
else{
    $empdataList = null;
}

#GET SALARY INFO
$salary_id = $_SESSION["isLogin"]['id'];
$salary_info = _getAllDataByParam('salary_info','user_id="' . $salary_id . "\"");
$salary_list = array(); // empty array
if ($salary_info != null && $salary_info['count'] != 0){       
    $salary_list = $salary_info['data'];
}
else{
    $salary_list = null;
}


?>
    <p><!-- Main content -->
    

<!-- <?php echo $_SESSION["isLogin"]['lastname'] . ", " . $_SESSION["isLogin"]['id']; ?> -->
<style type="text/css">
._success{
	color: #3c763d !important;
    background-color: #dff0d8 !important;
    border-color: #d6e9c6 !important;
}
._danger{
	color: #a94442 !important;
    background-color: #f2dede !important;
    border-color: #ebccd1 !important;
}

</style>
	<div class="content">
    <div class="container-fluid">
        <div class="card card-danger" ">
            <div class="card-header" style="background-color:  #800000;">
                <span>Contact Admin&nbsp;<i class="fas fa-angle-double-right"></i>&nbsp;</span>
                <div class="btn-group float-right">
                        <a href="index.php" class="btn btn-sm btn-default float-right" style="color: black;">Back</a>
                    </div>
            </div>
            <div class="card-body">

            	<div id="alert" class="alert alert-success alert-dismissible" style="display: none;">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong id="alert_title"></strong>&nbsp; &nbsp; <span id="alert_message"></span>
				</div>

            	<div class="form-group">
                	
				  <label for="comment">Topic:</label>
				   <input type="text" class="form-control" id="topic">
				  
				   
				</div>
                <div class="form-group">
                	
				  <label for="comment">Message:</label>
				   
				  <textarea class="form-control" rows="5" id="message"></textarea>
				  <br>
				   <button style="float: right;" id="send" class="btn btn-success">SEND</button>
				</div>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

    <p><!-- /.content -->
<style type="text/css">
	


</style>
<div class="container">
 

  
  
</div>

  <?php include 'helpers/footer.php'; ?>



    <script type="text/javascript">
    	$(function(){
    	 $(document).on("click","#send",function() {
    	 		var topic = $('#topic').val();
    	 		var message = $('#message').val();
    	 		var alert = $('#alert');

    	 		if(topic == ''){
    	 			alert.removeClass('_success').addClass('_danger').show();
    	 			alert.find('strong').text('Oopss..!');
    	 			alert.find('span').text('Please Enter Topic!');
    	 		}else{
    	 			if(message == ''){
    	 				alert.removeClass('_success').addClass('_danger').show();
	    	 			alert.find('strong').text('Oopss..!');
	    	 			alert.find('span').text('Please Enter Message!');
    	 			}
    	 			else{
    	 				$.ajax({
    	 					type: 'POST',
							dataType: 'json',
							url:  'message.php',
							data:{'f': 'postMessage', 'topic': topic, 'message': message},
							success: function(data){
								alert.removeClass(data.type2).addClass(data.type1).show();
			    	 			alert.find('strong').text(data.title);
			    	 			alert.find('span').text(data.message);
								if(data.status == 1 ){
									$('#topic').val('');
									$('#message').val('');
								}
							},
    	 				});
    	 			}
    	 		}


			});


			
			
    });

    	
    </script>






  							    