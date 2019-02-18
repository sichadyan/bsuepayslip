<?php 
$_HeaderTitle = 'Deduction Assignment'; 

include 'helpers/header.php';
include 'helpers/helper.php';
include 'helpers/crud.php';

//== GET EMPLOYEE LIST ==
$users_employee = _getAllData('user');
$empdataList = array(); // empty array
if ($users_employee != null && $users_employee['count'] != 0){       
    $empdataList = $users_employee['data'];
}
else{
    $empdataList = null;
}
//  var_dump ($users_employee);
?>
<!-- Main content -->

<div class="content">
    <div class="container-fluid">
        <div class="card card-success">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-responsive table-bordered table-striped table-hover table-condensed jqdatatable">
                    <thead>
                        <tr>
                            <th>Action
                            </th>
                            <th>ID#
                            </th>
                            <th>Role
                            </th>
                            <th>Full Name
                            </th>
                            <th>Department
                            </th>
                            <th>Position
                            </th>
                            <th>Gender
                            </th>
                            <th>Created By
                            </th>
                            <th>Created Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //DO LOOP HERE
                        //var_dump($empdataList);
                        if ($empdataList == null){
                            echo '<tr><td colspan="9" class="text-center">-- No Records Found! --</td></tr>';
                        }
                        else{
                            foreach ($empdataList as $row){
                                echo '<tr>';
                                echo '<td><a href="deductioninfo.php?id='. $row["id"] .'" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a></td>';
                                echo '<td>'. $row["idnumber"] .'</td>';
                                echo '<td>'. getRoleName($row['roleid']) .'</td>';
                                echo '<td>'. formatFullName('lfm',$row['firstname'],$row['middlename'],$row['lastname']) .'</td>';
                                echo '<td>'. getDepartmentName($row['departmentid']) .'</td>';
                                echo '<td>'. getPositionName($row['positionid']) .'</td>';
                                echo '<td>'. $row['gender'] .'</td>';
                                echo '<td>'. $row['createdby'] .'</td>';
                                echo '<td>'. $row['createddate'] .'</td>';
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