<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('db.php');
$student_name=$_POST['student_name'];
$student_roll_no=$_POST['student_roll_no'];
$student_class=$_POST['student_class'];
 
$stmt = $DBcon->prepare("INSERT INTO student(student_name,student_roll_no,student_class) VALUES(:student_name, :student_roll_no,:student_class)");
 
$stmt->bindparam(':student_name', $student_name);
$stmt->bindparam(':student_roll_no', $student_roll_no);
$stmt->bindparam(':student_class', $student_class);
if($stmt->execute())
{
  $res="Data Inserted Successfully:";
  echo json_encode($res);
}
else {
  $error="Not Inserted,Some Probelm occur.";
  echo json_encode($error);
}
 
 
 
 ?>