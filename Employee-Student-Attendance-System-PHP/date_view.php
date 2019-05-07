<?php 
    include "inc/header.php" ;
    include "class/Student.php" ;
?>
 

<div class="panel panel-default">
    <div class="row">
        <div class="col-3">
            <h2><a href="add.php" class="btn btn-success">Add Student</a></h2>
        </div>
        <div class="col-3"></div> 
        <div class="col-3"></div>
        <div class="col-3">
            <h2><a href="index.php" class="btn btn-info" style="float:right">Take Attendence</a></h2>
        </div>
    </div>

    <div class="panel-body">
        <form action="" method="post">
            <table class="table table-dark table-hover">
                <tr>
                  <th width="20%">Serial</th>
                  <th width="50%">Attendence Date</th>
                  <th width="30%">Action</th>
                </tr>

<?php  
$student = new Student();
$getdata = $student->getDateList();
if ($getdata) {
    $i=0;  
    while ($result = $getdata->fetch_assoc()) {
    $i++;
?>                
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['att_time']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="student_view.php?date=<?php echo $result['att_time']; ?>">View</a>                                        
                    </td>
                </tr>
<?php } } ?>

            </table>
        </form>
    </div>
</div>

      <?php include "inc/footer.php" ;?>
