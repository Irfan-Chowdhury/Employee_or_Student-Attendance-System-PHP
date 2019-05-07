<?php 
    include "inc/header.php" ;
    include "class/Student.php" ;
?>

<!-- script not working -->

<script type="text/javascript">
$(document).ready(function(){
    $("form").submit(function(){
        var roll = true;
        $(':radio').each(function(){
            name = $(this).attr('name');
            if (roll && !$(':radio[name=" '+ name + ' "]:checked').length) {
                alert(name + "Roll Missing !");
                // $('.alert').show();
                roll = false;
            }
        });
        return roll;
    });
});
</script>

<?php
    error_reporting(0);  //for -> Undefined index: attend in C:\xampp\htdocs\TLWP\14.Employee-Student-Attendance-System-PHP\Original_File\index.php on line 12

    $student = new Student();
    $current_date =date('Y-m-d');

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        
        $attend       = $_POST['attend'];
        $insertattend = $student-> insertAttendance($current_date,$attend);
    }
?>
      
<?php
    if (isset($insertattend)) {
        echo $insertattend;
    }
?> 
<!-- <div class='alert alert-danger' style="display:none"><strong>Error !</strong> Student Roll Missing.</div> -->

<div class="panel panel-default">
    <div class="row">
        <div class="col-3">
            <h2><a href="add.php" class="btn btn-success">Add Student</a></h2>
        </div>
        <div class="col-3"></div> 
        <div class="col-3"></div>
        <div class="col-3">
            <h2><a href="date_view.php" class="btn btn-info" style="float:right">View All</a></h2>
        </div>
    </div>

    <div class="text-center" >
        <h4><strong>Date: </strong> <?php echo  $current_date; ?></h4>
    </div>

    <div class="panel-body">
        <form action="" method="post">
            <table class="table table-dark table-hover">
                <tr>
                  <th width="25%">Serial</th>
                  <th width="25%">Student Name</th>
                  <th width="25%">Student Roll</th>
                  <th width="25%">Attendence</th>
                </tr>
<!-- --------- For Read Data from Database--------------- -->
<?php  
  $getStudent = $student->getStudents();
  if ($getStudent) {
      $i=0;  
      while ($result = $getStudent->fetch_assoc()) {
        $i++;
?>                
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $result['name']; ?></td>
                  <td><?php echo $result['roll']; ?></td>
                  <td>
                    <input type="radio" name="attend[<?php echo $result['roll']; ?>]" value="present">P
                    <input type="radio" name="attend[<?php echo $result['roll']; ?>]" value="absent">A
                  </td>
                </tr>
<?php } } ?>
<!-- ___________________ X ____________________ -->
            </table>
                   <input class="btn btn-primary" type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>

      <?php include "inc/footer.php" ;?>
