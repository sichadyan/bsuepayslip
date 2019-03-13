<?php 
$_HeaderTitle = 'Mail box'; 

include 'helpers/helper.php';
include 'helpers/crud.php';

//== GET ALL message ==
$message_tbl = _getAllData('message_tbl');
$mess_list = array(); // empty array
if ($message_tbl != null && $message_tbl['count'] != 0){       
    $mess_list = $message_tbl['data'];
    
    

}
else{
    $mess_list = null;
}



//  var_dump ($users_employee);
?>

<?php include 'helpers/header.php'; ?>
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
    <div class="container-fluid" >
        <div class="card card-success" >
            <div class="card-header" style="background-color:  #800000;">
               Mail
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                    <thead>
                        <tr>
                            <th>Action
                            </th>
                            <th>ID#
                            </th>
                            <th>User id
                            </th>
                            <th>Status
                            </th>
                            <th>Date
                            </th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //DO LOOP HERE
                        //var_dump($empdataList);
                        if ($mess_list == null){
                            echo '<tr><td colspan="9" class="text-center">-- No Records Found! --</td></tr>';
                        }
                        else{
                          $status = ['Unread','Read'];

                            foreach ($mess_list as $row){
                              
                                echo '<tr>';
                                echo '<td><div class="btn-group"><a href="employeeedit.php?id='. $row["id"] .'" class="btn btn-sm btn-primary">Edit</a><a href="employeeedit.php?id='. $row["id"] .'" class="btn btn-sm btn-info">Details</a><form method="post"><button type="submit" onclick="return confirm(\'Are you sure you want to delete this?\');" class="btn btn-sm btn-danger" name="btnDelete" id="btnDelete" value="'. $row["id"].'">Delete</button></form></div></td>';
                                echo '<td>'. $row["id"] .'</td>';
                                echo '<td>'. $row['user_id'] .'</td>';
                                echo '<td>'. $status[$row['status']] .'</td>';
                                 echo '<td>'. $row['date_created'] .'</td>';
                                
                                echo '</tr>';
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
  <?php include 'helpers/footer.php'; ?>