<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');


class Student
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();    
    }

    public function getStudents()
    {
        $query = "SELECT *FROM tbl_student";
        $result = $this->db->select($query);
        return $result;
    }


    public function insertStudent($name,$roll)  //------>>>>> Method-1
    {
        $name = mysqli_real_escape_string($this->db->link,$name);
        $roll = mysqli_real_escape_string($this->db->link,$roll);

        if (empty($name) || empty($roll)) {
            $msg = "<div class='alert alert-danger'><strong>Error !</strong>Feild must not be empty.</div>" ;
            return $msg;
        }
        else 
        {
            $query= "INSERT INTO tbl_student (name,roll) VALUES('$name','$roll') ";
            $inserted_row= $this->db->insert($query);

            $query= "INSERT INTO  tbl_attendance (roll) VALUES('$roll') ";
            $inserted_row= $this->db->insert($query);

            if ($inserted_row) 
            {
                $msg = "<div class='alert alert-success'><strong>Success !</strong> Data Inserted Successfully.</div>" ;
                return $msg;
            }
            else 
            {
                $msg = "<div class='alert alert-danger'><strong>Error !</strong> Data not Inserted.</div>" ;
                return $msg;
            }
        }

        
    }


    public function insertAttendance($current_date,$attend=array()) //------>>>>> Method-2
    {
        // if(isset($attend)) 
        // {
        //     $attend   = mysqli_real_escape_string($this->db->link, $attend);
        // }else{
        //     //$attend = "";
        //     $msg= "<div class='alert alert-danger'><strong>Error !</strong> Feild must not be empty !</div>";
        //     return $msg;
        // }


        $query= "SELECT DISTINCT att_time FROM tbl_attendance";
        $getdata = $this->db->select($query);
        
        while ($result = $getdata->fetch_assoc()) 
        {
            $db_date = $result['att_time'];  //att=attend

            if ($current_date == $db_date) 
            {
                $msg = "<div class='alert alert-danger'><strong>Error !</strong> Attendance Already Taken Today.</div>" ;
                return $msg;
            }
        }


        foreach ($attend as $attend_key => $attend_value)  //attend_key= roll & attend_value= present or absent
        {
            if ($attend_value == "present") 
            {
                $student_query= "INSERT INTO tbl_attendance(roll,attend,att_time) VALUES('$attend_key','present', now())";
                $data_insert = $this->db->insert($student_query);
            }
            elseif ($attend_value == "absent") 
            {
                $student_query= "INSERT INTO tbl_attendance(roll,attend,att_time) VALUES('$attend_key','absent', now())";
                $data_insert = $this->db->insert($student_query);
            }
        }


        if (isset($data_insert)) 
        {
            $msg = "<div class='alert alert-success'><strong>Success !</strong> Attendance Data Inserted Successfully.</div>" ;
            return $msg;
        }
        else 
        {
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Attendance Data not Inserted.</div>" ;
            return $msg;
        }

    }


    public function getDateList() //------>>>>> Method-3
    {
        $query= "SELECT DISTINCT att_time FROM tbl_attendance";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllData($date)
    {
        $query = "SELECT tbl_student.name, tbl_attendance.*
                  FROM tbl_student
                  INNER JOIN  tbl_attendance
                  ON  tbl_student.roll = tbl_attendance.roll
                  WHERE att_time = '$date' ";

        $result = $this->db->select($query);
        return $result;
    }


    public function updateAttendance($date,$attend) //------>>>>> Method-4
    {
        foreach ($attend as $attend_key => $attend_value)  //attend_key= roll & attend_value= present or absent
        {
            if ($attend_value == "present") 
            {
                $query ="UPDATE tbl_attendance
                         SET attend = 'present' 
                         WHERE roll = '".$attend_key."' AND att_time = '".$date."'  ";
                $data_update = $this->db->update($query);
            }
            elseif ($attend_value == "absent") 
            {
                $query ="UPDATE tbl_attendance
                         SET attend = 'absent' 
                         WHERE roll = '".$attend_key."' AND att_time = '".$date."'  ";
                $data_update = $this->db->update($query);
            }
        }

        if ($data_update) 
        {
            $msg = "<div class='alert alert-success'><strong>Success !</strong> Attendance Data Updated Successfully.</div>" ;
            return $msg;
        }
        else 
        {
            $msg = "<div class='alert alert-danger'><strong>Error !</strong> Attendance Data not Updated.</div>" ;
            return $msg;
        }

    }
}



?>