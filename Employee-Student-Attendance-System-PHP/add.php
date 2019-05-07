<?php 
    include "inc/header.php" ;
    include "class/Student.php" ;
?>

<?php 
    $student = new Student();

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $name= $_POST['name']; 
        $roll =$_POST['roll'];

        $insertData = $student->insertStudent($name,$roll);
    }
?>
      
<?php
    if (isset($insertData)) {
        echo $insertData;
    }
?>      

<div class="panel panel-default">
    <div class="row">
        <div class="col-3">
            <h2><a href="index.php" class="btn btn-success">Back</a></h2>
        </div>
        <div class="col-3"></div> 
        <div class="col-3"></div>
        <div class="col-3">
            <h2><a href="" class="btn btn-info" style="float:right">Add Student</a></h2>
        </div>
    </div>

    <div class="panel-body mt-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Student Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" >
            </div>
            <div class="form-group">
                <label for="roll">Roll:</label>
                <input type="number" class="form-control" id="roll" placeholder="Enter Roll" name="roll" >
            </div>

                <button type="submit" class="btn btn-primary"> Add Student</button>
        </form>
    </div>
</div>

<?php include "inc/footer.php" ;?>
