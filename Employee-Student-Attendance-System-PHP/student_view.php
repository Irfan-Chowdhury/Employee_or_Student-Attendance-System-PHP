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
                    // alert(name + "Roll Missing !");
                    $('.alert').show();
                    roll = false;
                }
            });
            return roll;
        });
    });
</script>

<?php
   // error_reporting(0);  //for -> Undefined index: attend in C:\xampp\htdocs\TLWP\14.Employee-Student-Attendance-System-PHP\Original_File\index.php on line 12

    $student = new Student();
    $date =$_GET['date'];

    if ($_SERVER["REQUEST_METHOD"]=="POST") 
    {    
        $attend       = $_POST['attend'];
        $attendUpdate = $student-> updateAttendance($date,$attend);
    }
?>
      
<?php
    if (isset($attendUpdate)) {
        echo $attendUpdate;
    }
?> 

<div class="panel panel-default">
    <div class="row">
        <div class="col-3">
            <h2><a href="add.php" class="btn btn-success">Add Student</a></h2>
        </div>
        <div class="col-3"></div> 
        <div class="col-3"></div>
        <div class="col-3">
            <h2><a href="date_view.php" class="btn btn-info" style="float:right">Back</a></h2>
        </div>
    </div>

 <div class='alert alert-danger' style="display:none"><strong>Error !</strong> Student Roll Missing.</div>
   
    <div class="panel-body">
        <div class="text-center" >
            <h4><strong>Date: </strong> <?php echo  $date; ?></h4>
        </div>
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
  $getStudent = $student->getAllData($date);
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
                    <input <?php if($result['attend']=="present"){echo "checked";} ?>   type="radio" name="attend[<?php echo $result['roll']; ?>]" value="present" >P
                    <input <?php if($result['attend']=="absent"){echo "checked";} ?>    type="radio" name="attend[<?php echo $result['roll']; ?>]" value="absent">A
                  </td>
                </tr>
<?php } } ?>
<!-- ___________________ X ____________________ -->
            </table>
                   <input class="btn btn-primary" type="submit" name="submit" value="Update">
        </form>
    </div>
</div>

      <?php include "inc/footer.php" ;?>
