<?php

  class Faculty{

    public function addfac($facID,$facultyName,$dateToday){
      $result= insert("INSERT INTO faculty(facID,facultyName,doe) VALUES('$facID','$facultyName','$dateToday') ");
      return $result;
    }

    public function updateFac($facID,$facultyName){
        $result = update("UPDATE faculty SET facultyName='$facultyName' WHERE facID='$facID'");
        return $result;
    }

    public function find_by_facID($facID){
      $result=query("SELECT * FROM faculty WHERE facID='$facID' ");
      return $result;
    }

    public function find_by_facultyName($facultyName){
      $result=query("SELECT * FROM faculty WHERE facultyName='$facultyName' ");
      return $result;
    }

    public function find_all_fac(){
      $result=query("SELECT * FROM faculty");
      return $result;
    }

    public function find_num_fac(){
      $result=query("SELECT * FROM faculty");
      $num = count($result);
      return $num;
    }

    public function find_num_facdep($facID){
      $result=query("SELECT * FROM department WHERE facID='$facID'");
      $num = count($result);
      return $num;
    }

  }

  class Department{

    public function addDep($depID,$facID,$departmentName,$dateToday){
      $result= insert("INSERT INTO department(depID,facID,departmentName,doe) VALUES('$depID','$facID','$departmentName','$dateToday') ");
      return $result;
    }

    public function updatedep($depID,$facID,$departmentName){
        $result = update("UPDATE department SET departmentName='$departmentName', facID='$facID' WHERE depID='$depID'");
        return $result;
    }

    public function find_by_depName($departmentName){
      $result=query("SELECT * FROM department WHERE departmentName='$departmentName' ");
      return $result;
    }

    public function find_all_dep(){
      $result=query("SELECT * FROM department");
      return $result;
    }

    public function find_by_facID($facID){
      $result=query("SELECT * FROM department WHERE facID='$facID' ");
      return $result;
    }
    public function find_by_depID($depID){
      $result=query("SELECT * FROM department WHERE depID='$depID' ");
      return $result;
    }

    public function find_num_dep(){
      $result=query("SELECT * FROM department");
      $num = count($result);
      return $num;
    }

    public function find_num_deplec($depID){
      $result=query("SELECT * FROM lecturer WHERE depID='$depID'");
      $num = count($result);
      return $num;
    }

  }

  class Lecturer{

    public function addlec($lecID,$facID,$depID,$firstName,$lastName,$otherName,$email,$phone,$position,$dateToday){
      $result= insert("INSERT INTO lecturer(lecID,facID,depID,firstName,lastName,otherName,email,phone,position,doe) VALUES('$lecID','$facID','$depID','$firstName','$lastName','$otherName','$email','$phone','$position','$dateToday') ");
      return $result;
    }

    public function updatelec($lecID,$facID,$depID,$firstName,$lastName,$otherName,$email,$phone,$position){
        $result = update("UPDATE lecturer SET facID='$facID', depID='$depID', firstName='$firstName', lastName='$lastName', otherName='$otherName', email='$email', phone='$phone', position='$position' WHERE lecID='$lecID'");
        return $result;
    }

    public function find_all_lec(){
      $result=query("SELECT * FROM lecturer");
      return $result;
    }

    public function find_all_lecdep($depID){
      $result=query("SELECT * FROM lecturer WHERE depID='$depID'");
      return $result;
    }

    public function find_by_lecID($lc){
      $result=query("SELECT * FROM lecturer WHERE lecID='$lc'");
      return $result;
    }

    public function checkphone($phone){
      $result=query("SELECT * FROM lecturer WHERE phone='$phone'");
      return $result;
    }

    public function checkmail($email){
      $result=query("SELECT * FROM users WHERE email='$email'");
      return $result;
    }

    public function find_by_facID($facID){
      $result=query("SELECT * FROM lecturer WHERE facID='$facID' ");
      return $result;
    }

    public function find_num_lec(){
      $result=query("SELECT * FROM lecturer");
      $num = count($result);
      return $num;
    }

    public function find_num_lecdep($depID){
      $result=query("SELECT * FROM lecturer WHERE depID='$depID'");
      $num = count($result);
      return $num;
    }

  }


  class Student{

    public function addstudent($studentID,$depID,$firstName,$lastName,$otherName,$email,$phone,$school,$level,$dateToday){
      $result= insert("INSERT INTO student(studentID,depID,firstName,lastName,otherName,email,phone,school,level,doe) VALUES('$studentID','$depID','$firstName','$lastName','$otherName','$email','$phone','$school','$level','$dateToday') ");
      return $result;
    }

    public function updateStudent($studentID,$depID,$firstName,$lastName,$otherName,$email,$phone,$school,$level){
        $result = update("UPDATE student SET depID='$depID', firstName='$firstName', lastName='$lastName', otherName='$otherName', email='$email', phone='$phone', school='$school', level='$level' WHERE studentID='$studentID'");
        return $result;
    }

    public function find_by_id($st){
      $result=query("SELECT * FROM student WHERE studentID='$st' ");
      return $result;
    }


    public function checkphone($phone){
      $result=query("SELECT * FROM student WHERE phone='$phone'");
      return $result;
    }

    public function checkmail($email){
      $result=query("SELECT * FROM users WHERE email='$email'");
      return $result;
    }

    public function find_all_student(){
      $result=query("SELECT * FROM student");
      return $result;
    }

    public function find_num_student(){
      $result=query("SELECT * FROM student");
      $num = count($result);
      return $num;
    }

    public function find_studentdep($depID){
      $result=query("SELECT * FROM student WHERE depID='$depID' ORDER BY level");
      return $result;
    }

    public function find_num_studentdep($depID){
      $result=query("SELECT * FROM student WHERE depID='$depID'");
      $num = count($result);
      return $num;
    }

  }


  class Course{

    public function addcourse($cID,$depID,$courseName,$level,$semester,$doe){
      $result= insert("INSERT INTO courses(cID,depID,courseName,level,semester,doe) VALUES('$cID','$depID','$courseName','$level','$semester','$doe') ");
      return $result;
    }

    public function updateCourse($cID,$courseName,$semester,$level){
        $result = update("UPDATE courses SET courseName='$courseName', level='$level', semester='$semester' WHERE cID='$cID'");
        return $result;
    }

    public function find_by_depID($depID){
      $result=query("SELECT * FROM courses WHERE depID='$depID' ORDER BY semester ");
      return $result;
    }

    public function find_all_courses(){
      $result=query("SELECT * FROM courses");
      return $result;
    }

    public function find_by_cID($cid){
      $result=query("SELECT * FROM courses WHERE cID='$cid'");
      return $result;
    }

    public function find_num_courses(){
      $result=query("SELECT * FROM courses");
      $num = count($result);
      return $num;
    }

    public function find_num_coursesdep($depID){
      $result=query("SELECT * FROM courses WHERE depID='$depID'");
      $num = count($result);
      return $num;
    }

  }



  class Cmanage{

    public function addcmanage($depID,$cID,$lecID,$doe){
      $result= insert("INSERT INTO cmanagement(depID,cID,lecID,doe) VALUES('$depID','$cID','$lecID','$doe') ");
      return $result;
    }

    public function updatecmanage($assignID,$lecID){
        $result = update("UPDATE cmanagement SET lecID='$lecID' WHERE assignID='$assignID'");
        return $result;
    }

    public function find_by_depID($depID){
      $result=query("SELECT * FROM cmanagement WHERE depID='$depID' ");
      return $result;
    }

    public function find_by_id($cm){
      $result=query("SELECT * FROM cmanagement WHERE assignID='$cm' ");
      return $result;
    }

    public function find_all_courses(){
      $result=query("SELECT * FROM cmanagement");
      return $result;
    }

    public function find_num_courses(){
      $result=query("SELECT * FROM cmanagement");
      $num = count($result);
      return $num;
    }

    public function find_num_coursesdep($depID){
      $result=query("SELECT * FROM cmanagement WHERE depID='$depID'");
      $num = count($result);
      return $num;
    }

  }




  class User{

    public function addUser($userID,$email,$password,$access,$flogin,$dateToday){
      $result= insert("INSERT INTO users(userID,email,password,access,flogin,doe) VALUES('$userID','$email','$password','$access','$flogin','$dateToday') ");
      return $result;
    }

    public function updateUser($facID,$facultyName){
        $result = update("UPDATE users SET facultyName='$facultyName' WHERE facID='$facID'");
        return $result;
    }

    public function signin($email,$password){
      $result=query("SELECT * FROM users WHERE email='$email' AND password='$password' ");
      return $result;
    }

    public function find_num_users(){
      $result=query("SELECT * FROM users");
      $num = count($result);
      return $num;
    }

  }
?>
